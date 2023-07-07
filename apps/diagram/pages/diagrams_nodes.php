<?php
/**
* This file contains process for diagrams nodes list
*
* @package    use_diagram
* @subpackage controller
* @version    1.0
* @date       10 Octobre 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$connect = new object_connect();
$ws->assign('pageRef',$connect->constructHref($ws->paramGet('APP_CODE'), $ws->extractPage(__FILE__), 'command:list'));

if ($domainId != '') {

	$slide = new object_slide();
	$slide->filterSet('domain_id',$domainId);
	$slideSelect = $slide->displaySelect('0', '', 'order:1')->returnGet();

	$question = new object_question();
	$question->filterSet('domain_id',$domainId);
	$questionSelect = $question->displaySelect('0', '', 'order:1')->returnGet();

	$connect = new object_connect();
	$slidesUrl = $connect->constructHref($ws->paramGet('APP_CODE'), 'slides', 'mode:api');
	$questionsUrl = $connect->constructHref($ws->paramGet('APP_CODE'), 'questions', 'mode:api');

	$diagramId = '';	
	if ($ws->argGet('command') == 'list') {
		$diagramId = $ws->paramGet('ID');
	}
	if ($diagramId != '') {
		$_SESSION['object_diagram_id'] = $diagramId;
	}
	else {
		$diagramId = $_SESSION['object_diagram_id'];
	}

	$diagram = new object_diagram();
	$diagramSelect = $diagram->display($diagramId);
	$diagramName = $diagramSelect->returnGet()['name'];
	$diagramType = $diagramSelect->returnGet()['type_id'];
	
	$wcrud = new wcrud('object_node', $ws->extractPage(__FILE__), 'nodes');
	$wcrud->titleSet(true); /* use Title */
	$wcrud->titleCodeSet($diagramName.' / ');
	$wcrud->pageSet(false); /* set processing type : true = in one box; false = force open new box */

	$wlist = $wcrud->listGet();
	$wlist->titleSet(false); /* use Title */
	$wlist->pageSet(true);
	$wlist->pagesizeSet(10, 20, 50); /* set number of lines for the list */
	$wlist->pagesearchSet(true); /* show search input and button */
	$wlist->pageorderSet(0); /* number of order type */
	$wlist->captionSet(true);
	$wlist->displaysizeSet('small'); /* set list width */
	$wlist->columnidSet(false); /* show id column */

	$wlist->sortSet(true); /* show or not the sort of columns. False by default */
	$wlist->viewSet(true); /* show or not the columns selector. False by default */
	$wlist->filterViewSet('id'); /* display a filter field */
	$wlist->filterViewSet('reference'); /* display a filter field */
	
	$wlist->columnidpctSet(5); /* set percent size for id column */
	$wlist->columnAdd('id',8, false); /* show title column */
	$wlist->columnAdd('reference',8); /* show title column */
	$wlist->columnAdd('title',25); /* show title column */
	$wlist->columnAdd('label',40); /* show label column */
	$wlist->columnactionpctSet(5); /* set percent size for edit and delete column */

	$wlist->eventSet('btnew', true); /* show new button */
	$wlist->eventSet('btevent', false); /* show edit button */
	$wlist->eventSet('btedit', true); /* show edit button */
	$wlist->eventSet('btdelete', true); /* show delete button */

	$wlist->deletecolumnnameSet('title'); /* column used in the delete confirmation window for the title */
	
	// line 1
	$wcrud->fieldSet('slide_id', 'list', $slideSelect, $slidesUrl);
	$wcrud->fieldSet('slide_label');
	$wcrud->sizeSet('slide_label',50);
	$wcrud->fieldLineSet('reference');
	$wcrud->sizeSet('reference',6);
	$wcrud->readonlySet('reference');
	$wcrud->fieldDisplaySet('reference', 'edit');
	$wcrud->fieldSet('information', 'choice');

	$wcrud->fieldSet('maintab', 'tab');
		$wcrud->fieldSet('contentInfo', 'tabcontent','maintab');
			$wcrud->fieldSet('slide_title');
			$wcrud->sizeSet('slide_title',50);
			$wcrud->fieldSet('slide_image', 'image');
			$wcrud->fieldSet('slide_image_display', 'choice');
			$wcrud->fieldSet('slide_description', 'textarea');
			$wcrud->rowsSet('slide_description', 8);
			$wcrud->colsSet('slide_description',100);

			$wcrud->fieldLinkSet('slide_label', 'slide_id', 'label');
			$wcrud->fieldLinkSet('slide_title', 'slide_id', 'title');
			$wcrud->fieldLinkSet('slide_image', 'slide_id', 'image');
			$wcrud->fieldLinkSet('slide_image_display', 'slide_id', 'image_display');
			$wcrud->fieldLinkSet('slide_description', 'slide_id', 'description');
		$wcrud->fieldSet('contentInfo_end', 'tabcontentend');
	
		$wcrud->fieldSet('contentQuestion', 'tabcontent','maintab');
			$wcrud->fieldSet('question_id', 'list', $questionSelect, $questionsUrl);
			$wcrud->fieldSet('question_label');
			$wcrud->sizeSet('question_label',50);
			$wcrud->fieldSet('question');
			$wcrud->sizeSet('question',50);
			$wcrud->fieldSet('question_description', 'textarea');
			$wcrud->rowsSet('question_description', 7);
			$wcrud->colsSet('question_description',100);

			$wcrud->fieldLinkSet('question_label', 'question_id', 'label');
			$wcrud->fieldLinkSet('question', 'question_id', 'title');
			$wcrud->fieldLinkSet('question_description', 'question_id', 'description');
		$wcrud->fieldSet('contentQuestion_end', 'tabcontentend');
	
	$wcrud->fieldSet('maintab_end', 'tabend','maintab');

	$wcrud->filterSet('slide_domain', $domainId);
	$wcrud->filterSet('diagram_id', $diagramId);
	$wcrud->initValueSet('question', 'questionInit', 'transform');
	$wcrud->filterSet('question_domain', $domainId);

	$wcrud->displayCrud();
}
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'home.php';
	require_once($filePath);
}
?>
