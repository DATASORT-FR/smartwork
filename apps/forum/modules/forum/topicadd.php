<?php
/**
* Page : Content Add for forum topic
*
* @package    feature_forum
* @subpackage controller
* @version    1.0
* @date       15 December 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$connect = new object_connect();
$linhHome = $connect->constructHref($ws->paramGet('APP_CODE'));

$forum = new Wforum();
$displayHtml = $forum->displayBreadCrumb('Forum', $linhHome, 'topic', $topicId);

?>