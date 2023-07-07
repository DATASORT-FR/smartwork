<?php
/**
* Copy of results fields
*
* @package    use_field
* @subpackage Json api
* @version    1.0
* @date       23 March 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$resultId = $ws->paramGet('ID');
if ($resultId != '') {
	$_SESSION['object_result_id'] = $resultId;
}
else {
	$resultId = $_SESSION['object_result_id'];
}

$copyFlag = false;
if ($resultId != '') {
	$result = new object_field_result();
	$copyFlag = $result->copy($resultId)->statusGet();
}
$ws->build('return');

?>
