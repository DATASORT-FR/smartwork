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
$ws->control('index.tpl');
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_templateMain.php';
require_once($filePath);

// Main zone
$connect = new object_connect();
$content = new Wcontent();
$ws->assign('PageBlock', $content->display('home','style:home', 'offersHref:' . $connect->constructHref($ws->paramGet('APP_CODE'), 'offres-missions-freelance')));

$list = array();
$job = new object_job();
$listHeader = $job->getListJob();
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
$connect = new object_connect();
for ($i=0; $i < count($list); $i++) {
	$item = get_object_vars($list[$i]);
	$item['intro'] = LIB_content::cleanHTML(preg_replace("#\r\n|\r|\n#U",' ',$item['intro']));
	$item['href'] = constructMissionHref($item['reference'], $item['title']);
	$item['title_alt'] = 'freelance ' . $item['location'] . ' : ' . $item['job_name'] . ' - ' . $item['job_object'];
	$jobList[] = $item;
}
$ws->assign('jobList', $jobList);
$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $ws->urlTitleGet());
$ws->build('index.tpl');
?>