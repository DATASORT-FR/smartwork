<?php
/**
* Forum : topic list
*
* @package    forum_module
* @version    1.0
* @date       20 January 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

// Main
$page = $ws->argGet('p');
$subjectId = $ws->argGet('subject');
$listStyle = $ws->argGet('style');
$max = $ws->argGet('max');
$header = $ws->argGet('header');

$forum = new Wforum();
$displayHtml = $forum->fetchListTopic('subject:'.$subjectId, 'style:'.$listStyle, 'max:'.$max, 'header:'.$header);

$smarty = new workpage();
$forum->initSmarty($smarty);
$smarty->assign('displayHtml',$displayHtml);
$smarty->display('simple.tpl');
?>
