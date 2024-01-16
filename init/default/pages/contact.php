<?php
/**
* Main file for contact
*
* @package    default_initialization
* @version    1.0
* @date       10 July 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('contact.tpl');
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_template.php';
require_once($filePath);

$ws->assign('classPage', 'contact');

$content = new Wcontent();
$ws->assign('contentBlock', $content->display('contact','style:header'));
$title = $content->displayGet('title');

$wContact = new Wcontact();
$ws->assign('contactBlock', $wContact->display());

//$connect = new object_connect();
//$contactAction = $connect->constructHref($ws->paramGet('APP_CODE'), "sendmail_contact");
//$ws->assign('ContactAction', $contactAction);

$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $title);

$ws->caching = false;
$ws->build('contact.tpl');
?>