<?php
/**
* This file contains App processing.
*
* Variables declaration 
*      $ws object workspace 
*
* @package    global
* @subpackage controller
* @version   1.0
* @date      04 April 2020
* @author    Alain VANDEPUTTE
* @copyright datasort.fr
*/

$ws = Workspace::ws_open();

if (!$ws->script()) {
	die();	
}

// Main
displayMsg('Begin process', '', 1);

$tbApplication = new Smart_select('adm_application');
$tbApplication->fieldAll();
$apps = $tbApplication->findAll();
foreach($apps as $key=>$app) {
	$appId = $app['id'];
	$appName = $app['name'];
	$appDir = $app['dir'];
}

$tbApplication = new Smart_select('adm_application');
$tbApplication->fieldAll();
$apps = $tbApplication->findAll();
foreach($apps as $key=>$app) {
	$traitFlag = true;

	$appId = $app['id'];
	$appStatusId = $app['status_id'];
	$appTypeId = $app['apptype_id'];
	$appCode = $app['code'];
	$appName = $app['name'];
	$appDir = $app['dir'];
	$appCopyCode = $app['copy_code'];
	$appCopyName = $app['copy_name'];
	$appFlagArchive = $app['flag_archive'];
	$dateArchive = $app['date_archive'];
	if (empty($appDir)) {
		displayMsg('Init dir App', '', 3);
		$appDir = $appName;
	}
	$dirPath = SITE_ROOT_DIR . APPS_PATH . $appDir;

	displayMsg($appCode, 'Application', 2);

	if ($appStatusId == -1) {
		displayMsg('Delete App', '', 3);
		$traitFlag = false;
		object_app_structure::delete($appId);
		if (file_exists($dirPath)) {
			xdelete($dirPath);
		}
	}
	
	if (($traitFlag) and ($appDir != $appName)) {
		displayMsg('Rename App', '', 3);
		$namePath = SITE_ROOT_DIR . APPS_PATH . $appName;
		if ((!file_exists($namePath)) and (file_exists($dirPath))) {
			rename($dirPath, $namePath);
		}
		$appDir = $appName;
		$dirPath = SITE_ROOT_DIR . APPS_PATH . $appDir;
	}
	
	if (($traitFlag) and (!file_exists($dirPath))) {
		displayMsg('App Not intitialized', '', 3);

		$appTypeName = 'default';
		$tbAppType = new Smart_select('adm_apptype');
		$tbAppType->fieldAll();
		$tbAppType->whereSet('id', $appTypeId);
		$appType = $tbAppType->find();
		if (!empty($appType)) {
			if (file_exists($ws->paramGet('BASE_DIR') . $appType['name'])) {
				$appTypeName = $appType['name'];
			}
			object_app_structure::initType($appId, $appTypeId);
		}
		$sourcePath = $ws->paramGet('BASE_DIR') . $appTypeName;
		if ((!file_exists($dirPath)) and (file_exists($sourcePath))) {
			displayMsg('Copy files from ' . $appTypeName, '', 4);
			xcopy($sourcePath, $dirPath);
		}
		
	}
	
	if (($traitFlag) and (!empty($appCopyCode))) {
		displayMsg('Copy App', '', 3);
		$tbApplication = new Smart_select('adm_application');
		$tbApplication->fieldAll();
		$tbApplication->whereSet('code', $appCopyCode);
		$appCible = $tbApplication->find();
		if (empty($appCible)) {
			if (!empty($appCopyName)) {
				$copyNamePath = SITE_ROOT_DIR . APPS_PATH . $appCopyName;
				if ((file_exists($dirPath)) and (!file_exists($copyNamePath))) {
					displayMsg('Copie des fichiers vers ' . $appCopyName, '', 4);
					xcopy($dirPath, $copyNamePath);
				}
			}
			object_app_structure::copy($appId);
		}
		else {
			displayMsg('Application cible deja existante', '', 4);
		}
		$appCopyCode = '';
	}
	$appCopyName = '';
	
	if (($traitFlag) and ($appFlagArchive == 1)) {
		displayMsg('Archive App', '', 3);
		$archiveNamePath = SITE_ROOT_DIR . ARCHIVE_PATH . $appName;
		if (file_exists($dirPath)) {
			if (file_exists($archiveNamePath)) {
				xdelete($archiveNamePath);
			}
			displayMsg('Copie des fichiers vers ' . $archiveNamePath, '', 4);
			xcopy($dirPath, $archiveNamePath);
		}
		object_app_structure::archive($appId);
		$dateArchive = date('Y-m-d H:i:s');
		$appFlagArchive = 0;
	}
	
	if ($traitFlag) {
		try {
			$tbApplication = new Smart_record('adm_application');
			$tbApplication->fieldSet('dir', $appDir);
			$tbApplication->fieldSet('copy_code', $appCopyCode);
			$tbApplication->fieldSet('copy_name', $appCopyName);
			$tbApplication->fieldSet('flag_archive', $appFlagArchive);
			$tbApplication->fieldSet('date_archive', $dateArchive);
			$tbApplication->idSet($appId);
			$tbApplication->update();
		}
		catch (Exception $e) {
			displayMsg('Update Error', '', 2);
		}
	}
	
}

?>