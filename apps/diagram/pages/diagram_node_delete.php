<?php
/**
* diagram node edit
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

$connect = new object_connect();
$ws->assign('$pageRef',$connect->constructHref($ws->paramGet('APP_CODE'), 'diagram-design'));

if ($domainId != '') {
	$nodeId = $ws->paramGet('ID');
	if ($nodeId != '') {
		$_SESSION['object_node_id'] = $nodeId;
	}
	else {
		$nodeId = $_SESSION['object_node_id'];
	}

	if ($nodeId != '') {
		$node = new object_node();
		$node->deleteChildren($nodeId);
//		$node->delete($nodeId);
	}

	$display_html = 'refresh';
	$ws->build($display_html);
}
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'home.php';
	require_once($filePath);
}
?>
