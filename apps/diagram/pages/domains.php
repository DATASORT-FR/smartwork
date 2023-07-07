<?php
/**
* @package    use_domain
* @subpackage controller
* @version    1.0
* @date       20 februar 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$connect = new object_connect();
$ws->assign('pageRef',$connect->constructHref($ws->paramGet('APP_CODE'), $ws->extractPage(__FILE__), 'command:list'));

$wcrud = new wcrud('object_domain', $ws->extractPage(__FILE__));
$wcrud->titleSet(true); /* use Title */
$wcrud->pageSet(false); /* set processing type : true = in one box; false = force open new box */

$wlist = $wcrud->listGet();
$wlist->pageSet(true);
$wlist->pagesizeSet(14); /* set number of lines for the list */
$wlist->pagesearchSet(true); /* show search input and button */
$wlist->pageorderSet(2); /* number of order type */
$wlist->displaysizeSet('small'); /* set list width */
$wlist->columnidSet(false); /* show id column */

$wlist->sortSet(true); /* show or not the sort of columns. False by default */
$wlist->viewSet(true); /* show or not the columns selector. False by default */

$wlist->columnidpctSet(5); /* set percent size for id column */
$wlist->columnAdd('id', 5, false); /* show code column */
$wlist->columnAdd('name',25); /* show code column */
$wlist->columnAdd('label',55); /* show label column */
$wlist->columnactionpctSet(5); /* set percent size for edit and delete column */

$wlist->eventSet('btnew', true); /* show new button */
$wlist->eventSet('btevent', false); /* show edit button */
$wlist->eventSet('bttool', true); /* show tool button */
$wlist->eventfileSet('bttool', 'domains_copy'); /* php tool file */
$wlist->eventiconSet('bttool', 'clone'); /* php event icon */
$wlist->eventboxSet('bttool', true);
$wlist->eventSet('btedit', true); /* show edit button */
$wlist->eventSet('btdelete', true); /* show delete button */

$wlist->deletecolumnnameSet('name'); /* column used in the delete confirmation window for the title */
	
// line 1
$wcrud->fieldSet('name');
$wcrud->fieldSet('label');
	
$wcrud->displayCrud();
?>
