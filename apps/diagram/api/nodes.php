<?php
/**
* API for nodes management
*
* @package    use_node
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

$nodes = new API_object();

$nodes->listSet('id');
$nodes->listSet('domain_id');
$nodes->listSet('domain_name');
$nodes->listSet('diagram_id');
$nodes->listSet('diagram_name');
$nodes->listSet('diagram_type');
$nodes->listSet('root');
$nodes->listSet('reference');
$nodes->listSet('title');
$nodes->listSet('process_id');
$nodes->listSet('process_name');
$nodes->listSet('image_display');
$nodes->listSet('image');
$nodes->listSet('description');
$nodes->listSet('question');
$nodes->listSet('process_text');

$nodes->objectNameSet('object_node');

$nodes->build();
?>
