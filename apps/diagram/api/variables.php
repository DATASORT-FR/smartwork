<?php
/**
* API for variables management
*
* @package    use_variable
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

$variables = new API_object();
$variables->objectNameSet('object_field_variable');

$variables->build();
?>
