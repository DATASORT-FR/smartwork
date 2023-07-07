<?php
/**
* @package    use_diagram
* @subpackage controller
* @version    1.0
* @date       08 Octobre 2020
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
	$diagram = new object_diagram();
	$diagram->filterSet('domain_id', $domainId);
	$diagram_select = $diagram->displaySelect()->returnGet();

	$nodeFrom = new object_node();
	$nodeFrom->filterSet('domain_id', $domainId);
	$nodeFrom_select = $nodeFrom->displaySelect()->returnGet();
	$nodeTo = new object_node();
	$nodeTo->filterSet('domain_id', $domainId);
	$nodeTo_select = $nodeTo->displaySelect()->returnGet();

	$wcrud = new wcrud('object_link', $ws->extractPage(__FILE__));
	$wcrud->titleSet(true); /* use Title */
	$wcrud->pageSet(false); /* set processing type : true = in one box; false = force open new box */

	$wlist = $wcrud->listGet();
	$wlist->pageSet(true);
	$wlist->pagesizeSet(14); /* set number of lines for the list */
	$wlist->pagesearchSet(true); /* show search input and button */
	$wlist->pageorderSet(2); /* number of order type */
	$wlist->displaysizeSet('small'); /* set list width */
	$wlist->columnidSet(false); /* show id column */
	$wlist->columnidpctSet(5); /* set percent size for id column */
	$wlist->columnAdd('nodeFrom_reference',10); /* show node title from */
	$wlist->columnAdd('nodeFrom',35); /* show node title from */
	$wlist->columnAdd('nodeTo_reference',10); /* show node title to */
	$wlist->columnAdd('nodeTo',35); /* show node title to */
	$wlist->columnactionpctSet(5); /* set percent size for edit and delete column */

	$wlist->eventSet('btnew', true); /* show new button */
	$wlist->eventSet('btevent', true); /* show edit button */
	$wlist->eventfileSet('btevent', 'diagram'); /* php event file */
	$wlist->eventboxSet('btevent', false);
	$wlist->eventSet('btedit', true); /* show edit button */
	$wlist->eventSet('btdelete', true); /* show delete button */

	$wlist->deletecolumnnameSet('name'); /* column used in the delete confirmation window for the title */
	
	// line 1
	$wcrud->fieldSet('diagram_id', 'list', $diagram_select);

	$wcrud->fieldSet('nodeFrom_id', 'list', $nodeFrom_select);	
	$wcrud->fieldSet('nodeTo_id', 'list', $nodeTo_select);	
	$wcrud->fieldSet('description', 'editor');
	$wcrud->fieldLabelSet('description', true);
	$wcrud->rowsSet('description', 27);

	$wcrud->filterSet('domain_id',$domainId);
	$wcrud->displayCrud();
}
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'home.php';
	require_once($filePath);
}
?>
