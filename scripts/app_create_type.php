<?php
/**
* This file contains home page processing.
*
* Variables declaration 
*      $ws object workspace 
*
* @package    global
* @subpackage controller
* @version   1.1
* @date      20 November 2013
* @author    Alain VANDEPUTTE
* @copyright datasort.fr
*/

$ws = Workspace::ws_open();

if (!$ws->script()) {
	die();	
}

// Main
displayMsg('Begin process', '', 1);

$appId = 1; 
$tbApplication = new Smart_select('adm_application');
$tbApplication->fieldAll();
$tbApplication->whereSet('id', $appId);
$app = $tbApplication->find();
if (!empty($app)) {
	$appCode = $app['code'];
	displayMsg($appCode, 'Sauvegarde App Type', 2);
	$appName = $app['name'];
	$appDir = $app['dir'];
	$namePath = SITE_ROOT_DIR . APPS_PATH . $appDir;
	$typePath = SITE_ROOT_DIR . BASE_PATH . $appName;
	if (file_exists($namePath)) {
		displayMsg('Copie des fichiers vers ' . $typePath, '', 3);
		xcopy($namePath, $typePath);
	}
	displayMsg('Copie structure ' . $appCode, '', 3);
	object_app_structure::createType($appId);
}

?>
