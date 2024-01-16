<?php
/**
* Site Source url list api
*
* @package    administration_visitor
* @version    1.0
* @date       26 October 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

header( 'content-type: application/json; charset=utf-8' );

$exploration = $ws->argPost('exploration');

if (empty($exploration)) {
	$exploration = 7;
}
$visitor = new object_visitor();
$list = $visitor->getListUrl($exploration);

header('Content-Type: application/json');
echo json_encode($list);

?>
