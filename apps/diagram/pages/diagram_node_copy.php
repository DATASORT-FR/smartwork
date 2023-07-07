<?php
/**
* diagram node move
*
* @package    Diagram svg
* @subpackage controller
* @version    1.0
* @date       25 January 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

function copyNode($diagramId, $nodeId)
{

	$item = array();
	$nodeItem = array();
	$nodeTitle = '';
	$nodeLabel = '';
	$nodeRoot = false;
	$nodeDescription = '';
	$nodeChilren = array();

	$node = new object_node();
	$item = $node->display($nodeId)->returnGet();
	$diagramId = $item['diagram_id'];
	$nodeReference = $item['reference'];
	$nodeRoot = $item['root'];
	$nodeSlideId = $item['slide_id'];
	$nodeQuestionId = $item['question_id'];

	$nodeItem = array();
	$nodeItem['diagram_id'] = $diagramId;
	$nodeItem['reference'] = $nodeReference;
	$nodeItem['root'] = $nodeRoot;
	$nodeItem['slide_id'] = $nodeSlideId;
	$nodeItem['question_id'] = $nodeQuestionId;
	
	$link = new object_link();
	$link->filterSet('diagram_id',$diagramId);
	$link->filterSet('nodeFrom_id',$nodeId);
	$list = $link->displayList(1)->returnGet();
	for ($i=0; $i < count($list); $i++) {
		$item = $list[$i];
		$nodeToId = copyNode($diagramId, $item['nodeTo_id']);
		$linkItem = array();
		$linkItem['nodeTo_id'] = $nodeToId;
		$linkItem['sequence'] = $item['sequence'];
		$linkItem['description'] = $item['description'];
		$nodeChilren[] = $linkItem;
	}
	$nodeCopyId = $node->insert($nodeItem)->returnGet();
	
	for ($i=0; $i < count($nodeChilren); $i++) {
		$item = $nodeChilren[$i];
		$linkItem = array();
		$linkItem['diagram_id'] = $diagramId;
		$linkItem['nodeTo_id'] = $item['nodeTo_id'];
		$linkItem['nodeFrom_id'] = $nodeCopyId;
		$linkItem['sequence'] = $item['sequence'];
		$linkItem['description'] = $item['description'];
		$link->insert($linkItem);
	}
	return $nodeCopyId;
}

if ($domainId != '') {
	$nodeFromId = $ws->argGet('fromid');
	$nodeToId = $ws->argGet('toid');

	$node = new object_node();
	$nodeSelect = $node->display($nodeFromId);
	$nodeFrom = $nodeSelect->returnGet();
	$diagramId = $nodeFrom['diagram_id'];

	$nodeCopyId = $node->copyChildren($nodeFromId, $domainId, $diagramId, '', $domainId, $diagramId, $nodeToId);

	$display_html = 'refresh';
	$ws->caching = false;
	$ws->build($display_html);
}
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'home.php';
	require_once($filePath);
}
?>
