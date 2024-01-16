<?php
/**
* Main file for default app
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
$ws->control('index.tpl');

// Main zone
$connect = new object_connect();
$content = new Wcontent();
$ws->assign('PageBlock', $content->display('article1','style:home'));

$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $ws->urlTitleGet());
$ws->build('index.tpl');
?>