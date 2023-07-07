<?php
/**
* Error file for "planète divorce"
*
* @package    divorce
* @subpackage controller
* @version    1.0
* @date       05 June 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

// Main zone
$ws->build('error.tpl');
?>