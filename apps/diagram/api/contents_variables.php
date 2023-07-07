<?php
/**
* API for variables content management
*
* @package    use_content_variables
* @subpackage Json api
* @version    1.0
* @date       31 May 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$content = new API_object();

$content->listSet('id');
$content->listSet('domain_id');
$content->listSet('domain_name');
$content->listSet('title');
$content->listSet('image');
$content->listSet('description');
$content->listSet('comp_image');
$content->listSet('comp_description');

$content->objectNameSet('object_content_variables');

$content->build();
?>
