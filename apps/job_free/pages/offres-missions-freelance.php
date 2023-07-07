<?php
/**
* Offers file for Job freelance
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
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_templateMain.php';
require_once($filePath);

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
	$tagsValue = strtolower(LIB_content::cleanSpecial($ws->argGet('tag')));
	if ($ws->ctrlGet('tag')) {
		$ws->sessionSet('object_offres_tags', $tagsValue);
	}
	else {
		$tagsValue = $ws->sessionGet('object_offres_tags');
	}
}

$jobNamesValue = $ws->argPost('jobnames');
if ($ws->ctrlPost('jobnames')) {
	$ws->sessionSet('object_offres_jobnames', $jobNamesValue);
}
else {
	$jobNamesValue = $ws->argGet('jobnames');
	if ($ws->ctrlGet('jobnames')) {
		$ws->sessionSet('object_offres_jobnames', $jobNamesValue);
	}
	else {
		$jobNamesValue = $ws->sessionGet('object_offres_jobnames');
	}
}

$scoresValue = $ws->argPost('scores');
if ($ws->ctrlPost('scores')) {
	$ws->sessionSet('object_offres_scores', $scoresValue);
}
else {
	$scoresValue = $ws->argGet('scores');
	if ($ws->ctrlGet('scores')) {
		$ws->sessionSet('object_offres_scores', $scoresValue);
	}
	else {
		$scoresValue = $ws->sessionGet('object_offres_scores');
	}
}

$pricesValue = $ws->argPost('prices');
if ($ws->ctrlPost('prices')) {
	$ws->sessionSet('object_offres_prices', $pricesValue);
}
else {
	$pricesValue = $ws->argGet('pricess');
	if ($ws->ctrlGet('prices')) {
		$ws->sessionSet('object_offres_prices', $pricesValue);
	}
	else {
		$pricesValue = $ws->sessionGet('object_offres_prices');
	}
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

$connect = new object_connect();
$content = new Wcontent();
$ws->assign('PageBlock', $content->display('offers','style:simple'));
$ws->assign('SearchValue', $searchValue);
$ws->assign('TagsValue', $tagsValue);
$ws->assign('JobNamesValue', $jobNamesValue);
$ws->assign('ScoresValue', $scoresValue);
$ws->assign('PricesValue', $pricesValue);
$ws->assign('CountriesValue', $countriesValue);
$ws->assign('LocationsValue', $locationsValue);
$ws->assign('OffersHref', $connect->constructHref($ws->paramGet('APP_CODE'), 'offres-missions-freelance'));
$ws->assign('SearchHref', $connect->constructHref($ws->paramGet('APP_CODE'), 'offersList'));
$ws->assign('TagsHref', $connect->constructHref($ws->paramGet('APP_CODE'), 'tags', 'mode:api'));
$ws->assign('JobNamesHref', $connect->constructHref($ws->paramGet('APP_CODE'), 'jobnames', 'mode:api'));
$ws->assign('LocationsHref', $connect->constructHref($ws->paramGet('APP_CODE'), 'locations', 'mode:api'));

$ws->caching = false;
$ws->build('offres-missions-freelance.tpl');

?>