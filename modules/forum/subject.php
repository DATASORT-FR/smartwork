<?php
/**
* Forum : subject page
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
$subjectId = $ws->paramGet('ID');
if ($subjectId != '') {
	$_SESSION['object_forum_subject_id'] = $subjectId;
}
else {
	$subjectId = $_SESSION['object_forum_subject_id'];
}
$style = $ws->argGet('style');

$forum = new Wforum();
$displayHtml = $forum->fetchSubject('id:'.$subjectId, 'style:'.$style);

$smarty = new workpage();
$forum->initSmarty($smarty);
$smarty->assign('displayHtml',$displayHtml);
$smarty->display('simple.tpl');
?>
