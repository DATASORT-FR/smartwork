<?php
/**
* diagram nodes hierarchy api
*
* @package    use_diagram
* @subpackage Json api
* @version    1.0
* @date       15 May 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

global $nodeList;

header( 'content-type: application/json; charset=utf-8' );

$diagramId = $ws->paramGet('ID');
if ($diagramId != '') {
	$_SESSION['object_diagram_id'] = $diagramId;
}
else {
	$diagramId = 1;
	if (isset($_SESSION['object_diagramId'])) {
		$diagramId = $_SESSION['object_diagramId'];
	}
}

function addNode($diagramId, $nodeId, $parentId, $level)
{
	global $nodeList;
	$item = array();

	$nodeItem = array();
	$nodeCode = '';
	$nodeTitle = '';
	$nodeLabel = '';
	$nodeRoot = false;
	$nodeDescription = '';
	$nodeImage = '';
	$nodeParents = array();
	$nodeChildren = array();
	$nodeLinks = array();
	$level = $level + 1;

	$tbNode = new Smart_select('dmg_node', 'dgm');
	$tbNode->fieldSet('id');
	$tbNode->fieldSet('diagram_id');
	$tbNode->fieldSet('reference');
	$tbNode->fieldSet('root');
	$tbNode->fieldSet('information');
	$tbNode->fieldSet('slide_id');
	$tbNode->fieldSet('question_id');
	$tbNode->whereSet('id', $nodeId);
	$item = $tbNode->find();
	if (!empty($item)) {
		$nodeCode = $nodeId;
		$nodeReference = $item['reference'];
		$nodeRoot = $item['root'];
		$nodeInformation = $item['information'];
		$slideId = $item['slide_id'];
		$questionId = $item['question_id'];
	
		$nodeTitle = '';
		$nodeLabel = '';
		$nodeImage = '';
		$nodeImageDisplay = 1;
		$nodeDescription = '';
		$noticeId = 0;
		$processId = 0;
		$variableContentId = 0;
		$resultContentId = 0;
		$tbSlide = new Smart_select('dmg_slide', 'dgm');
		$tbSlide->fieldSet('id');
		$tbSlide->fieldSet('title');
		$tbSlide->fieldSet('label');
		$tbSlide->fieldSet('image');
		$tbSlide->fieldSet('image_display');
		$tbSlide->fieldSet('description');
		$tbSlide->fieldSet('notice_id');
		$tbSlide->fieldSet('process_id');
		$tbSlide->fieldSet('variable_contentid');
		$tbSlide->fieldSet('result_contentid');
		$tbSlide->whereSet('id', $slideId);
		$item = $tbSlide->find();
		if (!empty($item)) {
			$nodeTitle = $item['title'];
			$nodeLabel = $item['label'];
			$nodeImage = $item['image'];
			$nodeImageDisplay = $item['image_display'];
			$nodeDescription = $item['description'];
			$noticeId = $item['notice_id'];
			$processId = $item['process_id'];
			$variableContentId = $item['variable_contentid'];
			$resultContentId = $item['result_contentid'];
		}

		// Notice content
		$nodeNoticeTitle = '';
		$nodeNoticeImage = '';
		$nodeNoticeDescription = '';
		$tb_content = new Smart_select('dmg_content', 'dgm');
		$tb_content->fieldSet('id');
		$tb_content->fieldSet('title');
		$tb_content->fieldSet('image');
		$tb_content->fieldSet('description');
		$tb_content->whereSet('id', $noticeId);
		$content = $tb_content->find();
		if (!empty($content)) {
			$nodeNoticeTitle = $content['title'];
			$nodeNoticeImage = $content['image'];
			$nodeNoticeDescription = $content['description'];
		}

		// Question content
		$nodeQuestion = '';
		$nodeQuestionImage = '';
		$nodeQuestionDescription  = '';
		$tb_content = new Smart_select('dmg_content', 'dgm');
		$tb_content->fieldSet('id');
		$tb_content->fieldSet('title');
		$tb_content->fieldSet('image');
		$tb_content->fieldSet('description');
		$tb_content->whereSet('id', $questionId);
		$content = $tb_content->find();
		if (!empty($content)) {
			$nodeQuestion = $content['title'];
			$nodeQuestionImage = $content['image'];
			$nodeQuestionDescription  = $content['description'];
		}

		// Variable content
		$nodeVariableTitle = '';
		$nodeVariableImage = '';
		$nodeVariableDescription = '';
		$nodeVariableItemsTitle = '';
		$nodeVariableItemsImage = '';
		$nodeVariableItemsDescription = '';
		$tb_content = new Smart_select('dmg_content', 'dgm');
		$tb_content->fieldSet('id');
		$tb_content->fieldSet('title');
		$tb_content->fieldSet('image');
		$tb_content->fieldSet('description');
		$tb_content->fieldSet('comp_description');
		$tb_content->whereSet('id', $variableContentId);
		$content = $tb_content->find();
		if (!empty($content)) {
			$nodeVariableTitle  = $content['title'];
			$nodeVariableImage  = $content['image'];
			$nodeVariableDescription  = $content['description'];
			$nodeVariableItemsTitle  = $content['title'];
			$nodeVariableItemsImage  = $content['image'];
			$nodeVariableItemsDescription  = $content['description'];
		}

		// Result content
		$nodeResultTitle = '';
		$nodeResultImage = '';
		$nodeResultDescription = '';
		$nodeResultItemsTitle = '';
		$nodeResultItemsImage = '';
		$nodeResultItemsDescription = '';
		$tb_content = new Smart_select('dmg_content', 'dgm');
		$tb_content->fieldSet('id');
		$tb_content->fieldSet('title');
		$tb_content->fieldSet('image');
		$tb_content->fieldSet('description');
		$tb_content->fieldSet('comp_description');
		$tb_content->whereSet('id', $resultContentId);
		$content = $tb_content->find();
		if (!empty($content)) {
			$nodeResultTitle  = $content['title'];
			$nodeResultImage  = $content['image'];
			$nodeResultDescription  = $content['description'];
			$nodeResultItemsTitle  = $content['title'];
			$nodeResultItemsImage  = $content['image'];
			$nodeResultItemsDescription  = $content['description'];
		}

		// Process content
		$nodeProcessTitle = '';
		$nodeProcessText = '';
		$nodeProcessText2 = '';
		$tbDiagram = new Smart_select('dmg_diagram', 'dgm');
		$tbDiagram->fieldSet('id');
		$tbDiagram->fieldSet('label');
		$tbDiagram->fieldSet('description');
		$tbDiagram->whereSet('id', $processId);
		$diagram = $tbDiagram->find();
		if (!empty($diagram)) {
			$nodeProcessTitle  = $diagram['label'];
			$nodeProcessText  = $diagram['description'];
		}

		// variable list
		$tbNodeVariable = new Smart_select('dmg_slide_variable', 'dgm');
		$tbNodeVariable->fieldSet('id');
		$tbNodeVariable->fieldSet('type');
		$tbNodeVariable->fieldSet('slide_id');
		$tbNodeVariable->fieldSet('field_id');
		$tbNodeVariable->whereSet('type', 0, 'and');
		$tbNodeVariable->whereSet('slide_id',$slideId, 'and');
		$itemListVariable = $tbNodeVariable->findAll();

		// result list
		$tbNodeResult = new Smart_select('dmg_slide_result', 'dgm');
		$tbNodeResult->fieldSet('id');
		$tbNodeResult->fieldSet('type');
		$tbNodeResult->fieldSet('slide_id');
		$tbNodeResult->fieldSet('field_id');
		$tbNodeResult->whereSet('type', 0, 'and');
		$tbNodeResult->whereSet('slide_id',$slideId, 'and');
		$itemListResult = $tbNodeResult->findAll();

		// variable1 list
		$tbNodeVariable = new Smart_select('dmg_slide_variable', 'dgm');
		$tbNodeVariable->fieldSet('id');
		$tbNodeVariable->fieldSet('type');
		$tbNodeVariable->fieldSet('slide_id');
		$tbNodeVariable->fieldSet('field_id');
		$tbNodeVariable->whereSet('type', 1, 'and');
		$tbNodeVariable->whereSet('slide_id',$slideId, 'and');
		$itemListVariable1 = $tbNodeVariable->findAll();

		// result1 list
		$tbNodeResult = new Smart_select('dmg_slide_result', 'dgm');
		$tbNodeResult->fieldSet('id');
		$tbNodeResult->fieldSet('type');
		$tbNodeResult->fieldSet('slide_id');
		$tbNodeResult->fieldSet('field_id');
		$tbNodeResult->whereSet('type', 1, 'and');
		$tbNodeResult->whereSet('slide_id',$slideId, 'and');
		$itemListResult1 = $tbNodeResult->findAll();

		// Variables and Results flags
		$nodeVariableFlag = false;
		if (count($itemListVariable) > 0) {
			$nodeVariableFlag = true;
		}
		$nodeVariableItemsFlag = false;
		if (count($itemListVariable1) > 0) {
			$nodeVariableItemsFlag = true;
		}
		$nodeResultFlag = false;
		if (count($itemListResult) > 0) {
			$nodeResultFlag = true;
		}
		$nodeResultItemsFlag = false;
		if (count($itemListResult1) > 0) {
			$nodeResultItemsFlag = true;
		}

		// Node image
		$atemp = explode(';',$nodeImage);
		$nodeImage = '';
		$nodeImageAlt = '';
		$nodeImageTitle = '';
		if (isset($atemp[0])) {
			$nodeImage = $atemp[0];
		}
		if (isset($atemp[1])) {
			$nodeImageAlt = $atemp[1];
		}
		if (isset($atemp[2])) {
			$nodeImageTitle = $atemp[2];
		}
		if (!file_exists($nodeImage)) {
			$nodeImage = '';
		}

		// Notice image
		$atemp = explode(';',$nodeNoticeImage);
		$nodeNoticeImage = '';
		$nodeNoticeImageAlt = '';
		$nodeNoticeImageTitle = '';
		if (isset($atemp[0])) {
			$nodeNoticeImage = $atemp[0];
		}
		if (isset($atemp[1])) {
			$nodeNoticeImageAlt = $atemp[1];
		}
		if (isset($atemp[2])) {
			$nodeNoticeImageTitle = $atemp[2];
		}
		if (!file_exists($nodeNoticeImage)) {
			$nodeNoticeImage = '';
		}
	
		// Variable image
		$atemp = explode(';',$nodeVariableImage);
		$nodeVariableImage = '';
		$nodeVariableImageAlt = '';
		$nodeVariableImageTitle = '';
		if (isset($atemp[0])) {
			$nodeVariableImage = $atemp[0];
		}
		if (isset($atemp[1])) {
			$nodeVariableImageAlt = $atemp[1];
		}
		if (isset($atemp[2])) {
			$nodeVariableImageTitle = $atemp[2];
		}
		if (!file_exists($nodeVariableImage)) {
			$nodeVariableImage = '';
		}
	
		// Variable image comp
		$atemp = explode(';',$nodeVariableItemsImage);
		$nodeVariableItemsImage = '';
		$nodeVariableItemsImageAlt = '';
		$nodeVariableItemsImageTitle = '';
		if (isset($atemp[0])) {
			$nodeVariableItemsImage = $atemp[0];
		}
		if (isset($atemp[1])) {
			$nodeVariableItemsImageAlt = $atemp[1];
		}
		if (isset($atemp[2])) {
			$nodeVariableItemsImageTitle = $atemp[2];
		}
		if (!file_exists($nodeVariableItemsImage)) {
			$nodeVariableItemsImage = '';
		}
	
		// Result image
		$atemp = explode(';',$nodeResultImage);
		$nodeResultImage = '';
		$nodeResultImageAlt = '';
		$nodeResultImageTitle = '';
		if (isset($atemp[0])) {
			$nodeResultImage = $atemp[0];
		}
		if (isset($atemp[1])) {
			$nodeResultImageAlt = $atemp[1];
		}
		if (isset($atemp[2])) {
			$nodeResultImageTitle = $atemp[2];
		}
		if (!file_exists($nodeResultImage)) {
			$nodeResultImage = '';
		}
	
		// Variable image comp
		$atemp = explode(';',$nodeResultItemsImage);
		$nodeResultItemsImage = '';
		$nodeResultItemsImageAlt = '';
		$nodeResultItemsImageTitle = '';
		if (isset($atemp[0])) {
			$nodeResultItemsImage = $atemp[0];
		}
		if (isset($atemp[1])) {
			$nodeResultItemsImageAlt = $atemp[1];
		}
		if (isset($atemp[2])) {
			$nodeResultItemsImageTitle = $atemp[2];
		}
		if (!file_exists($nodeResultItemsImage)) {
			$nodeResultItemsImage = '';
		}
	
		// Node item
		$nodeItem['code'] = $nodeCode;
		$nodeItem['reference'] = $nodeReference;
		$nodeItem['title'] = $nodeTitle;
		$nodeItem['label'] = $nodeLabel;
		$nodeItem['root'] = $nodeRoot;
		$nodeItem['process'] = $processId;
		$nodeItem['image'] = $nodeImage;
		$nodeItem['image_display'] = $nodeImageDisplay;
		$nodeItem['description'] = $nodeDescription;
		$nodeItem['question'] = $nodeQuestion;
		$nodeItem['question_description'] = $nodeQuestionDescription;
		$nodeItem['process_title'] = $nodeProcessTitle;
		$nodeItem['process_text'] = $nodeProcessText;
		$nodeItem['process_text2'] = $nodeProcessText2;
		if ($nodeRoot == 1) {
			$nodeItem['detail'] = $nodeNoticeDescription;
		}
		else {
			$nodeItem['detail'] = "";
		}
		$nodeItem['variable_title'] = $nodeVariableTitle;
		$nodeItem['variable_image'] = $nodeVariableImage;
		$nodeItem['variable_description'] = $nodeVariableDescription;
		$nodeItem['variable_items_title'] = $nodeVariableItemsTitle;
		$nodeItem['variable_items_image'] = $nodeVariableItemsImage;
		$nodeItem['variable_items_description'] = $nodeVariableItemsDescription;
		$nodeItem['result_title'] = $nodeResultTitle;
		$nodeItem['result_image'] = $nodeResultImage;
		$nodeItem['result_description'] = $nodeResultDescription;
		$nodeItem['result_items_title'] = $nodeResultItemsTitle;
		$nodeItem['result_items_image'] = $nodeResultItemsImage;
		$nodeItem['result_items_description'] = $nodeResultItemsDescription;
		$nodeItem['variable_flag'] = $nodeVariableFlag;
		$nodeItem['variable_items_flag'] = $nodeVariableItemsFlag;
		$nodeItem['result_flag'] = $nodeResultFlag;
		$nodeItem['result_items_flag'] = $nodeResultItemsFlag;
		$nodeItem['information'] = $nodeInformation;
		$nodeItem['level'] = $level;
		$nodeList[] = $nodeItem;
		
		$nodeIndex = count($nodeList) - 1;
		if ($level <= 20) {
			$tb_link = new Smart_select('dmg_link', 'dgm');
			$tb_link->fieldSet('id');
			$tb_link->fieldSet('nodeFrom_id');
			$tb_link->fieldSet('nodeTo_id');
			$tb_link->whereSet('diagram_id',$diagramId);
			$tb_link->whereSet('nodeFrom_id',$nodeId, 'and');
			$tb_link->orderSet('nodeFrom_id');
			$tb_link->orderSet('sequence');
			$tb_link->orderSet('nodeTo_id');
			$list = $tb_link->findAll();
		
			for ($i=0; $i < count($list); $i++) {
				$item = $list[$i];
				$nodeToId = $item['nodeTo_id'];
				addNode($diagramId, $nodeToId, $nodeId, $level);
				$nodeChildren[] = $nodeToId;
			}
		
			for ($i=0; $i < count($list); $i++) {
				$item = $list[$i];
				$linkItem = array();
				$linkItem['code'] = $item['id'];
				$linkItem['nodeTo'] = $item['nodeTo_id'];
				$linkItem['nodeFrom'] = $nodeId;
				$nodeLinks[] = $linkItem;
			}
		}
		if ($parentId <> '') {
			$nodeParents[] = $parentId;
		}
	
		$nodeItem['parents'] = $nodeParents;
		$nodeItem['children'] = $nodeChildren;
		$nodeItem['links'] = $nodeLinks;
		$nodeList[$nodeIndex] = $nodeItem;
	}
}

$tbNode = new Smart_select('dmg_node', 'dgm');
$tbNode->fieldSet('id');
$tbNode->whereSet('diagram_id', $diagramId);
$tbNode->whereSet('root', 1, 'and');
$node = $tbNode->find();
$nodeId = $node['id'];

$level = 0;
$nodeList = array();
addNode($diagramId, $nodeId, '', $level);
echo json_encode($nodeList);

?>
