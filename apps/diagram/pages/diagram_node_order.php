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

if ($domainId != '') {
	$nodeFromId = $ws->argGet('fromid');
	$nodeToId = $ws->argGet('toid');
	$nodeParentId = $ws->argGet('parentid');

	$node = new object_node();
	$nodeSelect = $node->display($nodeFromId);
	$nodeFrom = $nodeSelect->returnGet();
	$diagramId = $nodeFrom['diagram_id'];

	$node = new object_node();
	$nodeSelect = $node->display($nodeToId);
	$nodeTo = $nodeSelect->returnGet();

	$nodeFromSeq = 0;
	$nodeToSeq = 0;
	$link = new object_link();
	$link->filterSet('diagram_id',$diagramId);
	$link->filterSet('nodeFrom_id',$nodeParentId);
	$list = $link->displayList(1)->returnGet();
	for ($i=0; $i < count($list); $i++) {
		$item = $list[$i];
		switch ($item['nodeTo_id']) {
			case $nodeFromId :
				$nodeFromSeq = $i;
				break;
			case $nodeToId :
				$nodeToSeq = $i;
				break;
		}
		$item['new'] = $i;
		$list[$i] = $item;
	}

	$item = $list[$nodeFromSeq];
	$item['new'] = $nodeToSeq;
	$list[$nodeFromSeq] = $item;
	$item = $list[$nodeToSeq];
	$item['new'] = $nodeFromSeq;
	$list[$nodeToSeq] = $item;

	for ($i=0; $i < count($list); $i++) {
		$item = $list[$i];
		if ($item['new'] != $item['sequence']) {
			$argArray = array();
			$argArray['id'] = $item['id'];
			$argArray['sequence'] = $item['new'];
			$link = new object_link();
			$link->update($argArray);
		}
	}
	
	$display_html = 'refresh';
	$ws->caching = false;
	$ws->build($display_html);
}
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'home.php';
	require_once($filePath);
}
?>
