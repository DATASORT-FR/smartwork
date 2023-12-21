<?php
/**
* Locations api for Job freelance
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

if ($ws->cacheCtrl('locations')) {
	$adrStateList = $ws->cacheGet('locations');
}
else {
	$job = new object_job();
	$param = array('page' => -1);
	$listHeader = $job->getListAdrCity($param);
	$list = $listHeader['list'];
	$listCount = $listHeader['count'];
	$listPage =	$listHeader['page'];
	$listPageCount = $listHeader['page_count'];
	$listPageItemCount = $listHeader['page_item_count'];
	$listSearch = $listHeader['search'];
	
	$adrCityList = array();
	$adrAreaList = array();
	$adrStateList = array();
	$oldArea = '';
	$oldState = '';
	for ($i=0; $i < count($list); $i++) {
		$item = get_object_vars($list[$i]);
		$state = $item['state'];
		$area= $item['area'];
		$city = $item['city'];
		if ($i != 0) {
			if ($area <> $oldArea) {
				if ($oldArea != '') {
					$areaArray = array();
					$areaArray['text'] = $oldArea;
					if (count($adrCityList) > 1) {
						$areaArray['nodes'] = $adrCityList;
					}
					$adrAreaList[] = $areaArray;
					$adrCityList = array();
				}
			}
		}
		if ($i != 0) {
			if ($state <> $oldState) {
				$stateArray = array();
				$stateArray['text'] = $oldState;
				if (count($adrAreaList) > 1) {
					$stateArray['nodes'] = $adrAreaList;
				}
				$adrStateList[] = $stateArray;
				$adrAreaList = array();
			}
		}
		if ($city != '') {
			$cityArray = array();
			$cityArray['text'] = $city;
			$adrCityList[] = $cityArray;	
		}
		$oldArea= $area;
		$oldState = $state;
	}
	if (count($list) > 1) {
		if ($oldArea != '') {
			$areaArray = array();
			$areaArray['text'] = $oldArea;
			if (count($adrCityList) > 1) {
				$areaArray['nodes'] = $adrCityList;
			}
			$adrAreaList[] = $areaArray;
		}
		if ($oldState != '') {
			$stateArray = array();
			$stateArray['text'] = $oldState;
			if (count($adrAreaList) > 1) {
				$stateArray['nodes'] = $adrAreaList;
			}
			$adrStateList[] = $stateArray;
		}
	}
	$ws->cacheSet('locations', $adrStateList);
}

echo json_encode($adrStateList);

?>
