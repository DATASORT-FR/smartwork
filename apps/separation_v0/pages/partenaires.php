<?php
/**
* Main file for partners
*
* @package    partners
* @subpackage controller
* @version    1.0
* @date       15 May 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('partenaires.tpl');
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_template.php';
require_once($filePath);

$ws->assign('classPage', 'partenaires');

$content = new Wcontent();
$ws->assign('contentBlock', $content->display('partenaires','style:enconstruction'));
$title = $content->displayGet('title');
//$ws->assign('contentBlock', $content->display('partenaires','style:header'));
//$ws->assign('listBlock', $content->displayList('blog2', 'style:card'));

$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $title);

$ws->caching = false;
$ws->build('partenaires.tpl');
?>