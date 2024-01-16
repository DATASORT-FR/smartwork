<?php
/**
* Forum : post page
*
* @package    forum_module
* @version    1.0
* @date       24 January 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

// Main
$postId = $ws->paramGet('ID');
if ($postId != '') {
	$_SESSION['object_forum_post_id'] = $postId;
}
else {
	$postId = $_SESSION['object_forum_post_id'];
}
$topicId = $ws->argGet('topic');
if ($topicId != '') {
	$ws->sessionSet('object_forum_topic_id', $topicId);
}
else {
	$topicId = $ws->sessionGet('object_forum_topic_id');
}
$style = $ws->argGet('style');

$forum = new Wforum();
$displayHtml = $forum->fetchPost('id:'.$postId, 'topic:'.$topicId,'style:'.$style);

$smarty = new workpage();
$forum->initSmarty($smarty);
$smarty->assign('displayHtml',$displayHtml);
$smarty->display('simple.tpl');
?>
