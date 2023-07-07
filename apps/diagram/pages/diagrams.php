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

$adminJs = $ws->paramGet($ws->paramGet('APP_NAME') . '_RELA_JS_DIR') . 'admin-diagram.js';
$ws->addjs($adminJs, false);

if ($domainId != '') {

	$variable = new object_field_variable();
	$variable->filterSet('domain_id',$domainId);
	$variable->filterSet('nature', 1);
	$variable_list = $variable->displayList(0)->returnGet();

	$diagramType = new object_diagram_type();
	$diagramType_select = $diagramType->displaySelect()->returnGet();

	$wcrud = new wcrud('object_diagram', $ws->extractPage(__FILE__));
	$wcrud->titleSet(true); /* use Title */
	$wcrud->pageSet(false); /* set processing type : true = in one box; false = force open new box */

	$wlist = $wcrud->listGet();
	$wlist->pageSet(true);
	$wlist->pagesizeSet(10, 20); /* set number of lines for the list */
	$wlist->pagesearchSet(true); /* show search input and button */
	$wlist->pageorderSet(2); /* number of order type */
	$wlist->captionSet(true);
	$wlist->displaysizeSet('small'); /* set list width */
	$wlist->columnidSet(false); /* show id column */

	$wlist->sortSet(true); /* show or not the sort of columns. False by default */
	$wlist->viewSet(true); /* show or not the columns selector. False by default */
	$wlist->filterViewSet('type_id', 'list', $diagramType->displaySelect('0', '')->returnGet()); /* display a filter field */

	$wlist->columnidpctSet(5); /* set percent size for id column */
	$wlist->columnAdd('id', 5, false); /* show code column */
	$wlist->columnAdd('name',20); /* show code column */
	$wlist->columnAdd('type',10); /* show code column */
	$wlist->columnAdd('label',53); /* show label column */
	$wlist->columnactionpctSet(3); /* set percent size for edit and delete column */

	$wlist->eventSet('btnew', true); /* show new button */
	$wlist->eventSet('btevent', true); /* show event button */
	$wlist->eventfileSet('btevent', 'diagram_design'); /* php event file */
	$wlist->eventboxSet('btevent', false);
	$wlist->eventSet('bttool', true); /* show tool button */
	$wlist->eventfileSet('bttool', 'diagrams_copy'); /* php tool file */
	$wlist->eventiconSet('bttool', 'clone'); /* php event icon */
	$wlist->eventboxSet('bttool', true);
	$wlist->eventSet('btedit', true); /* show edit button */
	$wlist->eventSet('btdelete', true); /* show delete button */

	$wlist->deletecolumnnameSet('name'); /* column used in the delete confirmation window for the title */
	
	// line 1
	$wcrud->fieldSet('name');
	$wcrud->fieldSet('type_id', 'list', $diagramType_select);
	$wcrud->fieldSet('label');

	$wcrud->fieldSet('maintab', 'tab');
		$wcrud->fieldSet('info', 'tabcontent','maintab');
			$wcrud->fieldSet('description', 'editor');
			$wcrud->rowsSet('description', 12);
		$wcrud->fieldSet('info_end', 'tabcontentend');

		$wcrud->fieldSet('nodes', 'tabcontent','maintab');
		$wcrud->fieldDisplaySet('nodes', 'edit');
			$wcrud->fieldSet('nodes_list', 'crud', 'diagrams_nodes');
			$wcrud->fieldLabelSet('nodes_list', false);
		$wcrud->fieldSet('nodes_end', 'tabcontentend');

		$wcrud->fieldSet('links', 'tabcontent','maintab');
		$wcrud->fieldDisplaySet('links', 'edit');
			$wcrud->fieldSet('links_list', 'crud', 'diagrams_links');
			$wcrud->fieldLabelSet('links_list', false);
		$wcrud->fieldSet('links_end', 'tabcontentend');
		
	$wcrud->fieldSet('maintab_end', 'tabend','maintab');

	$wcrud->filterSet('domain_id', $domainId);
	$wcrud->displayCrud();
}
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'home.php';
	require_once($filePath);
}

?>
