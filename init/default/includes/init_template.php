<?php
/**
* This file contains template initialization code
*
* @package    default_initialization
* @version    1.2
* @date       25 November 2013
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

header( 'content-type: text/html; charset=utf-8' );

$ws->pageDescriptionSet('');
$ws->pageKeywordsSet('');
$ws->pageNewsKeywordsSet('');
$ws->pageImageSet('');

$ws->siteTitleSet($ws->getConfigVars("Txt_app_title"));
$ws->urlTitleSet($ws->getConfigVars("Txt_page_title"));

$fileSide = new JF_FileSide();
$fileSideBlock = $fileSide->display();
$ws->assign('FilesSideBlock', $fileSideBlock);

$content = new Wcontent();
$ws->assign('ArticleSideBlock', $content->display('article4','style:intro_card','icon:cog'));

// Right Side zone
$contentside = new JF_Contentside();
$contentsideBlock = $contentside->display();
$ws->assign('ContentsSideBlock', $contentsideBlock);

$caroussel = new JF_Caroussel();
$carousselBlock = $caroussel->display();
$ws->assign('CarousselBlock', $carousselBlock);

$wmenu = new wmenu();
$ws->assign('MenuNav',$wmenu->display($ws->paramGet('APP_CODE'), 'JF_MAIN', 'main', 'navbar-static-top navbar-dark bg-inverse'));
$ws->assign('MenuFooter',$wmenu->display($ws->paramGet('APP_CODE'), 'JF_FOOTER', 'simple'));

$social = new Wsocial();
$socialBlock = $social->display('facebook', 'linkedin', 'twitter', 'square:yes');
$ws->assign('SocialBlock', $socialBlock);

// Links
$connect = new object_connect();
$ws->assign('LinkHome', $connect->constructHref($ws->paramGet('APP_CODE')));
$ws->assign('LinkLogin', $connect->constructHref($ws->paramGet('APP_CODE'), 'login'));
$ws->assign('LinkAccount', $connect->constructHref($ws->paramGet('APP_CODE'), 'account'));
$ws->assign('flagConnect', $ws->userConnected());

$content = new Wcontent();
$footer1= $content->display('footer1','style: intro_simple', 'header: 3', 'icon: text-height');
$ws->assign('Footer1Block', $footer1);
$ws->assign('Footer1Link', $connect->constructHref($ws->paramGet('APP_CODE'), 'code:FOOTER1'));

$footer2 = $content->display('footer2','style: intro_simple', 'header: 3', 'icon: wrench');
$ws->assign('Footer2Block', $footer2);
$ws->assign('Footer2Link', $connect->constructHref($ws->paramGet('APP_CODE'), 'code:footer2'));

$footer3 = $content->display('footer3','style: intro_simple', 'header: 3', 'icon: paperclip');
$ws->assign('Footer3Block', $footer3);
$ws->assign('Footer3Link', $connect->constructHref($ws->paramGet('APP_CODE'), 'code:footer3'));

$thumbnails = new JF_Thumbnails();
$thumbnailsBlock = $thumbnails->display();
$ws->assign('ThumbnailsBlock', $thumbnailsBlock);
