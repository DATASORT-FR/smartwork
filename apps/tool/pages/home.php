<?php
/**
* Main file for article
*
* @package    Test
* @subpackage controller
* @version    1.0
* @date       15 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('home.tpl');
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_template_outil.php';
require_once($filePath);

$ws->paramSet('CONTENT_RIGHT_DELETE', False);
$ws->assign('classPage', 'home');

// Situation diagram
$ws->assign('situationTitle','Ma situation');
$connect = new object_connect();
$pageSituation = $connect->constructHref($ws->paramGet('APP_CODE'),  'outil_situation');
$ws->assign('pageSituation', $pageSituation);

// Variables crud
$ws->assign('variableTitle','Mes informations');
$connect = new object_connect();
$pageVariable = $connect->constructHref($ws->paramGet('APP_CODE'),  'outil_variable');
$ws->assign('pageVariable', $pageVariable);

// Result
$ws->assign('resultTitle','Mon diagnostic');
$connect = new object_connect();
$pageResult = $connect->constructHref($ws->paramGet('APP_CODE'),  'outil_result');
$ws->assign('pageResult', $pageResult);

//  Procédure
$ws->assign('procedureTitle','Ma procédure');
$connect = new object_connect();
$pageProcedure = $connect->constructHref($ws->paramGet('APP_CODE'),  'outil_procedure');
$pageDossier = $connect->constructHref($ws->paramGet('APP_CODE'),  'outil_dossier');
$downloadDossier = $connect->constructHref($ws->paramGet('APP_CODE'),  'outil_download');
$sendDossier = $connect->constructHref($ws->paramGet('APP_CODE'),  'outil_send');
$ws->assign('pageDossier', $pageDossier);
$ws->assign('pageProcedure', $pageProcedure);
$ws->assign('downloadDossier', $downloadDossier);
$ws->assign('sendDossier', $sendDossier);

$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), 'outil');

$ws->caching = false;
$ws->build('home.tpl');
?>