<?php
/**
* Page : Content page for articles
*
* @package    Job Freelance
* @subpackage controller
* @version    1.0
* @date       15 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('content.tpl');
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_template.php';
require_once($filePath);

$id = $ws->paramGet('ID');
// Main zone
$content = new Wcontent();
if ($content->ctrl($id)) {
	$content = new Wcontent();
	$contentBlock= $content->display($id);
	$ws->assign('contentBlock', $contentBlock);

	$code = $content->displayGet('code');
	$flagArticle = false;
	if (($code == 'ACTUALITES') or ($code == 'BONPLANS') or ($code == 'DOSSIERS')) {
		$flagArticle = true;
	}
	$ws->assign('contentCode', $code);

	$title = $content->displayGet('title');
	$ws->logTrace($ws->paramGet('TRACE_NAME'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $title);
	if ($flagArticle) {
		$contentSideBlock = $content->displayList($code,'style:contentside','max:5','random:true');
		$ws->assign('contentSideBlock', $contentSideBlock);
		$ws->build('content_article.tpl');
	}
	else {
		$ws->build('content.tpl');
	}
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
