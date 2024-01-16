<?php
/**
* Forum : topic page
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
$topicId = $ws->paramGet('ID');
if ($topicId != '') {
	$_SESSION['object_forum_topic_id'] = $topicId;
}
else {
	$topicId = $_SESSION['object_forum_topic_id'];
}
$style = $ws->argGet('style');

$forum = new Wforum();
$displayHtml = $forum->fetchTopic('id:'.$topicId, 'style:'.$style);

$smarty = new workpage();
$forum->initSmarty($smarty);
$smarty->assign('displayHtml',$displayHtml);
$smarty->display('simple.tpl');
?>
