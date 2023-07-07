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

$flagEnable = false;
if ($ws->argGet('action') == 'enable') {
	$flagEnable = true;
}

$connect = new object_connect();
if ($flagEnable) {
	$connect->appParamSet($ws->paramGet('APP_CODE'),'phone', 'true');
}
else {
	$connect->appParamSet($ws->paramGet('APP_CODE'),'phone', 'false');
}

$display_html = 'reload';
echo($display_html);
?>
