<?php
/**
* @package    use_content_results
* @subpackage controller
* @version    1.0
* @date       16 June 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$connect = new object_connect();
$ws->assign('pageRef',$connect->constructHref($ws->paramGet('APP_CODE'), $ws->extractPage(__FILE__), 'command:list'));

if (!function_exists('titleInit')) {
	function titleInit($label) {	
		return $label;
	}
}

if ($domainId != '') {

	$wcrud = new wcrud('object_content_results', $ws->extractPage(__FILE__), 'contents');
	$wcrud->titleSet(true); /* use Title */
	$wcrud->pageSet(false); /* set processing type : true = in one box; false = force open new box */

	$wlist = $wcrud->listGet();
	$wlist->pageSet(true);
	$wlist->pagesizeSet(10, 20, 50); /* set number of lines for the list */
	$wlist->pagesearchSet(true); /* show search input and button */
	$wlist->pageorderSet(2); /* number of order type */
	$wlist->captionSet(true);
	$wlist->displaysizeSet('small'); /* set list width */
	$wlist->columnidSet(false); /* show id column */

	$wlist->sortSet(true); /* show or not the sort of columns. False by default */
	$wlist->viewSet(true); /* show or not the columns selector. False by default */
	$wlist->filterViewSet('label'); /* display a filter field */

	$wlist->columnidpctSet(10); /* set percent size for id column */
	$wlist->columnAdd('id', 10, false); /* show code column */
	$wlist->columnAdd('label',75); /* show code column */
	$wlist->columnactionpctSet(5); /* set percent size for edit and delete column */

	$wlist->eventSet('btnew', true); /* show new button */
	$wlist->eventSet('btedit', true); /* show edit button */
	$wlist->eventSet('btdelete', true); /* show delete button */

	$wlist->deletecolumnnameSet('label'); /* column used in the delete confirmation window for the title */
	
	$wcrud->fieldSet('label');
	$wcrud->sizeSet('label',50);
	$wcrud->fieldSet('title');
	$wcrud->sizeSet('title',50);
	$wcrud->fieldSet('image', 'image');
	$wcrud->fieldSet('description', 'textarea');
	$wcrud->rowsSet('description', 7);
	$wcrud->colsSet('description',100);

	$wcrud->initValueSet('title', 'titleInit', 'transform', 'label');

	$wcrud->filterSet('domain_id', $domainId);
	$wcrud->displayCrud();
}
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'home.php';
	require_once($filePath);
}

?>
