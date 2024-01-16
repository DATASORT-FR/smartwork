<?php
/**
* Mediamanager : new directory page
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
$createDirRef = $connect->constructHref($ws->paramGet('APP_CODE'), "mediacreatedir", "module:mediamanager");

$moduleMedia = new Wmedia();
$smarty = new workpage();
$moduleMedia->initSmarty($smarty);
$smarty->assign('createDirRef', $createDirRef);
$smarty->display('medianewdir.tpl');
?>
