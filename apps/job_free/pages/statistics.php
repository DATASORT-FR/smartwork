<?php
/**
* Statistics file for Job freelance
*
* @package    Job Freelance
* @subpackage controller
* @version    1.0
* @date       15 December 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('statistics.tpl');
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_templateMain.php';
require_once($filePath);

// Main

$connect = new object_connect();
$content = new Wcontent();

$content = new Wcontent();
$ws->assign('PageBlock', $content->display('statistics','style:simple'));
$ws->assign('StatByJobNamesHref', $connect->constructHref($ws->paramGet('APP_CODE'), 'statjobnames', 'mode:api'));
$ws->assign('StatByJobObjectsHref', $connect->constructHref($ws->paramGet('APP_CODE'), 'statjobobjects', 'mode:api'));
$ws->assign('StatBySiteSourcesHref', $connect->constructHref($ws->paramGet('APP_CODE'), 'statsitesources', 'mode:api'));
$ws->assign('StatByDayHref', $connect->constructHref($ws->paramGet('APP_CODE'), 'statdays', 'mode:api'));

$ws->assign('SiteSourcesHref', $connect->constructHref($ws->paramGet('APP_CODE'), 'sitesources', 'mode:api'));

$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $ws->urlTitleGet());
$ws->build('statistics.tpl');

?>