<?php
/**
* API for slides management
*
* @package    use_slide
* @subpackage Json api
* @version    1.0
* @date       21 June 2022
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

$notices->objectNameSet('object_slide');

$notices->build();
?>
