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
	$diagram_id = '';	
	if ($ws->argGet('command') == 'list') {
		$diagram_id = $ws->paramGet('ID');
	}
	if ($diagram_id != '') {
		$_SESSION['object_diagram_id'] = $diagram_id;
	}
	else {
		$diagram_id = $_SESSION['object_diagram_id'];
	}

	$diagram = new object_diagram();
	$diagram_select = $diagram->display($diagram_id);
	$diagram_name = $diagram_select->returnGet()['name'];
	$nodeFrom = new object_node();
	$nodeFrom->filterSet('diagram_id',$diagram_id);
	$nodeFrom_select = $nodeFrom->displaySelect()->returnGet();
	$nodeTo = new object_node();
	$nodeTo->filterSet('diagram_id',$diagram_id);
	$nodeTo_select = $nodeTo->displaySelect()->returnGet();

	$wcrud = new wcrud('object_link', $ws->extractPage(__FILE__), 'links');
	$wcrud->titleSet(true); /* use Title */
	$wcrud->titleCodeSet($diagram_name.' / ');
	$wcrud->pageSet(false); /* set processing type : true = in one box; false = force open new box */

	$wlist = $wcrud->listGet();
	$wlist->titleSet(false); /* use Title */
	$wlist->pageSet(true);
	$wlist->pagesizeSet(10, 20, 50); /* set number of lines for the list */
	$wlist->pagesearchSet(true); /* show search input and button */
	$wlist->pageorderSet(0); /* number of order type */
	$wlist->captionSet(true);
	$wlist->displaysizeSet('small'); /* set list width */
	$wlist->columnidSet(false); /* show id column */

	$wlist->sortSet(true); /* show or not the sort of columns. False by default */
	$wlist->viewSet(true); /* show or not the columns selector. False by default */
	$wlist->filterViewSet('nodeFrom_id'); /* display a filter field */
	$wlist->filterViewSet('nodeTo_id'); /* display a filter field */

	$wlist->columnidpctSet(5); /* set percent size for id column */
	$wlist->columnAdd('nodeFrom_reference',10); /* show node title from */
	$wlist->columnAdd('nodeFrom',35); /* show node title from */
	$wlist->columnAdd('nodeTo_reference',10); /* show node title to */
	$wlist->columnAdd('nodeTo',35); /* show node title to */
	$wlist->columnactionpctSet(5); /* set percent size for edit and delete column */

	$wlist->eventSet('btnew', true); /* show new button */
	$wlist->eventSet('btevent', false); /* show edit button */
	$wlist->eventSet('btedit', true); /* show edit button */
	$wlist->eventSet('btdelete', true); /* show delete button */

	$wlist->deletecolumnnameSet('code'); /* column used in the delete confirmation window for the title */
	
	$wcrud->fieldSet('nodeFrom_id', 'list', $nodeFrom_select);	
	$wcrud->fieldSet('nodeTo_id', 'list', $nodeTo_select);	
	$wcrud->fieldSet('description', 'editor');
	$wcrud->fieldLabelSet('description', true);
	$wcrud->rowsSet('description', 27);

	$wcrud->filterSet('diagram_id',$diagram_id);

	$wcrud->displayCrud();
}
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'home.php';
	require_once($filePath);
}
?>
