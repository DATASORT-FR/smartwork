<?php
/**
* API for notices management
*
* @package    use_question
* @subpackage Json api
* @version    1.0
* @date       19 May 2022
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
$notices->listSet('label');
$notices->listSet('title');
$notices->listSet('image');
$notices->listSet('description');
$notices->listSet('comp_image');
$notices->listSet('comp_description');

$notices->objectNameSet('object_question');

$notices->build();
?>
