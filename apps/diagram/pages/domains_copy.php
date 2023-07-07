<?php
/**
* Copy of domain
*
* @package    use_domain
* @subpackage Json api
* @version    1.0
* @date       23 March 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$domainId = $ws->paramGet('ID');
if ($domainId != '') {
	$_SESSION['object_domain_id'] = $domainId;
}
else {
	$domainId = $_SESSION['object_domain_id'];
}

$copyFlag = false;
if ($domainId != '') {
	$domain = new object_domain();
	$copyFlag = $domain->copy($domainId)->statusGet();
}
$ws->build('return');

?>
