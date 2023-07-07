<?php
/**
* traces api for daigram
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
$traces->listSet('id');
$traces->listSet('date_creation');
$traces->listSet('date_update');
$traces->listSet('session');
$traces->listSet('reference');
$traces->listSet('user');
$traces->listSet('domain_id');
$traces->listSet('domain_name');
$traces->listSet('situation_id');
$traces->listSet('situation_nodes');
$traces->listSet('process_id');
$traces->listSet('process_nodes');
$traces->listSet('slide');

$traces->createSet('init');
$traces->objectNameSet('object_trace');

$traces->build();

?>
