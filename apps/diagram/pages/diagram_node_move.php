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

	$node = new object_node();
	$nodeSelect = $node->display($nodeFromId);
	$nodeFrom = $nodeSelect->returnGet();

	$node = new object_node();
	$nodeSelect = $node->display($nodeToId);
	$nodeTo = $nodeSelect->returnGet();

	$link = new object_link();
	$link->filterSet('diagram_id',$nodeFrom['diagram_id']);
	$link->filterSet('nodeTo_id',$nodeFrom['id']);
	$list = $link->displayList(1)->returnGet();
	for ($i=0; $i < count($list); $i++) {
		$item = $list[$i];
		$link->delete($item['id']);
	}

	$linkItem = array();
	$linkItem['diagram_id'] = $nodeFrom['diagram_id'];
	$linkItem['nodeTo_id'] = $nodeFrom['id'];
	$linkItem['nodeFrom_id'] = $nodeTo['id'];
	$link->insert($linkItem);

	$display_html = 'refresh';
	$ws->caching = false;
	$ws->build($display_html);
}
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'home.php';
	require_once($filePath);
}
?>
