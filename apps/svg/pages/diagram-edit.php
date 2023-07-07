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

$nodeId = $ws->argPost('id');
$parentId = $ws->argPost('parent-id');

//$node = new na_node(); /* Open user class */
//$nodeDisplay = $display->display($nodeId);

$connect = new object_connect();
$ws->assign('$pageRef',$connect->constructHref($ws->paramGet('APP_CODE'), 'diagram-design'));

$wcrud = new wcrud('na_node', $ws->extractPage(__FILE__));
$wcrud->titleSet(false); /* use Title */
$wcrud->pageSet(true); /* set processing type : true = in one box; false = force open new box */

$wcrud->fieldSet('password', 'password');

if ($nodeId == '') {
	$wcrud->displayCrudNew();
}
else {
	$wcrud->displayCrudEdit($nodeId);
}
?>
