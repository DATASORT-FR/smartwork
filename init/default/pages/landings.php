<?php
/**
* Landing pages
*
* @package    default_initialization
* @version    1.0
* @date       15 May 2018
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('landings.tpl');

// Main
$content = new Wcontent();
$connect = new object_connect();
$ws->assign('pageBlock', $content->display('landingheader'));

$ws->assign('listBlock', $content->displayList('landing', 'content_page:landing', 'style:landing'));

$ws->caching = false;
$ws->build('landings.tpl');
?>