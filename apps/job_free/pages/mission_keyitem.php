<?php
/**
* Mission administration file for Job freelance 
*
* @package    ob Freelance
* @subpackage controller
* @version    1.0
* @date       15 November 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

// Main
$missionReference = $_SESSION['object_mission_ref'];

$keyitem = new object_keyitem(); /* Open menu features class */
$keyitem->filterSet('item_id',$missionReference);

$wcrud = new wcrud('object_keyitem', 'mission_keyitem', 'mission_keyitem');
$wcrud->titleSet(false); /* use Title */
$wcrud->titleCodeSet($missionReference);
$wcrud->pageSet(true);

$wlist = $wcrud->listGet();
$wlist->pagesizeSet(14); /* set number of lines for the list */
$wlist->pagesearchSet(false); /* show search input and button */
$wlist->pageorderSet(0); /* number of order type */
$wlist->displaysizeSet('large'); /* set list width */
$wlist->columnAdd('key_name',15); /* show name column */
$wlist->columnAdd('function',15); /* show name column */
$wlist->columnAdd('search',50); /* show name column */
$wlist->columnAdd('word',20); /* show ref column */
$wlist->columnactionpctSet(5); /* set percent size for edit and delete column */
$wlist->eventSet('btnew', false); /* show new button */
$wlist->eventSet('btedit', false); /* show edit button */
$wlist->eventSet('btdelete', false); /* show delete button */
$wlist->eventSet('btclose', false); /* show close button */
$wlist->deletecolumnnameSet('key_name'); /* column used in the delete confirmation window for the title */

$wcrud->fieldSet('key_name');
$wcrud->fieldSet('function');
$wcrud->fieldSet('search');
$wcrud->fieldSet('word');
$wcrud->filterSet('item_id',$missionReference);

$wcrud->displayCrudList();
?>
