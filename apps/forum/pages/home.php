<?php
/**
* Main file for article
*
* @package    Test
* @subpackage controller
* @version    1.0
* @date       15 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('home.tpl');
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_template.php';
require_once($filePath);

$ws->assign('classPage', 'home');

//$content = new Wcontent();
//$ws->assign('contentBlock', $content->display('cgu','style:header'));
$title = '';
//$title = $content->displayGet('title');

$connect = new object_connect();
$linhHome = $connect->constructHref($ws->paramGet('APP_CODE'));

$forum = new Wforum();
$ws->assign('breadCrumbBlock', $forum->displayBreadCrumb('Forum', $linhHome));
$ws->assign('lastBlock', $forum->displayListLastTopic(5));
$ws->assign('subjectBlock', $forum->displayListSubject('separation', 'caption:true'));

$ws->logTrace($ws->paramGet('APP_CODE'), 'subject', $ws->paramGet('ID'), $title);
$ws->caching = false;
$ws->build('home.tpl');

?>