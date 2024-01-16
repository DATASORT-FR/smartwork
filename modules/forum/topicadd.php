<?php
/**
* Forum : add for forum topic
*
* @package    forum_module
* @version    1.0
* @date       15 December 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$displayHtml = '';

?>