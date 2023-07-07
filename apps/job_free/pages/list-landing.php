<?php
/**
* list-landing-page file for Job freelance
*
* @package    Job Freelance
* @subpackage controller
* @version    1.0
* @date       15 May 2018
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('list-landing.tpl');
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_templateMain.php';
require_once($filePath);

// Main
$content = new Wcontent();
$connect = new object_connect();
$ws->assign('pageBlock', $content->display('landingheader'));

$ws->assign('listBlock', $content->displayList('landing', 'content_page:landing', 'style:landing'));

$ws->caching = false;
$ws->build('list-landing.tpl');
?>