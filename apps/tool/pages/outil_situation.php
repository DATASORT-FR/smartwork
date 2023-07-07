<?php
/**
* Main file for diagram variables design
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

$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('outil_situation.tpl');

$domainId = SEPARATION_DOMAIN_ID;
$diagramId = SEPARATION_DIAGRAM_ID;

$userId = 0;
if ($flagConnect) {
	$userId = $ws->connected_id();
}

/*  init trace */
if ((SEPARATION_ESPACE_DEBUG) and ($userId == 0)) {
	$reference = '';
}
else {
	$reference = strval($userId);
}
$traceDiagramItem = array();
$traceDiagram = new object_trace_diagram();
$traceDiagramItem = $traceDiagram->init($diagramId, $reference, session_id(), $ws->connected_id())->returnGet();

$diagramName = $traceDiagramItem['diagram_name'];
$diagramType = $traceDiagramItem['diagram_type'];
$nodeSelected = $traceDiagramItem['diagram_selected'];

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

$connect = new object_connect();
$ws->assign('pageVisu', DIAGRAM_SERVERNAME . '/nodes/');
$ws->assign('nodeSave', $connect->constructHref($ws->paramGet('APP_CODE'), 'diagram_selected'));
$ws->assign('pageHierarchy', DIAGRAM_SERVERNAME . '/diagrams/'.$diagramId.'/hierarchy/');

$ws->assign('diagramId', $diagramId);
$ws->assign('diagramName', $diagramName);
$ws->assign('diagramType', $diagramType);
$ws->assign('nodeSelected', $nodeSelected);

$title = 'Diagnostic-Situation';
$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $title);

$ws->caching = false;
$ws->build('outil_situation.tpl');

?>