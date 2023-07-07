<?php
/**
* Main file for diagram chart
*
* @package    Diagram svg
* @subpackage controller
* @version    1.0
* @date       28 September 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();

$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_templateHome.php';
require_once($filePath);

$connect = new object_connect();
$ws->assign('pageRef', $connect->constructHref($ws->paramGet('APP_CODE'), 'diagram-design'));
$ws->assign('pageEdit', $connect->constructHref($ws->paramGet('APP_CODE'), 'diagram-edit'));
$ws->assign('pageDelete', '');
$ws->assign('titleDelete', '');
$ws->assign('labelDelete', '');

$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $ws->urlTitleGet());

$ws->caching = false;
$ws->build('diagram.tpl');

?>