<?php
/**
* Main file for article
*
* @package    Article
* @subpackage controller
* @version    1.0
* @date       15 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_templateMain.php';
require_once($filePath);

$articleCode = 'video';
$categoryValue = '';
$classPage = 'video';
$videoValue = 1;
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'list-calculate.php';
require_once($filePath);

$connect = new object_connect();
$articlesLink = $connect->constructHref($ws->paramGet('APP_CODE'), 'mediation-video-detail');
$ws->assign('articlesLink', $articlesLink);

$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $ws->urlTitleGet());
$ws->caching = false;
$ws->build('mediation_list.tpl');
?>