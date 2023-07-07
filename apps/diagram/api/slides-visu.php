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

header( 'content-type: application/json; charset=utf-8' );

$slideId = $ws->paramGet('ID');
if ($slideId != '') {
	$_SESSION['object_slideId'] = $slideId;
}
else {
	$slideId = 1;
	if (isset($_SESSION['object_slideId'])) {
		$slideId = $_SESSION['object_slideId'];
	}
}

//$reference = $ws->argPost('REFERENCE');
$reference = '';

$return = array();
$return['title'] = '';
$return['description'] = '';
$return['variable0'] = '';
$return['variable1'] = '';
$return['result0'] = '';
$return['result1'] = '';
$return['link'] = '';
$returnFlag = false;
$categoryFlag = false;

$objectslide = new object_slide();
$slide = $objectslide->display($slideId)->returnGet();
if ($slide) {
	$returnFlag = true;
	$domainId = $slide['domain_id'];
	$return['title'] = $slide['title'];
	$return['description'] = $slide['description'];
	$id = initTrace($domainId, $reference);

	$variableList = array();
	$variableList = analyseSlideVariable($id, $slideId, 0);
	if (count($variableList) > 0) {
		$returnFlag = true;
		$displayHtml = showVariable($id, $variableList, $categoryFlag);
		$return['variable0'] = $displayHtml;
	}
	$variableList = array();
	$variableList = analyseSlideVariable($id, $slideId, 1);
	if (count($variableList) > 0) {
		$returnFlag = true;
		$displayHtml = showVariable($id, $variableList, $categoryFlag);
		$return['variable1'] = $displayHtml;
	}

	$resultList = array();
	$resultList = analyseSlideResult($id, $slideId, 0);
	if (count($resultList) > 0) {
		$returnFlag = true;
		$displayHtml = showResult($id, $resultList, $categoryFlag);
		$return['result0'] = $displayHtml;
	}
	$resultList = array();
	$resultList = analyseSlideResult($id, $slideId, 1);
	if (count($resultList) > 0) {
		$returnFlag = true;
		$displayHtml = showResult($id, $resultList, $categoryFlag);
		$return['result1'] = $displayHtml;
	}
	$linkList = array();
	$linkList = analyseSlideLink($slideId);
	if (count($linkList) > 0) {
		$returnFlag = true;
		$return['link'] = $linkList;
	}


}
if ($returnFlag) {
	header("HTTP/1.0 200 OK");
	echo json_encode($return);

}
else {
	header("HTTP/1.0 404 Not Found");
}
exit();
?>