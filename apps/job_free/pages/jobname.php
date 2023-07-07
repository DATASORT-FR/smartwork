<?php
/**
* Main file for Job freelance
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
$ws->control('jobname.tpl');
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_templateMain.php';
require_once($filePath);

$id = $ws->paramGet('ID');
// Main zone
$content = new Wcontent();
if ($content->ctrl($id)) {
	$ws->assign('PageBlock', $content->display($id));
	$param1 = $content->displayGet('param1');
	$title = $content->displayGet('title');
	if (empty($param1)) {
		$param1 = $title;
	}
	$ws->assign('Param1', $param1);

	$connect = new object_connect();
	$listLink = $connect->constructHref($ws->paramGet('APP_CODE'), 'offres-missions-freelance');
	$ws->assign('ListLink', $listLink);

	$param = array();
	$param['job_name'] = $param1;
	$param['score'] = 1;
	$job = new object_job();
	$listHeader = $job->getListJob($param);
	$list = $listHeader['list'];
	$listCount = $listHeader['count'];
	$listPage =	$listHeader['page'];
	$listPageCount = $listHeader['page_count'];
	$listPageItemCount = $listHeader['page_item_count'];
	$listSearch = $listHeader['search'];
	$listJobName = $listHeader['job_name'];
	$listLocations = $listHeader['locations'];
	$listTags = $listHeader['tags'];
	$jobList = array();
	for ($i=0; $i < count($list); $i++) {
		$item = get_object_vars($list[$i]);
		$item['intro'] = LIB_content::cleanHTML(preg_replace("#\r\n|\r|\n#U",' ',$item['intro']));
		$item['href'] = constructMissionHref($item['reference'], $item['title']);
		$jobList[] = $item;
	}
	$ws->assign('jobList', $jobList);
	
	$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $param1);
	$ws->build('jobname.tpl');
} 
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_DIR') . 'error.php';
	if (file_exists($filePath)) {
		require_once($filePath);
	}
	else {		
		$ws->build('error.tpl');
	}
}
?>