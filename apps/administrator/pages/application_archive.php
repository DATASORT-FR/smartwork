<?php
/**
* @package    application_archive
* @subpackage controller
* @version    1.0
* @date       19 Februar 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$application_id = $ws->argGet('object_application_id');
if ($application_id == '') {
	$application_id = $ws->sessionGet('application_archive_id');
}
else {
	$ws->sessionSet('application_archive_id', $application_id);
}

$application = new object_application();
$application->procArchive($application_id);

$ws->build('return');

?>
