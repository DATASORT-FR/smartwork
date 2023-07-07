<?php
/**
* Offers file for Job freelance
*
* @package    Job Freelance
* @subpackage controller
* @version    1.0
* @date       15 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('companies.tpl');
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_templateMain.php';
require_once($filePath);

// Main
$content = new Wcontent();
$ws->assign('PageBlock', $content->display('companies','style:simple'));

$searchValue = $ws->argPost('search');
if ($ws->ctrlPost('search')) {
	$ws->sessionSet('object_companies_search', $searchValue);
}
else {
	$searchValue = $ws->sessionGet('object_companies_search');
}

$connect = new object_connect();
$ws->assign('PageBlock', $content->display('companies','style:simple'));
$ws->assign('SearchValue', $searchValue);
$ws->assign('SearchHref', $connect->constructHref($ws->paramGet('APP_CODE'), 'companieslist'));

$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $ws->urlTitleGet());
$ws->build('companies.tpl');

?>