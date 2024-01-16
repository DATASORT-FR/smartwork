<?php
/**
* Group rights administration
*
* @package    administration_group
* @version    1.0
* @date       19 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$group_id = '';
if ($ws->argGet('command') == 'list') {
	$group_id = $ws->paramGet('ID');
}
if ($group_id == '') {
	$group_id = $ws->sessionGet('object_group_id');
}
else {
	$ws->sessionSet('object_group_id', $group_id);
}

$group = new object_group(); /* Open group class */
$group_display = $group->display($group_id);
$application_id = $group_display->returnGet()['application_id'];
$group_code = $group_display->returnGet()['code'];

$feature = new object_feature(); /* Open menu features class */
$feature->filterSet('application_id',$application_id);
$feature_select = $feature->displaySelect("0", "")->returnGet();

$module = new object_module(); /* Open menu modules class */
$module_select = $module->displaySelect("0", "")->returnGet();

/* display processing */
$connect = new object_connect();
$ws->assign('page_ref',$connect->constructHref($ws->paramGet('APP_CODE'), $ws->extractPage(__FILE__), 'command:list'));
$wcrud = new wcrud('object_group_right', $ws->extractPage(__FILE__));
$wcrud->titleSet(true); /* use Title */
$wcrud->titleCodeSet($group_code);
$wcrud->pageSet(true); /* set processing type : true = in one box; false = force open new box */

$wlist = $wcrud->listGet();
$wlist->pagesizeSet(14); /* set number of lines for the list */
$wlist->pagesearchSet(true); /* show search input and button */
$wlist->pageorderSet(0); /* number of order type */
$wlist->columnidSet(true);
$wlist->displaysizeSet('small'); /* set list width */
$wlist->columnAdd('feature_code',25); /* show name column */
$wlist->columnAdd('module_code',25); /* show name column */
$wlist->columnAdd('right_read_label',9); /* show name column */
$wlist->columnAdd('right_create_label',9); /* show name column */
$wlist->columnAdd('right_update_label',9); /* show name column */
$wlist->columnAdd('right_delete_label',9); /* show name column */
$wlist->columnAdd('right_event_label',9); /* show name column */
$wlist->columnactionpctSet(5); /* set percent size for edit and delete column */

$wlist->eventSet('btnew', true); /* show new button */
$wlist->eventSet('btedit', true); /* show edit button */
$wlist->eventSet('btdelete', true); /* show delete button */
$wlist->eventSet('btclose', true); /* show close button */

$wlist->deletecolumnnameSet('code'); /* column used in the delete confirmation window for the title */

$wcrud->fieldSet('feature_id', 'list', $feature_select);
$wcrud->fieldSet('module_id', 'list', $module_select);
$wcrud->fieldSet('right_read');
$wcrud->fieldSet('right_create');
$wcrud->fieldSet('right_update');
$wcrud->fieldSet('right_delete');
$wcrud->fieldSet('right_event');
$wcrud->filterSet('group_id',$group_id);

$wcrud->displayCrud();
?>
