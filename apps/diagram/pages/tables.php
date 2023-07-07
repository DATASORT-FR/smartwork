<?php
/**
* diagram tables edit
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

	$tableType = new object_table_type();
	$tableType_select = $tableType->displaySelect()->returnGet();

	$wcrud = new wcrud('object_field_table', $ws->extractPage(__FILE__));
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

	$wlist->columnidpctSet(5); /* set percent size for id column */
	$wlist->columnAdd('name',20); /* show code column */
	$wlist->columnAdd('type',10); /* show type column */
	$wlist->columnAdd('label',60); /* show label column */
	$wlist->columnactionpctSet(5); /* set percent size for edit and delete column */

	$wlist->eventSet('btnew', true); /* show new button */
	$wlist->eventSet('bttool', true); /* show tool button */
	$wlist->eventfileSet('bttool', 'tables_copy'); /* php tool file */
	$wlist->eventiconSet('bttool', 'clone'); /* php event icon */
	$wlist->eventboxSet('bttool', true);
	$wlist->eventSet('btedit', true); /* show edit button */
	$wlist->eventSet('btdelete', true); /* show delete button */

	$wlist->deletecolumnnameSet('name'); /* column used in the delete confirmation window for the title */	

	$wcrud->fieldSet('name');
	$wcrud->fieldLineSet('type_id', 'list', $tableType_select);
	$wcrud->fieldSet('label');
	
	$wcrud->fieldSet('col1_field');
	$wcrud->fieldLineSet('col1_byrange', 'choice');

	$wcrud->fieldSet('col2_field');
	$wcrud->fieldLineSet('col2_byrange', 'choice');
	$wcrud->fieldDisplayOnlySet('col2_field', 'col1_field', '', '!=');
	$wcrud->fieldDisplayOnlySet('col2_byrange', 'col1_field', '', '!=');

	$wcrud->fieldSet('col3_field');
	$wcrud->fieldLineSet('col3_byrange', 'choice');
	$wcrud->fieldDisplayOnlySet('col3_field', 'col2_field', '', '!=');
	$wcrud->fieldDisplayOnlySet('col3_byrange', 'col2_field', '', '!=');

	$wcrud->fieldSet('table_data', 'datagrid');
	$wcrud->datagridSet('col1_min');
	$wcrud->datagridSet('col1_max');
	$wcrud->fieldDisplayOnlySet('col1_max', 'col1_byrange', 1);
	$wcrud->datagridSet('col2_min');
	$wcrud->datagridSet('col2_max');
	$wcrud->fieldDisplayOnlySet('col2_min', 'col2_field', '', '!=');
	$wcrud->fieldDisplayOnlySet('col2_max', 'col2_field', '', '!=');
	$wcrud->fieldDisplayOnlySet('col2_max', 'col2_byrange', 1);
	$wcrud->datagridSet('col3_min');
	$wcrud->datagridSet('col3_max');
	$wcrud->fieldDisplayOnlySet('col3_min', 'col3_field', '', '!=');
	$wcrud->fieldDisplayOnlySet('col3_max', 'col3_field', '', '!=');
	$wcrud->fieldDisplayOnlySet('col3_max', 'col3_byrange', 1, '=', 'and');
	$wcrud->datagridSet('value');
	$wcrud->fieldLabelSet('table_data', true);

	$wcrud->filterSet('domain_id',$domainId);
	$wcrud->filterSet('nature',2);
	$wcrud->displayCrud();
}
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'home.php';
	require_once($filePath);
}
?>
