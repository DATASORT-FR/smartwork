<?php
/**
* Category content administration
*
* @package    content_administration
* @version    1.0
* @date       19 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$category = new object_content_category(); /* Open content category class */
$category_select = $category->displaySelect('0', '');

$application = new object_application(); /* Open application class */
$application_select = $application->displaySelect('0', '');

/* display processing */
$connect = new object_connect();
$ws->assign('pageRef',$connect->constructHref($ws->paramGet('APP_CODE'), $ws->extractPage(__FILE__), 'command:list'));
$wcrud = new wcrud('object_content_category', $ws->extractPage(__FILE__));
$wcrud->titleSet(true); /* use Title */
$wcrud->pageSet(true); /* set processing type : true = in one box; false = force open new box */

$wlist = $wcrud->listGet();
$wlist->pagesizeSet(14); /* set number of lines for the list */
$wlist->pagesearchSet(true); /* show search input and button */
$wlist->pageorderSet(3); /* number of order type */
$wlist->columnidSet(true); /* show id column */
$wlist->displaysizeSet('small'); /* set list width */
$wlist->columnidpctSet(5); /* set percent size for id column */
$wlist->columnAdd('application_id',15); /* show application column */
$wlist->columnAdd('code',15); /* show code column */
$wlist->columnAdd('parent',15); /* show parent column */
$wlist->columnAdd('status',10); /* show parent column */
$wlist->columnAdd('label',30); /* show description column */
$wlist->columnactionpctSet(5); /* set percent size for edit and delete column */

$wlist->eventSet('btnew', true); /* show new button */
$wlist->eventSet('btevent', true); /* show edit button */
$wlist->eventfileSet('btevent', 'menu_feature'); /* php event file */
$wlist->eventboxSet('btevent', false);
$wlist->eventcommandSet('btevent', 'list');
$wlist->eventSet('btedit', true); /* show edit button */
$wlist->eventSet('btdelete', true); /* show delete button */

$wlist->deletecolumnnameSet('code'); /* column used in the delete confirmation window for the title */
	
$wcrud->fieldSet('code');
$wcrud->fieldSet('label');
$wcrud->fieldSet('status_id', 'choice');
$wcrud->fieldSet('parent_id', 'list', $category_select->returnGet());
$wcrud->fieldSet('description', 'textarea');
$wcrud->rowsSet('description', 6);
$wcrud->colsSet('description',100);
$wcrud->fieldSet('clear');
$wcrud->fieldSet('application_id', 'list', $application_select->returnGet());	

$wcrud->displayCrud();
?>
