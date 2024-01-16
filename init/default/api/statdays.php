<?php
/**
* Site Source Count api for Job freelance
*
* @package    Job Freelance
* @subpackage Json api
* @version    1.0
* @date       15 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

header( 'content-type: application/json; charset=utf-8' );

$sitesource = $ws->argPost('sitesource');
$exploration = $ws->argPost('exploration');

if (empty($exploration)) {
	$exploration = 7;
}

$job = new object_job();
$list = $job->getCountByDay($exploration,$sitesource);

echo json_encode($list);

?>
