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

$social = new Wsocial();
$socialBlock = $social->display('facebook', 'linkedin', 'twitter', 'square:yes');
$ws->assign('socialBlock', $socialBlock);

$wmenu = new wmenu();

$ws->assign('MenuHeader1',$wmenu->display($ws->paramGet('APP_CODE'), 'MD_HEADER1', 'simple'));
$ws->assign('MenuHeader2',$wmenu->display($ws->paramGet('APP_CODE'), 'MD_HEADER2', 'simple'));
$ws->assign('MenuHeader3',$wmenu->display($ws->paramGet('APP_CODE'), 'MD_HEADER3', 'simple'));
$ws->assign('MenuNav',$wmenu->display($ws->paramGet('APP_CODE'), 'MD_MAIN', 'simple'));
$ws->assign('MenuFooter',$wmenu->display($ws->paramGet('APP_CODE'), 'MD_FOOTER', 'simple'));

$menuBack = true;
If (!empty($ws->paramGet('APP_ONLY'))) {
	$menuBack = false;
}
$ws->assign('MenuBack',$menuBack);

$connect = new object_connect();
$ws->assign('LinkHome', $connect->constructHref($ws->paramGet('APP_CODE')));
$ws->assign('LinkLogin', $connect->constructHref($ws->paramGet('APP_CODE'), 'login'));

$content = new Wcontent();
$footer1= $content->display('footer1','style: intro_simple', 'header: 3', 'icon: text-height');
$ws->assign('Footer1Block', $footer1);

$footer2 = $content->display('footer2','style: intro_simple', 'header: 3', 'icon: wrench');
$ws->assign('Footer2Block', $footer2);

$footer3 = $content->display('footer3','style: intro_simple', 'header: 3', 'icon: paperclip');
$ws->assign('Footer3Block', $footer3);

$thumbnails = new JF_Thumbnails();
$thumbnailsBlock = $thumbnails->display();
$ws->assign('ThumbnailsBlock', $thumbnailsBlock);

$flagConnect = false;
$nameConnect = "";
if ($ws->sessionGet('connect_id') <> $ws->paramGet('USER_GUEST')) {
	$flagConnect = $ws->connected();
	$nameConnect = $ws->connected_name();
}
$ws->assign('flagConnect',$flagConnect);
$ws->assign('nameConnect',$nameConnect);
