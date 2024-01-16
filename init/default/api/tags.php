<?php
/**
* Tags api for Job freelance
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

if ($ws->cacheCtrl('tags')) {
	$tagsList = $ws->cacheGet('tags');
}
else {
	$job = new object_job();
	$param = array('page' => -1);
	$listHeader = $job->getListTag($param);
	$list = $listHeader['list'];
	$listCount = $listHeader['count'];
	$listPage =	$listHeader['page'];
	$listPageCount = $listHeader['page_count'];
	$listPageItemCount = $listHeader['page_item_count'];
	$listSearch = $listHeader['search'];
	
	$tagsList = $list;
	$ws->cacheSet('tags', $tagsList);
}
echo json_encode($tagsList);

?>
