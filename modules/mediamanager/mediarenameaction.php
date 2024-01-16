<?php
/**
* Mediamanager : rename process
*
* @package    module_mediamanager
* @version    1.0
* @date       19 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

// Main
$path = $ws->argPost('path');
$oldName = $ws->argPost('filename');
$name = $ws->argPost('name');
$oldFile = $path . $oldName;
$newFile = $path . $name;

if ($ws->paramGet('MEDIA_RIGHT_UPDATE') == 1) {
	$moduleMedia = new Wmedia();
	$moduleMedia->renameFile($oldFile, $newFile);
}
?>
