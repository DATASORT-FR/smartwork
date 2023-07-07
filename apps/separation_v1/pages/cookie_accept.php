<?php
/**
* Main file for cookie accept
*
* @package    Separation 
* @subpackage controller
* @version    1.0
* @date       14 March 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();

$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));

$ws->cookieResponseSet(true);
$ws->cookieFlagSet(true);

echo 'Ok';
exit();

?>