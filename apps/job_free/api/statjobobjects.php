<?php
/**
* JobObjects Count api for Job freelance
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

define('MAX_OBJECTS',20);

$functionSort = function(array $a, array $b) {
   return $b['count'] - $a['count'];
};

header( 'content-type: application/json; charset=utf-8' );
 
$job = new object_job();
$list = $job->getCountJobObject();
$arrayResult = $list;
usort($arrayResult, $functionSort);

$list = array();
$countOthers = 0;
for ($i=0; $i < count($arrayResult); $i++) {
	if ($i < MAX_OBJECTS) {
		$list[] = $arrayResult[$i];
	}
	else {
		$countOthers = $countOthers + $arrayResult[$i]['count'];
	}
}
if (count($arrayResult) > MAX_OBJECTS) {
	$item = array();
	$item['group'] = 'Others';
	$item['ssgroup'] = '';
	$item['date'] = '';
	$item['count'] = $countOthers;
	$list[] = $item;
}

echo json_encode($list);

?>
