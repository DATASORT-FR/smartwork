<?php
/**
* file pages
*
* @package    default_initialization
* @version    1.0
* @date       10 May 2018
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('files.tpl');

// Main
$content = new Wcontent();
$connect = new object_connect();
$ws->assign('pageBlock', $content->display('fileheader'));
$ws->assign('listBlock', $content->displayList('file', 'content_page:file', 'style:file', 'order:alpha'));

$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $ws->urlTitleGet());
$ws->build('files.tpl');

?>