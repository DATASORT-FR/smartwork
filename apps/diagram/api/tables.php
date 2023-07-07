<?php
/**
* API for tables management
*
* @package    use_table
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

$tables = new API_object();
$tables->objectNameSet('object_field_table');

$tables->build();
?>
