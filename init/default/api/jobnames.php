<?php
/**
* JobNames api for Job freelance
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

if ($ws->cacheCtrl('jobNames')) {
	$jobNamesList = $ws->cacheGet('jobNames');
}
else {
	$job = new object_job();
	$param = array('page' => -1);
	$listHeader = $job->getListJobName($param);
	$list = $listHeader['list'];
	$listCount = $listHeader['count'];
	$listPage =	$listHeader['page'];
	$listPageCount = $listHeader['page_count'];
	$listPageItemCount = $listHeader['page_item_count'];
	$listSearch = $listHeader['search'];
	
	$jobNamesList = $list;
	$ws->cacheSet('jobNames', $jobNamesList);
}
echo json_encode($jobNamesList);

?>
