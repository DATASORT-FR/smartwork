<?php
/**
* Password lost page
*
* @package    module_contact
* @version    1.0
* @date       5 August 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));

if (!defined('MAIL_CONTACT_TO')) {
	define('MAIL_CONTACT_TO', '');
}

if (!empty(MAIL_CONTACT_TO)) {
	$name = $ws->argPost('name');
	$email = $ws->argPost('email');
	$phone = $ws->argPost('phone');
	$message = $ws->argPost('message');

	$from = $ws->getConfigVars("Mail_from") . ',' . $ws->getConfigVars("Mail_from_name");
	$to = MAIL_CONTACT_TO;

	$subject = $ws->getConfigVars("Mail_contact_subject");
	$bodyTxt = $ws->getConfigVars("Mail_contact_txt");
	$bodyTxt = preg_replace("#\[name\]#isU", $name, $bodyTxt);
	$bodyTxt = preg_replace("#\[email\]#isU", $email, $bodyTxt);
	$bodyTxt = preg_replace("#\[phone\]#isU", $phone, $bodyTxt);
	$bodyTxt = preg_replace("#\[message\]#isU", $message, $bodyTxt);

	$ws->assign("Name", $name);
	$ws->assign("Email", $email);
	$ws->assign("Phone", $phone);
	$ws->assign("Message", $message);
	$bodyHtml = $ws->displayFetch('mail_contact.tpl');
	
	$return = mailSend($from, $to, $subject, $bodyHtml, $bodyTxt);
}
else {
	$return = false;
}

if ($return) {
	echo 'Ok';
}
else {
	echo 'Ko';
}

?>
