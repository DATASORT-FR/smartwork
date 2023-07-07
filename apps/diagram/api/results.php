<?php
/**
* API for results management
*
* @package    use_result
* @subpackage Json api
* @version    1.0
* @date       15 March 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$results = new API_object();
$results->objectNameSet('object_field_result');

$results->build();
?>
