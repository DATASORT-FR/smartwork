<?php
/**
* blog article list page
*
* @package    default_initialization
* @version    1.0
* @date       15 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('blog.tpl');

// Main
$content = new Wcontent();
$connect = new object_connect();
$ws->assign('pageBlock', $content->display('blogheader'));
$ws->assign('listBlock', $content->displayList('blog', 'style:blog'));

$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $ws->urlTitleGet());
$ws->build('blog.tpl');

?>