<?php
/**
* Forum : post administration
*
* @package    forum_module
* @version    1.0
* @date       29 December 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$topicId = $ws->argGet('topic');
if ($topicId != '') {
	$ws->sessionSet('object_forum_topic_id', $topicId);
}
else {
	$topicId = $ws->sessionGet('object_forum_topic_id');
}
$context = $ws->argGet('context');
$command = $ws->argGet('command');

$connect = new object_connect();
$ws->assign('pageRef',$connect->constructHref($ws->paramGet('APP_CODE'), $ws->extractPage(__FILE__), 'command:list'));

$object = new BUS_object();
$status_select = $object->initSelect();
$status_select = $object->addSelect($status_select, "0", $ws->getConfigVars("Lbl_status_0"));
$status_select = $object->addSelect($status_select, "1", $ws->getConfigVars("Lbl_status_1"));

$wcrud = new wcrud('object_forum_post', $ws->extractPage(__FILE__));
$wcrud->titleSet(false); /* use Title */
$wcrud->pageSet(false); /* set processing type : true = in one box; false = force open new box */
$wcrud->writeSet(true); /* Forcer le crud en mode update */

$wcrud->createReturnSet('reload');
$wcrud->deleteReturnSet('reload');
$wcrud->updateReturnSet('reload');

$flagAdmin = false;
if ($ws->connected_id() == $ws->paramGet('USER_SUPERADMIN')) {
	$flagAdmin = true;
}
if ((!$flagAdmin) and ($command != 'new') and ($ws->paramGet('FORUM_RIGHT_UPDATE') == 1)) {
	$flagAdmin = true;
}
if ((!$flagAdmin) and ($command == 'new') and ($ws->paramGet('FORUM_RIGHT_CREATE') == 1)) {	
	$flagAdmin = true;
}
// line 1
if (($command != 'new') and ($command != 'create')) {
	$wcrud->fieldSet('status_id', 'list', $status_select);
	$wcrud->fieldLineSet('author');
}
$wcrud->fieldSet('content', 'comment');
$wcrud->rowsSet('content', 5);
$wcrud->fieldLabelSet('content', false);

if ($command == 'new') {
	$wcrud->defaultValueSet('content', $context);
}

if ($command == 'create') {
	$wcrud->filterSet('status_id', 1);
	$wcrud->filterSet('topic_id', $topicId);
	$wcrud->filterSet('reference', $ws->connected_id());
	$wcrud->filterSet('author', $ws->connected_surname());
}
if ($command == 'update') {
	$wcrud->filterSet('ref_moderator', $ws->connected_id());
	$wcrud->filterSet('moderator', $ws->connected_surname());
}

$wcrud->displayCrud();
?>
