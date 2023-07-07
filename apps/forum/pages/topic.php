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
$ws->control('topic.tpl');
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_template.php';
require_once($filePath);

$ws->assign('classPage', 'topic');

$topicId = $ws->paramGet('ID');
if ($topicId != '') {
	$ws->sessionSet('object_topic_id', $topicId);
}
else {
	$topicId = $ws->sessionGet('object_topic_id');
}

$connect = new object_connect();
$pageConnect = $connect->constructHref($ws->paramGet('APP_CODE'),  'ctrl_connect');
$ws->assign('pageConnect', $pageConnect);

$forum = new Wforum();
$ws->assign('topicBlock', $forum->displayTopic($topicId));
$ws->assign('postBlock', $forum->displayListPost($topicId));
$title = $forum->displayTopicGet('label');

if ($ws->connected() and ($ws->connected_id() != $ws->paramGet('USER_GUEST'))) {
	$objForumTopicHistory = new object_forum_topic_history();
	$fct_return = $objForumTopicHistory->add($ws->connected_id(), $topicId);
}

$ws->logTrace($ws->paramGet('APP_CODE'), 'topic', $topicId, $title);
$ws->caching = false;
$ws->build('topic.tpl');

?>