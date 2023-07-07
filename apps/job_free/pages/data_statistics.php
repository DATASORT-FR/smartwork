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
$ws->control('data_statistics.tpl');
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_templateMain.php';
require_once($filePath);

// Main

$connect = new object_connect();
$content = new Wcontent();

$content = new Wcontent();
$ws->assign('PageBlock', $content->display('statistics','style:simple'));
$ws->assign('StatByDayHref', $connect->constructHref($ws->paramGet('APP_CODE'), 'statvisitors', 'mode:api'));
$ws->assign('StatTodayHref', $connect->constructHref($ws->paramGet('APP_CODE'), 'stattoday', 'mode:api'));
$ws->assign('UrlsByDayHref', $connect->constructHref($ws->paramGet('APP_CODE'), 'staturls', 'mode:api'));
$ws->assign('exportLink', $connect->constructHref($ws->paramGet('APP_CODE'), 'data_export'));

$ws->caching = false;
$ws->build('data_statistics.tpl');

?>