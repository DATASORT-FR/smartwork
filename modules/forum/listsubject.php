<?php
/**
* Forum : subject list
*
* @package    forum_module
* @version    1.0
* @date       19 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

// Main
$page = $ws->argGet('p');
$application = $ws->argGet('application');
$categoryId = $ws->argGet('category');
$listStyle = $ws->argGet('style');
$max = $ws->argGet('max');
$caption = $ws->argGet('caption');
$header = $ws->argGet('header');

$forum = new Wforum();
$displayHtml = $forum->fetchListSubject('application:'.$application, 'category:'.$categoryId, 'style:'.$listStyle, 'max:'.$max, 'caption:'.$caption, 'header:'.$header);

$smarty = new workpage();
$forum->initSmarty($smarty);
$smarty->assign('displayHtml',$displayHtml);
$smarty->display('simple.tpl');
?>
