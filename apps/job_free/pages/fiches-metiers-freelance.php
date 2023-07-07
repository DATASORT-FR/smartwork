<?php
/**
* job Name file for Job freelance
*
* @package    Job Freelance
* @subpackage controller
* @version    1.0
* @date       10 May 2018
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('list-jobname.tpl');
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_templateMain.php';
require_once($filePath);

// Main

$content = new Wcontent();
$connect = new object_connect();
$ws->assign('pageBlock', $content->display('jobnameheader'));
$ws->assign('listBlock', $content->displayList('jobname', 'content_page:jobname', 'style:jobname', 'order:alpha'));

$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $ws->urlTitleGet());
$ws->build('list-jobname.tpl');

?>