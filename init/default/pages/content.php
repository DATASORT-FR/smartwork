<?php
/**
* Page : Content page for articles
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
$ws->control('content.tpl');

$id = $ws->paramGet('ID');
// Main zone
$content = new Wcontent();
if ($content->ctrl($id)) {
	$contentHtml= $content->display($id);
	$ws->assign('Content', $contentHtml);
	$title = $content->displayGet('title');
	$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $title);
	$ws->build('content.tpl');
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
