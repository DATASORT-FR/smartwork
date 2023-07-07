<?php
/**
* Copy of result category
*
* @package    use_result_category
* @subpackage Json api
* @version    1.0
* @date       29 March 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$categoryId = $ws->paramGet('ID');
if ($categoryId != '') {
	$_SESSION['object_result_category_id'] = $categoryId;
}
else {
	$categoryId = $_SESSION['object_result_category_id'];
}

$copyFlag = false;
if ($categoryId != '') {
	$category = new object_result_category();
	$copyFlag = $category->copy($categoryId)->statusGet();
}
$ws->build('return');

?>
