<?php
/**
* Main file for actuaelites
*
* @package    actualites
* @subpackage controller
* @version    1.0
* @date       15 May 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('actualites.tpl');
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_template.php';
require_once($filePath);

$ws->assign('classPage', 'actualites');

$content = new Wcontent();
$ws->assign('contentBlock', $content->display('actualites-header','style:simple'));
$title = $content->displayGet('title');
$ws->assign('listBlock', $content->displayList('actualites', 'style:blog'));

$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $title);

$ws->caching = false;
$ws->build('actualites.tpl');
?>