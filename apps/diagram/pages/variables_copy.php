<?php
/**
* Copy of variables fields
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

$variableId = $ws->paramGet('ID');
if ($variableId != '') {
	$_SESSION['object_variable_id'] = $variableId;
}
else {
	$variableId = $_SESSION['object_variable_id'];
}

$copyFlag = false;
if ($variableId != '') {
	$variable = new object_field_variable();
	$copyFlag = $variable->copy($variableId)->statusGet();
}
$ws->build('return');

?>
