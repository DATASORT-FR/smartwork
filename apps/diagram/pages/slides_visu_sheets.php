<?php
/**
* Main file for slides chart
*
* @package    Slide
* @subpackage controller
* @version    1.0
* @date       28 august 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();

$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_diagnostic.php';
require_once($filePath);

$userId = 0;
$flagConnect = false;
if ($ws->sessionGet('connect_id') <> $ws->paramGet('USER_GUEST')) {
	$flagConnect = $ws->connected();
}
if ($flagConnect) {
	$userId = $ws->connected_id();
}
if ($userId == 0) {
	$reference = '';
}
else {
	$reference = strval($userId);
}

if ($domainId != '') {
	$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $ws->urlTitleGet());

	$reference = '';
	$traceItem = array();
	$trace = new object_trace();
	$traceItem = $trace->init($domainId, $reference, session_id(), $ws->connected_id())->returnGet();
	$domainName = $traceItem['domain_name'];

	$idTrace = $traceItem['id'];;

	$connect = new object_connect();
	$pageVisu = $connect->constructHref($ws->paramGet('APP_CODE'), 'slides/','mode:api');
	$pageSave = $connect->constructHref($ws->paramGet('APP_CODE'), 'traces/','mode:api');

//	$visuJs = '';
	$visuJs = $ws->paramGet($ws->paramGet('APP_NAME') . '_RELA_JS_DIR') . 'slides_visu_sheets.js';
//	$visuCss = '';
	$visuCss = $ws->paramGet($ws->paramGet('APP_NAME') . '_RELA_TEMPLATES_CSS_DIR') . 'slides_visu_sheets.css';
	$ws->assign('visuJs', $visuJs);
	$ws->assign('visuCss', $visuCss);

	$ws->assign('traceId', $idTrace);
	$ws->assign('reference', $reference);
	$ws->assign('domainId', $domainId);
	$ws->assign('domainName', $domainName);
	$ws->assign('pageVisu', $pageVisu);
	$ws->assign('pageSave', $pageSave);

	$slideList = array();
	$slide = new object_slide();
	$slide->filterSet('domain_id',$domainId);
	$slide->filterSet('type_id',1);
	$slides = $slide->displayList(0)->returnGet();
	for ($i=0; $i < count($slides); $i++) {
		$slideId = $slides[$i]['id'];
		$slideItem = $slide->display($slideId)->returnGet();
		$slideItem['code'] = $slideItem['id'];

		// Slide image
		$imageArray = analyseImage($slideItem['image']);
		$slideItem['image'] = $imageArray['image'];
		$slideItem['image_title'] = $imageArray['title'];
		$slideItem['image_alt'] = $imageArray['alt'];

		// Variable image
		$imageArray = analyseImage($slideItem['variable_image']);
		$slideItem['variable_image'] = $imageArray['image'];
		$slideItem['variable_image_title'] = $imageArray['title'];
		$slideItem['variable_image_alt'] = $imageArray['alt'];

		// Result image
		$imageArray = analyseImage($slideItem['result_image']);
		$slideItem['result_image'] = $imageArray['image'];
		$slideItem['result_image_title'] = $imageArray['title'];
		$slideItem['result_image_alt'] = $imageArray['alt'];

		$slideItem['level'] = $i + 1;
		$slideItem['nb_slide'] = count($slides);

		$slideList[] = $slideItem;
	}
	$ws->assign('slideList', $slideList);

	$ws->caching = false;
	$ws->build('slides_visu_sheets.tpl');
}
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'home.php';
	require_once($filePath);
}

?>