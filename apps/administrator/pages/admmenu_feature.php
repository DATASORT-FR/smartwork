<?php
/**
* Menu features administration
*
* @package    administration_menu
* @version    1.0
* @date       19 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$menu_id = '';	
if ($ws->argGet('command') == 'list') {
	$menu_id = $ws->paramGet('ID');
}
if ($menu_id != '') {
	$ws->sessionSet('object_menu_id4', $menu_id);
}
else {
	$menu_id = $ws->sessionGet('object_menu_id4');
}

$object = new BUS_object();
$ope_select = $object->initSelect();
$ope_select = $object->addSelect($ope_select, '1', '==');
$ope_select = $object->addSelect($ope_select, '2', '!=');
$ope_select = $object->addSelect($ope_select, '3', '>=');
$ope_select = $object->addSelect($ope_select, '4', '<=');

$connect = new object_connect();
$ws->assign('page_ref',$connect->constructHref($ws->paramGet('APP_CODE'), $ws->extractPage(__FILE__), 'command:list'));
$menu = new object_menu(); /* Open menu class */
$menu_display = $menu->display($menu_id);
$application_id = $menu_display->returnGet()['application_id'];
$menu_title = $menu_display->returnGet()['title'];

$menu_feature = new object_menu_feature(); /* Open menu features class */
$menu_feature->filterSet('menu_id',$menu_id);
$menu_feature->filterSet('parent_id',0);
$menu_feature_parent_select = $menu_feature->displaySelect("0", "")->returnGet();

$feature = new object_feature();
$feature->filterSet('application_id',$application_id);
$feature_select = $feature->displaySelect("0", "")->returnGet();

/* display processing */
$wcrud = new wcrud('object_menu_feature', $ws->extractPage(__FILE__));
$wcrud->titleSet(true); /* use Title */
$wcrud->titleCodeSet($menu_title);
$wcrud->pageSet(true); /* set processing type : true = in one box; false = force open new box */

$wlist = $wcrud->listGet();
$wlist->pagesizeSet(14); /* set number of lines for the list */
$wlist->pagesearchSet(true); /* show search input and button */
$wlist->pageorderSet(0); /* number of order type */
$wlist->displaysizeSet('small'); /* set list width */
$wlist->columnAdd('name',30); /* show name column */
$wlist->columnAdd('feature',20); /* show name column */
$wlist->columnAdd('ref',20); /* show ref column */
$wlist->columnAdd('content_id',20); /* show ref Id column */
$wlist->columnactionpctSet(5); /* set percent size for edit and delete column */

$wlist->eventSet('btnew', true); /* show new button */
$wlist->eventSet('btevent', true); /* show edit button */
$wlist->eventboxSet('btevent', false);
$wlist->eventiconSet('btevent', 'arrow-up');
$wlist->eventcommandSet('btevent', 'levelUp');
$wlist->eventSet('btedit', true); /* show edit button */
$wlist->eventSet('btdelete', true); /* show delete button */
$wlist->eventSet('btclose', true); /* show close button */

$wlist->deletecolumnnameSet('code'); /* column used in the delete confirmation window for the title */

$wcrud->commandSet('levelUp', 'levelUp');
$wcrud->fieldSet('name');
$wcrud->fieldSet('ref');
$wcrud->fieldSet('content_id');
$wcrud->fieldSet('parent_id', 'list', $menu_feature_parent_select);
$wcrud->fieldSet('feature_id', 'list', $feature_select);
$wcrud->fieldSet('infos', 'group');
	$wcrud->fieldSet('page');
	$wcrud->fieldSet('class');
	$wcrud->fieldSet('icon');
	$wcrud->fieldSet('icon_only');
$wcrud->fieldSet('infos_end', 'groupend');
//$wcrud->fieldSet('display', 'group');
//	$wcrud->fieldSet('display_field');
//	$wcrud->fieldAppendSet('display_ope', 'list', $ope_select);
//	$wcrud->fieldAppendSet('display_value');
//$wcrud->fieldSet('display_end', 'groupend');

$wcrud->filterSet('menu_id',$menu_id);

$wcrud->displayCrud();
?>
