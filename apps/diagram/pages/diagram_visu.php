<?php
/**
* Main file for diagram chart design
*
* @package    Diagram svg
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

$diagramId = $ws->paramGet('ID');
if ($diagramId != '') {
	$ws->sessionSet('object_diagramId', $diagramId);
}
else {
	$diagramId = $ws->sessionGet('object_diagramId');
}

if ($diagramId != '') {
	$visuJs = $ws->paramGet($ws->paramGet('APP_NAME') . '_RELA_JS_DIR') . 'visu-diagram.js';
	$ws->assign('visuJs', $visuJs);

	if ($diagramId != '0') {
		$traceDiagramItem = array();
		$reference = '';
		$traceDiagram = new object_trace_diagram();
		$traceDiagramItem = $traceDiagram->init($diagramId, $reference, session_id(), $ws->connected_id())->returnGet();

		$diagramId = $traceDiagramItem['diagram_id'];
		$diagramName = $traceDiagramItem['diagram_name'];
		$diagramType = $traceDiagramItem['diagram_type'];
		$nodeSelected = $traceDiagramItem['diagram_selected'];

		$diagram = new object_diagram();
		$diagramItem = $diagram->display($diagramId);
		$domainId = $diagramItem->returnGet()['domain_id'];

		$traceItem = array();
		$trace = new object_trace();
		$traceItem = $trace->init($domainId, $reference, session_id(), $ws->connected_id())->returnGet();
		if ($diagramType == 1) {
			$traceItem['situation_id'] = $diagramId;
			$traceItem['situation_nodes'] = $traceDiagramItem['diagram_nodes'];
		}
		else {
			$traceItem['process_id'] = $diagramId;
			$traceItem['process_nodes'] = $traceDiagramItem['diagram_nodes'];
		}
		$trace->update($traceItem);
	}
	else {
		$diagramName = '';
		$diagramType = 1;
		$nodeSelected = '';
	}

	$connect = new object_connect();
	$ws->assign('pageVisu', $connect->constructHref($ws->paramGet('APP_CODE'), 'diagram_node_visu'));
	$ws->assign('pageSave', $connect->constructHref($ws->paramGet('APP_CODE'), 'diagram_selected'));
	$ws->assign('pageHierarchy', $connect->constructHref($ws->paramGet('APP_CODE'), 'diagrams/'.$diagramId.'/hierarchy/','mode:api'));

	$ws->assign('diagramId', $diagramId);
	$ws->assign('diagramName', $diagramName);
	$ws->assign('diagramType', $diagramType);
	$ws->assign('nodeSelected', $nodeSelected);

	$ws->caching = false;
	$ws->build('diagram_visu.tpl');
}
else {
	$ws->build('simple.tpl');
}

?>