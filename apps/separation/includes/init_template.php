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

// Css files
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_TEMPLATES_CSS_DIR') . 'template.less';
if (file_exists($filePath)) {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_RELA_TEMPLATES_CSS_DIR') . 'template.less';
	$ws->addcss($filePath);
}

// Javascript files
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_TEMPLATES_JS_DIR') . 'template.js';
if (file_exists($filePath)) {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_RELA_TEMPLATES_JS_DIR') . 'template.js';
	$ws->addjs($filePath, false);
}

// Page params
$ws->pageDescriptionSet('');
$ws->pageKeywordsSet('');
$ws->pageNewsKeywordsSet('');
$ws->pageImageSet('');

$ws->siteTitleSet($ws->getConfigVars("Txt_app_title"));
$ws->twitterTitleSet($ws->getConfigVars("Txt_twitter_title"));
$ws->urlTitleSet($ws->getConfigVars("Txt_default_title"));
$ws->urlDescriptionSet($ws->getConfigVars("Txt_default_description"));
$ws->urlKeywordsSet($ws->getConfigVars("Txt_default_keywords"));
$ws->urlNewsKeywordsSet($ws->getConfigVars("Txt_default_newsKeywords"));

$menuBack = true;
If (!empty($ws->paramGet('APP_ONLY'))) {
	$menuBack = false;
}
$ws->assign('menuBack',$menuBack);

// Links
$connect = new object_connect();
$ws->assign('LinkHome', $connect->constructHref($ws->paramGet('APP_CODE')));
$ws->assign('LinkAPropos', $connect->constructHref($ws->paramGet('APP_CODE'), 'apropos'));
$ws->assign('LinkDossiers', $connect->constructHref($ws->paramGet('APP_CODE'), 'dossiers'));
$ws->assign('LinkBonPlans', $connect->constructHref($ws->paramGet('APP_CODE'), 'bonplans'));
$ws->assign('LinkActualites', $connect->constructHref($ws->paramGet('APP_CODE'), 'actualites'));
//$ws->assign('LinkForum', $connect->constructHref($ws->paramGet('APP_CODE'), 'forum'));
$ws->assign('LinkForum', $connect->constructHref('FORUM', 'fullpath:true'));
$ws->assign('LinkContact', $connect->constructHref($ws->paramGet('APP_CODE'), 'contact'));
$ws->assign('LinkDiagnostic', $connect->constructHref($ws->paramGet('APP_CODE'), 'diagnostic'));
$ws->assign('LinkStatistics', $connect->constructHref($ws->paramGet('APP_CODE'), 'data_statistics'));
$ws->assign('LinkParameters', $connect->constructHref($ws->paramGet('APP_CODE'), 'parametres'));
$ws->assign('LinkUsers', $connect->constructHref($ws->paramGet('APP_CODE'), 'user'));
$ws->assign('LinkLandings', $connect->constructHref($ws->paramGet('APP_CODE'), 'list_landing'));
$ws->assign('LinkLogin', $connect->constructHref($ws->paramGet('APP_CODE'), 'login'));
$ws->assign('LinkMonCompte', $connect->constructHref($ws->paramGet('APP_CODE'), 'moncompte'));

$ws->assign('LinkPartenaires', $connect->constructHref($ws->paramGet('APP_CODE'), 'partenaires'));
$ws->assign('LinkCookies', $connect->constructHref($ws->paramGet('APP_CODE'), 'cookies'));
$ws->assign('LinkCGU', $connect->constructHref($ws->paramGet('APP_CODE'), 'cgu'));
$ws->assign('LinkConfidentialite', $connect->constructHref($ws->paramGet('APP_CODE'), 'confidentialite'));
$ws->assign('LinkMentionsLegales', $connect->constructHref($ws->paramGet('APP_CODE'), 'mentions_legales'));
$ws->assign('LinkSiteMap', $connect->constructHref($ws->paramGet('APP_CODE'), 'sitemap', 'mode:xml'));

$ws->assign('LinkOutil', $connect->constructHref($ws->paramGet('APP_CODE'), 'outil'));
$ws->assign('LinkLoginBox', $connect->constructHref($ws->paramGet('APP_CODE'), 'loginbox'));
$ws->assign('LinkCookieAccept', $connect->constructHref($ws->paramGet('APP_CODE'), 'cookie_accept'));
$ws->assign('LinkCookieDismiss', $connect->constructHref($ws->paramGet('APP_CODE'), 'cookie_dismiss'));

if ($ws->paramGet('APP_PARAM_PHONE', 'false') != 'false') {
	$flagPhone = true;
}
else {
	$flagPhone = false;
}

// connection informations
$ws->assign('flagPhone', $flagPhone);
$ws->assign('flagConnect',$flagConnect);
$ws->assign('flagAdmin',$flagAdmin);
$ws->assign('nameConnect',$nameConnect);

