<?php
/**
* API for diagrams management
*
* @package    use_diagram
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

$domains = new API_object();
$domains->objectNameSet('object_diagram');

$domains->build();
?>
