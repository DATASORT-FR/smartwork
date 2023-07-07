<?php
/**
* Articles file
*
* @package    Articles
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
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_templateMain.php';
require_once($filePath);

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
	$tagsValue = $ws->argGet('tags');
	if ($ws->ctrlGet('tags')) {
		$ws->sessionSet('object_articles_tags', $tagsValue);
	}
	else {
		$tagsValue = $ws->sessionGet('object_articles_tags');
	}
}

$categoryValue = $ws->argPost('category');
if ($ws->ctrlPost('category')) {
	$ws->sessionSet('object_articles_category', $categoryValue);
}
else {
	$categoryValue = $ws->argGet('category');
	if ($ws->ctrlGet('category')) {
		$ws->sessionSet('object_articles_category', $categoryValue);
	}
	else {
		$categoryValue = $ws->sessionGet('object_articles_category');
	}
}

$subcategoryValue = $ws->argPost('subcategory');
if ($ws->ctrlPost('subcategory')) {
	$ws->sessionSet('object_articles_subcategory', $subcategoryValue);
}
else {
	$subcategoryValue = $ws->argGet('subcategory');
	if ($ws->ctrlGet('subcategory')) {
		$ws->sessionSet('object_articles_subcategory', $subcategoryValue);
	}
	else {
		$subcategoryValue = $ws->sessionGet('object_articles_subcategory');
	}
}

$thematicValue = $ws->argPost('thematic');
if ($ws->ctrlPost('thematic')) {
	$ws->sessionSet('object_articles_thematic', $thematicValue);
}
else {
	$thematicValue = $ws->argGet('thematic');
	if ($ws->ctrlGet('thematic')) {
		$ws->sessionSet('object_articles_thematic', $thematicValue);
	}
	else {
		$thematicValue = $ws->sessionGet('object_articles_thematic');
	}
}

$subthematicValue = $ws->argPost('subthematic');
if ($ws->ctrlPost('subthematic')) {
	$ws->sessionSet('object_articles_subthematic', $subthematicValue);
}
else {
	$subthematicValue = $ws->argGet('subthematic');
	if ($ws->ctrlGet('subthematic')) {
		$ws->sessionSet('object_articles_subthematic', $subthematicValue);
	}
	else {
		$subthematicValue = $ws->sessionGet('object_articles_subthematic');
	}
}

$locationValue = $ws->argPost('location');
if ($ws->ctrlPost('location')) {
	$ws->sessionSet('object_articles_location', $locationValue);
}
else {
	$locationValue = $ws->argGet('location');
	if ($ws->ctrlGet('location')) {
		$ws->sessionSet('object_articles_location', $locationValue);
	}
	else {
		$locationValue = $ws->sessionGet('object_articles_location');
	}
}

$pageValue = $ws->argGet('p');
if ($ws->ctrlGet('p')) {
	$ws->sessionSet('object_articles_page', $pageValue);
}
else {
	$pageValue = $ws->sessionGet('object_articles_page');
}

$content = new Wcontent();
$connect = new object_connect();
$articlesLink = $connect->constructHref($ws->paramGet('APP_CODE'), 'articles');
$ws->assign('PageBlock', $content->display('articles','style:simple'));
$ws->assign('SearchValue', $searchValue);
$ws->assign('TagsValue', $tagsValue);
$ws->assign('CategoryValue', $categoryValue);
$ws->assign('SubCategoryValue', $subcategoryValue);
$ws->assign('ThematicValue', $thematicValue);
$ws->assign('SubThematicValue', $subthematicValue);
$ws->assign('LocationValue', $locationValue);
$ws->assign('ArticlesHref', $connect->constructHref($ws->paramGet('APP_CODE'), 'articles'));
$ws->assign('SearchHref', $connect->constructHref($ws->paramGet('APP_CODE'), 'articlesList'));
$ws->assign('TagsHref', $connect->constructHref($ws->paramGet('APP_CODE'), 'tags', 'mode:api'));
$ws->assign('CategoryHref', $connect->constructHref($ws->paramGet('APP_CODE'), 'categories', 'mode:api'));
$ws->assign('SubCategoryHref', $connect->constructHref($ws->paramGet('APP_CODE'), 'subcategories', 'mode:api'));
$ws->assign('ThematicHref', $connect->constructHref($ws->paramGet('APP_CODE'), 'thematics', 'mode:api'));
$ws->assign('SubThematicHref', $connect->constructHref($ws->paramGet('APP_CODE'), 'subthematics', 'mode:api'));
$ws->assign('LocationHref', $connect->constructHref($ws->paramGet('APP_CODE'), 'locations', 'mode:api'));

$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $ws->urlTitleGet());
$ws->caching = false;
$ws->build('articles.tpl');

?>