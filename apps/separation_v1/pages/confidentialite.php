<?php
/**
* Main file for confidentiality page
*
* @package    confidentiality
* @subpackage controller
* @version    1.0
* @date       15 July 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('confidentialite.tpl');
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_template.php';
require_once($filePath);

$ws->assign('classPage', 'confidentialite');

$content = new Wcontent();
$ws->assign('contentBlock', $content->display('confidentialite','style:header'));
$title = $content->displayGet('title');

$ws->logTrace($ws->paramGet('TRACE_NAME'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $title);

$ws->caching = false;
$ws->build('confidentialite.tpl');
?>