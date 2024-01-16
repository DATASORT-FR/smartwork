<?php
/**
* Page : Content page for articles
*
* @package    default_initialization
* @version    1.0
* @date       15 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$social = new Wsocial();
$displayHtml = $social->displayShare('facebook', 'linkedin', 'google', 'twitter', 'square:no');

?>