<?php
/**
* diagram node edit
*
* @package    Diagram svg
* @subpackage controller
* @version    1.0
* @date       28 September 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$connect = new object_connect();
$ws->assign('$pageRef',$connect->constructHref($ws->paramGet('APP_CODE'), 'diagram-design'));

if ($domainId != '') {
	$linkId = $ws->paramGet('ID');
	if ($linkId != '') {
		$_SESSION['object_link_id'] = $linkId;
	}
	else {
		$linkId = $_SESSION['object_link_id'];
	}

	$wcrud = new wcrud('object_link', $ws->extractPage(__FILE__), 'links');
	$wcrud->titleSet(false); /* use Title */
	$wcrud->pageSet(false); /* set processing type : true = in one box; false = force open new box */
	$wcrud->returnSet(false);
	
	$wcrud->fieldSet('nodeFrom');
	$wcrud->readonlySet('nodeFrom');
	$wcrud->fieldSet('nodeTo');
	$wcrud->readonlySet('nodeTo');
	$wcrud->fieldSet('description', 'editor');
	$wcrud->rowsSet('description', 30);

	$wcrud->displayCrudEdit($linkId);
}
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'home.php';
	require_once($filePath);
}
?>
