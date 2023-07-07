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
	$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $ws->urlTitleGet());

	$reference = '';
	$traceItem = array();
	$trace = new object_trace();
	$traceItem = $trace->init($domainId, $reference, session_id(), $ws->connected_id())->returnGet();
	$domainName = $traceItem['domain_name'];

	$connect = new object_connect();
	$pageVisu = $connect->constructHref($ws->paramGet('APP_CODE'), 'slides/','mode:api');
	$pageHierarchy = $connect->constructHref($ws->paramGet('APP_CODE'), 'domains/'.$domainId.'/hierarchy/','mode:api');
	$pageSave = $connect->constructHref($ws->paramGet('APP_CODE'), 'traces/','mode:api');

	$pageDossier = $connect->constructHref($ws->paramGet('APP_CODE'),  'outil_dossier');
	$downloadDossier = $connect->constructHref($ws->paramGet('APP_CODE'),  'outil_download');

	$visuJs = $ws->paramGet($ws->paramGet('APP_NAME') . '_RELA_JS_DIR') . 'slides_visu_simple.js';
	$visuCss = $ws->paramGet($ws->paramGet('APP_NAME') . '_RELA_TEMPLATES_CSS_DIR') . 'slides_visu_simple.css';
	$ws->assign('visuJs', $visuJs);
	$ws->assign('visuCss', $visuCss);

	$ws->assign('domainId', $domainId);
	$ws->assign('domainName', $domainName);
	$ws->assign('pageVisu', $pageVisu);
	$ws->assign('pageSave', $pageSave);
	$ws->assign('pageHierarchy', $pageHierarchy);
	$ws->assign('pageDossier', $pageDossier);
	$ws->assign('downloadDossier', $downloadDossier);

	$ws->caching = false;
	$ws->build('slides_visu_simple.tpl');
}
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'home.php';
	require_once($filePath);
}

?>