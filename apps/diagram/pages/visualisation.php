<?php
/**
* Main file for diagram chart
*
* @package    Diagram svg
* @subpackage controller
* @version    1.0
* @date       28 September 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();

$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$visuJs = $ws->paramGet($ws->paramGet('APP_NAME') . '_RELA_JS_DIR') . 'visu-diagram.js';
$ws->assign('visuJs', $visuJs);

$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_templateHome.php';
require_once($filePath);

$diagram = new object_diagram();
$diagramSelect = $diagram->displaySelect()->returnGet();

$connect = new object_connect();
$ws->assign('pageRef', $connect->constructHref($ws->paramGet('APP_CODE'), 'diagram_visualisation'));
$ws->assign('listDiagram', $diagramSelect);

$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $ws->urlTitleGet());

$ws->caching = false;
$ws->build('visualisation.tpl');

?>