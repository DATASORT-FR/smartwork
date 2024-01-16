<?php
/**
* Application import administration
*
* @package    administration_application
* @version    1.0
* @date       27 July 2023
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));

$source = $ws->argPost('source');
$name = $ws->argPost('name');
$code = $ws->argPost('code');
$copyContent = $ws->argPost('copy_content');

if (empty($source)) {
	$ws->control('application_import.tpl');
	initWorkConfig($ws, 'application_import');

	$listSource = array();
	$list = array_diff(scandir($ws->paramGet('ARCHIVE_DIR')), array('..', '.'));
	foreach ($list as $fileName) {
		$file = $ws->paramGet('ARCHIVE_DIR') . $fileName;
		if (is_dir($file)) {
			$listSource[] = $fileName;
		}
	}
	$ws->assign('ListSource', $listSource);

	$connect = new object_connect();
	$importtAction = $connect->constructHref($ws->paramGet('APP_CODE'), "admapplication_import");
	$ws->assign('ImporttAction', $importtAction);

	$ws->caching = false;
	$ws->build('application_import.tpl');
}
else {
//displayMsg('Traitement application import');

	$application = new object_application();
	$application->procImport($source, $name, $code, $copyContent);
	$ws->build('return');
}
?>
