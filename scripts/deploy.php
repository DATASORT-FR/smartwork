<?php
/**
* This file contains Smartwork Deploy processing.
*
* @package   administration_script
* @version   1.0
* @date      29 November 2023
* @author    Alain VANDEPUTTE
* @copyright datasort.fr
*/

$ws = Workspace::ws_open();

if (!$ws->script()) {
	die();	
}

define('TYPE_FULL', 1);
define('TYPE_NOCOMPLETE', 2);
define('TYPE_FULL_EXCEPT', 3);

// Params
$dirArray = array(
	'apps' =>  array(
		'path' => APPS_PATH,
		'type' => TYPE_NOCOMPLETE,
		'right' => RIGHT_READ
	),
	'apps/administrator' =>  array(
		'path' => APPS_ADMINISTRATOR_PATH,
		'type' => TYPE_FULL,
		'right' => RIGHT_READ
	),
	'archive' =>  array(
		'path' => ARCHIVE_PATH,
		'type' => TYPE_NOCOMPLETE,
		'right' => RIGHT_READ
	),
	'backup' =>  array(
		'path' => BACKUP_PATH,
		'type' => TYPE_NOCOMPLETE,
		'right' => RIGHT_READ
	),
	'cache' =>  array(
		'path' => CACHE_PATH,
		'type' => TYPE_NOCOMPLETE,
		'right' => RIGHT_UPDATE
	),
	'compile' =>  array(
		'path' => COMPILE_PATH,
		'type' => TYPE_NOCOMPLETE,
		'right' => RIGHT_UPDATE
	),
	'default' =>  array(
		'path' => DEFAULT_PATH,
		'type' => TYPE_FULL,
		'right' => RIGHT_READ
	),
	'docs' =>  array(
		'path' => DOCS_PATH,
		'type' => TYPE_FULL,
		'right' => RIGHT_READ
	),
	'files' =>  array(
		'path' => FILES_PATH,
		'type' => TYPE_NOCOMPLETE,
		'right' => RIGHT_UPDATE
	),
	'images' =>  array(
		'path' => IMAGES_PATH,
		'type' => TYPE_NOCOMPLETE,
		'right' => RIGHT_UPDATE
	),
	'images/administrator' =>  array(
		'path' => IMAGES_ADMINISTRATOR_PATH,
		'type' => TYPE_FULL,
		'right' => RIGHT_UPDATE
	),
	'includes' =>  array(
		'path' => INCLUDES_PATH,
		'type' => TYPE_FULL_EXCEPT,
		'right' => RIGHT_READ
	),
	'classes' =>  array(
		'path' => CLASSES_PATH,
		'type' => TYPE_FULL,
		'right' => RIGHT_READ
	),
	'models' =>  array(
		'path' => MODELS_PATH,
		'type' => TYPE_FULL,
		'right' => RIGHT_READ
	),
	'init' =>  array(
		'path' => INIT_PATH,
		'type' => TYPE_FULL,
		'right' => RIGHT_READ
	),
	'language' => array(
		'path' => LANGUAGE_PATH,
		'type' => TYPE_FULL,
		'right' => RIGHT_READ
	),
	'libs' =>  array(
		'path' => LIBS_PATH,
		'type' => TYPE_FULL,
		'right' => RIGHT_READ
	),
	'logs' =>  array(
		'path' => LOGS_PATH,
		'type' => TYPE_NOCOMPLETE,
		'right' => RIGHT_UPDATE
	),
	'modules' =>  array(
		'path' => MODULES_PATH,
		'type' => TYPE_FULL,
		'right' => RIGHT_READ
	),
	'pages' =>  array(
		'path' => PAGES_PATH,
		'type' => TYPE_FULL,
		'right' => RIGHT_READ
	),
	'plugins' =>  array(
		'path' => PLUGINS_PATH,
		'type' => TYPE_FULL,
		'right' => RIGHT_READ
	),
	'scripts' =>  array(
		'path' => SCRIPTS_PATH,
		'type' => TYPE_FULL,
		'right' => RIGHT_READ
	),
	'templates' =>  array(
		'path' => TEMPLATES_PATH,
		'type' => TYPE_FULL,
		'right' => RIGHT_READ
	),
	'uploads' =>  array(
		'path' => UPLOADS_PATH,
		'type' => TYPE_NOCOMPLETE,
		'right' => RIGHT_UPDATE
	),
	'workspace' => array(
		'path' => WORKSPACE_PATH,
		'type' => TYPE_FULL,
		'right' => RIGHT_READ
	),
);

// Functions
function deployPath($sourcePath, $ciblePath, $type = TYPE_FULL, $right = RIGHT_READ) {
	$return = true;

	switch($type) {
		case TYPE_FULL :
			if (file_exists($ciblePath)) {
				xdelete($ciblePath);
			}
			xcopy($sourcePath, $ciblePath, $right);
			displayMsg('Delete and copy directories/files to ' . $ciblePath, '', 3);
			break;
		case TYPE_NOCOMPLETE :
			xmkdir($ciblePath, $right);
			displayMsg('Create ' . $ciblePath, '', 3);
			break;
		case TYPE_FULL_EXCEPT :
			xmkdir($ciblePath, $right);
			foreach (scandir($sourcePath) as $file) {
				if ($file != 'config.php') {
					if (!is_dir($sourcePath . '/' . $file)) {
						xcopy($sourcePath . '/' . $file, $ciblePath . '/' . $file, $right);
					}
				}
				else {
					if (!file_exists($ciblePath . '/' . $file)) {
						xcopy($sourcePath . '/' . $file, $ciblePath . '/' . $file, $right);
					}
				}
			}
			displayMsg('Create and copy only files from to ' . $ciblePath, '', 3);
			break;
		default :
			displayMsg('Analyse ' . $ciblePath, '', 3);
			if (file_exists($ciblePath)) {
				displayMsg('Files already exist', '', 4);
			}
	}
	
	return $return;
}

// Main
$cibleDir = $ws->argGet(0);
$cibleDir = xpath($cibleDir);
if (!empty($cibleDir)) {
	displayMsg($cibleDir, 'Begin deploy process to ', 1);

	foreach($dirArray as $dirKey=>$dirItem) {
		displayMsg($dirKey . ' files copy', '', 2);
		$source = SITE_ROOT_DIR . $dirItem['path'];
		$cible = $cibleDir . $dirItem['path'];
		$type = $dirItem['type'];
		$right = $dirItem['right'];
		deployPath($source, $cible, $type);
	}
	foreach (scandir(SITE_ROOT_DIR) as $file) {
		if (!is_dir(SITE_ROOT_DIR . $file)) {
			displayMsg('Copy file to ' . $cibleDir . $file, '', 2);
			xcopy(SITE_ROOT_DIR . $file, $cibleDir . $file, RIGHT_READ);
		}
	}

}

?>