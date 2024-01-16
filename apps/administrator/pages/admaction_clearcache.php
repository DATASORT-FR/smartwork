<?php
/**
* Action : clear cache
*
* @package    administration_action
* @version    1.0
* @date       23 May 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$ws->clearAllCache();

$display_html = 'refresh';
$ws->caching = false;
$ws->build($display_html);
?>
