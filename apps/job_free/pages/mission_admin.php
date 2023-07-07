<?php
/**
* Mission administration file for Job freelance 
*
* @package    Job Freelance
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
$missionId = $ws->paramGet('ID');
if ($missionId != '') {
	$_SESSION['object_mission_id'] = $missionId;
}
else {
	$missionId = $_SESSION['object_mission_id'];
}

$listStatus = array();
$item = array();
$item['id'] = STATUS_DUPLICATE;
$item['description'] = $ws->getConfigVars("Txt_status_duplicate");
$listStatus[] = $item;

$item = array();
$item['id'] = STATUS_KO;
$item['description'] = $ws->getConfigVars("Txt_status_ko");
$listStatus[] = $item;

$item = array();
$item['id'] = STATUS_INIT;
$item['description'] = $ws->getConfigVars("Txt_status_init");
$listStatus[] = $item;

$item = array();
$item['id'] = STATUS_ACTIVE;
$item['description'] = $ws->getConfigVars("Txt_status_active");
$listStatus[] = $item;

$item = array();
$item['id'] = STATUS_CLOSED;
$item['description'] = $ws->getConfigVars("Txt_status_closed");
$listStatus[] = $item;

$item = array();
$item['id'] = STATUS_BACKUPED;
$item['description'] = $ws->getConfigVars("Txt_status_backuped");
$listStatus[] = $item;

$job = new object_job();
$listJobName = $job->getSelectJobName();
$listJobObject = $job->getSelectJobObject();

$wcrud = new wcrud('object_admjob', 'mission_admin', 'mission_admin');
$wcrud->titleSet(false); /* use Title */
$wcrud->pageSet(true);
$wcrud->editcolumnnameSet('reference'); 

$wcrud->fieldSet('title');
$wcrud->sizeSet('title',220);
$wcrud->fieldColSizeSet('title',12);
$wcrud->fieldSet('date_publication', 'date');
$wcrud->formatSet('date_publication', $ws->sessionGet('dateFormat'));
$wcrud->fieldLineSet('status', 'list', $listStatus);
$wcrud->fieldSet('location');
$wcrud->fieldLineSet('duration');
$wcrud->fieldSet('job_name', 'list', $listJobName);
$wcrud->fieldLineSet('job_object', 'list', $listJobObject);
$wcrud->fieldSet('score');
$wcrud->fieldLineSet('rate');
$wcrud->fieldSet('job_branch');
$wcrud->fieldLineSet('clear');

$wcrud->fieldSet('maintab', 'tab');

	$wcrud->fieldSet('tab1', 'tabcontent','maintab');
		$wcrud->fieldSet('intro', 'textarea');
		$wcrud->rowsSet('intro', 3);
		$wcrud->colsSet('intro',100);
		$wcrud->fieldSet('keywords', 'textarea');
		$wcrud->rowsSet('keywords', 1);
		$wcrud->colsSet('keywords',100);
		$wcrud->fieldSet('job');
		$wcrud->fieldLineSet('job_contract');
		$wcrud->fieldSet('job_style');
		$wcrud->fieldLineSet('job_type');
		$wcrud->fieldSet('start');
		$wcrud->fieldLineSet('start_date','date');
		$wcrud->formatSet('start_date', 'd/m/Y');
	$wcrud->fieldSet('tab1_end', 'tabcontentend');

	$wcrud->fieldSet('tab2', 'tabcontent','maintab');
		$wcrud->fieldSet('description', 'editor');
		$wcrud->rowsSet('description', 25);
	$wcrud->fieldSet('tab2_end', 'tabcontentend');

	$wcrud->fieldSet('tab3', 'tabcontent','maintab');
		$wcrud->fieldSet('image','image');
		$wcrud->fieldSet('video');
		$wcrud->sizeSet('video',200);
	$wcrud->fieldSet('tab3_end', 'tabcontentend');

	$wcrud->fieldSet('tab4', 'tabcontent','maintab');
		$wcrud->fieldSet('mission_keyitem', 'crud', 'mission_keyitem');
	$wcrud->fieldSet('tab4_end', 'tabcontentend');

$wcrud->fieldSet('maintab_end', 'tabend','maintab');

$ws->clearAllCache();
$wcrud->displayCrudEdit($missionId);
?>
