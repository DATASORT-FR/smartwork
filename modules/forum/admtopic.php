<?php
/**
* Forum : topic administration
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

$subjectId = $ws->argGet('subject');
if ($subjectId != '') {
	$ws->sessionSet('object_forum_subject_id', $subjectId);
}
else {
	$subjectId = $ws->sessionGet('object_forum_subject_id');
}
$command = $ws->argGet('command');

$connect = new object_connect();
$ws->assign('pageRef',$connect->constructHref($ws->paramGet('APP_CODE'), $ws->extractPage(__FILE__), 'command:list'));

$object = new BUS_object();
$status_select = $object->initSelect();
$status_select = $object->addSelect($status_select, "0", $ws->getConfigVars("Lbl_status_0"));
$status_select = $object->addSelect($status_select, "1", $ws->getConfigVars("Lbl_status_1"));

$subject = new object_forum_subject();
$subject_select = $subject->displaySelect('', '');

$wcrud = new wcrud('object_forum_topic', $ws->extractPage(__FILE__));
$wcrud->titleSet(true); /* use Title */
$wcrud->pageSet(false); /* set processing type : true = in one box; false = force open new box */
$wcrud->writeSet(true); /* Forcer le crud en mode update */

$wcrud->deleteReturnSet('reload');

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
$wcrud->fieldSet('label');

if (($command != 'new') and ($command != 'create')) {
	$wcrud->fieldSet('maintab', 'tab');
		$wcrud->fieldSet('tab1', 'tabcontent','maintab');
}
			$wcrud->fieldSet('content', 'comment');
			$wcrud->rowsSet('content', 8);
			$wcrud->fieldLabelSet('content', false);
if (($command != 'new') and ($command != 'create')) {
		$wcrud->fieldSet('tab1_end', 'tabcontentend');
		$wcrud->fieldSet('tab2', 'tabcontent','maintab');
			$wcrud->fieldSet('alias', 'text');
			$wcrud->sizeSet('alias',60);
			$wcrud->fieldSet('alt', 'text');
			$wcrud->sizeSet('alt',80);
		$wcrud->fieldSet('tab2_end', 'tabcontentend');
	$wcrud->fieldSet('maintab_end', 'tabend','maintab');
}

if ($command == 'create') {
	$wcrud->filterSet('status_id', 1);
	$wcrud->filterSet('subject_id', $subjectId);
	$wcrud->filterSet('reference', $ws->connected_id());
	$wcrud->filterSet('author', $ws->connected_surname());
}
if ($command == 'update') {
	$wcrud->filterSet('ref_moderator', $ws->connected_id());
	$wcrud->filterSet('moderator', $ws->connected_surname());
}
$wcrud->displayCrud();

?>
