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

$ws->siteTitleSet($ws->getConfigVars("Txt_site_title"));
$ws->pageDescriptionSet('');
$ws->pageKeywordsSet('');
$ws->pageNewsKeywordsSet('');
$ws->pageImageSet('');

$ws->assign('app_title', $ws->getConfigVars("Txt_app_title"));
$ws->assign('appGoogleVerif', $ws->getConfigVars("Txt_app_google_verif"));

$wmenu = new wmenu();
$ws->assign('menuNav1',$wmenu->display($ws->paramGet('APP_CODE'), 'DMG_MAIN', 'other'));
$ws->assign('menuNav2',$wmenu->display($ws->paramGet('APP_CODE'), 'DMG_DEF', 'other'));
$ws->assign('menuFooter',$wmenu->display($ws->paramGet('APP_CODE'), 'DMG_FOOTER', 'simple'));

$menuBack = true;
If (!empty($ws->paramGet('APP_ONLY'))) {
	$menuBack = false;
}
$ws->assign('menuBack',$menuBack);

$connect = new object_connect();
$ws->assign('LinkHome', $connect->constructHref($ws->paramGet('APP_CODE')));
$ws->assign('LinkLogin', $connect->constructHref($ws->paramGet('APP_CODE'), 'login'));
$ws->assign('LinkDomain', $connect->constructHref($ws->paramGet('APP_CODE'), 'domain'));

$domainName = '';
$domainId = '';	
$domainId = $ws->argGet('domainid');
if ($domainId != '') {
	$ws->sessionSet('object_domain_id', $domainId);
}
else {
	$domainId = $ws->sessionGet('object_domain_id');
}
if ($domainId != '') {
	$domain = new object_domain();
	$domainDisplay = $domain->display($domainId)->returnGet();
	$domainName = $domainDisplay['name'];
}

$flagConnect = false;
$nameConnect = "";
if ($ws->sessionGet('connect_id') <> $ws->paramGet('USER_GUEST')) {
	$flagConnect = $ws->connected();
	$nameConnect = $ws->connected_name();
}
$ws->assign('flagConnect',$flagConnect);
$ws->assign('nameConnect',$nameConnect);
$ws->assign('domainName',$domainName);
