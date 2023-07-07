<?php
/**
* list-landing-page file for Separation
*
* @package    Separation
* @subpackage controller
* @version    1.0
* @date       15 Februer 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('list_landing.tpl');
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_template.php';
require_once($filePath);

$ws->assign('classPage', 'landing');

// Main
$content = new Wcontent();
$ws->assign('contentBlock', $content->display('landing-header','style:simple'));
$title = $content->displayGet('title');
$ws->assign('listBlock', $content->displayList('landing', 'style:blog'));

$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $title);

$ws->caching = false;
$ws->build('list_landing.tpl');

?>