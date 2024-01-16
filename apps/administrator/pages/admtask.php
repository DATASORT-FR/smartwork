<?php
/**
* Tasks administration
*
* @package    administration_task
* @version    1.0
* @date       27 July 2023
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$command = $ws->argGet('command');

$connect = new object_connect();
$ws->assign('page_ref',$connect->constructHref($ws->paramGet('APP_CODE'), $ws->extractPage(__FILE__), 'command:list'));

$status = new object_task_status(); /* Open status class */
$status_select = $status->displaySelect()->returnGet();

$type = new object_task_type(); /* Open type class */
$type_select = $type->displaySelect()->returnGet();

$operation = new object_task_operation(); /* Open operation class */
$operation_select = $operation->displaySelect()->returnGet();

$wcrud = new wcrud('object_task', $ws->extractPage(__FILE__));
$wcrud->titleSet(true); /* use Title */
$wcrud->pageSet(false); /* set processing type : true = in one box; false = force open new box */

$wlist = $wcrud->listGet();
$wlist->titleSet(true);
$wlist->pageSet(true);
$wlist->pagesizeSet(15); /* set number of lines for the list */
$wlist->pagesearchSet(false); /* show search input and button */
$wlist->pageorderSet(0); /* number of order type */
$wlist->displaysizeSet('small'); /* set list width */
$wlist->columnidSet(false); /* show id column */

$wlist->sortSet(false); /* show or not the sort of columns. False by default */

//$wlist->columnidpctSet(5); /* set percent size for id column */
$wlist->columnAdd('operation',25); /* show code column */
$wlist->columnAdd('name',25); /* show code column */
$wlist->columnAdd('status',25); /* show code column */
$wlist->columnAdd('date_creation',20); /* show code column */
$wlist->columnactionpctSet(5); /* set percent size for edit and delete column */

$wlist->eventSet('btnew', true); /* show new button */
$wlist->eventSet('btevent', false); /* show edit button */
$wlist->eventSet('btedit', true); /* show edit button */
$wlist->eventSet('btdelete', true); /* show delete button */

$wlist->deletecolumnnameSet('name'); /* column used in the delete confirmation window for the title */

if (($command == 'new') or ($command == 'create')) {	

	// line 1
	$wcrud->fieldSet('status_id', 'hidden');
	$wcrud->fieldSet('date_status', 'hidden');

	// line 2
	$wcrud->fieldSet('type_id', 'list', $type_select);
	$wcrud->fieldColSizeSet('type_id',5);
	$wcrud->fieldLabelSizeSet('type_id', 2);

	$wcrud->fieldLineSet('operation_id', 'list', $operation_select);
	$wcrud->fieldColSizeSet('operation_id',7);
	$wcrud->fieldLabelSizeSet('operation_id', 2);
	
	// line 3
	$wcrud->fieldSet('code');
	$wcrud->fieldColSizeSet('code',5);
	$wcrud->fieldLabelSizeSet('code', 2);
	
	$wcrud->fieldLineSet('name');
	$wcrud->sizeSet('name', 30);
	$wcrud->fieldColSizeSet('name',7);
	$wcrud->fieldLabelSizeSet('name', 2);
	
	// line 4
	$wcrud->fieldSet('source_id');
	$wcrud->fieldColSizeSet('source_id',5);
	$wcrud->fieldLabelSizeSet('source_id', 2);
	
	$wcrud->fieldLineSet('target_id');
	$wcrud->fieldColSizeSet('target_id',5);
	$wcrud->fieldLabelSizeSet('target_id', 2);

	// line 5
	$wcrud->fieldSet('parameters', 'textarea');
	$wcrud->rowsSet('parameters', 10);
	$wcrud->colsSet('parameters',80);
	
}
if ($command == 'edit') {	

	// line 1
	$wcrud->fieldSet('date_creation');
	$wcrud->fieldColSizeSet('date_creation',5);
	$wcrud->fieldLabelSizeSet('date_creation', 2);
	$wcrud->readonlySet('date_creation');

	$wcrud->fieldLineSet('status_id', 'list', $status_select);
	$wcrud->sizeSet('status_id', 10);
	$wcrud->fieldColSizeSet('status_id',7);
	$wcrud->fieldLabelSizeSet('status_id', 2);
	$wcrud->readonlySet('status_id');
	
	$wcrud->fieldAppendSet('date_satus');
	$wcrud->sizeSet('date_satus', 10);
	$wcrud->readonlySet('date_satus');

	// line 2
	$wcrud->fieldSet('type_id', 'list', $type_select);
	$wcrud->fieldColSizeSet('type_id',5);
	$wcrud->fieldLabelSizeSet('type_id', 2);
	$wcrud->readonlySet('type_id');

	$wcrud->fieldLineSet('operation_id', 'list', $operation_select);
	$wcrud->fieldColSizeSet('operation_id',7);
	$wcrud->fieldLabelSizeSet('operation_id', 2);
	$wcrud->readonlySet('operation_id');
	
	// line 3
	$wcrud->fieldSet('code');
	$wcrud->fieldColSizeSet('code',5);
	$wcrud->fieldLabelSizeSet('code', 2);
	$wcrud->readonlySet('code');
	
	$wcrud->fieldLineSet('name');
	$wcrud->sizeSet('name', 30);
	$wcrud->fieldColSizeSet('name',7);
	$wcrud->fieldLabelSizeSet('name', 2);
	$wcrud->readonlySet('name');
	
	// line 4
	$wcrud->fieldSet('source_id');
	$wcrud->fieldColSizeSet('source_id',5);
	$wcrud->fieldLabelSizeSet('source_id', 2);
	$wcrud->readonlySet('source_id');
	
	$wcrud->fieldLineSet('target_id');
	$wcrud->fieldColSizeSet('target_id',5);
	$wcrud->fieldLabelSizeSet('target_id', 2);
	$wcrud->readonlySet('target_id');

	// line 5
	$wcrud->fieldSet('parameters', 'textarea');
	$wcrud->rowsSet('parameters', 10);
	$wcrud->colsSet('parameters',80);
	$wcrud->readonlySet('parameters');
	
	$wcrud->btresetSet(false);
	$wcrud->btokSet(false);

}

if ($command == 'create') {	
	$wcrud->valueSet('status_id', 0);
}

$wcrud->displayCrud();
?>
