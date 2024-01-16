<?php
/**
* Content page
*
* @package    content_module
* @version    1.0
* @date       19 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

// Main
$contentId = $ws->paramGet('ID');
if ($contentId != '') {
	$_SESSION['object_content_id'] = $contentId;
}
else {
	$contentId = $_SESSION['object_content_id'];
}

$content = array();
$moduleContent = new Wcontent();
$objContent = new object_content();
$fct_return = $objContent->display($contentId);
if ($fct_return->statusGet()) {
	$content = $fct_return->returnGet();
	$content['current_style'] = $content['style'];
	$displayHtml = $moduleContent->fetch($content);
}
else {
	$displayHtml = $ws->getConfigVars("Txt_Content_not_found");	
}

$smarty = new workpage();
$moduleContent->initSmarty($smarty);
$smarty->assign('displayHtml',$displayHtml);
$smarty->display('content.tpl');
?>
