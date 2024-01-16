<?php
/**
* This file contains template initialization code
*
* @package    administration_initialization
* @version    1.2
* @date       25 November 2013
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

header( 'content-type: text/html; charset=utf-8' );

$wlogin = new wlogin();
$wmenu = new wmenu();
$modulehistory = new whistory();

$ws->assign('IncConnect',$wlogin->displayConnect('inline', true, false));
$ws->assign('IncNav',$wmenu->display($ws->paramGet('APP_CODE'),'MAINMENU', 'main'));
$ws->assign('FlagHistory',$modulehistory->displayFlaghistory());
$ws->assign('IncHistory',$modulehistory->displayHistory());
