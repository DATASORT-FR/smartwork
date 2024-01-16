<?php
/**
* Application copy administration
*
* @package    administration_application
* @version    1.0
* @date       2 April 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

//$application_id = $ws->argGet('object_application_id');
$application_id = $ws->argPost('id');
if ($application_id == '') {
	$application_id = $ws->sessionGet('application_copy_id');
}
else {
	$ws->sessionSet('application_copy_id', $application_id);
}

$connect = new object_connect();
$ws->assign('page_ref',$connect->constructHref($ws->paramGet('APP_CODE'), $ws->extractPage(__FILE__), 'command:list'));

$wcrud = new wcrud('object_application', $ws->extractPage(__FILE__));
$wcrud->titleSet(false); /* use Title */
$wcrud->pageSet(true); /* set processing type : true = in one box; false = force open new box */

$wcrud->fieldSet('copy_code');
$wcrud->fieldLabelSizeSet('copy_code', 3);
$wcrud->requiredSet('copy_code');

$wcrud->fieldSet('copy_name');
$wcrud->fieldLabelSizeSet('copy_name', 3);
$wcrud->requiredSet('copy_name');

$wcrud->fieldSet('copy_content', 'choice');
$wcrud->fieldLabelSizeSet('copy_content', 3);

$wcrud->filterSet('flag_admin',4);

$wcrud->displayCrudEdit($application_id);

?>
