<?php
/**
* Forum categories administration
*
* @package    forum_administration
* @version    1.0
* @date       29 December 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$connect = new object_connect();
$ws->assign('pageRef',$connect->constructHref($ws->paramGet('APP_CODE'), $ws->extractPage(__FILE__), 'command:list'));

$application = new object_application(); /* Open application class */
$application_select = $application->displaySelect('', '', 'code');

$wcrud = new wcrud('object_forum_category', $ws->extractPage(__FILE__));
$wcrud->titleSet(true); /* use Title */
$wcrud->pageSet(false); /* set processing type : true = in one box; false = force open new box */

$wlist = $wcrud->listGet();
$wlist->pageSet(true);
$wlist->pagesizeSet(14); /* set number of lines for the list */
$wlist->pagesearchSet(true); /* show search input and button */
$wlist->pageorderSet(0); /* number of order type */
$wlist->displaysizeSet('small'); /* set list width */
$wlist->columnidSet(false); /* show id column */
$wlist->columnidpctSet(0); /* set percent size for id column */
$wlist->columnAdd('application',20); /* show label column */
$wlist->columnAdd('name',30); /* show label column */
$wlist->columnAdd('label',50); /* show label column */
$wlist->columnactionpctSet(5); /* set percent size for edit and delete column */

$wlist->eventSet('btnew', true); /* show new button */
$wlist->eventSet('btevent', true); /* show edit button */
$wlist->eventboxSet('btevent', false);
$wlist->eventiconSet('btevent', 'arrow-up');
$wlist->eventcommandSet('btevent', 'levelUp');
$wlist->eventSet('btedit', true); /* show edit button */
$wlist->eventSet('btdelete', true); /* show delete button */

$wlist->deletecolumnnameSet('name'); /* column used in the delete confirmation window for the title */
	
// line 1
$wcrud->commandSet('levelUp', 'levelUp');
$wcrud->fieldSet('name');
$wcrud->fieldSet('label');
$wcrud->fieldSet('application', 'list', $application_select->returnGet());
$wcrud->displayCrud();
?>
