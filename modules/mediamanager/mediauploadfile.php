<?php
/**
* Mediamanager : upload process
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
$base = $ws->argPost('base');

if ($ws->paramGet('MEDIA_RIGHT_CREATE') == 1) {
	$moduleMedia = new Wmedia();
	$moduleMedia->uploadFile($base, 'name');
}
?>
