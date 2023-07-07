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

$domainId = $ws->sessionGet('object_domain_id');
if ($domainId != '') {
	$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
	$ws->control();
	$ws->caching = false;
	$ws->build('home.tpl');
}
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'domain.php';
	require_once($filePath);
}

?>