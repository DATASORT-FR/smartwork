<?php
/**
* Content administration
*
* @package    content_administration
* @version    1.0
* @date       19 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$imagesPath = $ws->paramGet('IMAGES_PATH');

$application = new object_application(); /* Open application class */
$application_select = $application->displaySelect('0', '');

$category = new object_content_category(); /* Open content category class */
$category_select = $category->displaySelect('0','');

$author = new object_content_author(); /* Open content category class */
$author_select = $author->displaySelect();

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
$wlist->columnAdd('application',15); /* show application column */
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
$wcrud->fieldSet('category_id', 'list', $category_select->returnGet());
$wcrud->fieldLineSet('date_publication', 'date');
$wcrud->formatSet('date_publication', 'd/m/Y');
$wcrud->fieldSet('maintab', 'tab');
	$wcrud->fieldSet('tab1', 'tabcontent','maintab');
		$wcrud->fieldSet('code', 'text');
		$wcrud->fieldSet('status_id', 'choice');
		$wcrud->fieldSet('image', 'image', $imagesPath);
		$wcrud->fieldSet('intro', 'textarea');
		$wcrud->rowsSet('intro', 6);
		$wcrud->colsSet('intro',100);
	$wcrud->fieldSet('tab1_end', 'tabcontentend');
	$wcrud->fieldSet('tab2', 'tabcontent','maintab');
		$wcrud->fieldSet('content', 'editor');
		$wcrud->rowsSet('content', 25);
	$wcrud->fieldSet('tab2_end', 'tabcontentend');
	$wcrud->fieldSet('tab3', 'tabcontent','maintab');
		$wcrud->fieldSet('author_id', 'list', $author_select->returnGet());
		$wcrud->fieldSet('author_id', 'number');
		$wcrud->fieldSet('alias', 'text');
		$wcrud->sizeSet('alias',60);
		$wcrud->fieldSet('description', 'textarea');
		$wcrud->rowsSet('description', 3);
		$wcrud->colsSet('description',100);
		$wcrud->fieldSet('keywords', 'textarea');
		$wcrud->rowsSet('keywords', 3);
		$wcrud->colsSet('keywords',50);
	$wcrud->fieldSet('tab3_end', 'tabcontentend');
	

	$wcrud->fieldSet('tab4', 'tabcontent','maintab');
		$wcrud->fieldSet('title_page');
		$wcrud->sizeSet('title_page',80);
		$wcrud->fieldSet('param1');
		$wcrud->sizeSet('param1',80);
		$wcrud->fieldSet('param2');
		$wcrud->sizeSet('param2',80);
		$wcrud->fieldSet('alt', 'text');
		$wcrud->sizeSet('alt',80);
		$wcrud->fieldSet('style', 'text');
		$wcrud->sizeSet('style',10);
		$wcrud->fieldSet('class', 'text');
		$wcrud->sizeSet('class',10);
		$wcrud->fieldSet('icon', 'text');
		$wcrud->sizeSet('icon',10);
		$wcrud->fieldSet('path', 'text');
		$wcrud->sizeSet('path',20);
		$wcrud->fieldSet('content_page', 'text');
		$wcrud->sizeSet('content_page',40);
	$wcrud->fieldSet('tab4_end', 'tabcontentend');
	
	$wcrud->fieldSet('tab5', 'tabcontent','maintab');
		$wcrud->fieldSet('block1', 'textarea');
		$wcrud->rowsSet('block1', 6);
		$wcrud->colsSet('block1',100);
		$wcrud->fieldLineSet('block2', 'textarea');
		$wcrud->rowsSet('block2', 6);
		$wcrud->colsSet('block2',100);
		$wcrud->fieldSet('block3', 'textarea');
		$wcrud->rowsSet('block3', 6);
		$wcrud->colsSet('block3',100);
		$wcrud->fieldLineSet('block4', 'textarea');
		$wcrud->rowsSet('block4', 6);
		$wcrud->colsSet('block4',100);
		$wcrud->fieldSet('block5', 'textarea');
		$wcrud->rowsSet('block5', 6);
		$wcrud->colsSet('block5',100);
		$wcrud->fieldLineSet('block6', 'textarea');
		$wcrud->rowsSet('block6', 6);
		$wcrud->colsSet('block6',100);
	$wcrud->fieldSet('tab5_end', 'tabcontentend');

	$wcrud->fieldSet('tab6', 'tabcontent','maintab');
		$wcrud->fieldSet('image1', 'image', $imagesPath);
		$wcrud->fieldSet('image2', 'image', $imagesPath);
		$wcrud->fieldSet('image3', 'image', $imagesPath);
		$wcrud->fieldSet('image4', 'image', $imagesPath);
		$wcrud->fieldSet('image5', 'image', $imagesPath);
		$wcrud->fieldSet('image6', 'image', $imagesPath);
	$wcrud->fieldSet('tab6_end', 'tabcontentend');
	
	
$wcrud->fieldSet('maintab_end', 'tabend','maintab');

$wcrud->displayCrud();
?>
