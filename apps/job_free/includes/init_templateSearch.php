<?php
/**
* This file contains template "Main" initialization code
*
* @package    global
* @subpackage initialization
* @version    1.2
* @date       25 November 2013
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

$login = new JF_Login();
$loginBlock = $login->display();
$ws->assign('LoginBlock', $loginBlock);

$statistics = new JF_Statistics();
$statisticsBlock = $statistics->display();
$ws->assign('StatisticsBlock', $statisticsBlock);

$caroussel = new JF_Caroussel();
$carousselBlock = $caroussel->display();
$ws->assign('CarousselBlock', $carousselBlock);

$wmenu = new wmenu();
$ws->assign('MenuNav',$wmenu->display($ws->paramGet('APP_CODE'), 'JF_MAIN', 'main', 'navbar-static-top navbar-dark bg-inverse'));
$ws->assign('MenuFooter',$wmenu->display($ws->paramGet('APP_CODE'), 'JF_FOOTER', 'simple'));

$social = new Wsocial();
$socialBlock = $social->display('facebook', 'linkedin', 'twitter', 'square:yes');
$ws->assign('socialBlock', $socialBlock);

$content = new Wcontent();
$footer1= $content->display('4','style: intro_simple', 'header: 3', 'icon: text-height');
$ws->assign('Footer1Block', $footer1);

$footer2 = $content->display('5','style: intro_simple', 'header: 3', 'icon: wrench');
$ws->assign('Footer2Block', $footer2);

$footer3 = $content->display('6','style: intro_simple', 'header: 3', 'icon: paperclip');
$ws->assign('Footer3Block', $footer3);

$thumbnails = new JF_Thumbnails();
$thumbnailsBlock = $thumbnails->display();
$ws->assign('ThumbnailsBlock', $thumbnailsBlock);

