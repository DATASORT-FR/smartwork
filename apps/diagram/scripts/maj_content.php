<?php
/**
* This file contains App processing.
*
* Variables declaration 
*      $ws object workspace 
*
* @package    global
* @subpackage controller
* @version   1.0
* @date      20 May 2022
* @author    Alain VANDEPUTTE
* @copyright datasort.fr
*/

$ws = Workspace::ws_open();

if (!$ws->script()) {
	die();	
}

// Main
displayMsg('Update Content', '', 1);
displayMsg('Begin process', '', 1);

$tbDomain = new Smart_select('dmg_domain', 'dgm');
$tbDomain->fieldAll();
$tbDomain->orderSet('id');
$domains = $tbDomain->findAll();
foreach($domains as $key=>$domain) {
	$domainId = $domain['id'];
	displayMsg('Traitement domaine  ' . $domainId, '', 1);

	$slideReference = 0;
	$tbDiagram = new Smart_select('dmg_diagram', 'dgm');
	$tbDiagram->fieldAll();
	$tbDiagram->whereSet('domain_id', $domainId);
	$tbDiagram->orderSet('id');
	$diagrams = $tbDiagram->findAll();
	foreach($diagrams as $key=>$diagram) {
		$traitFlag = true;

		$diagamId = $diagram['id'];
		$typeId = $diagram['type_id'];
		displayMsg('Traitement diagram  ' . $diagamId, '', 2);
	
		$tbNode = new Smart_select('dmg_node', 'dgm');
		$tbNode->fieldAll();
		$tbNode->whereSet('diagram_id', $diagamId);
		$tbNode->orderSet('id');
		$nodes = $tbNode->findAll();
		foreach($nodes as $key=>$node) {
			$nodeId = $node['id'];
			$nodeTitle = $node['title'];
			$nodeReference = $node['reference'];
			$nodeImage = $node['image'];
			$nodeImageDisplay = $node['image_display'];
			$nodeDescription = $node['description'];
			$nodeProcessText = $node['process_text'];
			$nodeProcessText2 = $node['process_text2'];
			$nodeImageNotice = $node['image_notice'];
			$nodeDescriptionNotice = $node['description_notice'];
			$nodeQuestion = $node['question'];
			$nodeQuestionDescription = $node['question_description'];
			$nodeVariableImage = $node['variable_image'];
			$nodeVariableDescription = $node['variable_description'];
			$nodeVariableItems = $node['variable_items'];
			$nodeVariableItemsImage = $node['variable_items_image'];
			$nodeVariableItemsDescription = $node['variable_items_description'];
			$nodeResultImage = $node['result_image'];
			$nodeResultDescription = $node['result_description'];
			$nodeResultItems = $node['result_items'];
			$nodeResultItemsImage = $node['result_items_image'];
			$nodeResultItemsDescription = $node['result_items_description'];
		
			$tbLink = new Smart_select('dmg_link', 'dgm');
			$tbLink->fieldSet('id');
			$tbLink->fieldSet('diagram_id');
			$tbLink->fieldSet('nodeFrom_id');
			$tbLink->fieldSet('nodeTo_id');
			$tbLink->fieldSet('sequence');
			$tbLink->fieldSet('description');
			$tbLink->whereSet('diagram_id',$diagamId);
			$tbLink->whereSet('nodeFrom_id',$nodeId, 'and');
			$items = $tbLink->findAll();
			$flagNodeEnd = false;
			if ((empty($items)) and ($diagamId == 1)) {
				$flagNodeEnd = true;
			}
			if ($flagNodeEnd) {
				displayMsg('Traitement noeud final ' . $nodeId, '', 3);
			}
			else {
				displayMsg('Traitement noeud intermédiaire ' . $nodeId, '', 3);
			}
			if (strlen($nodeTitle) > 2) {

				$nodeLabel = $nodeTitle;
				$nodeQuestionLabel = $nodeQuestion;
				if ($flagNodeEnd) {
					$nodeLabel = $nodeTitle . '-' . $nodeReference;
					$nodeQuestionLabel = $nodeQuestion . '-' . $nodeReference;
					if (!empty($nodeProcessText)) {
						if (!empty($nodeDescription)) {
							$nodeDescription .= "\r\n";
						}
						$nodeDescription .= $nodeProcessText;
					}
				}

				// Notice image
				$atemp = explode(';',$nodeImageNotice);
				$image = '';
				if (isset($atemp[0])) {
					$image = $atemp[0];
				}
				if (!file_exists($image)) {
					$image = '';
				}
				$noticeId = 0;
				if (!empty($nodeDescriptionNotice)) {
					$tbContent = new Smart_select('dmg_content', 'dgm');
					$tbContent->fieldSet('id');
					$tbContent->fieldSet('label');
					$tbContent->fieldSet('title');
					$tbContent->fieldSet('image');
					$tbContent->fieldSet('description');
					$tbContent->whereSet('domain_id', $domainId);
					$tbContent->whereSet('type_id', 1, 'and');
					$tbContent->whereSet('label', $nodeLabel, 'and');
					$content = $tbContent->find();
					if (!empty($content)) {
						$noticeId = $content['id'];
						if (strlen($nodeDescriptionNotice) > strlen($content['description'])) {
							$tbContent = new Smart_record('dmg_content', 'dgm');
							$tbContent->idSet($noticeId);
							$tbContent->fieldSet('description', $nodeDescriptionNotice);
							$tbContent->update();
						}
					}
					else {
						$tbContent = new Smart_record('dmg_content', 'dgm');
						$tbContent->fieldSet('domain_id', $domainId);
						$tbContent->fieldSet('type_id', 1);
						$tbContent->fieldSet('label', $nodeLabel);
						$tbContent->fieldSet('title', $nodeTitle);
						$tbContent->fieldSet('image', $nodeImageNotice);
						$tbContent->fieldSet('description', $nodeDescriptionNotice);
						$noticeId = $tbContent->insert();
					}
				}

				// Variable Content
				$atemp = explode(';',$nodeVariableImage);
				$image = '';
				if (isset($atemp[0])) {
					$image = $atemp[0];
				}
				if (!file_exists($image)) {
					$image = '';
				}
				$variableContentId = 0;
				if ((!empty($image)) or (!empty($nodeVariableDescription))) {
					$tbContent = new Smart_select('dmg_content', 'dgm');
					$tbContent->fieldSet('id');
					$tbContent->fieldSet('label');
					$tbContent->fieldSet('title');
					$tbContent->fieldSet('image');
					$tbContent->fieldSet('description');
					$tbContent->whereSet('domain_id', $domainId);
					$tbContent->whereSet('type_id', 3, 'and');
					$tbContent->whereSet('image', $nodeVariableImage, 'and');
					$tbContent->whereSet('description', $nodeVariableDescription, 'and');
					$content = $tbContent->find();
					if (!empty($content)) {
						$variableContentId = $content['id'];
					}
					else {
						$tbContent = new Smart_record('dmg_content', 'dgm');
						$tbContent->fieldSet('domain_id', $domainId);
						$tbContent->fieldSet('type_id', 3);
						$tbContent->fieldSet('label', $nodeLabel);
						$tbContent->fieldSet('title', $nodeTitle);
						$tbContent->fieldSet('image', $nodeVariableImage);
						$tbContent->fieldSet('description', $nodeVariableDescription);
						$variableContentId = $tbContent->insert();
					}
				}

				// Result Content
				$atemp = explode(';',$nodeResultImage);
				$image = '';
				if (isset($atemp[0])) {
					$image = $atemp[0];
				}
				if (!file_exists($image)) {
					$image = '';
				}
				$resultContentId = 0;
				if ((!empty($image)) or (!empty($nodeResultDescription))) {
					$tbContent = new Smart_select('dmg_content', 'dgm');
					$tbContent->fieldSet('id');
					$tbContent->fieldSet('label');
					$tbContent->fieldSet('title');
					$tbContent->fieldSet('image');
					$tbContent->fieldSet('description');
					$tbContent->whereSet('domain_id', $domainId);
					$tbContent->whereSet('type_id', 3, 'and');
					$tbContent->whereSet('image', $nodeResultImage, 'and');
					$tbContent->whereSet('description', $nodeResultDescription, 'and');
					$content = $tbContent->find();
					if (!empty($content)) {
						$resultContentId = $content['id'];
					}
					else {
						$tbContent = new Smart_record('dmg_content', 'dgm');
						$tbContent->fieldSet('domain_id', $domainId);
						$tbContent->fieldSet('type_id', 3);
						$tbContent->fieldSet('label', $nodeLabel);
						$tbContent->fieldSet('title', $nodeTitle);
						$tbContent->fieldSet('image', $nodeResultImage);
						$tbContent->fieldSet('description', $nodeResultDescription);
						$resultContentId = $tbContent->insert();
					}
				}

				// Question
				$questionId = 0;
				if (!empty($nodeQuestion)) {
					$tbContent = new Smart_select('dmg_content', 'dgm');
					$tbContent->fieldSet('id');
					$tbContent->fieldSet('label');
					$tbContent->fieldSet('title');
					$tbContent->fieldSet('image');
					$tbContent->fieldSet('description');
					$tbContent->whereSet('domain_id', $domainId);
					$tbContent->whereSet('type_id', 2, 'and');
					$tbContent->whereSet('label', $nodeQuestionLabel, 'and');
					$content = $tbContent->find();
					if (!empty($content)) {
						$questionId = $content['id'];
						if (strlen($nodeQuestionDescription) > strlen($content['description'])) {
							$tbContent = new Smart_record('dmg_content', 'dgm');
							$tbContent->idSet($questionId);
							$tbContent->fieldSet('description', $nodeQuestionDescription);
							$tbContent->update();
						}
					}
					else {
						$tbContent = new Smart_record('dmg_content', 'dgm');
						$tbContent->fieldSet('domain_id', $domainId);
						$tbContent->fieldSet('type_id', 2);
						$tbContent->fieldSet('label', $nodeQuestionLabel);
						$tbContent->fieldSet('title', $nodeQuestion);
						$tbContent->fieldSet('description', $nodeQuestionDescription);
						$questionId = $tbContent->insert();
					}
				}
				
				// Slide analyse
				$tbSlide = new Smart_select('dmg_slide', 'dgm');
				$tbSlide->fieldSet('id');
				$tbSlide->fieldSet('label');
				$tbSlide->fieldSet('title');
				$tbSlide->fieldSet('image');
				$tbSlide->fieldSet('description');
				$tbSlide->fieldSet('notice_id');
				$tbSlide->fieldSet('variable_contentid');
				$tbSlide->fieldSet('result_contentid');
				$tbSlide->whereSet('domain_id', $domainId, 'and');
				$tbSlide->whereSet('type_id', $typeId, 'and');
				$tbSlide->whereSet('label', $nodeLabel, 'and');
				$slide = $tbSlide->find();
				if (!empty($slide)) {
					$slideId = $slide['id'];
					if ((strlen($nodeDescription) > strlen($slide['description'])) or ($slide['notice_id'] != $noticeId) or ($slide['variable_contentid'] != $variableContentId) or ($slide['result_contentid'] != $resultContentId)) {
						$tbSlide = new Smart_record('dmg_slide', 'dgm');
						$tbSlide->idSet($slideId);
						$tbSlide->fieldSet('description', $nodeDescription);
						$tbSlide->fieldSet('notice_id', $noticeId);
						$tbSlide->fieldSet('variable_contentid', $variableContentId);
						$tbSlide->fieldSet('result_contentid', $resultContentId);
						$tbSlide->update();
					}
				}
				else {
					$slideReference++;
					$slideSequence = object_slide::_maxSequence($domainId, $typeId);
					$tbSlide = new Smart_record('dmg_slide', 'dgm');
					$tbSlide->fieldSet('domain_id', $domainId);
					$tbSlide->fieldSet('type_id', $typeId);
					$tbSlide->fieldSet('sequence', $slideSequence);
					$tbSlide->fieldSet('reference', $slideReference);
					$tbSlide->fieldSet('label', $nodeLabel);
					$tbSlide->fieldSet('title', $nodeTitle);
					$tbSlide->fieldSet('image', $nodeImage);
					$tbSlide->fieldSet('image_display', $nodeImageDisplay);
					$tbSlide->fieldSet('description', $nodeDescription);
					$tbSlide->fieldSet('notice_id', $noticeId);
					$tbSlide->fieldSet('variable_contentid', $variableContentId);
					$tbSlide->fieldSet('result_contentid', $resultContentId);
					$slideId = $tbSlide->insert();
				}

				// node variables
				$tbNodeVariable = new Smart_select('dmg_node_variable', 'dgm');
				$tbNodeVariable->fieldSet('id');
				$tbNodeVariable->fieldSet('node_id');
				$tbNodeVariable->fieldSet('field_id');
				$tbNodeVariable->whereSet('node_id',$nodeId);
				$listNodeVariable = $tbNodeVariable->findAll();

				$tbSlideVariable = new Smart_select('dmg_slide_variable', 'dgm');
				$tbSlideVariable->fieldSet('id');
				$tbSlideVariable->fieldSet('type_id');
				$tbSlideVariable->fieldSet('slide_id');
				$tbSlideVariable->fieldSet('field_id');
				$tbSlideVariable->whereSet('type_id', 0, 'and');
				$tbSlideVariable->whereSet('slide_id', $slideId, 'and');
				$listSlideVariable = $tbSlideVariable->findAll();

				if ((count($listNodeVariable) > 0) and (count($listNodeVariable) > count($listSlideVariable))) {
					for ($i = 0; $i < count($listSlideVariable); $i++) {
						$item = $listSlideVariable[$i];
						$tbSlideVariable = new Smart_record('dmg_slide_variable', 'dgm');
						$tbSlideVariable->idSet($item['id']);
						$tbSlideVariable->delete();
					}
	
					foreach($listNodeVariable as $key=>$item) {
						$fieldId = $item['field_id'];
						$tbSlideVariable = new Smart_record('dmg_slide_variable', 'dgm');
						$tbSlideVariable->fieldSet('type_id', 0);
						$tbSlideVariable->fieldSet('slide_id', $slideId);
						$tbSlideVariable->fieldSet('field_id', $fieldId);
						$tbSlideVariable->insert();
					}
				}

				// node variable items
				$listNodeVariable = explode(';', $nodeVariableItems);

				$tbSlideVariable = new Smart_select('dmg_slide_variable', 'dgm');
				$tbSlideVariable->fieldSet('id');
				$tbSlideVariable->fieldSet('type_id');
				$tbSlideVariable->fieldSet('slide_id');
				$tbSlideVariable->fieldSet('field_id');
				$tbSlideVariable->whereSet('type_id', 1, 'and');
				$tbSlideVariable->whereSet('slide_id', $slideId, 'and');
				$listSlideVariable = $tbSlideVariable->findAll();

				if ((count($listNodeVariable) > 0) and (count($listNodeVariable) > count($listSlideVariable))) {
					for ($i = 0; $i < count($listSlideVariable); $i++) {
						$item = $listSlideVariable[$i];
						$tbSlideVariable = new Smart_record('dmg_slide_variable', 'dgm');
						$tbSlideVariable->idSet($item['id']);
						$tbSlideVariable->delete();
					}

					foreach($listNodeVariable as $fieldId) {
						if (!empty($fieldId)) {
							$tbSlideVariable = new Smart_record('dmg_slide_variable', 'dgm');
							$tbSlideVariable->fieldSet('type_id', 1);
							$tbSlideVariable->fieldSet('slide_id', $slideId);
							$tbSlideVariable->fieldSet('field_id', $fieldId);
							$tbSlideVariable->insert();
						}
					}
				}

				// node results
				$tbNodeResult = new Smart_select('dmg_node_result', 'dgm');
				$tbNodeResult->fieldSet('id');
				$tbNodeResult->fieldSet('node_id');
				$tbNodeResult->fieldSet('field_id');
				$tbNodeResult->whereSet('node_id',$nodeId);
				$listNodeResult = $tbNodeResult->findAll();

				$tbSlideResult = new Smart_select('dmg_slide_result', 'dgm');
				$tbSlideResult->fieldSet('id');
				$tbSlideResult->fieldSet('type_id');
				$tbSlideResult->fieldSet('slide_id');
				$tbSlideResult->fieldSet('field_id');
				$tbSlideResult->whereSet('type_id', 0, 'and');
				$tbSlideResult->whereSet('slide_id', $slideId, 'and');
				$listSlideResult = $tbSlideResult->findAll();

				if ((count($listNodeResult) > 0) and (count($listNodeResult) > count($listSlideResult))) {
					for ($i=0; $i < count($listSlideResult); $i++) {
						$item = $listSlideResult[$i];

						$tbSlideVariable = new Smart_record('dmg_slide_result', 'dgm');
						$tbSlideVariable->idSet($item['id']);
						$tbSlideVariable->delete();
					}

					foreach($listNodeResult as $key=>$item) {
						$fieldId = $item['field_id'];
						$tbSlideVariable = new Smart_record('dmg_slide_result', 'dgm');
						$tbSlideVariable->fieldSet('type_id', 0);
						$tbSlideVariable->fieldSet('slide_id', $slideId);
						$tbSlideVariable->fieldSet('field_id', $fieldId);
						$tbSlideVariable->insert();
					}
				}

				// node result items
				$listNodeResult = explode(';', $nodeResultItems);

				$tbSlideResult = new Smart_select('dmg_slide_result', 'dgm');
				$tbSlideResult->fieldSet('id');
				$tbSlideResult->fieldSet('type_id');
				$tbSlideResult->fieldSet('slide_id');
				$tbSlideResult->fieldSet('field_id');
				$tbSlideResult->whereSet('type_id', 1, 'and');
				$tbSlideResult->whereSet('slide_id', $slideId, 'and');
				$listSlideResult = $tbSlideResult->findAll();

				if ((count($listNodeResult) > 0) and (count($listNodeResult) > count($listSlideResult))) {
					for ($i=0; $i < count($listSlideResult); $i++) {
						$item = $listSlideResult[$i];
						$tbSlideVariable = new Smart_record('dmg_slide_result', 'dgm');
						$tbSlideVariable->idSet($item['id']);
						$tbSlideVariable->delete();
					}

					foreach($listNodeResult as $fieldId) {
						if (!empty($fieldId)) {
							$tbSlideVariable = new Smart_record('dmg_slide_result', 'dgm');
							$tbSlideVariable->fieldSet('type_id', 1);
							$tbSlideVariable->fieldSet('slide_id', $slideId);
							$tbSlideVariable->fieldSet('field_id', $fieldId);
							$tbSlideVariable->insert();
						}
					}
				}

				// Update node
				$tbNode = new Smart_record('dmg_node', 'dgm');
				$tbNode->fieldSet('slide_id', $slideId);
				$tbNode->fieldSet('question_id', $questionId);
				$tbNode->idSet($nodeId);
				$tbNode->update();
			}
		}
	}
}

?>