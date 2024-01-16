<?php
/**
* Password lost mail
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

$email = $ws->argPost('email');

$wlogin = new wlogin();
$return = $wlogin->sendMailPassword($email);

if ($return) {
	$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $ws->urlTitleGet());
}

?>
