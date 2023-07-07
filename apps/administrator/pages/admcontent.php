<?php
/**
* @package    use_content
* @subpackage controller
* @version    1.0
* @date       19 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$application = new object_application(); /* Open application class */
$application_select = $application->displaySelect('0', '');

$category = new object_content_category(); /* Open content category class */
$category_select = $category->displaySelect('0','');

$connect = new object_connect();
$pageRef = $connect->constructHref($ws->paramGet('APP_CODE'), $ws->extractPage(__FILE__), 'command:list');
$ws->assign('pageRef',$pageRef);

$wcrud = new wcrud('object_content', $ws->extractPage(__FILE__));
$wcrud->titleSet(true); /* use Title */
$wcrud->pageSet(true); /* set processing type : true = in one box; false = force open new box */

$wlist = $wcrud->listGet();
$wlist->pagesizeSet(14, 10, 20, 50); /* set number of lines for the list */
$wlist->pagesizeselectorSet(true); /* display page size selector. False by default */
$wlist->pagesearchSet(true); /* show search input and button */
$wlist->pageorderSet(4); /* number of order type */
$wlist->displaysizeSet('small'); /* set list width */
$wlist->columnidSet(true); /* show id column */
$wlist->sortSet(true); /* show or not the sort of columns. False by default */
$wlist->viewSet(true); /* show or not the columns selector. False by default */
$wlist->filterViewSet('code'); /* display a filter field */
$wlist->filterViewSet('application_id', 'list', $application_select->returnGet()); /* display a filter field */
$wlist->columnidpctSet(5); /* set percent size for id column */
$wlist->columnAdd('application_id',15); /* show application column */
$wlist->columnAdd('code',15); /* show code column */
$wlist->columnAdd('status',15); /* show description column */
$wlist->columnAdd('title',40, false); /* show description column */
$wlist->columnactionpctSet(5); /* set percent size for edit and delete column */

$wlist->eventSet('btnew', true); /* show new button */
$wlist->eventSet('btedit', true); /* show edit button */
$wlist->eventSet('btdelete', true); /* show delete button */

$wlist->deletecolumnnameSet('code'); /* column used in the delete confirmation window for the title */
	
$wcrud->fieldSet('title');
$wcrud->sizeSet('title',220);
$wcrud->fieldSet('application_id', 'list', $application_select->returnGet());
$wcrud->fieldSet('maintab', 'tab');
	$wcrud->fieldSet('tab1', 'tabcontent','maintab');
		$wcrud->fieldSet('code', 'text');
		$wcrud->fieldSet('status_id', 'choice');
		$wcrud->fieldSet('intro', 'textarea');
		$wcrud->rowsSet('intro', 6);
		$wcrud->colsSet('intro',100);
	$wcrud->fieldSet('tab1_end', 'tabcontentend');
	$wcrud->fieldSet('tab2', 'tabcontent','maintab');
		$wcrud->fieldSet('content', 'editor');
		$wcrud->rowsSet('content', 25);
	$wcrud->fieldSet('tab2_end', 'tabcontentend');
	$wcrud->fieldSet('tab3', 'tabcontent','maintab');
		$wcrud->fieldSet('category_id', 'list', $category_select->returnGet());
		$wcrud->fieldSet('description', 'textarea');
		$wcrud->rowsSet('description', 3);
		$wcrud->colsSet('description',100);
		$wcrud->fieldSet('keywords', 'textarea');
		$wcrud->rowsSet('keywords', 3);
		$wcrud->colsSet('keywords',50);
	$wcrud->fieldSet('tab3_end', 'tabcontentend');
$wcrud->fieldSet('maintab_end', 'tabend','maintab');

$wcrud->displayCrud();
?>
