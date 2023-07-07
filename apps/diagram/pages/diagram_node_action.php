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
	$nodeFromId = $ws->argGet('fromid');
	$nodeToId = $ws->argGet('toid');
	if (($nodeFromId != '') and ($nodeFromId != '')) {
	}

	initWorkConfig($ws, 'nodes');

	$nodeFrom = new object_node();
	$nodeSelect = $nodeFrom->display($nodeFromId);
	$nodeFromItem = $nodeSelect->returnGet();
	$diagramId = $nodeFromItem['diagram_id'];
	$nodeFromTitle = $nodeFromItem['title_code'];

	$nodeTo = new object_node();
	$nodeSelect = $nodeTo->display($nodeToId);
	$nodeToItem = $nodeSelect->returnGet();
	$nodeToTitle = $nodeToItem['title_code'];

	$flagBrother = false;
	$nodeParentId = 0;
	$link = new object_link();
	$link->filterSet('diagram_id',$diagramId);
	$link->filterSet('nodeTo_id',$nodeFromId);
	$list = $link->displayList(1)->returnGet();
	for ($i=0; $i < count($list); $i++) {
		$item = $list[$i];		
		$link = new object_link();
		$link->filterSet('diagram_id',$diagramId);
		$link->filterSet('nodeFrom_id',$item['nodeFrom_id']);
		$link->filterSet('nodeTo_id',$nodeToId);
		$listResult = $link->displayList(1)->returnGet();
		if (count($listResult) > 0) {
			$flagBrother = true;
			$nodeParentId = $item['nodeFrom_id'];
		}
	}

	$ws->assign('pageMove', $connect->constructHref($ws->paramGet('APP_CODE'), 'diagram_node_move') . '?fromid=' . $nodeFromId .'&toid=' . $nodeToId);
	if ($flagBrother) {
		$ws->assign('pageOrder', $connect->constructHref($ws->paramGet('APP_CODE'), 'diagram_node_order') . '?parentid=' . $nodeParentId . '&fromid=' . $nodeFromId .'&toid=' . $nodeToId);
	}
	else {
		$ws->assign('pageOrder', '');
	}
	$ws->assign('pageCopy', $connect->constructHref($ws->paramGet('APP_CODE'), 'diagram_node_copy') . '?fromid=' . $nodeFromId .'&toid=' . $nodeToId);

	$ws->assign('nodeFromTitle', $nodeFromTitle);
	$ws->assign('nodeToTitle', $nodeToTitle);
	$ws->assign('nodeFromId', $nodeFromId);
	$ws->assign('nodeToId', $nodeToId);

	$ws->caching = false;
	$ws->build('diagram_node_action.tpl');
}
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'home.php';
	require_once($filePath);
}
?>
