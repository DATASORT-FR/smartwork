<?php
/**
* Main file for diagram chart
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

$visuJs = $ws->paramGet($ws->paramGet('APP_NAME') . '_RELA_JS_DIR') . 'visu-diagram.js';
$ws->assign('visuJs', $visuJs);

$diagramId = $ws->paramGet('ID');
if ($diagramId != '') {
	$_SESSION['object_diagram_id'] = $diagramId;
}
else {
	$diagramId = 1;
	if (isset($_SESSION['object_diagramId'])) {
		$diagramId = $_SESSION['object_diagramId'];
	}
}

$diagram = new object_diagram();
$diagram_select = $diagram->display($diagramId);
$domainId = $diagram_select->returnGet()['domain_id'];
$ws->sessionSet('object_domain_id', $domainId);

$connect = new object_connect();
$ws->assign('pageVisu', $connect->constructHref($ws->paramGet('APP_CODE'), 'diagram_node_visu'));
$ws->assign('pageHierarchy', $connect->constructHref($ws->paramGet('APP_CODE'), 'diagrams/'.$diagramId.'/hierarchy/','mode:api'));
$ws->assign('diagramId', $diagramId);

$ws->caching = false;
$ws->build('diagram.tpl');

?>