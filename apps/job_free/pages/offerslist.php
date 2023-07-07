<?php
/**
* Offers list file for Job freelance
*
* @package    Job Freelance
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

define('MAX_LIST_COUNT', 250);
define('MAX_TAGS',4);

// Main
$searchValue = $ws->argPost('search');
if ($ws->ctrlPost('search')) {
	$ws->sessionSet('object_offers_search', $searchValue);
}
else {
	$searchValue = $ws->sessionGet('object_offers_search');
}

$tagsValue = $ws->argPost('tags');
if ($ws->ctrlPost('tags')) {
	$ws->sessionSet('object_offres_tags', $tagsValue);
}
else {
	$tagsValue = $ws->sessionGet('object_offres_tags');
}

$jobNamesValue = $ws->argPost('jobnames');
if ($ws->ctrlPost('jobnames')) {
	$ws->sessionSet('object_offres_jobnames', $jobNamesValue);
}
else {
	$jobNamesValue = $ws->sessionGet('object_offres_jobnames');
}

$scoresValue = $ws->argPost('scores');
if ($ws->ctrlPost('scores')) {
	$ws->sessionSet('object_offres_scores', $scoresValue);
}
else {
	$scoresValue = $ws->sessionGet('object_offres_scores');
}

$pricesValue = $ws->argPost('prices');
if ($ws->ctrlPost('prices')) {
	$ws->sessionSet('object_offres_prices', $pricesValue);
}
else {
	$pricesValue = $ws->sessionGet('object_offres_prices');
}

$countriesValue = $ws->argPost('countries');
if ($ws->ctrlPost('countries')) {
	$ws->sessionSet('object_offres_countries', $countriesValue);
}
else {
	$countriesValue = $ws->sessionGet('object_offres_countries');
}

$locationsValue = $ws->argPost('locations');
if ($ws->ctrlPost('locations')) {
	$ws->sessionSet('object_offres_locations', $locationsValue);
}
else {
	$locationsValue = $ws->sessionGet('object_offres_locations');
}

$pageValue = $ws->argGet('p');
if ($ws->ctrlGet('p')) {
	$ws->sessionSet('object_offres_page', $pageValue);
}
else {
	$pageValue = $ws->sessionGet('object_offres_page');
}

$param = array();
if ($searchValue != '') {
	$param['search'] = $searchValue;
}
if ($tagsValue != '') {
	$param['tags'] = $tagsValue;
}
if ($jobNamesValue != '') {
	$param['job_name'] = $jobNamesValue;
}
if ($scoresValue != '') {
	$param['score'] = (int)$scoresValue;
}
if ($pricesValue != '') {
	$param['rate'] = (int)$pricesValue;
}
if (($countriesValue != '') and ($countriesValue != 'France')) {
	$param['locations'] = $countriesValue;
}
else {
	if ($locationsValue != '') {
		$param['locations'] = $locationsValue;
	}
	else {
		if ($countriesValue == 'France') {
			$param['locations'] = $countriesValue;
		}
	}
}
if ($pageValue != '') {
	$param['page'] = $pageValue;
}
if ($ws->paramGet('RIGHT_UPDATE') == 1) {
	$param['status'] = STATUS_DUPLICATE;	
}

// Main zone
$job = new object_job();
$listHeader = $job->getListJob($param);
$list = $listHeader['list'];
$listCount = $listHeader['count'];
$listPage =	$listHeader['page'];
$listPageCount = $listHeader['page_count'];
$listPageItemCount = $listHeader['page_item_count'];
$listSearch = $listHeader['search'];
$listJobName = $listHeader['job_name'];
$listScore = $listHeader['score'];
$listPrice = $listHeader['rate'];
//$listPrice = 100;
$listLocations = $listHeader['locations'];
$listTags = $listHeader['tags'];

$ws->sessionSet('object_offres_page', $listPage);

$connect = new object_connect();
$listMission = array();
for ($i=0; $i < count($list); $i++) {
	$item = get_object_vars($list[$i]);
	$item['intro'] = LIB_content::cleanHTML(preg_replace("#\r\n|\r|\n#iusU",' ',$item['intro']));
	$item['href'] = constructMissionHref($item['reference'], $item['title']);
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
			$itemTag['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), 'offres-missions-freelance', 'tag:' .  $aTemp[$j]);
			$tags[] = $itemTag;
		}
	}
	$item['list_tag'] = $tags;
	$item['title_alt'] = 'freelance ' . $item['location'] . ' : ' . $item['job_name'] . ' - ' . $item['job_object'];
	$listMission[] = $item;
}

$listPagination = array();
if ($listPageCount > 1) {
	if (($listPageCount > 2) and ($listPage > 3)) {
		$pageItem = array();
		$pageItem['page'] = 0;
		$pageItem['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), 'offersList', 'p:0');
		$listPagination[] = $pageItem;
	}
	if ($listPage > 2) {
		$pageItem = array();
		$pageItem['page'] = $listPage - 2;
		$pageItem['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), 'offersList', 'p:' .  ($listPage - 2));
		$listPagination[] = $pageItem;
	}
	if ($listPage > 1) {
		$pageItem = array();
		$pageItem['page'] = $listPage - 1;
		$pageItem['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), 'offersList', 'p:' .  ($listPage - 1));
		$listPagination[] = $pageItem;
	}
	$pageItem = array();
	$pageItem['page'] = $listPage;
	$pageItem['href'] = '';
	$listPagination[] = $pageItem;
	if ($listPage + 1 <=  $listPageCount) {
		$pageItem = array();
		$pageItem['page'] = $listPage + 1;
		$pageItem['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), 'offersList', 'p:' .  ($listPage + 1));
		$listPagination[] = $pageItem;
	}
	if ($listPage + 2 <=  $listPageCount) {
		$pageItem = array();
		$pageItem['page'] = $listPage + 2;
		$pageItem['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), 'offersList', 'p:' .  ($listPage + 2));
		$listPagination[] = $pageItem;
	}
	if (($listPageCount > 2) and ($listPage + 3 <=  $listPageCount)) {
		$pageItem = array();
		$pageItem['page'] = -1;
		$pageItem['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), 'offersList', 'p:' .  $listPageCount);
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

if ($listJobName != '') {
	if ($listText2 != '') {
		$listText2 .= '<br>';
	}
	$listText2 .= 'Poste : ' . $listJobName;
}

if (($listScore != '') and ($listScore != '0')){
	if ($listText2 != '') {
		$listText2 .= '<br>';
	}
	$listText2 .= 'Score > ' . $listScore;
}

if (($listPrice != '') and ($listPrice != '0')) {
	if ($listText2 != '') {
		$listText2 .= '<br>';
	}
	$listText2 .= 'Tarif > ' . $listPrice;
}

if ($listLocations != '') {
	if ($listText2 != '') {
		$listText2 .= '<br>';
	}
	$listText2 .= 'Lieux : ' . $listLocations;
}

$listText = '';
if (($listCount < MAX_LIST_COUNT) or ($listText2 != ''))  {
	$listText  = $listText1;
	if ($listText2 != '') {
		$listText .= '<br>';
	}
}
$listText .= $listText2;

$ws->urlTitleSet($ws->getConfigVars("Txt_offerslist_title"));
$ws->urlDescriptionSet($ws->getConfigVars("Txt_offerslist_description"));
$ws->urlKeywordsSet($ws->getConfigVars("Txt_offerslist_keywords"));
$ws->urlNewsKeywordsSet($ws->getConfigVars("Txt_offerslist_newsKeywords"));
$ws->urlImageSet('');

$ws->assign('ListText', $listText);
$ws->assign('ListMission', $listMission);
$ws->assign('ListPagination', $listPagination);
$ws->assign('ListPage', $listPage);
$ws->assign('ListPageCount', $listPageCount);

$ws->caching = false;
$ws->build('offersList.tpl');

?>