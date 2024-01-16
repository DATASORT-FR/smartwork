<?php
/**
* inscription validation mail
*
* @package    module_login
* @version    1.0
* @date       5 August 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));

$userId = 0;
$login = $ws->argPost('login');

$wlogin = new wlogin();
$return = $wlogin->sendMailValidation($login);

if ($return) {
	$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $ws->urlTitleGet());
}
?>
