<?php
/**
* Companies file for Job freelance
*
* @package    Job Freelance
* @subpackage controller
* @version    1.0
* @date       10 June 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

define('MAX_LIST_COUNT', 100);

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

// Main
$searchValue = $ws->argPost('search');
if ($ws->ctrlPost('search')) {
	$ws->sessionSet('object_offers_search', $searchValue);
}
else {
	$searchValue = $ws->sessionGet('object_offers_search');
}

$param = array();
if ($searchValue != '') {
	$param['search'] = $searchValue;
}

// Main zone
$job = new object_Job();
$listHeader = $job->getListCompany($param);
$list = $listHeader['list'];
$listCount = $listHeader['count'];
$listPage =	$listHeader['page'];
$listPageCount = $listHeader['page_count'];
$listPageItemCount = $listHeader['page_item_count'];
$listSearch = $listHeader['search'];
$companyList = array();
$connect = new object_connect();
for ($i=0; $i < count($list); $i++) {
	$item = get_object_vars($list[$i]);
	$item['resume'] = '';
//	$item['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), 'company', 'id:' .  $item['reference']);
	$companyList[] = $item;
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

$listText = '';
if (($listCount < MAX_LIST_COUNT) or ($listText2 != ''))  {
	$listText  = $listText1;
	if ($listText2 != '') {
		$listText .= '<br>';
	}
}
$listText .= $listText2;

$ws->assign('ListText', $listText);
$ws->assign('CompanyList', $companyList);
$ws->assign('ListPagination', $listPagination);
$ws->assign('ListPage', $listPage);
$ws->assign('ListPageCount', $listPageCount);

$ws->build('companieslist.tpl');
?>