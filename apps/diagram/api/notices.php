<?php
/**
* API for notices management
*
* @package    use_notice
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

$notices = new API_object();

$notices->listSet('id');
$notices->listSet('domain_id');
$notices->listSet('domain_name');
$notices->listSet('title');
$notices->listSet('image');
$notices->listSet('description');
$notices->listSet('comp_image');
$notices->listSet('comp_description');

$notices->objectNameSet('object_notice');

$notices->build();
?>
