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

$ws->pageDescriptionSet('');
$ws->pageKeywordsSet('');
$ws->pageNewsKeywordsSet('');
$ws->pageImageSet('');

$ws->siteTitleSet($ws->getConfigVars("Txt_app_title"));
$ws->urlTitleSet($ws->getConfigVars("Txt_page_title"));
