<?php
/**
* Administration actions
*
* @package    
* @subpackage controller
* @version    1.0
* @date       23 May 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('parametres.tpl');
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_template.php';
require_once($filePath);

$ws->assign('classPage', 'parametres');

$connect = new object_connect();
$ws->assign('LinkPhoneEnable', $connect->constructHref($ws->paramGet('APP_CODE'), 'parametres_phone', 'action:enable'));
$ws->assign('LinkPhoneDisable', $connect->constructHref($ws->paramGet('APP_CODE'), 'parametres_phone', 'action:disable'));
$ws->assign('linkClearCache', $connect->constructHref($ws->paramGet('APP_CODE'), 'parametres_clearcache'));

$ws->caching = false;
$ws->build('parametres.tpl');
?>
