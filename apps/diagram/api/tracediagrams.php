<?php
/**
* diagam traces api for daigram
*
* @package    traces
* @subpackage Json api
* @version    1.0
* @date       15 May 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$traces = new API_object();
$traces->createSet('init');
$traces->objectNameSet('object_trace_diagram');

$traces->build();

?>
