<?php
/**
* Categories api for Job freelance
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

if ($ws->cacheCtrl('categories')) {
	$categoryList = $ws->cacheGet('categories');
}
else {
	$article = new object_article();
	$param = array('page' => -1);
	$listHeader = $article->getListCategory($param);
	$list = $listHeader['list'];
	$listCount = $listHeader['count'];
	$listPage =	$listHeader['page'];
	$listPageCount = $listHeader['page_count'];
	$listPageItemCount = $listHeader['page_item_count'];
	$listSearch = $listHeader['search'];
	
	$categoryList = $list;
	$ws->cacheSet('categories', $categoryList);
}
echo json_encode($categoryList);

?>
