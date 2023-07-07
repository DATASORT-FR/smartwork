<?php
/**
* Main file for diagram variable design
*
* @package    Diagram 
* @subpackage controller
* @version    1.0
* @date       14 March 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();

$ws->logSys('debug', 'Page : ' . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

if ($ws->ctrlPost('diagram_id')) {
	$diagramId = $ws->argPost('diagram_id');
}
else {
	$diagramId = 0;
}
if ($ws->ctrlPost('diagram_selected')) {
	$diagramSelected = $ws->argPost('diagram_selected');
}
else {
	$diagramSelected = 0;
}
if ($ws->ctrlPost('diagram_nodes')) {
	$diagramNodes = $ws->argPost('diagram_nodes');
}
else {
	$diagramNodes = '';
}
if ($ws->ctrlPost('process_id')) {
	$processId = $ws->argPost('process_id');
}
else {
	$processId = 0;
}

if ($diagramId != 0) {
	$reference = '';

	$traceDiagram = new object_trace_diagram();
	$traceDiagramItem = array();
	$traceDiagramItem = $traceDiagram->init($diagramId, $reference, session_id(), $ws->connected_id())->returnGet();
	$traceDiagramId = $traceDiagramItem['id'];
	$diagramType = $traceDiagramItem['diagram_type'];

	$traceDiagramItem = array();
	$traceDiagramItem['id']= $traceDiagramId;
	$traceDiagramItem['diagram_selected'] = $diagramSelected;
	$traceDiagramItem['diagram_nodes'] = $diagramNodes;
	$traceDiagramItem['process_id'] = $processId;
	$traceDiagram->update($traceDiagramItem);

	$diagram = new object_diagram();
	$diagramItem = $diagram->display($diagramId);
	$domainId = $diagramItem->returnGet()['domain_id'];

	$traceItem = array();
	$trace = new object_trace();
	$traceItem = $trace->init($domainId, $reference, session_id(), $ws->connected_id())->returnGet();
	if ($diagramType == 1) {
		$traceItem['situation_id'] = $diagramId;
		$traceItem['situation_nodes'] = $traceDiagramItem['diagram_nodes'];
		if ($processId != 0) {
			$traceItem['process_id'] = $processId;
			$traceProcessItem = array();
			$traceProcessItem = $traceDiagram->init($processId, $reference, session_id(), $ws->connected_id())->returnGet();
			$traceItem['process_nodes'] = $traceProcessItem['diagram_nodes'];
		}
		else {
			$traceItem['process_id'] = 0;
			$traceItem['process_nodes'] = '';
		}
	}
	else {
		$traceItem['process_id'] = $diagramId;
		$traceItem['process_nodes'] = $traceDiagramItem['diagram_nodes'];
	}
	$trace->update($traceItem);
}
else {
	$ws->build('simple.tpl');
}

?>