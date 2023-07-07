<?php
/**
* Main file for domain chart
*
* @package    Domain svg
* @subpackage controller
* @version    1.0
* @date       21 Februar 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();

$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$domain = new object_domain();
$domainSelect = $domain->displayList()->returnGet();

initWorkConfig($ws, 'domains');

$connect = new object_connect();
$ws->assign('pageRef', $connect->constructHref($ws->paramGet('APP_CODE'), 'domain'));
$ws->assign('listDomain', $domainSelect);
$ws->assign('domainId', $domainId);

$ws->caching = false;
$ws->build('domain.tpl');

?>