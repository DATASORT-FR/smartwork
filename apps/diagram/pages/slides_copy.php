<?php
/**
* Copy of slides
*
* @package    use_slide
* @subpackage Json api
* @version    1.0
* @date       23 July 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$slideId = $ws->paramGet('ID');
if ($slideId != '') {
	$_SESSION['object_slide_id'] = $slideId;
}
else {
	$slideId = $_SESSION['object_slide_id'];
}

$copyFlag = false;
if ($slideId != '') {
	$slide = new object_slide();
	$copyFlag = $slide->copy($slideId)->statusGet();
}
$ws->build('return');

?>
