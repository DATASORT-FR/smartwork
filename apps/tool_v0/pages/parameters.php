<?php
/**
* Administration actions
*
* @package    
* @subpackage controller
* @version    1.0
* @date       29 March 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('parameters.tpl');
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_template_outil.php';
require_once($filePath);

$ws->assign('classPage', 'parameters');

$title = $ws->getConfigVars('Title_parameters');

$domainId = $ws->paramGet('APP_PARAM_DOMAIN', SEPARATION_DOMAIN_ID);
$diagramId = $ws->paramGet('APP_PARAM_DIAGRAM', SEPARATION_DIAGRAM_ID);

$ws->assign('DomainId', $domainId);
$ws->assign('DiagramId', $diagramId);

$connect = new object_connect();
$ws->assign('LinkParamUpdate', $connect->constructHref($ws->paramGet('APP_CODE'), 'parameters_update'));
$ws->assign('linkClearCache', $connect->constructHref($ws->paramGet('APP_CODE'), 'parameters_clearcache'));

$ws->caching = false;
$ws->build('parameters.tpl');
?>
