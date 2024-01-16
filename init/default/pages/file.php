<?php
/**
* File page
*
* @package    default_initialization
* @version    1.0
* @date       15 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('file.tpl');

$id = $ws->paramGet('ID');
// Main zone
$content = new Wcontent();
if ($content->ctrl($id)) {
	$ws->assign('PageBlock', $content->display($id));
	$param1 = $content->displayGet('param1');
	$title = $content->displayGet('title');
	if (empty($param1)) {
		$param1 = $title;
	}
	$ws->assign('Param1', $param1);
	
	$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $param1);
	$ws->build('file.tpl');
} 
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_DIR') . 'error.php';
	if (file_exists($filePath)) {
		require_once($filePath);
	}
	else {		
		$ws->build('error.tpl');
	}
}
?>