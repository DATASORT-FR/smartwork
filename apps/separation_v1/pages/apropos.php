<?php
/**
* Main file for About us
*
* @package    about us
* @subpackage controller
* @version    1.0
* @date       15 December 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('apropos.tpl');
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_template.php';
require_once($filePath);

$ws->assign('classPage', 'apropos');

$content = new Wcontent();
$ws->assign('contentBlock', $content->display('apropos','style:apropos'));
$title = $content->displayGet('title');

$ws->logTrace($ws->paramGet('TRACE_NAME'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $title);

$ws->caching = false;
$ws->build('apropos.tpl');
?>