<?php
/**
* Thematics api for Articles
*
* @package    Articles
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

if ($ws->cacheCtrl('thematics')) {
	$thematicList = $ws->cacheGet('thematics');
}
else {
	$article = new object_article();
	$param = array('page' => -1);
	$listHeader = $article->getListThematic($param);
	$list = $listHeader['list'];
	$listCount = $listHeader['count'];
	$listPage =	$listHeader['page'];
	$listPageCount = $listHeader['page_count'];
	$listPageItemCount = $listHeader['page_item_count'];
	$listSearch = $listHeader['search'];
	
	$thematicList = $list;
	$ws->cacheSet('thematics', $thematicList);
}
echo json_encode($thematicList);

?>
