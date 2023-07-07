<?php
/**
* Mission file for Job freelance
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

// Main
$mission_ref = $ws->paramGet('ID');
if ($mission_ref != '') {
	$_SESSION['object_mission_ref'] = $mission_ref;
}
else {
	$mission_ref = $_SESSION['object_mission_ref'];
}

$job = new object_job();
$mission = $job->getJob($mission_ref);

$dateValue = DateTime::createFromFormat('Y-m-d', $mission['date_publication']);
date_add($dateValue, date_interval_create_from_date_string('90 days'));
$mission['date_publication'] = dateFormat('EEEE dd MMMM YYYY', strtotime($mission['date_publication']));

$atemp = explode(',', $mission['location']);
$n = 0;
$mission['location'] = '';
foreach($atemp as $key=>$value) {
	if ($n < 2) {
		if ($n > 0) {
			$mission['location'] .= ', ';
		}
		$mission['location'] .= $value;
	}
	$n++;
}

$mission['youtube'] = false;
$pos = strpos($mission['video'], 'youtube.');
if ($pos !== false) {
	$mission['youtube'] = true;
}

if ($mission['rate'] == 0) {
	$mission['rate'] = $ws->getConfigVars("Txt_mission_rate_default");
}
else {
	$mission['rate'] = $mission['rate'] . $ws->getConfigVars("Txt_mission_rate_byday");		
}

$connect = new object_connect();

$urlKeywords = preg_replace("#;#iusU", ',', $mission['keywords']);

$urlNewsKeywords = '';
$listTags = explode(';', $mission['tags']);
$tags = array();
for ($i=0; $i < count($listTags); $i++) {
	if (!empty($listTags[$i])) {
		if ($i > 0) {
			$urlNewsKeywords .= ',';
		}
		$urlNewsKeywords .= $listTags[$i];
		$item = array();
		$item['tag'] = $listTags[$i];
		$item['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), 'offres-missions-freelance', 'tag:' .  $listTags[$i]);	
		$tags[] = $item;
	}
}

$missionLinks = $mission['link'];
$links = array();
for ($i=0; $i < count($missionLinks); $i++) {
	$item = get_object_vars($missionLinks[$i]);
	switch ($item['status']) {
		case STATUS_CLOSED :
			$item['status'] = $ws->getConfigVars("Txt_status_closed");
			break;
		default:
			$item['status'] = $ws->getConfigVars("Txt_status_active");
	}

	if ($item['rate'] == 0) {
		$item['rate'] = 'NC';
	}
	else {
		$item['rate'] = $item['rate'] . $ws->getConfigVars("Txt_mission_rate_byday");		
	}
	$links[] = $item;
}

switch ($mission['status']) {
	case STATUS_DUPLICATE :
		$mission['statusName'] = $ws->getConfigVars("Txt_status_duplicate");
		$stemp = $ws->getConfigVars("Txt_list_status_duplicate");
		break;
	case STATUS_KO :
		$mission['statusName'] = $ws->getConfigVars("Txt_status_ko");
		$stemp = $ws->getConfigVars("Txt_list_status_ko");
		break;
	case STATUS_INIT :
		$mission['statusName'] = $ws->getConfigVars("Txt_status_init");
		$stemp = $ws->getConfigVars("Txt_list_status_init");
		break;
	case STATUS_ACTIVE :
		$mission['statusName'] = $ws->getConfigVars("Txt_status_active");
		$stemp = $ws->getConfigVars("Txt_list_status_active");
		break;
	case STATUS_CLOSED :
		$mission['statusName'] = $ws->getConfigVars("Txt_status_closed");
		$stemp = $ws->getConfigVars("Txt_list_status_closed");
		break;
	case STATUS_BACKUPED :
		$mission['statusName'] = $ws->getConfigVars("Txt_status_backuped");
		$stemp = $ws->getConfigVars("Txt_list_status_backuped");
		break;
	default:
		$mission['statusName'] = '';
}
$mission['status'] = $stemp;

if ($mission['start'] != 'Asap') {
	if (isset($mission['start_date'])) {
		$mission['start'] = $mission['start_date'];
	}
	else {
		$mission['start'] = 'Asap';		
	}
}

$listLink = $connect->constructHref($ws->paramGet('APP_CODE'), 'offres-missions-freelance');
$adminLink = $connect->constructHref($ws->paramGet('APP_CODE'), 'mission_admin', 'id:' . $mission['id']);

if (date_format($dateValue, 'Y-m-d') < date('Y-m-d')) {
	$urlLink = $listLink;
}
else {
	$urlLink = constructMissionHref($mission['reference'], $mission['title']);
}

$missionLink = $connect->constructHref($ws->paramGet('APP_CODE'), 'mission_detail', 'id:' . $mission_ref);
if ($ws->canonicalGet() == '') {
	$urlLink = preg_replace('#^\./#Usi', $ws->baseUrlGet() , $urlLink);
}
else {
	$urlLink = preg_replace('#^\./' . strtolower($ws->paramGet('APP_CODE')) . '/#Usi', $ws->canonicalGet() . '/' , $urlLink);
	$urlLink = preg_replace('#^\./#Usi', $ws->canonicalGet() . '/' , $urlLink);
}
$ws->urlLinkSet($urlLink);

$pageTitle = 'Mission ' . $mission['job_name'] . ' ' . 'freelance' . '-' . $mission['location'];
$pageTitle = mb_substr($pageTitle, 0, 70);

$pageDescription = $mission['job_object'] . ' freelance' . ' - secteur : ' . $mission['job_branch'] . ' - ' .  $mission['title'] . '. ' . $mission['intro'];
if (mb_strlen($pageDescription) > 330) {
	$pageDescription = mb_substr($pageDescription, 0, 330);
	$cesure = 0;
	$cesure = mb_strrpos($pageDescription, '.');
		
	$cesure1 = mb_strrpos($pageDescription, ';');
	if ($cesure1 > $cesure) {
		$cesure = $cesure1;
	}
	$cesure1 = mb_strrpos($pageDescription, ',');
	if ($cesure1 > $cesure) {
		$cesure = $cesure1;
	}
	$cesure1 = mb_strrpos($pageDescription, ' ');
	if ($cesure1 - $cesure > 10) {
		$cesure = $cesure1;
	}
	if ($cesure > 0) {
		$pageDescription = mb_substr($pageDescription, 0, $cesure);
	}
}
$pageDescription = trim($pageDescription);

if (empty($mission['original'])) {
	$mission['original'] = 0;
}

$social = new Wsocial();
$socialShare = $social->displayShare('facebook', 'linkedin', 'google', 'twitter', 'square:no');

$ws->assign('socialShare', $socialShare);
$ws->assign('Mission', $mission);
$ws->assign('Tags', $tags);
$ws->assign('Links', $links);
$ws->assign('AdminLink', $adminLink);
$ws->assign('ListLink', $listLink);

?>
