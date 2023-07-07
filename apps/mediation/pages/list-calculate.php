<?php
/**
* Main file for mediation
*
* @package    Mediation
* @subpackage controller
* @version    1.0
* @date       28 December 2018
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();

if (!isset($articleCode)) {
	$articleCode = 'home';
}
if (!isset($categoryValue)) {
	$categoryValue = '';
}
if (!isset($classPage)) {
	$classPage = '';
}
if (!isset($videoValue)) {
	$videoValue = -1;
}
$categoryName = LIB_content::cleanSpecial($categoryValue);
$href = '';
$objectPage = 'object_home_page';
if (!empty($categoryName)) {
	$href = 'mediation-' . $categoryName;
	$objectPage = 'object_' . $categoryName . '_page';
}

// Main zone
$content = new Wcontent();
$ws->assign('PageBlock', $content->display($articleCode,'style:simple'));

$pageValue = $ws->argGet('p');
if ($ws->ctrlGet('p')) {
	$ws->sessionSet($objectPage, $pageValue);
}
else {
	$pageValue = $ws->sessionGet($objectPage);
}

$param = array();
if ($categoryValue != '') {
	$param['category'] = $categoryValue;
}
if ($pageValue != '') {
	$param['page'] = $pageValue;
}
if ($ws->paramGet('RIGHT_UPDATE') == 1) {
	$param['status'] = STATUS_DUPLICATE;	
}
if ($videoValue != -1) {
	$param['video'] = $videoValue;
}

$article = new object_article();
$listHeader = $article->getListArticle($param);
$list = $listHeader['list'];
$listCount = $listHeader['count'];
$listPage =	$listHeader['page'];
$listPageCount = $listHeader['page_count'];
$listPageItemCount = $listHeader['page_item_count'];
$listSearch = $listHeader['search'];
$listCategories = $listHeader['category'];
$listSubCategories = $listHeader['subcategory'];
$listThematics = $listHeader['thematic'];
$listSubThematics = $listHeader['subthematic'];
$listLocation = $listHeader['locations'];
$listTags = $listHeader['tags'];

$connect = new object_connect();
$articleList = array();
for ($i=0; $i < count($list); $i++) {
	$item = get_object_vars($list[$i]);
	$reference = $item['reference'];
	$title = $item['title'];
	
	if (strlen($title) > 65) {
		$title = mb_substr($title, 0, 65);
		$cesure = 0;
		$cesure = mb_strrpos($title, '.');
		
		$cesure1 = mb_strrpos($title, ';');
		if ($cesure1 > $cesure) {
			$cesure = $cesure1;
		}
		$cesure1 = mb_strrpos($title, ',');
		if ($cesure1 > $cesure) {
			$cesure = $cesure1;
		}
		$cesure1 = mb_strrpos($title, ':');
		if ($cesure1 > $cesure) {
			$cesure = $cesure1;
		}
		$cesure1 = mb_strrpos($title, ' ');
		if ($cesure1 - $cesure > 10) {
			$cesure = $cesure1;
		}
		if ($cesure > 0) {
			$title = mb_substr($title, 0, $cesure);
		}
		$item['title'] = $title;
	}
	
	$item['intro'] = preg_replace("#\r\n|\r|\n#iusU",' ',$item['intro']);
	$item['href'] = constructArticleHref($reference, $title);
	$item['date_publication'] = dateFormat('EEEE dd MMMM YYYY', strtotime($item['date_publication']));
	
	switch ($item['status']) {
		case STATUS_DUPLICATE :
			$stemp = $ws->getConfigVars("Txt_list_status_duplicate");
			break;
		case STATUS_KO :
			$stemp = $ws->getConfigVars("Txt_list_status_ko");
			break;
		case STATUS_INIT :
			$stemp = $ws->getConfigVars("Txt_list_status_init");
			break;
		case STATUS_ACTIVE :
			$stemp = $ws->getConfigVars("Txt_list_status_active");
			break;
		case STATUS_CLOSED :
			$stemp = $ws->getConfigVars("Txt_list_status_closed");
			break;
		case STATUS_BACKUPED :
			$stemp = $ws->getConfigVars("Txt_list_status_backuped");
			break;
		default:
			$stemp = '';
	}
	$item['status'] = $stemp;

	$defaultImage = findArticleImage($item['reference'], $item['category']);
	$articleImage = new JF_ArticleImage();
	$item['displayImage'] = $articleImage->display($item, $defaultImage, "image");
			
	$articleList[] = $item;
}

$listPagination = array();
if ($listPageCount > 1) {
	if (($listPageCount > 2) and ($listPage > 3)) {
		$pageItem = array();
		$pageItem['page'] = 0;
		$pageItem['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), $href, 'p:1');
		$listPagination[] = $pageItem;
	}
	if ($listPage > 2) {
		$pageItem = array();
		$pageItem['page'] = $listPage - 2;
		if ($listPage - 2 > 1) {
			$pageItem['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), $href, 'p:' .  ($listPage - 2));
		}
		else {
			$pageItem['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), $href, 'p:1');
		}
		$listPagination[] = $pageItem;
	}
	if ($listPage > 1) {
		$pageItem = array();
		$pageItem['page'] = $listPage - 1;
		if ($listPage - 1 > 1) {
			$pageItem['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), $href, 'p:' .  ($listPage - 1));
		}
		else {
			$pageItem['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), $href, 'p:1');
		}
		$listPagination[] = $pageItem;
	}
	$pageItem = array();
	$pageItem['page'] = $listPage;
	$pageItem['href'] = '';
	$listPagination[] = $pageItem;
	if ($listPage + 1 <=  $listPageCount) {
		$pageItem = array();
		$pageItem['page'] = $listPage + 1;
		$pageItem['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), $href, 'p:' .  ($listPage + 1));
		$listPagination[] = $pageItem;
	}
	if ($listPage + 2 <=  $listPageCount) {
		$pageItem = array();
		$pageItem['page'] = $listPage + 2;
		$pageItem['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), $href, 'p:' .  ($listPage + 2));
		$listPagination[] = $pageItem;
	}
	if (($listPageCount > 2) and ($listPage + 3 <=  $listPageCount)) {
		$pageItem = array();
		$pageItem['page'] = -1;
		$pageItem['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), $href, 'p:' .  $listPageCount);
		$listPagination[] = $pageItem;
	}	
}

$articleCreate= $connect->constructHref($ws->paramGet('APP_CODE'), 'article_admin', 'command:new');

$ws->assign('classPage', $classPage);
$ws->assign('ArticleList', $articleList);
$ws->assign('ArticleCreate', $articleCreate);
$ws->assign('ListPagination', $listPagination);
$ws->assign('ListPage', $listPage);
$ws->assign('ListPageCount', $listPageCount);

?>