<?php
/**
* Forum topics administration
*
* @package    forum_topic
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

$object = new BUS_object();
$status_select = $object->initSelect();
$status_select = $object->addSelect($status_select, "0", $ws->getConfigVars("Lbl_status_0"));
$status_select = $object->addSelect($status_select, "1", $ws->getConfigVars("Lbl_status_1"));

$subject = new object_forum_subject();
$subject_select = $subject->displaySelect('', '');

$wcrud = new wcrud('object_forum_topic', $ws->extractPage(__FILE__));
$wcrud->titleSet(true); /* use Title */
$wcrud->pageSet(false); /* set processing type : true = in one box; false = force open new box */

$wlist = $wcrud->listGet();
$wlist->pageSet(true);
$wlist->pagesizeSet(14); /* set number of lines for the list */
$wlist->pagesearchSet(true); /* show search input and button */
$wlist->pageorderSet(0); /* number of order type */
$wlist->displaysizeSet('small'); /* set list width */
$wlist->columnidSet(false); /* show id column */
$wlist->columnidpctSet(5); /* set percent size for id column */
$wlist->columnAdd('subject_name',10); /* show subject column */
$wlist->columnAdd('date_creation',20); /* show date column */
$wlist->columnAdd('author',10); /* show author column */
$wlist->columnAdd('status',20); /* show status column */
$wlist->columnAdd('label',40); /* show label column */
$wlist->columnactionpctSet(5); /* set percent size for edit and delete column */

$wlist->eventSet('btnew', true); /* show new button */
$wlist->eventSet('btedit', true); /* show edit button */
$wlist->eventSet('btdelete', true); /* show delete button */

$wlist->deletecolumnnameSet('label'); /* column used in the delete confirmation window for the title */
	
// line 1
$wcrud->fieldSet('subject_id', 'list', $subject_select->returnGet());
$wcrud->fieldLineSet('reference');
$wcrud->fieldLineSet('author');
$wcrud->fieldSet('status_id', 'list', $status_select);
$wcrud->fieldLineSet('ref_moderator');
$wcrud->fieldLineSet('moderator');
$wcrud->fieldSet('label');
$wcrud->fieldSet('description', 'comment');
$wcrud->rowsSet('description', 25);

$wcrud->displayCrud();

?>
