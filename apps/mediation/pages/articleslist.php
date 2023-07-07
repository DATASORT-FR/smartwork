<?php
/**
* Articles list file
*
* @package    Article
* @subpackage controller
* @version    1.0
* @date       15 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

define('MAX_LIST_COUNT', 3500);
define('MAX_TAGS',3);

// Main
$searchValue = $ws->argPost('search');
if ($ws->ctrlPost('search')) {
	$ws->sessionSet('object_articles_search', $searchValue);
}
else {
	$searchValue = $ws->sessionGet('object_articles_search');
}

$tagsValue = $ws->argPost('tags');
if ($ws->ctrlPost('tags')) {
	$ws->sessionSet('object_articles_tags', $tagsValue);
}
else {
	$tagsValue = $ws->sessionGet('object_articles_tags');
}

$categoryValue = $ws->argPost('category');
if ($ws->ctrlPost('category')) {
	$ws->sessionSet('object_articles_category', $categoryValue);
}
else {
	$categoryValue = $ws->sessionGet('object_articles_category');
}

$subcategoryValue = $ws->argPost('subcategory');
if ($ws->ctrlPost('subcategory')) {
	$ws->sessionSet('object_articles_subcategory', $subcategoryValue);
}
else {
	$subcategoryValue = $ws->sessionGet('object_articles_subcategory');
}

$thematicValue = $ws->argPost('thematic');
if ($ws->ctrlPost('thematic')) {
	$ws->sessionSet('object_articles_thematic', $thematicValue);
}
else {
	$thematicValue = $ws->sessionGet('object_articles_thematic');
}

$subthematicValue = $ws->argPost('subthematic');
if ($ws->ctrlPost('subthematic')) {
	$ws->sessionSet('object_articles_subthematic', $subthematicValue);
}
else {
	$subthematicValue = $ws->sessionGet('object_articles_subthematic');
}

$locationValue = $ws->argPost('location');
if ($ws->ctrlPost('location')) {
	$ws->sessionSet('object_articles_location', $locationValue);
}
else {
	$locationValue = $ws->sessionGet('object_articles_location');
}

$pageValue = $ws->argGet('p');
if ($ws->ctrlGet('p')) {
	$ws->sessionSet('object_articles_page', $pageValue);
}
else {
	$pageValue = $ws->sessionGet('object_articles_page');
}

$param = array();
if ($searchValue != '') {
	$param['search'] = $searchValue;
}
if ($tagsValue != '') {
	$param['tags'] = $tagsValue;
}
if ($categoryValue != '') {
	$param['category'] = $categoryValue;
}
if ($subcategoryValue != '') {
	$param['subcategory'] = $subcategoryValue;
}
if ($thematicValue != '') {
	$param['thematic'] = $thematicValue;
}
if ($subthematicValue != '') {
	$param['subthematic'] = $subthematicValue;
}
if ($locationValue != '') {
	$param['location'] = $locationValue;
}
if ($pageValue != '') {
	$param['page'] = $pageValue;
}
if ($ws->paramGet('RIGHT_UPDATE') == 1) {
	$param['status'] = STATUS_DUPLICATE;	
}

// Main zone
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

$ws->sessionSet('object_articles_page', $listPage);

$connect = new object_connect();
$listArticle = array();
for ($i=0; $i < count($list); $i++) {
	$item = get_object_vars($list[$i]);
	if (!isset($item['tags'])) {
		$item['tags'] = '';
	}
	$reference = $item['reference'];
	$title = $item['title'];
	
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
	$aTemp = explode(';', $item['tags']);
	$tags = array();
	for ($j=0; $j < count($aTemp); $j++) {
		if ((!empty($aTemp[$j])) and ($j < MAX_TAGS)) {
			$itemTag = array();
			$itemTag['tag'] = $aTemp[$j];
			$itemTag['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), 'articles', 'tag:' .  $aTemp[$j]);
			$tags[] = $itemTag;
		}
	}
	$item['list_tag'] = $tags;
		
	$defaultImage = findArticleImage($item['reference'], $item['category']);
	$articleImage = new JF_ArticleImage();
	$item['displayImage'] = $articleImage->display($item, $defaultImage, "image");
	
	$listArticle[] = $item;
}
$listPagination = array();
if ($listPageCount > 1) {
	if (($listPageCount > 2) and ($listPage > 3)) {
		$pageItem = array();
		$pageItem['page'] = 0;
		$pageItem['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), 'articlesList', 'p:0');
		$listPagination[] = $pageItem;
	}
	if ($listPage > 2) {
		$pageItem = array();
		$pageItem['page'] = $listPage - 2;
		$pageItem['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), 'articlesList', 'p:' .  ($listPage - 2));
		$listPagination[] = $pageItem;
	}
	if ($listPage > 1) {
		$pageItem = array();
		$pageItem['page'] = $listPage - 1;
		$pageItem['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), 'articlesList', 'p:' .  ($listPage - 1));
		$listPagination[] = $pageItem;
	}
	$pageItem = array();
	$pageItem['page'] = $listPage;
	$pageItem['href'] = '';
	$listPagination[] = $pageItem;
	if ($listPage + 1 <=  $listPageCount) {
		$pageItem = array();
		$pageItem['page'] = $listPage + 1;
		$pageItem['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), 'articlesList', 'p:' .  ($listPage + 1));
		$listPagination[] = $pageItem;
	}
	if ($listPage + 2 <=  $listPageCount) {
		$pageItem = array();
		$pageItem['page'] = $listPage + 2;
		$pageItem['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), 'articlesList', 'p:' .  ($listPage + 2));
		$listPagination[] = $pageItem;
	}
	if (($listPageCount > 2) and ($listPage + 3 <=  $listPageCount)) {
		$pageItem = array();
		$pageItem['page'] = -1;
		$pageItem['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), 'articlesList', 'p:' .  $listPageCount);
		$listPagination[] = $pageItem;
	}	
}

$listText1 = '';
if ($listCount == 0) {
	$listText1 = 'Aucun résultat trouvé pour les critères de recherche';
}
else {
	$listText1 = '[count] résultats trouvés pour les critères de recherche ';
	$listText1 = str_replace('[count]', '<strong>' . (string)$listCount . '</strong>', $listText1);
}

$listText2 = '';
if ($listSearch != '') {
	$listText2 .= 'Expression : ' . $listSearch;
}
if ($listTags != '') {
	if ($listText2 != '') {
		$listText2 .= '<br>';
	}
	$listText2 .= 'Tags : ' . $listTags;
}

if ($listCategories != '') {
	if ($listText2 != '') {
		$listText2 .= '<br>';
	}
	$listText2 .= 'Catégorie : ' . $listCategories;
}

if ($listSubCategories != '') {
	if ($listText2 != '') {
		$listText2 .= '<br>';
	}
	$listText2 .= 'Sous-catégorie : ' . $listSubCategories;
}

if ($listThematics != '') {
	if ($listText2 != '') {
		$listText2 .= '<br>';
	}
	$listText2 .= 'Thématique : ' . $listThematics;
}

if ($listSubThematics != '') {
	if ($listText2 != '') {
		$listText2 .= '<br>';
	}
	$listText2 .= 'Sous-thématique : ' . $listSubThematics;
}

if ($listLocation != '') {
	if ($listText2 != '') {
		$listText2 .= '<br>';
	}
	$listText2 .= 'Lieux : ' . $listLocation;
}

$listText = '';
if ($listText2 != '')  {
	$listText  = $listText1;
	$listText .= '<br>';
	$listText .= $listText2;
}

$ws->urlTitleSet($ws->getConfigVars("Txt_articleslist_title"));
$ws->urlDescriptionSet($ws->getConfigVars("Txt_articleslist_description"));
$ws->urlKeywordsSet($ws->getConfigVars("Txt_articleslist_keywords"));
$ws->urlNewsKeywordsSet($ws->getConfigVars("Txt_articleslist_newsKeywords"));
$ws->urlImageSet('');

$articleCreate= $connect->constructHref($ws->paramGet('APP_CODE'), 'article_admin', 'command:new');

$ws->assign('ListText', $listText);
$ws->assign('ListArticle', $listArticle);
$ws->assign('ArticleCreate', $articleCreate);
$ws->assign('ListPagination', $listPagination);
$ws->assign('ListPage', $listPage);
$ws->assign('ListPageCount', $listPageCount);

$ws->caching = false;
$ws->build('articlesList.tpl');

?>