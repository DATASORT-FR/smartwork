<?php
/**
* diagram results edit
*
* @package    use_field
* @subpackage controller
* @version    1.0
* @date       28 September 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$connect = new object_connect();
$ws->assign('pageRef',$connect->constructHref($ws->paramGet('APP_CODE'), $ws->extractPage(__FILE__), 'command:list'));

if ($domainId != '') {

	$resultType = new object_result_type();
	$resultType_select = $resultType->displaySelect()->returnGet();
	$resultCategory = new object_result_category();
	$resultCategory->filterSet('domain_id', $domainId);
	$resultCategory_select = $resultCategory->displaySelect()->returnGet();

	$wcrud = new wcrud('object_field_result', $ws->extractPage(__FILE__));
	$wcrud->titleSet(true); /* use Title */
	$wcrud->pageSet(false); /* set processing type : true = in one box; false = force open new box */

	$wlist = $wcrud->listGet();
	$wlist->pageSet(true);
	$wlist->pagesizeSet(10, 20, 50); /* set number of lines for the list */
	$wlist->pagesearchSet(true); /* show search input and button */
	$wlist->pageorderSet(0); /* number of order type */
	$wlist->displaysizeSet('small'); /* set list width */
	$wlist->columnidSet(false); /* show id column */

	$wlist->sortSet(true); /* show or not the sort of columns. False by default */
	$wlist->viewSet(true); /* show or not the columns selector. False by default */
//	$wlist->filterViewSet('name'); /* display a filter field */
	$wlist->filterViewSet('category_id', 'list', $resultCategory_select); /* display a filter field */
	$wlist->filterViewSet('type_id', 'list', $resultType->displaySelect('0','')->returnGet()); /* display a filter field */
	
	$wlist->columnidpctSet(5); /* set percent size for id column */
	$wlist->columnAdd('category_name',15);
	$wlist->columnAdd('name',15); /* show code column */
	$wlist->columnAdd('type',8); /* show code column */
	$wlist->columnAdd('label',35); /* show label column */
	$wlist->columnAdd('nodisplay', 10, false); /* show nodisplay flag column */
	$wlist->columnAdd('line', 10, false); /* show line flag column */
	$wlist->columnactionpctSet(3); /* set percent size for edit and delete column */

	$wlist->eventSet('btnew', true); /* show new button */
	$wlist->eventSet('btevent', true);
	$wlist->eventboxSet('btevent', false);
	$wlist->eventiconSet('btevent', 'arrow-up');
	$wlist->eventcommandSet('btevent', 'levelUp');
	$wlist->eventSet('bttool', true); /* show tool button */
	$wlist->eventfileSet('bttool', 'results_copy'); /* php tool file */
	$wlist->eventiconSet('bttool', 'clone'); /* php event icon */
	$wlist->eventboxSet('bttool', true);
	$wlist->eventSet('btedit', true); /* show edit button */
	$wlist->eventSet('btdelete', true); /* show delete button */

	$wlist->deletecolumnnameSet('name'); /* column used in the delete confirmation window for the title */	
	$wcrud->commandSet('levelUp', 'levelUp');

	$wcrud->fieldSet('name');
	$wcrud->fieldLineSet('nodisplay', 'choice');
	$wcrud->fieldSet('type_id', 'list', $resultType_select);
	$wcrud->fieldLineSet('category_id', 'list', $resultCategory_select);
	$wcrud->fieldLineSet('line', 'choice');
	$wcrud->fieldDisplayOnlySet('line', 'nodisplay', '0');
	$wcrud->fieldSet('label');

	$wcrud->fieldSet('display_func', 'textarea');
	$wcrud->rowsSet('display_func', 4);
	$wcrud->colsSet('display_func',100);
	$wcrud->fieldDisplayOnlySet('display_func', 'nodisplay', '0');
	
	$wcrud->fieldSet('formula', 'textarea');
	$wcrud->rowsSet('formula', 4);
	$wcrud->colsSet('formula',100);
	$wcrud->fieldSet('description', 'editor');
	$wcrud->fieldLabelSet('description', true);
	$wcrud->rowsSet('description', 15);

	$wcrud->initValueSet('line', 0);
	$wcrud->filterSet('domain_id',$domainId);
	$wcrud->filterSet('nature',3);
	$wcrud->displayCrud();
}
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'home.php';
	require_once($filePath);
}
?>
