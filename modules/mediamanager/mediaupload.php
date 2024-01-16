<?php
/**
* Mediamanager : upload page
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
$uploadFileRef = $connect->constructHref($ws->paramGet('APP_CODE'), "mediauploadfile", "module:mediamanager");

$moduleMedia = new Wmedia();
$smarty = new workpage();
$moduleMedia->initSmarty($smarty);
$smarty->assign('uploadFileRef', $uploadFileRef);
$smarty->display('mediaupload.tpl');
?>
