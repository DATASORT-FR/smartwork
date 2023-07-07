<?php
/**
* This file contains template initialization code
*
* @package    global
* @subpackage initialization
* @version    1.2
* @date       25 November 2013
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

header( 'content-type: text/html; charset=utf-8' );

// Template css
//$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_TEMPLATES_CSS_DIR') . 'template.css';
//if (file_exists($filePath)) {
//	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_RELA_TEMPLATES_CSS_DIR') . 'template.css';
//	$ws->addcss($filePath);
//}

$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_TEMPLATES_CSS_DIR') . 'template_outil.css';
if (file_exists($filePath)) {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_RELA_TEMPLATES_CSS_DIR') . 'template_outil.css';
	$ws->addcss($filePath);
}

// Template js
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_TEMPLATES_JS_DIR') . 'template.js';
if (file_exists($filePath)) {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_RELA_TEMPLATES_JS_DIR') . 'template.js';
	$ws->addjs($filePath);
}

$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_TEMPLATES_JS_DIR') . 'template_outil.js';
if (file_exists($filePath)) {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_RELA_TEMPLATES_JS_DIR') . 'template_outil.js';
	$ws->addjs($filePath, false);
}

// Page params
$ws->pageDescriptionSet('');
$ws->pageKeywordsSet('');
$ws->pageNewsKeywordsSet('');
$ws->pageImageSet('');

$ws->siteTitleSet($ws->getConfigVars("Txt_app_title"));
$ws->twitterTitleSet($ws->getConfigVars("Txt_twitter_title"));
$ws->urlTitleSet($ws->getConfigVars("Txt_tool_title"));
$ws->urlDescriptionSet($ws->getConfigVars("Txt_tool_description"));
$ws->urlKeywordsSet($ws->getConfigVars("Txt_tool_keywords"));
$ws->urlNewsKeywordsSet($ws->getConfigVars("Txt_default_newsKeywords"));

$menuBack = true;
If (!empty($ws->paramGet('APP_ONLY'))) {
	$menuBack = false;
}
$ws->assign('menuBack',$menuBack);

// Links
$connect = new object_connect();
$ws->assign('LinkHome', $connect->constructHref('SEPARATION', 'fullpath:true'));
$ws->assign('LinkAPropos', $connect->constructHref('SEPARATION', 'apropos', 'fullpath:true'));
$ws->assign('LinkDossiers', $connect->constructHref('SEPARATION', 'dossiers', 'fullpath:true'));
$ws->assign('LinkBonPlans', $connect->constructHref('SEPARATION', 'bonplans', 'fullpath:true'));
$ws->assign('LinkActualites', $connect->constructHref('SEPARATION', 'actualites', 'fullpath:true'));
$ws->assign('LinkForum', $connect->constructHref($ws->paramGet('APP_CODE')));
$ws->assign('LinkContact', $connect->constructHref('SEPARATION', 'contact', 'fullpath:true'));
$ws->assign('LinkDiagnostic', $connect->constructHref($ws->paramGet('APP_CODE')));
$ws->assign('LinkParameters', $connect->constructHref($ws->paramGet('APP_CODE'), 'parameters'));
$ws->assign('LinkLogin', $connect->constructHref($ws->paramGet('APP_CODE'), 'login'));
$ws->assign('LinkMonCompte', $connect->constructHref($ws->paramGet('APP_CODE'), 'moncompte'));

$ws->assign('LinkLoginBox', $connect->constructHref($ws->paramGet('APP_CODE'), 'loginbox'));
$ws->assign('LinkCookieAccept', $connect->constructHref($ws->paramGet('APP_CODE'), 'cookie_accept'));
$ws->assign('LinkCookieDismiss', $connect->constructHref($ws->paramGet('APP_CODE'), 'cookie_dismiss'));

$flagAdmin = false;
if ($ws->connected() and ($ws->connected_id() == $ws->paramGet('USER_SUPERADMIN'))) {
	$flagAdmin = true;
}

// connection informations
$ws->assign('flagConnect',$flagConnect);
$ws->assign('flagAdmin',$flagAdmin);
$ws->assign('nameConnect',$nameConnect);

