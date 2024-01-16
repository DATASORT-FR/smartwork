<?php
/**
* Contents list
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
$code = $ws->argGet('code');
if (!empty($code)) {
	$ws->sessionSet('object_content_code', $code);
}
else {
	$code = $ws->sessionGet('object_content_code');
}

$content_page = $ws->argGet('content_page');
if (!empty($content_page)) {
	$ws->sessionSet('object_content_page', $content_page);
}
else {
	$content_page = $ws->sessionGet('object_content_page');
}

$category = $ws->argGet('category');
if (!empty($category)) {
	$ws->sessionSet('object_content_category', $category);
}
else {
	$category = $ws->sessionGet('object_content_category');
}

$page = $ws->argGet('p');
if (!empty($page)) {
	$ws->sessionSet('object_content_page_number', $page);
}
else {
	$page = $ws->sessionGet('object_content_page_number');
}

$style = $ws->argGet('style');
$classAdd = $ws->argGet('class');
$icon = $ws->argGet('icon');
$header = $ws->argGet('header');

$list = array();
$moduleContent = new Wcontent();
$objContent = new object_content();
$fct_return = $objContent->findList($ws->paramGet('APP_CODE_CONTENT'), $code, $category);
if ($fct_return->statusGet()) {
	$list['list'] = $fct_return->returnGet();
	$list['class'] = $classAdd;
	$list['icon'] = $icon;
	$list['header'] = $header;
	$list['style'] = $style;
	$list['code'] = $code;
	$list['category'] = $category;
	$list['page'] = $page;
	$list['content_page'] = $content_page;
	$displayHtml = $moduleContent->fetchList($list);
}

$smarty = new workpage();
$moduleContent->initSmarty($smarty);
$smarty->assign('displayHtml',$displayHtml);
$smarty->display('listcontent.tpl');
?>
