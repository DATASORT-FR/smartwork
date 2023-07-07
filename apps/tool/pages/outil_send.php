<?php
/**
* Main file for diagram results design
*
* @package    Diagram 
* @subpackage controller
* @version    1.0
* @date       14 March 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();

$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_diagnostic.php';
require_once($filePath);

if (!defined('DOSSIER_CONTACT_TO')) {
	define('DOSSIER_CONTACT_TO', '');
}
$userId = 0;
$inscriptionId = $ws->sessionGet('inscription_id');
$flagInscription = false;
$resultSend = 'Unvalid';
if ($flagConnect) {
	$userId = $ws->connected_id();
}
if (($userId == 0) and ($inscriptionId != '')) {
	$flagInscription = true;
	$userId = $inscriptionId;
	$ws->sessionSet('inscription_id', 0);
	$ws->sessionSet('inscription_name', '');
}
if ((SEPARATION_ESPACE_DEBUG) or ($userId != 0)) {
	$categoryName = SEPARATION_DOSSIER_CATEGORY;
	$displayHtml = displayResult($categoryName);
	$ws->assign('contentBlock', $displayHtml);
	$ws->assign('imgLogo', encode_img_base64(SITE_ROOT_DIR . '/images/separation/en-tete-planete-separation.jpeg', 'jpeg'));
	$html = $ws->displayFetch('outil_download.tpl');
	$fileName = $ws->paramGet('UPLOADS_DIR') . strtolower($ws->paramGet('APP_NAME')) . '/' . 'dossier-avocat' . '-' . $userId . '-' . dateFormat('YYYYMMdd') . '.pdf';
	$return = html2PdfFile($fileName, $html);
	
	if ($return and (!empty(DOSSIER_CONTACT_TO))) {
		
		$connect = new object_connect();
		$fct_return = $connect->display($userId);
		if ($fct_return->statusGet()) {
			$array_login = $fct_return->returnGet();
			$name = $array_login['lastname'] . ' ' . $array_login['firstname'];
			$surname = $array_login['surname'];
			$email = $array_login['email'];
		}
		
		$from = $ws->getConfigVars("Mail_from") . ',' . $ws->getConfigVars("Mail_from_name");
		$to = DOSSIER_CONTACT_TO;

		$subject = $ws->getConfigVars("Mail_dossier_subject");
		$bodyTxt = $ws->getConfigVars("Mail_dossier_txt");
		$bodyTxt = preg_replace("#\[name\]#isU", $name, $bodyTxt);
		$bodyTxt = preg_replace("#\[email\]#isU", $email, $bodyTxt);
		$bodyTxt = preg_replace("#\[surname\]#isU", $surname, $bodyTxt);

		$ws->assign("Name", $name);
		$ws->assign("Email", $email);
		$ws->assign("Surname", $surname);
		$bodyHtml = $ws->displayFetch('mail_dossier.tpl');

		$title = 'Diagnostic-Envoi dossier';
		$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $title);
	
		$return = mailSend($from, $to, $subject, $bodyHtml, $bodyTxt, $fileName);
		if ($return) {
			if (!$flagInscription) {
				$resultSend = 'Ok1';
			}
			else {
				$resultSend = 'Ok2';
			}
		}
	}
}
echo $resultSend;
exit();
?>