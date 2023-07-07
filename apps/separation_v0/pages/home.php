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

$ws->assign('classPage', 'home');

$title = $ws->getConfigVars("Txt_home_title");
$ws->pageTitleSet($title);
$ws->pageDescriptionSet($ws->getConfigVars("Txt_home_description"));
$ws->pageKeywordsSet($ws->getConfigVars("Txt_home_keywords"));

$connect = new object_connect();
$linkLoginBox = '';
if (!$flagConnect) {
	$linkLoginBox = $connect->constructHref($ws->paramGet('APP_CODE'), 'loginbox');
}
$content = new Wcontent();
$ws->assign('listBlock', $content->displayList('dossiers','style:homelist','max:3'));

$ws->logTrace($ws->paramGet('APP_CODE'), 'home', $ws->paramGet('ID'), $title);

$ws->caching = false;
$ws->build('home.tpl');

?>