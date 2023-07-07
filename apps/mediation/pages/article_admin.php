<?php
/**
* Article administration file for mediation
*
* @package    Mediation
* @subpackage controller
* @version    1.0
* @date       15 November 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

// Main
$command = $ws->argGet('command');

$listStatus = array();
$item = array();
$item['id'] = STATUS_DUPLICATE;
$item['description'] = $ws->getConfigVars("Txt_article_status_duplicate");
$listStatus[] = $item;

$item = array();
$item['id'] = STATUS_KO;
$item['description'] = $ws->getConfigVars("Txt_article_status_ko");
$listStatus[] = $item;

$item = array();
$item['id'] = STATUS_ACTIVE;
$item['description'] = $ws->getConfigVars("Txt_article_status_active");
$listStatus[] = $item;

$list= array();
$listCategory = array();
if ($ws->cacheCtrl('categories')) {
	$list = $ws->cacheGet('categories');
}
else {
	$article = new object_article();
	$param = array('page' => -1);
	$listHeader = $article->getListCategory($param);
	$list = $listHeader['list'];
	$ws->cacheSet('categories', $list);
}
for ($i=0; $i < count($list); $i++) {
	$stemp = $list[$i];
	$item = array();
	$item['id'] = $stemp;
	$item['description'] = $stemp;
	$listCategory[] = $item;
}


$list= array();
$listSubCategory = array();
if ($ws->cacheCtrl('subcategories')) {
	$list = $ws->cacheGet('subcategories');
}
else {
	$article = new object_article();
	$param = array('page' => -1);
	$listHeader = $article->getListSubCategory($param);
	$list = $listHeader['list'];
	$ws->cacheSet('subcategories', $list);
}
for ($i=0; $i < count($list); $i++) {
	$stemp = $list[$i];
	$item = array();
	$item['id'] = $stemp;
	$item['description'] = $stemp;
	$listSubCategory[] = $item;
}

$list= array();
$listThematic = array();
if ($ws->cacheCtrl('thematics')) {
	$list = $ws->cacheGet('thematics');
}
else {
	$article = new object_article();
	$param = array('page' => -1);
	$listHeader = $article->getListThematic($param);
	$list = $listHeader['list'];
	$ws->cacheSet('thematics', $list);
}
for ($i=0; $i < count($list); $i++) {
	$stemp = $list[$i];
	$item = array();
	$item['id'] = $stemp;
	$item['description'] = $stemp;
	$listThematic[] = $item;
}

$list= array();
$listSubThematic = array();
if ($ws->cacheCtrl('subthematics')) {
	$list = $ws->cacheGet('subthematics');
}
else {
	$article = new object_article();
	$param = array('page' => -1);
	$listHeader = $article->getListSubThematic($param);
	$list = $listHeader['list'];
	$ws->cacheSet('subthematics', $list);
}
for ($i=0; $i < count($list); $i++) {
	$stemp = $list[$i];
	$item = array();
	$item['id'] = $stemp;
	$item['description'] = $stemp;
	$listSubThematic[] = $item;
}

function dateInit() {
	$value = '';
	$value = date('d/m/Y');
	return $value;
}

function referenceInit() {	
	$reference = 'ma';
	return $reference;
}

$wcrud = new wcrud('object_admarticle', 'article_admin', 'article_admin');
$wcrud->titleSet(true); /* use Title */
$wcrud->pageSet(true);
$wcrud->editcolumnnameSet('reference'); 

$wcrud->fieldSet('title');
$wcrud->sizeSet('title',220);
$wcrud->fieldColSizeSet('title',12);
$wcrud->fieldSet('date_publication', 'date');
$wcrud->formatSet('date_publication', 'd/m/Y');
$wcrud->fieldLineSet('status', 'list', $listStatus);

$wcrud->fieldSet('category', 'textlist', $listCategory);
$wcrud->fieldLineSet('subcategory', 'textlist', $listSubCategory);

$wcrud->fieldSet('thematic', 'textlist', $listThematic);
$wcrud->fieldLineSet('subthematic', 'textlist', $listSubThematic);

$wcrud->fieldSet('search_item_id');
$wcrud->fieldDisplaySet('search_item_id', 'no');
$wcrud->fieldSet('type');
$wcrud->fieldDisplaySet('type', 'no');
$wcrud->fieldSet('application');
$wcrud->fieldDisplaySet('application', 'no');

$wcrud->fieldSet('maintab', 'tab');

	$wcrud->fieldSet('tab1', 'tabcontent','maintab');
		$wcrud->fieldSet('intro', 'textarea');
		$wcrud->rowsSet('intro', 3);
		$wcrud->colsSet('intro',100);
		$wcrud->fieldSet('keywords', 'textarea');
		$wcrud->rowsSet('keywords', 1);
		$wcrud->colsSet('keywords',100);
	$wcrud->fieldSet('tab1_end', 'tabcontentend');

	$wcrud->fieldSet('tab2', 'tabcontent','maintab');
		$wcrud->fieldSet('description', 'editor');
		$wcrud->rowsSet('description', 30);
	$wcrud->fieldSet('tab2_end', 'tabcontentend');

	$wcrud->fieldSet('tab3', 'tabcontent','maintab');
		$wcrud->fieldSet('image','image');
		$wcrud->sizeSet('image',200);
		$wcrud->fieldSet('video','image');
		$wcrud->sizeSet('video',200);
	$wcrud->fieldSet('tab3_end', 'tabcontentend');

$wcrud->fieldSet('maintab_end', 'tabend','maintab');

$wcrud->initValueSet('date_publication', 'dateInit', 'function');
$wcrud->initValueSet('score', 0);

$wcrud->initValueSet('search_item_id', 0);
$wcrud->initValueSet('type', 'article');
$wcrud->initValueSet('application', 'mediation');

$ws->clearAllCache();
$wcrud->displayCrud();
?>
