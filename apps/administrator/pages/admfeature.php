<?php
/**
* Features administration
*
* @package    administration_feature
* @version    1.0
* @date       19 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$application = new object_application(); /* Open application class */
$application_select = $application->displaySelect();

$connect = new object_connect();
$pageRef = $connect->constructHref($ws->paramGet('APP_CODE'), $ws->extractPage(__FILE__), 'command:list');
$ws->assign('pageRef',$pageRef);

$wcrud = new wcrud('object_feature', $ws->extractPage(__FILE__));
$wcrud->titleSet(true); /* use Title */
$wcrud->pageSet(true); /* set processing type : true = in one box; false = force open new box */

$wlist = $wcrud->listGet();
$wlist->pagesizeSet(14); /* set number of lines for the list */
$wlist->pagesearchSet(true); /* show search input and button */
$wlist->pageorderSet(4); /* number of order type */
$wlist->displaysizeSet('small'); /* set list width */
$wlist->columnidSet(true); /* show id column */
$wlist->columnidpctSet(5); /* set percent size for id column */
$wlist->columnAdd('application',17); /* show application column */
$wlist->columnAdd('code',17); /* show code column */
$wlist->columnAdd('label',50); /* show description column */
$wlist->columnactionpctSet(5); /* set percent size for edit and delete column */

$wlist->eventSet('btnew', true); /* show new button */
$wlist->eventSet('btedit', true); /* show edit button */
$wlist->eventSet('btdelete', true); /* show delete button */

$wlist->deletecolumnnameSet('code'); /* column used in the delete confirmation window for the title */
	
$wcrud->fieldSet('code', 'text');
$wcrud->fieldSet('label', 'text');
$wcrud->fieldSet('clear');
$wcrud->fieldSet('application_id', 'list', $application_select->returnGet());

$wcrud->displayCrud();
?>
