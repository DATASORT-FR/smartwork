<?php
/**
* Copy of tables fields
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

$tableId = $ws->paramGet('ID');
if ($tableId != '') {
	$_SESSION['object_table_id'] = $tableId;
}
else {
	$tableId = $_SESSION['object_table_id'];
}

$copyFlag = false;
if ($tableId != '') {
	$table = new object_field_table();
	$copyFlag = $table->copy($tableId)->statusGet();
}
$ws->build('return');

?>
