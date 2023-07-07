<?php
/**
* Main file for cgu
*
* @package    cgu
* @subpackage controller
* @version    1.0
* @date       10 July 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('cgu.tpl');
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_template.php';
require_once($filePath);

$ws->assign('classPage', 'cgu');

$content = new Wcontent();
$ws->assign('contentBlock', $content->display('cgu','style:header'));
$title = $content->displayGet('title');

$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $title);

$ws->caching = false;
$ws->build('cgu.tpl');
?>