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

	$slide = new object_slide();
	$slide->filterSet('domain_id',$domainId);
	$slideSelect = $slide->displaySelect('0', '', 'order:1')->returnGet();

	$question = new object_question();
	$question->filterSet('domain_id',$domainId);
	$questionSelect = $question->displaySelect('0', '', 'order:1')->returnGet();

	$connect = new object_connect();
	$slidesUrl = $connect->constructHref($ws->paramGet('APP_CODE'), 'slides', 'mode:api');
	$questionsUrl = $connect->constructHref($ws->paramGet('APP_CODE'), 'questions', 'mode:api');

	$nodeId = $ws->paramGet('ID');
	if ($nodeId != '') {
		$_SESSION['object_node_id'] = $nodeId;
	}
	else {
		$nodeId = $_SESSION['object_node_id'];
	}

	$node = new object_node();
	$nodeSelect = $node->display($nodeId);
	$nodeTitle = $nodeSelect->returnGet()['title'];
	$nodeLabel = $nodeSelect->returnGet()['label'];
	$diagramId = $nodeSelect->returnGet()['diagram_id'];

	$diagram = new object_diagram();
	$diagramSelect = $diagram->display($diagramId);
	$diagramName = $diagramSelect->returnGet()['name'];
	$diagramType = $diagramSelect->returnGet()['type_id'];

	$wcrud = new wcrud('object_node', $ws->extractPage(__FILE__), 'nodes');
	$wcrud->titleSet(false); /* use Title */
	$wcrud->pageSet(false); /* set processing type : true = in one box; false = force open new box */
	$wcrud->returnSet(false);
	
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

	$wcrud->displayCrudEdit($nodeId);
}
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'home.php';
	require_once($filePath);
}
?>
