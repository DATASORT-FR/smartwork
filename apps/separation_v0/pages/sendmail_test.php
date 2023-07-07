<?php
/**
* Password lost page
*
* @package    Login
* @subpackage controller
* @version    1.0
* @date       5 August 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
//$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_template.php';
//require_once($filePath);

error_reporting(E_ALL);
ini_set("display_errors", 1);

$login = $ws->argPost('login');

$to = $login;

$token = '';
$connect = new object_connect();
$linkValidation = $connect->constructHref($ws->paramGet('APP_CODE'), "user_validation", "key:" . $token);
$ws->assign('LinkValidation', $linkValidation);

$from = 'alain.vandeputte@datasort.fr';
$to = 'vandeputtealain@orange.fr';
$subject = "Validation d'inscription";
$bodyHtml = "<div>Validation d'inscription corps Html</div>";
$bodyTxt = "Validation d'inscription corps Text";
$return = mailSend($from, $to, $subject, $bodyHtml, $bodyTxt);

if (!$return) {
	echo 'Message non envoyé';
} 
else {
	echo 'Message bien envoyé';
}

?>
