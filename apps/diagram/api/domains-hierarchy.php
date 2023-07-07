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

header( 'content-type: application/json; charset=utf-8' );

$domainId = $ws->paramGet('ID');
if ($domainId != '') {
	$_SESSION['object_domainId'] = $domainId;
}
else {
	$domainId = 1;
	if (isset($_SESSION['object_domainId'])) {
		$domainId = $_SESSION['object_domainId'];
	}
}

function addSlide($slideId)
{
	$item = array();

	$slideItem = array();

	$slideReference = '';
	$slideTitle = '';
	$slideLabel = '';
	$slideImage = '';
	$slideImageDisplay = 1;
	$slideDescription = '';
	$noticeId = 0;
	$processId = 0;
	$variableContentId = 0;
	$resultContentId = 0;

	$tbSlide = new Smart_select('dmg_slide', 'dgm');
	$tbSlide->fieldSet('id');
	$tbSlide->fieldSet('reference');
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
		$slideReference = $item['reference'];
		$slideTitle = $item['title'];
		$slideLabel = $item['label'];
		$slideImage = $item['image'];
		$slideImageDisplay = $item['image_display'];
		$slideDescription = $item['description'];
		$noticeId = $item['notice_id'];
		$processId = $item['process_id'];
		$variableContentId = $item['variable_contentid'];
		$resultContentId = $item['result_contentid'];

		// Notice content
		$slideNoticeTitle = '';
		$slideNoticeImage = '';
		$slideNoticeDescription = '';
		$tb_content = new Smart_select('dmg_content', 'dgm');
		$tb_content->fieldSet('id');
		$tb_content->fieldSet('title');
		$tb_content->fieldSet('image');
		$tb_content->fieldSet('description');
		$tb_content->whereSet('id', $noticeId);
		$content = $tb_content->find();
		if (!empty($content)) {
			$slideNoticeTitle = $content['title'];
			$slideNoticeImage = $content['image'];
			$slideNoticeDescription = $content['description'];
		}

		// Variable content
		$slideVariableTitle = '';
		$slideVariableImage = '';
		$slideVariableDescription = '';
		$tb_content = new Smart_select('dmg_content', 'dgm');
		$tb_content->fieldSet('id');
		$tb_content->fieldSet('title');
		$tb_content->fieldSet('image');
		$tb_content->fieldSet('description');
		$tb_content->fieldSet('comp_description');
		$tb_content->whereSet('id', $variableContentId);
		$content = $tb_content->find();
		if (!empty($content)) {
			$slideVariableTitle  = $content['title'];
			$slideVariableImage  = $content['image'];
			$slideVariableDescription  = $content['description'];
		}

		// Result content
		$slideResultTitle = '';
		$slideResultImage = '';
		$slideResultDescription = '';
		$tb_content = new Smart_select('dmg_content', 'dgm');
		$tb_content->fieldSet('id');
		$tb_content->fieldSet('title');
		$tb_content->fieldSet('image');
		$tb_content->fieldSet('description');
		$tb_content->fieldSet('comp_description');
		$tb_content->whereSet('id', $resultContentId);
		$content = $tb_content->find();
		if (!empty($content)) {
			$slideResultTitle  = $content['title'];
			$slideResultImage  = $content['image'];
			$slideResultDescription  = $content['description'];
		}

		// Process content
		$slideProcessTitle = '';
		$slideProcessDescription = '';
		$tbDiagram = new Smart_select('dmg_diagram', 'dgm');
		$tbDiagram->fieldSet('id');
		$tbDiagram->fieldSet('label');
		$tbDiagram->fieldSet('description');
		$tbDiagram->whereSet('id', $processId);
		$diagram = $tbDiagram->find();
		if (!empty($diagram)) {
			$slideProcessTitle  = $diagram['label'];
			$slideProcessDescription  = $diagram['description'];
		}

		// variable list
		$tbSlideVariable = new Smart_select('dmg_slide_variable', 'dgm');
		$tbSlideVariable->fieldSet('id');
		$tbSlideVariable->fieldSet('field_id');
		$tbField=$tbSlideVariable->joinSet('field_id', 'dmg_field', 'id');
		$tbField->fieldSet('name');
		$tbSlideVariable->whereSet('type', 0, 'and');
		$tbSlideVariable->whereSet('slide_id',$slideId, 'and');
		$itemListVariable = $tbSlideVariable->findAll();

		// result list
		$tbSlideResult = new Smart_select('dmg_slide_result', 'dgm');
		$tbSlideResult->fieldSet('id');
		$tbSlideResult->fieldSet('field_id');
		$tbField=$tbSlideResult->joinSet('field_id', 'dmg_field', 'id');
		$tbField->fieldSet('name');
		$tbSlideResult->whereSet('type', 0, 'and');
		$tbSlideResult->whereSet('slide_id',$slideId, 'and');
		$itemListResult = $tbSlideResult->findAll();

		// variable1 list
		$tbSlideVariable = new Smart_select('dmg_slide_variable', 'dgm');
		$tbSlideVariable->fieldSet('id');
		$tbSlideVariable->fieldSet('field_id');
		$tbField=$tbSlideVariable->joinSet('field_id', 'dmg_field', 'id');
		$tbField->fieldSet('name');
		$tbSlideVariable->whereSet('type', 1, 'and');
		$tbSlideVariable->whereSet('slide_id',$slideId, 'and');
		$itemListVariable1 = $tbSlideVariable->findAll();

		// result1 list
		$tbSlideResult = new Smart_select('dmg_slide_result', 'dgm');
		$tbSlideResult->fieldSet('id');
		$tbSlideResult->fieldSet('field_id');
		$tbField=$tbSlideResult->joinSet('field_id', 'dmg_field', 'id');
		$tbField->fieldSet('name');
		$tbSlideResult->whereSet('type', 1, 'and');
		$tbSlideResult->whereSet('slide_id',$slideId, 'and');
		$itemListResult1 = $tbSlideResult->findAll();

		// variable1 list
		$tbSlideLink = new Smart_select('dmg_slide_link', 'dgm');
		$tbSlideLink->fieldSet('id');
		$tbSlideLink->fieldSet('link_id');
		$tbSlideLink->whereSet('slide_id',$slideId, 'and');
		$itemListLink = $tbSlideLink->findAll();

		// Variables and Results flags
		$slideVariableFlag = false;
		if (count($itemListVariable) > 0) {
			$slideVariableFlag = true;
		}
		$slideVariable1Flag = false;
		if (count($itemListVariable1) > 0) {
			$slideVariable1Flag = true;
		}
		$slideResultFlag = false;
		if (count($itemListResult) > 0) {
			$slideResultFlag = true;
		}
		$slideResult1Flag = false;
		if (count($itemListResult1) > 0) {
			$slideResult1Flag = true;
		}
		$slideLinkFlag = false;
		if (count($itemListLink) > 0) {
			$slideLinkFlag = true;
		}

		// Slide image
		$atemp = explode(';',$slideImage);
		$slideImage = '';
		$slideImageAlt = '';
		$slideImageTitle = '';
		if (isset($atemp[0])) {
			$slideImage = $atemp[0];
		}
		if (isset($atemp[1])) {
			$slideImageAlt = $atemp[1];
		}
		if (isset($atemp[2])) {
			$slideImageTitle = $atemp[2];
		}
		if (!file_exists($slideImage)) {
			$slideImage = '';
		}

		// Notice image
		$atemp = explode(';',$slideNoticeImage);
		$slideNoticeImage = '';
		$slideNoticeImageAlt = '';
		$slideNoticeImageTitle = '';
		if (isset($atemp[0])) {
			$slideNoticeImage = $atemp[0];
		}
		if (isset($atemp[1])) {
			$slideNoticeImageAlt = $atemp[1];
		}
		if (isset($atemp[2])) {
			$slideNoticeImageTitle = $atemp[2];
		}
		if (!file_exists($slideNoticeImage)) {
			$slideNoticeImage = '';
		}
	
		// Variable image
		$atemp = explode(';',$slideVariableImage);
		$slideVariableImage = '';
		$slideVariableImageAlt = '';
		$slideVariableImageTitle = '';
		if (isset($atemp[0])) {
			$slideVariableImage = $atemp[0];
		}
		if (isset($atemp[1])) {
			$slideVariableImageAlt = $atemp[1];
		}
		if (isset($atemp[2])) {
			$slideVariableImageTitle = $atemp[2];
		}
		if (!file_exists($slideVariableImage)) {
			$slideVariableImage = '';
		}
	
		// Result image
		$atemp = explode(';',$slideResultImage);
		$slideResultImage = '';
		$slideResultImageAlt = '';
		$slideResultImageTitle = '';
		if (isset($atemp[0])) {
			$slideResultImage = $atemp[0];
		}
		if (isset($atemp[1])) {
			$slideResultImageAlt = $atemp[1];
		}
		if (isset($atemp[2])) {
			$slideResultImageTitle = $atemp[2];
		}
		if (!file_exists($slideResultImage)) {
			$slideResultImage = '';
		}
		
		// Node item
		$slideItem['code'] = $slideId;
		$slideItem['reference'] = $slideReference;
		$slideItem['title'] = $slideTitle;
		$slideItem['label'] = $slideLabel;
		$slideItem['image'] = $slideImage;
		$slideItem['image_display'] = $slideImageDisplay;
		$slideItem['description'] = $slideDescription;

		$slideItem['process'] = $processId;

		$slideItem['process_title'] = $slideProcessTitle;
		$slideItem['process_description'] = $slideProcessDescription;

		$slideItem['variable_title'] = $slideVariableTitle;
		$slideItem['variable_image'] = $slideVariableImage;
		$slideItem['variable_description'] = $slideVariableDescription;

		$slideItem['variable_list'] = $itemListVariable;
		$slideItem['variable1_list'] = $itemListVariable1;

		$slideItem['result_title'] = $slideResultTitle;
		$slideItem['result_image'] = $slideResultImage;
		$slideItem['result_description'] = $slideResultDescription;

		$slideItem['result_list'] = $itemListResult;
		$slideItem['result1_list'] = $itemListResult1;

		$slideItem['variable_flag'] = $slideVariableFlag;
		$slideItem['variable1_flag'] = $slideVariable1Flag;
		$slideItem['result_flag'] = $slideResultFlag;
		$slideItem['result1_flag'] = $slideResult1Flag;

		$slideList[] = $slideItem;
		
		return $slideItem;
	}
}

$slideList = array();
$tbSlide = new Smart_select('dmg_slide', 'dgm');
$tbSlide->fieldSet('id');
$tbSlide->fieldSet('reference');
$tbSlide->whereSet('domain_id',$domainId, 'and');
$tbSlide->whereSet('type_id', 1, 'and');
$tbSlide->orderSet('sequence');
$list = $tbSlide->findAll();
for ($i=0; $i < count($list); $i++) {
	$slideItem = addSlide($list[$i]['id']);
	$slideItem['level'] = $i + 1;
	$slideItem['nb_slide'] = count($list);
	$slideList[] = $slideItem;
}
echo json_encode($slideList);

?>
