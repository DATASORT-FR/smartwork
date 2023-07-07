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
$ws->control();

$argArray = $ws->argPost();
foreach($argArray as $key=>$value) {
	if (preg_match("/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/", $value)) {
		$aTemp = explode('/',$value);
		$value = $aTemp[2] .'-' . $aTemp[1] .'-' . $aTemp[0];
	}
	$argArray[$key] = $value;
}

$trace = new object_trace();
$fct_return = $trace->update($argArray);
if ($fct_return->statusGet()) {
	header('Content-Type: application/json');
	echo json_encode($fct_return->returnGet(), JSON_PRETTY_PRINT);
}
else {
	header("HTTP/1.0 404 Not Found");
}
exit();

?>