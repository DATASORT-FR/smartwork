<?php
/**
* clear cache
*
* @package    
* @subpackage controller
* @version    1.0
* @date       23 May 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$domainId = $ws->paramGet('APP_PARAM_DOMAIN', SEPARATION_DOMAIN_ID);
$diagramId = $ws->paramGet('APP_PARAM_DIAGRAM', SEPARATION_DIAGRAM_ID);

if ($ws->ctrlPost('domain')) {
	$domainId = $ws->argPost('domain');
}

if ($ws->ctrlPost('diagram')) {
	$diagramId = $ws->argPost('diagram');
}

$connect = new object_connect();
$connect->appParamSet($ws->paramGet('APP_CODE'),'domain', $domainId);
$connect->appParamSet($ws->paramGet('APP_CODE'),'diagram', $diagramId);
$connect->appFind($ws->paramGet('APP_CODE'), false);

?>
