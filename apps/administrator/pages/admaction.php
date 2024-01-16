<?php
/**
* Actions administration
*
* @package    administration_action
* @version    1.0
* @date       23 May 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('admaction.tpl');

$connect = new object_connect();

initWorkConfig($ws, 'admaction');

$ws->assign('pageClearCache', $connect->constructHref($ws->paramGet('APP_CODE'), 'admaction_clearcache'));

$ws->caching = false;
$ws->build('admaction.tpl');
?>
