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

$ws->assign('classPage', 'subject');

$subjectId = $ws->paramGet('ID');
if ($subjectId != '') {
	$ws->sessionSet('object_subject_id', $subjectId);
}
else {
	$subjectId = $ws->sessionGet('object_subject_id');
}

$connect = new object_connect();
$pageConnect = $connect->constructHref($ws->paramGet('APP_CODE'),  'ctrl_connect');
$ws->assign('pageConnect', $pageConnect);

$forum = new Wforum();
$ws->assign('subjectBlock', $forum->displaySubject($subjectId));
$title = $forum->displaySubjectGet('name');

$ws->assign('topicBlock', $forum->displayListTopic($subjectId));

$ws->logTrace($ws->paramGet('APP_CODE'), 'topic', $subjectId, $title);
$ws->caching = false;
$ws->build('subject.tpl');

?>