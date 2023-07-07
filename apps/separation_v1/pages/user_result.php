<?php
/**
* Main file for diagram results design for user
*
* @package    User
* @subpackage controller
* @version    1.0
* @date       14 August 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();

$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_diagnostic.php';
require_once($filePath);

$categoryDiagnostic = SEPARATION_RESULT_CATEGORY;
$categoryProcedure = SEPARATION_PROCEDURE_CATEGORY;
$categoryDossier = SEPARATION_DOSSIER_CATEGORY;

$title = 'Utilisateur-Résultat';
$ws->logTrace($ws->paramGet('TRACE_NAME'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $title);

$userId = $ws->paramGet('ID');
$userCode = '';
$displayHtmlDiagnostic = '';
$displayHtmlProcedure = '';
$displayHtmldossier = '';
if ($userId == '') {
	$userId = $ws->sessionGet('user_result_id');
}
else {
	$ws->sessionSet('user_result_id', $userId);
}
if ($userId != 0) {
	$user = new object_user(); /* Open user class */
	$userDisplay = $user->display($userId);
	$userCode = $userDisplay->returnGet()['login'];

	$displayHtmlDiagnostic = displayResult($categoryDiagnostic, strval($userId));
	$displayHtmlProcedure = displayResult($categoryProcedure, strval($userId));
	$displayHtmldossier = displayResult($categoryDossier, strval($userId));
}

$downloadDossier = $connect->constructHref($ws->paramGet('APP_CODE'),  'outil_download') . '?id=' . $userId;

$ws->assign('userCode', $userCode);
$ws->assign('diagnostic', $displayHtmlDiagnostic);
$ws->assign('procedure', $displayHtmlProcedure);
$ws->assign('dossier', $displayHtmldossier);
$ws->assign('downloadDossier', $downloadDossier);

$ws->build('user_result.tpl');

?>