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

if ($domainId != '') {
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
	$diagramSelect = $diagram->display($diagramId);
	$diagramCode = $diagramSelect->returnGet()['code'];

	initWorkConfig($ws, 'diagrams');

	$connect = new object_connect();
	$ws->assign('pageCreate', $connect->constructHref($ws->paramGet('APP_CODE'), 'diagram_node_create'));
	$ws->assign('pageEdit', $connect->constructHref($ws->paramGet('APP_CODE'), 'diagram_node_edit'));
	$ws->assign('pageEditLink', $connect->constructHref($ws->paramGet('APP_CODE'), 'diagram_link_edit'));
	$ws->assign('pageDelete', $connect->constructHref($ws->paramGet('APP_CODE'), 'diagram_node_delete'));
	$ws->assign('pageAction', $connect->constructHref($ws->paramGet('APP_CODE'), 'diagram_node_action'));
	$ws->assign('titleDelete', 'Suppression du noeud ');
	$ws->assign('labelDelete', 'Comfirmez-vous la suppression de ce noeud ?');
	$ws->assign('pageHierarchy', $connect->constructHref($ws->paramGet('APP_CODE'), 'diagrams/'.$diagramId.'/hierarchy/','mode:api'));
	$ws->assign('diagramId', $diagramId);
	$ws->assign('diagramCode', $diagramCode);

	$ws->build('diagram_design.tpl');
}
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'home.php';
	require_once($filePath);
}
?>