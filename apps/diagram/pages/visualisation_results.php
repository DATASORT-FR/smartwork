<?php
/**
* Main file for diagram chart
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
	$visuJs = $ws->paramGet($ws->paramGet('APP_NAME') . '_RELA_JS_DIR') . 'visu-diagram.js';
	$ws->assign('visuJs', $visuJs);

	$connect = new object_connect();
	$ws->assign('pageRef', $connect->constructHref($ws->paramGet('APP_CODE'), 'diagram_results_visu'));
	$ws->assign('domainId', $domainId);

	$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $ws->urlTitleGet());

	$ws->caching = false;
	$ws->build('visualisation_results.tpl');
}
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'home.php';
	require_once($filePath);
}

?>