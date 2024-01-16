<?php
/**
* Application export administration
*
* @package    administration_application
* @version    1.0
* @date       16 July 2023
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$application_id = $ws->argGet('object_application_id');
if ($application_id == '') {
	$application_id = $ws->sessionGet('application_export_id');
}
else {
	$ws->sessionSet('application_export_id', $application_id);
}

$application = new object_application();
$application->procExport($application_id);

$ws->build('return');

?>
