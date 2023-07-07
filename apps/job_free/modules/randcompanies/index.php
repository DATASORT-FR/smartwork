<?php
/**
* Random companies feature
*
* @package    Job Free app
* @subpackage controller
* @version    1.5
* @date       17 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('RANDCOMPANIES_NAME', 'randcompanies');

// Menu Path
$ws->paramSet($ws->paramGet('APP_NAME'). '_' . $ws->paramGet('RANDCOMPANIES_NAME') . '_TEMPLATES_SRC_DIR', $ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . $ws->paramGet('RANDCOMPANIES_NAME') . '/' . TEMPLATES_SRC_PATH);

class JF_randCompanies
{

    public function __construct() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
    }

    function display() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$smarty = new workpage();
		$smarty->template_dir = $ws->paramGet($ws->paramGet('APP_NAME'). '_' . $ws->paramGet('RANDCOMPANIES_NAME') . '_TEMPLATES_SRC_DIR') ;

		$job = new object_job();
		$listHeader = $job->getListCompanyRandom();
		$list = $listHeader['list'];
		$listCount = $listHeader['count'];
		$listPage =	$listHeader['page'];
		$listPageCount = $listHeader['page_count'];
		$listPageItemCount = $listHeader['page_item_count'];
		$listSearch = $listHeader['search'];
		$connect = new object_connect();
		$companyList = array();
		for ($i=0; $i < count($list); $i++) {
			$item = get_object_vars($list[$i]);
			$item['name'] =  ucwords($item['name']);
			$item['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGE_COMPANY'), 'id:' .  $item['reference']);
			$companyList[] = $item;
		}

		$smarty->assign('CompaniesList', $companyList);		
		$smarty->assign('CompaniesHref', $connect->constructHref($ws->paramGet('APP_CODE'), $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGE_COMPANIES')));		
		return $smarty->fetch('index.tpl');
	}

}

?>
