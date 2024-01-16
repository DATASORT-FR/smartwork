<?php
/**
* Site Source today url list api 
*
* @package    administration_visitor
* @version    1.0
* @date       15 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

header('content-type: application/json; charset=utf-8');

$visitor = new object_visitor();
$list = $visitor->getListUrlDay();

header('Content-Type: application/json');
echo json_encode($list);

?>
