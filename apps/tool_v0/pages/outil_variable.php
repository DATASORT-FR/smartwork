<?php
/**
* Main file for diagram variables design
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

$domainId = $ws->paramGet('APP_PARAM_DOMAIN', SEPARATION_DOMAIN_ID);
$userId = 0;
$flagConnect = false;

if ($ws->sessionGet('connect_id') <> $ws->paramGet('USER_GUEST')) {
	$flagConnect = $ws->connected();
}
if ($flagConnect) {
	$userId = $ws->connected_id();
}
if ($userId == 0) {
	$reference = '';
}
else {
	$reference = strval($userId);
}

$nodeCode = $ws->argGet('code');
$step = $ws->argGet('step');
$id = initTrace($domainId, $reference);

$categoryFlag = false;
$variableList = analyseVariable($id, $nodeCode, $step);
if (count($variableList) > 0) {
	header("HTTP/1.0 200 OK");
	$displayHtml = showVariable($id, $variableList, $categoryFlag);
	echo($displayHtml);
}
else {
	header("HTTP/1.0 404 Not Found");
}
exit();
?>