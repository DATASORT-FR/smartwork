<?php
/**
* Site Source Count api for Job freelance
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

define('MAX_SITES',15);

$functionSort = function(array $a, array $b) {
   return $b['count'] - $a['count'];
};

header( 'content-type: application/json; charset=utf-8' );

$exploration = $ws->argPost('exploration');

if (empty($exploration)) {
	$exploration = 7;
}

$job = new object_job();
$list = $job->getCountSiteSource($exploration);
$arrayResult = $list;
usort($arrayResult, $functionSort);

$list = array();
$countOthers = 0;
for ($i=0; $i < count($arrayResult); $i++) {
	if ($i < MAX_SITES) {
		$list[] = $arrayResult[$i];
	}
	else {
		$countOthers = $countOthers + $arrayResult[$i]['count'];
	}
}
if (count($arrayResult) > MAX_SITES) {
	$item = array();
	$item['group'] = 'Others';
	$item['ssgroup'] = '';
	$item['date'] = '';
	$item['count'] = $countOthers;
	$list[] = $item;
}
echo json_encode($list);

?>
