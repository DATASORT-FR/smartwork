<?php
/**
* This file contains App processing.
*
* @package   administration_script
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
	$traitFlag = true;
	$appId = $app['id'];
	$appStatusId = $app['status_id'];
	$appType = $app['apptype'];
	$appCode = $app['code'];
	$appName = $app['name'];
	$appDir = $app['dir'];
	$appCopyCode = $app['copy_code'];
	$appCopyName = $app['copy_name'];
	$appFlagAdmin = $app['flag_admin'];
	$dateExport = $app['date_export'];
	$dateImport = $app['date_import'];

	displayMsg($appCode, 'Application', 1);
	displayMsg('App control', '', 2);
	if (empty($appDir)) {
		displayMsg('Init dir App', '', 3);
		$appDir = $appName;
		try {
			$tbApplication = new Smart_record('adm_application');
			$tbApplication->fieldSet('dir', $appDir);
			$tbApplication->idSet($appId);
			$tbApplication->update();
		}
		catch (Exception $e) {
			displayMsg('Update Error', '', 2);
		}
	}

	if ($appFlagAdmin == 2) {
		displayMsg('App Not intitialized', '', 2);
		object_app_structure::initType($appId);
	}

	if ($appFlagAdmin == 3) {
		object_app_structure::rename($appId);
	}
	
	if ($appFlagAdmin == 4) {
		object_app_structure::copy($appId);
	}
	
	if ($appFlagAdmin == 5) {
		object_app_structure::export($appId);
		$dateExport = date('Y-m-d H:i:s');
	}

	if ($appFlagAdmin == 6) {
		object_app_structure::delete($appId);
	}

	if ($appFlagAdmin == 7) {
		if (!empty($appCopyName)) {
			object_app_structure::import($appId);
		}
	}
	
}

?>