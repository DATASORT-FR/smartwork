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

if ($domainId != '') {
	$visuJs = '';
//	$visuJs = $ws->paramGet($ws->paramGet('APP_NAME') . '_RELA_JS_DIR') . 'slides_visu_sheets.js';
	$ws->assign('visuJs', $visuJs);
	$visuCss = '';
//	$visuCss = $ws->paramGet($ws->paramGet('APP_NAME') . '_RELA_TEMPLATES_CSS_DIR') . 'slides_visu_sheets.css';
	$ws->assign('visuCss', $visuCss);

	$connect = new object_connect();
	$ws->assign('pageRefSimple', $connect->constructHref($ws->paramGet('APP_CODE'), 'slides_visu_simple'));
	$ws->assign('pageRefSheets', $connect->constructHref($ws->paramGet('APP_CODE'), 'slides_visu_sheets'));
	$ws->assign('domainId', $domainId);

	$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $ws->urlTitleGet());

	$ws->caching = false;
	$ws->build('visualisation_slides.tpl');
}
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'home.php';
	require_once($filePath);
}

?>