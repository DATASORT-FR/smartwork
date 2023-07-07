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

if ($domainId != '') {
	$nodeId = $ws->paramGet('ID');
	if ($nodeId != '') {
		$_SESSION['object_node_id'] = $nodeId;
	}
	else {
		$nodeId = $_SESSION['object_node_id'];
	}

	$node = new object_node();
	$item = $node->display($nodeId)->returnGet();
	$nodeCode = $nodeId;
	$nodeDescription = $item['description'];
	$nodeTitleNotice = $item['notice_title'];
	$nodeDescriptionNotice = $item['notice_description'];
	$nodeImageNotice = $item['notice_image'];

	$atemp = explode(';',$nodeImageNotice);
	$nodeImageNotice = '';
	$nodeImageAltNotice = '';
	$nodeImageTitleNotice = '';
	if (isset($atemp[0])) {
		$nodeImageNotice = $atemp[0];
	}
	if (isset($atemp[1])) {
		$nodeImageAltNotice = $atemp[1];
	}
	if (isset($atemp[2])) {
		$nodeImageTitleNotice = $atemp[2];
	}
	if (!file_exists($nodeImageNotice)) {
		$nodeImageNotice = '';
	}
	
	$ws->assign('Content_title',$nodeTitleNotice);
	$ws->assign('Content_image',$nodeImageNotice);
	$ws->assign('Content_imageAlt',$nodeImageAltNotice);
	$ws->assign('Content_imageTitle',$nodeImageTitleNotice);
	$ws->assign('Content_intro', $nodeDescription);
	$ws->assign('Content_content',$nodeDescriptionNotice);

	$ws->caching = false;
	$ws->build('diagram_node_visu.tpl');
}
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'home.php';
	require_once($filePath);
}
?>
