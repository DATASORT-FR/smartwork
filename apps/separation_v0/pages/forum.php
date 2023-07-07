<?php
/**
* Main file for forum
*
* @package    forum
* @subpackage controller
* @version    1.0
* @date       21 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));

//$ws->control('forum.tpl');
//$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_template.php';
//require_once($filePath);

//$ws->assign('classPage', 'forum');

//$content = new Wcontent();
//$ws->assign('contentBlock', $content->display('forum','style:enconstruction'));
//$title = $content->displayGet('title');

//$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $title);

//$ws->caching = false;
//$ws->build('forum.tpl');

$connect = new object_connect();
header('Location: ' . $connect->constructHref('FORUM', 'fullpath:true'));
exit();

?>