<?php
/**
* Main file for article
*
* @package    Test
* @subpackage controller
* @version    1.0
* @date       15 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('outil.tpl');
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_template_outil.php';
require_once($filePath);

$ws->paramSet('CONTENT_RIGHT_DELETE', False);
$ws->assign('classPage', 'outil');

$domainId = $ws->paramGet('APP_PARAM_DOMAIN', SEPARATION_DOMAIN_ID);
$diagramId = $ws->paramGet('APP_PARAM_DIAGRAM', SEPARATION_DIAGRAM_ID);

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
$pageVariable = $connect->constructHref($ws->paramGet('APP_CODE'),  'outil_variable');
$pageResult = $connect->constructHref($ws->paramGet('APP_CODE'),  'outil_result');
$pageDiagnostic = $connect->constructHref($ws->paramGet('APP_CODE'),  'outil_diagnostic');
$pageProcedure = $connect->constructHref($ws->paramGet('APP_CODE'),  'outil_procedure');
$pageDossier = $connect->constructHref($ws->paramGet('APP_CODE'),  'outil_dossier');
$downloadDossier = $connect->constructHref($ws->paramGet('APP_CODE'),  'outil_download');
$sendDossier = $connect->constructHref($ws->paramGet('APP_CODE'),  'outil_send');
$pageVisu = DIAGRAM_SERVERNAME . '/nodes/';
$nodeSave = $connect->constructHref($ws->paramGet('APP_CODE'), 'diagram_selected');
$pageHierarchy = DIAGRAM_SERVERNAME . '/diagrams/'.$diagramId.'/hierarchy/';

$ws->assign('situationTitle','Ma situation');
$ws->assign('variableTitle','Mes informations');
$ws->assign('resultTitle','Mon diagnostic');
$ws->assign('procedureTitle','Ma procédure');

$ws->assign('pageVariable', $pageVariable);
$ws->assign('pageResult', $pageResult);
$ws->assign('pageDiagnostic', $pageDiagnostic);
$ws->assign('pageDossier', $pageDossier);
$ws->assign('pageProcedure', $pageProcedure);
$ws->assign('pageHierarchy', $pageHierarchy);

$ws->assign('diagramId', $diagramId);
$ws->assign('diagramName', $diagramName);
$ws->assign('diagramType', $diagramType);
$ws->assign('nodeSelected', $nodeSelected);
$ws->assign('pageVisu', $pageVisu);
$ws->assign('nodeSave', $nodeSave);
$ws->assign('downloadDossier', $downloadDossier);
$ws->assign('sendDossier', $sendDossier);

$title = 'Diagnostic';
$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $title);

$ws->caching = false;
$ws->build('outil.tpl');
?>