<?php
/**
* Mediamanager : files list
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
$path = $ws->argGet('path');

$listFile = array();
$moduleMedia = new Wmedia();
if ($ws->paramGet('MEDIA_RIGHT_READ') == 1) {
	$listFile = $moduleMedia->fileList($path);
}

$smarty = new workpage();
$moduleMedia->initSmarty($smarty);
$smarty->assign('listFile', $listFile);
$smarty->display('listpath.tpl');

?>
