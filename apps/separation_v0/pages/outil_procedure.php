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

$categoryName = SEPARATION_PROCEDURE_CATEGORY;

$title = 'Diagnostic-Procédure';
$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $title);

$userId = 0;
$inscriptionId = $ws->sessionGet('inscription_id');
$flagInscription = false;
$displayHtml = 'Unvalid';
if ($flagConnect) {
	$userId = $ws->connected_id();
}
if (($userId == 0) and ($inscriptionId != '')) {
	$flagInscription = true;
	$userId = $inscriptionId;
	$ws->sessionSet('inscription_id', 0);
	$ws->sessionSet('inscription_name', '');
}
if ($userId != 0) {
	$displayHtml = displayResult($categoryName);
}
echo($displayHtml);
?>