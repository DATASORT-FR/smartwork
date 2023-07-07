<?php
/**
* This file contains initialization code
*
* @package    test
* @subpackage initialization
* @version    1.2
* @date       13 December 2013
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
defined('_WSEXEC') or die();

$ws = workspace::ws_open();

function initTrace($domainId, $reference = '') {
	$ws = workspace::ws_open();
	$traceItem = array();
	
	$trace = new object_trace();
	$traceItem = $trace->init($domainId, $reference, session_id(), $ws->connected_id())->returnGet();
	$id = $traceItem['id'];
	$diagramId = $traceItem['situation_id'];

	$traceDiagram = new object_trace_diagram();
	$traceDiagramItem = $traceDiagram->init($diagramId, $reference, session_id(), $ws->connected_id())->returnGet();

	$argArray = array(
		'id' => $id
	);
	$traceItem = $trace->update($argArray);
	return $id;
}

function analyseVariable($id, $nodeId = '', $step = 0) {
	$ws = workspace::ws_open();
	$traceItem = array();
	
	$trace = new object_trace();
	$traceItem = $trace->display($id)->returnGet();
	$displayVariable = $traceItem['display_value'];
	$domainId = $traceItem['domain_id'];

	$variable = array();
	$variableDisplayList = array();
	$variableList = array();
	$variableAllList = array();
	if (empty($nodeId)) {
		$objectVariable = new object_field_variable();
		$objectVariable->filterSet('domain_id',$domainId);
		$variableList = $objectVariable->displayList(0)->returnGet();
	}
	else {
		$objectNode = new object_node();
		$node = $objectNode->display($nodeId)->returnGet();
		if ($step == 0) {
			$variableList = $node['variable_list'];

		}
		else {
			$variableList = $node['variable_1_list'];
		}
	}
	for($i=0; $i < count($variableList); $i++) {
		$variable = $variableList[$i];
		$variable['display'] = 1;
		$field = $variable['name'];
		$display = 1;
		if ($variable['nodisplay'] == 1) {
			$display = 0;
		}
		if (($display == 1) and (isset($displayVariable[$field]))) {
			$variable['display'] = $displayVariable[$field];
		}
		if ($display == 1) {
			if ($variable['type_id'] == 9) {
				if(empty($variableAllList)){
					if (empty($nodeId)) {
						$variableAllList = $variableList;
					}
					else {
						$objectVariable = new object_field_variable();
						$objectVariable->filterSet('domain_id',$domainId);
						$variableAllList = $objectVariable->displayList(0)->returnGet();
					}
				}
				$aTemp = explode(';', $variable['variable_object_items']);
				for($j=0; $j < count($aTemp); $j++) {
					for($k=0; $k < count($variableAllList); $k++) {
						$variableObject = $variableAllList[$k];
						if ($variableObject['id'] == $aTemp[$j]) {
							$variableObject['name'] = $variable['name'] . '_' . $variableObject['name'];
							if ($variable['variable_nolabel'] != 1) {
								$variableObject['collabel'] = $variableObject['label'];
							}
							else {
								$variableObject['collabel'] = '';
							}
							if ($j != 0) {
								$variableObject['append'] = 1;
							}
							else {
								$variableObject['label'] = $variable['label'];
								$variableObject['append'] = 0;
							}
							$variableObject['category_id'] = $variable['category_id'];
							$variableObject['category_name'] = $variable['category_name'];
							$variableObject['category_label'] = $variable['category_label'];
							$variableObject['variable_mandatory'] = $variable['variable_mandatory'];
							if ($j == 0) {
								$variableObject['description'] = $variable['description'];
							}
							else {
								$variableObject['description'] = '';
							}
							if (isset($displayVariable[$variableObject['name']])) {
								$variableObject['display'] = $displayVariable[$variableObject['name']];
							}
							else {
								$variableObject['display'] = $variable['display'];
							}
							$variableDisplayList[] = $variableObject;
						}
					}
				}
			}
			else {
				$variable['collabel'] = '';
				$variable['append'] = 0;
				$variableDisplayList[] = $variable;
			}
		}
	}
	return $variableDisplayList;
}

function showVariable($id, $variableDisplayList, $categoryFlag=true) {
	$ws = workspace::ws_open();
	$ws->paramSet('RIGHT_UPDATE', true);
	$return = '';

	$categoryId = 0;
	$categoryName = '';
	$wcrud = new wcrud('object_trace', 'outil');
	$wcrud->titleSet(false);
	$wcrud->pageSet(false);
	$wcrud->btreturnSet(false);
	$wcrud->btokSet(false);
	$wcrud->btresetSet(false);
	$wcrud->saveAutoSet(false);
	$connect = new object_connect();
	$pageSave = $connect->constructHref($ws->paramGet('APP_CODE'), 'outil_variable_update');
	$wcrud->saveAutoRefSet($pageSave);
	if ($categoryFlag) {
		if (count($variableDisplayList) > 0) {
			$wcrud->fieldSet('maintab', 'page');
		}
	}
	for($i=0; $i < count($variableDisplayList); $i++) {
		$variable = $variableDisplayList[$i];
		if ($categoryFlag) {
			$new_categoryId = $variable['category_id'];
			$new_categoryName = $variable['category_name'];
			if ($new_categoryId != $categoryId) {
				if ($categoryId != 0) {
					$wcrud->fieldSet($categoryName . '_end', 'pagecontentend');
				}
				$categoryId = $new_categoryId;
				$categoryName = $new_categoryName;
				$wcrud->fieldSet($categoryName, 'pagecontent','maintab');
				$wcrud->labelSet($categoryName, $variable['category_label']);
				if (!empty($variable['category_description'])) {
					$wcrud->fieldSet($categoryName . '_paraph', 'paraph',$variable['category_description']);
				}
			}
		}
		$field = $variable['name'];
		$label = $variable['label'];
		$type = $variable['type_id'];
		$collabel = $variable['collabel'];
		$required = $variable['variable_mandatory'];
		$size = intval($variable['variable_size']);
		$format = $variable['variable_format'];
		$listValue = $variable['variable_value'];

		if ($variable['line'] == 0) {
			if (!empty($variable['description'])) {
				$wcrud->fieldSet($field . '_paraph', 'paraph',$variable['description']);
				if ($variable['display'] == 0) {
					$wcrud->classSet($field . '_paraph', 'display-none');
				}
			}
		}
		switch ($type) {
			case 0 :
				if ($variable['append'] == 0) {
					if ($variable['line'] == 0) {
						$wcrud->fieldSet($field, 'display', $variable['label']);
					}
					else {
						$wcrud->fieldSet($field, 'display', $variable['label']);
					}
				}
				else {
					$wcrud->fieldAppendSet($field, 'display', $variable['label']);
				}
				break;
			case 2 :
				if ($variable['append'] == 0) {
					if ($variable['line'] == 0) {
						$wcrud->fieldSet($field, 'integer');
					}
					else {
						$wcrud->fieldSet($field, 'integer');
					}
				}
				else {
					$wcrud->fieldAppendSet($field, 'integer');
				}
				break;
			case 3 :
				if ($variable['append'] == 0) {
					if ($variable['line'] == 0) {
						$wcrud->fieldSet($field, 'number');
					}
					else {
						$wcrud->fieldSet($field, 'number');
					}
				}
				else {
					$wcrud->fieldAppendSet($field, 'number');
				}
				break;
			case 4 :
				$aTemp = explode(';', $listValue);
				$list = array();
				if (!$required) {
					$listItem = array();
					$listItem['id'] = '0';
					$listItem['description'] = '';
					$list[] = $listItem;
				}
				for($j=0; $j < count($aTemp); $j++) {
					$value = intval($aTemp[$j]);
					$listItem = array();
					$aTemp1 = explode(':', $aTemp[$j]);
					$listItem['id'] = $aTemp1[0];
					if (isset($aTemp1[1])) {
						$listItem['description'] = $aTemp1[1];
					}
					else {
						$listItem['description'] = $aTemp1[0];
					}
					$list[] = $listItem;
				}
				if ($variable['append'] == 0) {
					if ($variable['line'] == 0) {
						$wcrud->fieldSet($field, 'list', $list);
					}
					else {
						$wcrud->fieldSet($field, 'list', $list);
					}
				}
				else {
					$wcrud->fieldAppendSet($field, 'list', $list);
				}
				break;
			case 5 :
				$aTemp = explode(';', $listValue);
				$list = array();
				if (!$required) {
					$listItem = array();
					$listItem['id'] = ' ';
					$listItem['description'] = '';
					$list[] = $listItem;
				}
				for($j=0; $j < count($aTemp); $j++) {
					$listItem = array();
					$aTemp1 = explode(':', $aTemp[$j]);
					$listItem['id'] = $aTemp1[0];
					if (isset($aTemp1[1])) {
						$listItem['description'] = $aTemp1[1];
					}
					else {
						$listItem['description'] = $aTemp1[0];
					}
					$list[] = $listItem;
				}
				if ($variable['append'] == 0) {
					if ($variable['line'] == 0) {
						$wcrud->fieldSet($field, 'list', $list);
					}
					else {
						$wcrud->fieldSet($field, 'list', $list);
					}
				}
				else {
					$wcrud->fieldAppendSet($field, 'list', $list);
				}
				break;
			case 6 :
				if ($variable['append'] == 0) {
					if ($variable['line'] == 0) {
						$wcrud->fieldSet($field, 'currency');
					}
					else {
						$wcrud->fieldSet($field, 'currency');
					}
				}
				else {
					$wcrud->fieldAppendSet($field, 'currency');
				}
				$wcrud->formatSet($field, 'euro');
				break;
			case 7 :
				if ($variable['append'] == 0) {
					if ($variable['line'] == 0) {
						$wcrud->fieldSet($field, 'email');
					}
					else {
						$wcrud->fieldSet($field, 'email');
					}
				}
				else {
					$wcrud->fieldAppendSet($field, 'email');
				}
				break;
			case 8 :
				if ($variable['append'] == 0) {
					if ($variable['line'] == 0) {
						$wcrud->fieldSet($field, 'date');
					}
					else {
						$wcrud->fieldSet($field, 'date');
					}
				}
				else {
					$wcrud->fieldAppendSet($field, 'date');
				}
				$wcrud->defaultValueSet($field, ' ');
				$wcrud->formatSet($field, 'd/m/Y');
				break;
			case 10 :
				if ($variable['append'] == 0) {
					if ($variable['line'] == 0) {
						$wcrud->fieldSet($field, 'display', $variable['description']);
					}
					else {
						$wcrud->fieldSet($field, 'display', $variable['description']);
					}
				}
				else {
					$wcrud->fieldAppendSet($field, 'display', $variable['description']);
				}
				break;
			default :
				if ($variable['append'] == 0) {
					if ($variable['line'] == 0) {
						$wcrud->fieldSet($field, 'text');
					}
					else {
						$wcrud->fieldSet($field, 'text');
					}
				}
				else {
					$wcrud->fieldAppendSet($field, 'text');
				}
				if ($size > 0) {
					$wcrud->sizeSet($field, $size);
				}
				if (!empty($format)) {
					$wcrud->formatSet($field, $format);
				}
		}
		if ($variable['no_label'] == 0) {
			if ($variable['type_id'] != 0) {
				if (!empty($label)) {
					$wcrud->labelSet($field, $label . ' :');
				}
				if (!empty($collabel)) {
					$wcrud->collabelSet($field, $collabel);
				}
			}
			$wcrud->fieldLabelSizeSet($field, 5);
		}
		else {
			$wcrud->fieldLabelSet($field, false);
		}
		if ($required) {
			$wcrud->requiredSet($field);
		}
		if ($variable['display'] == 0) {
			$wcrud->classSet($field, 'display-none');
		}
	}
	if ($categoryFlag) {
		if ($categoryId != 0) {
			$wcrud->fieldSet($categoryName . '_end', 'pagecontentend');
		}
		if (count($variableDisplayList) > 0) {
			$wcrud->fieldSet('maintab_end', 'pageend','maintab');
		}
	}

	$return = $wcrud->fetchCrudEdit($id);
	return $return;
}

function displayVariable() {
	$ws = workspace::ws_open();
	$ws->paramSet('RIGHT_UPDATE', True);
	$return = '';
	$domainId = $ws->paramGet('APP_PARAM_DOMAIN', SEPARATION_DOMAIN_ID);
	$userId = 0;
	$flagConnect = false;

	if ($ws->sessionGet('connect_id') <> $ws->paramGet('USER_GUEST')) {
		$flagConnect = $ws->connected();
	}
	if ($flagConnect) {
		$userId = $ws->connected_id();
	}
	if ($userId == 0) {
		$reference = '';
	}
	else {
		$reference = strval($userId);
	}
	$traceItem = array();
	$trace = new object_trace();
	$traceItem = $trace->init($domainId, $reference, session_id(), $ws->connected_id())->returnGet();
	$id = $traceItem['id'];
	$diagramId = $traceItem['situation_id'];

	$traceDiagram = new object_trace_diagram();
	$traceDiagramItem = $traceDiagram->init($diagramId, $reference, session_id(), $ws->connected_id())->returnGet();

	$argArray = array(
		'id' => $id
	);
	$traceItem = $trace->update($argArray);
	$traceItem = $trace->display($id)->returnGet();
	$displayVariable = $traceItem['display_value'];

	$empty = true;
	$wcrud = new wcrud('object_trace', 'outil');
	$wcrud->titleSet(false);
	$wcrud->pageSet(false);
	$wcrud->btreturnSet(false);
	$wcrud->btokSet(false);
	$wcrud->btresetSet(false);
	$wcrud->saveAutoSet(false);
	$connect = new object_connect();
	$pageSave = $connect->constructHref($ws->paramGet('APP_CODE'), 'outil_variable_update');
	$wcrud->saveAutoRefSet($pageSave);

	$categoryId = 0;
	$categoryName = '';
	$variable = array();
	$variableDisplayList = array();
	
	$variableObject = new object_field_variable();
	$variableObject->filterSet('domain_id',$domainId);
	$variableObject->filterSet('nature', 1);
	$variableList = $variableObject->displayList(0)->returnGet();
	for($i=0; $i < count($variableList); $i++) {
		$variable = $variableList[$i];
		$variable['display'] = 1;
		$field = $variable['name'];
		$display = 1;
		if ($variable['nodisplay'] == 1) {
			$display = 0;
		}
		if (($display == 1) and (isset($displayVariable[$field]))) {
			$variable['display'] = $displayVariable[$field];
		}
		if ($display == 1) {
			$empty = false;
			if ($variable['type_id'] == 9) {
				$aTemp = explode(';', $variable['variable_object_items']);
				for($j=0; $j < count($aTemp); $j++) {
					for($k=0; $k < count($variableList); $k++) {
						$variableObject = $variableList[$k];
						if ($variableObject['id'] == $aTemp[$j]) {
							$variableObject['name'] = $variable['name'] . '_' . $variableObject['name'];
							if ($variable['variable_nolabel'] != 1) {
								$variableObject['collabel'] = $variableObject['label'];
							}
							else {
								$variableObject['collabel'] = '';
							}
							if ($j != 0) {
								$variableObject['append'] = 1;
							}
							else {
								$variableObject['label'] = $variable['label'];
								$variableObject['append'] = 0;
							}
							$variableObject['category_id'] = $variable['category_id'];
							$variableObject['category_name'] = $variable['category_name'];
							$variableObject['category_label'] = $variable['category_label'];
							$variableObject['variable_mandatory'] = $variable['variable_mandatory'];
							if ($j == 0) {
								$variableObject['description'] = $variable['description'];
							}
							else {
								$variableObject['description'] = '';
							}
							if (isset($displayVariable[$variableObject['name']])) {
								$variableObject['display'] = $displayVariable[$variableObject['name']];
							}
							else {
								$variableObject['display'] = $variable['display'];
							}
							$variableDisplayList[] = $variableObject;
						}
					}
				}
			}
			else {
				$variable['collabel'] = '';
				$variable['append'] = 0;
				$variableDisplayList[] = $variable;
			}
		}
	}
	if (count($variableDisplayList) > 0) {
		$wcrud->fieldSet('maintab', 'page');
	}
	
	for($i=0; $i < count($variableDisplayList); $i++) {
		$variable = $variableDisplayList[$i];
		$new_categoryId = $variable['category_id'];
		$new_categoryName = $variable['category_name'];
		if ($new_categoryId != $categoryId) {
			if ($categoryId != 0) {
				$wcrud->fieldSet($categoryName . '_end', 'pagecontentend');
			}
			$categoryId = $new_categoryId;
			$categoryName = $new_categoryName;
			$wcrud->fieldSet($categoryName, 'pagecontent','maintab');
			$wcrud->labelSet($categoryName, $variable['category_label']);
			if (!empty($variable['category_description'])) {
				$wcrud->fieldSet($categoryName . '_paraph', 'paraph',$variable['category_description']);
			}
		}
		$field = $variable['name'];
		$label = $variable['label'];
		$type = $variable['type_id'];
		$collabel = $variable['collabel'];
		$required = $variable['variable_mandatory'];
		$size = intval($variable['variable_size']);
		$format = $variable['variable_format'];
		$listValue = $variable['variable_value'];

		if ($variable['line'] == 0) {
			if (!empty($variable['description'])) {
				$wcrud->fieldSet($field . '_paraph', 'paraph',$variable['description']);
				if ($variable['display'] == 0) {
					$wcrud->classSet($field . '_paraph', 'display-none');
				}
			}
		}
		switch ($type) {
			case 0 :
				if ($variable['append'] == 0) {
					if ($variable['line'] == 0) {
						$wcrud->fieldSet($field, 'display', $variable['label']);
					}
					else {
						$wcrud->fieldLineSet($field, 'display', $variable['label']);
					}
				}
				else {
					$wcrud->fieldAppendSet($field, 'display', $variable['label']);
				}
				break;
			case 2 :
				if ($variable['append'] == 0) {
					if ($variable['line'] == 0) {
						$wcrud->fieldSet($field, 'integer');
					}
					else {
						$wcrud->fieldLineSet($field, 'integer');
					}
				}
				else {
					$wcrud->fieldAppendSet($field, 'integer');
				}
				break;
			case 3 :
				if ($variable['append'] == 0) {
					if ($variable['line'] == 0) {
						$wcrud->fieldSet($field, 'number');
					}
					else {
						$wcrud->fieldLineSet($field, 'number');
					}
				}
				else {
					$wcrud->fieldAppendSet($field, 'number');
				}
				break;
			case 4 :
				$aTemp = explode(';', $listValue);
				$list = array();
				if (!$required) {
					$listItem = array();
					$listItem['id'] = '0';
					$listItem['description'] = '';
					$list[] = $listItem;
				}
				for($j=0; $j < count($aTemp); $j++) {
					$value = intval($aTemp[$j]);
					$listItem = array();
					$aTemp1 = explode(':', $aTemp[$j]);
					$listItem['id'] = $aTemp1[0];
					if (isset($aTemp1[1])) {
						$listItem['description'] = $aTemp1[1];
					}
					else {
						$listItem['description'] = $aTemp1[0];
					}
					$list[] = $listItem;
				}
				if ($variable['append'] == 0) {
					if ($variable['line'] == 0) {
						$wcrud->fieldSet($field, 'list', $list);
					}
					else {
						$wcrud->fieldLineSet($field, 'list', $list);
					}
				}
				else {
					$wcrud->fieldAppendSet($field, 'list', $list);
				}
				break;
			case 5 :
				$aTemp = explode(';', $listValue);
				$list = array();
				if (!$required) {
					$listItem = array();
					$listItem['id'] = ' ';
					$listItem['description'] = '';
					$list[] = $listItem;
				}
				for($j=0; $j < count($aTemp); $j++) {
					$listItem = array();
					$aTemp1 = explode(':', $aTemp[$j]);
					$listItem['id'] = $aTemp1[0];
					if (isset($aTemp1[1])) {
						$listItem['description'] = $aTemp1[1];
					}
					else {
						$listItem['description'] = $aTemp1[0];
					}
					$list[] = $listItem;
				}
				if ($variable['append'] == 0) {
					if ($variable['line'] == 0) {
						$wcrud->fieldSet($field, 'list', $list);
					}
					else {
						$wcrud->fieldLineSet($field, 'list', $list);
					}
				}
				else {
					$wcrud->fieldAppendSet($field, 'list', $list);
				}
				break;
			case 6 :
				if ($variable['append'] == 0) {
					if ($variable['line'] == 0) {
						$wcrud->fieldSet($field, 'currency');
					}
					else {
						$wcrud->fieldLineSet($field, 'currency');
					}
				}
				else {
					$wcrud->fieldAppendSet($field, 'currency');
				}
				$wcrud->formatSet($field, 'euro');
				break;
			case 7 :
				if ($variable['append'] == 0) {
					if ($variable['line'] == 0) {
						$wcrud->fieldSet($field, 'email');
					}
					else {
						$wcrud->fieldLineSet($field, 'email');
					}
				}
				else {
					$wcrud->fieldAppendSet($field, 'email');
				}
				break;
			case 8 :
				if ($variable['append'] == 0) {
					if ($variable['line'] == 0) {
						$wcrud->fieldSet($field, 'date');
					}
					else {
						$wcrud->fieldLineSet($field, 'date');
					}
				}
				else {
					$wcrud->fieldAppendSet($field, 'date');
				}
				$wcrud->defaultValueSet($field, ' ');
				$wcrud->formatSet($field, 'd/m/Y');
				break;
			case 10 :
				if ($variable['append'] == 0) {
					if ($variable['line'] == 0) {
						$wcrud->fieldSet($field, 'display', $variable['description']);
					}
					else {
						$wcrud->fieldLineSet($field, 'display', $variable['description']);
					}
				}
				else {
					$wcrud->fieldAppendSet($field, 'display', $variable['description']);
				}
				break;
			default :
				if ($variable['append'] == 0) {
					if ($variable['line'] == 0) {
						$wcrud->fieldSet($field, 'text');
					}
					else {
						$wcrud->fieldLineSet($field, 'text');
					}
				}
				else {
					$wcrud->fieldAppendSet($field, 'text');
				}
				if ($size > 0) {
					$wcrud->sizeSet($field, $size);
				}
				if (!empty($format)) {
					$wcrud->formatSet($field, $format);
				}
		}
		if ($variable['no_label'] == 0) {
			if ($variable['type_id'] != 0) {
				if (!empty($label)) {
					$wcrud->labelSet($field, $label . ' :');
				}
				if (!empty($collabel)) {
					$wcrud->collabelSet($field, $collabel);
				}
			}
			$wcrud->fieldLabelSizeSet($field, 3);
		}
		else {
			$wcrud->fieldLabelSet($field, false);
		}
		if ($required) {
			$wcrud->requiredSet($field);
		}
		if ($variable['display'] == 0) {
			$wcrud->classSet($field, 'display-none');
		}
	}
	if ($categoryId != 0) {
		$wcrud->fieldSet($categoryName . '_end', 'pagecontentend');
	}
	if (count($variableList) > 0) {
		$wcrud->fieldSet('maintab_end', 'pageend','maintab');
	}

	if ($empty) {
		$return = '';
	}
	else {
		$return = $wcrud->fetchCrudEdit($id);
	}
	return $return;
}

/********************************/
/*      Result functions        */
/********************************/
function analyseResult($id, $nodeId = '', $step = 0) {
	$ws = workspace::ws_open();
	$traceItem = array();
	$resultList = array();
	$resultDisplayList = array();

	$trace = new object_trace();
	$traceItem = $trace->display($id)->returnGet();
	$displayResult = $traceItem['display_value'];

	$objectNode = new object_node();
	$node = $objectNode->display($nodeId)->returnGet();
	if ($step == 0) {
		$resultList = $node['result_list'];
	}
	else {
		$resultList = $node['result_1_list'];
	}
	for($i=0; $i < count($resultList); $i++) {
		$result = $resultList[$i];
		$field = $result['name'];
		$display = 1;
		if ($result['nodisplay'] == 1) {
			$display = 0;
		}
		if (($display == 1) and(isset($displayResult[$field]))) {
			$display = $displayResult[$field];
		}
		if ($display == 1) {
			$resultDisplayList[] = $result;
		}
	}
	return $resultDisplayList;
}

function showResult($id, $resultList) {
	$ws = workspace::ws_open();
	$traceItem = array();
	$return = '';

	$wcrud = new wcrud('object_trace', $ws->extractPage(__FILE__));
	$wcrud->idSet(false);
	$wcrud->titleSet(false);
	$wcrud->pageSet(false);
	$wcrud->btreturnSet(false);
	$wcrud->btokSet(false);
	$wcrud->btresetSet(false);
	$wcrud->saveAutoSet(true);
	for($i=0; $i < count($resultList); $i++) {
		$result = $resultList[$i];
		$field = $result['name'];

		$label = $result['label'];
		$type = $result['type_id'];

		if ($result['line'] == 0) {
			if (!empty($result['description'])) {
				$wcrud->fieldSet($field . '_paraph', 'paraph',$result['description']);
			}
		}
		switch ($type) {
			case 2 :
				if ($result['line'] == 0) {
					$wcrud->fieldSet($field, 'integer');
				}
				else {
					$wcrud->fieldLineSet($field, 'integer');
				}
				break;
			case 3 :
				if ($result['line'] == 0) {
					$wcrud->fieldSet($field, 'number');
				}
				else {
					$wcrud->fieldLineSet($field, 'number');
				}
				break;
			case 4 :
				if ($result['line'] == 0) {
					$wcrud->fieldSet($field, 'date');
				}
				else {
					$wcrud->fieldLineSet($field, 'date');
				}
				$wcrud->defaultValueSet($field, ' ');
				$wcrud->formatSet($field, 'd/m/Y');
				break;
			case 5 :
				if ($result['line'] == 0) {
					$wcrud->fieldSet($field, 'currency');
				}
				else {
					$wcrud->fieldLineSet($field, 'currency');
				}
				$wcrud->formatSet($field, 'euro');
				break;
			case 6 :
				if ($result['line'] == 0) {
					$wcrud->fieldSet($field, 'display');
				}
				else {
					$wcrud->fieldLineSet($field, 'display');
				}
				break;
			default :
				if ($result['line'] == 0) {
					$wcrud->fieldSet($field, 'text');
				}
				else {
					$wcrud->fieldLineSet($field, 'text');
				}
		}
		$wcrud->labelSet($field, $label.' :');
		$wcrud->readonlySet($field);
	}
	$return = $wcrud->fetchCrudEdit($id);

	return $return;
}

function displayResult($categoryName) {
	$ws = workspace::ws_open();
	$return = '';
	$domainId = $ws->paramGet('APP_PARAM_DOMAIN', SEPARATION_DOMAIN_ID);
	$userId = 0;
	$flagConnect = false;

	if ($ws->sessionGet('connect_id') <> $ws->paramGet('USER_GUEST')) {
		$flagConnect = $ws->connected();
	}
	if ($flagConnect) {
		$userId = $ws->connected_id();
	}
	if ($userId == 0) {
		$reference = '';
	}
	else {
		$reference = strval($userId);
	}
	$traceItem = array();
	$trace = new object_trace();
	$traceItem = $trace->init($domainId, $reference, session_id(), $ws->connected_id())->returnGet();
	$id = $traceItem['id'];
	$diagramId = $traceItem['situation_id'];

	$traceDiagram = new object_trace_diagram();
	$traceDiagramItem = $traceDiagram->init($diagramId, $reference, session_id(), $ws->connected_id())->returnGet();

	$argArray = array(
		'id' => $id
	);
	$traceItem = $trace->update($argArray);
	$traceItem = $trace->display($id)->returnGet();
	$displayResult = $traceItem['display_value'];

	$empty = true;
	$wcrud = new wcrud('object_trace', $ws->extractPage(__FILE__));
	$wcrud->idSet(false);
	$wcrud->titleSet(false);
	$wcrud->pageSet(false);
	$wcrud->btreturnSet(false);
	$wcrud->btokSet(false);
	$wcrud->btresetSet(false);
	$wcrud->saveAutoSet(true);

	$resultObject = new object_field_result();
	$resultObject->filterSet('domain_id',$domainId);
	$resultObject->filterSet('nature', 1);
	$resultList = $resultObject->displayList(0)->returnGet();
	for($i=0; $i < count($resultList); $i++) {
		$result = $resultList[$i];
		$field = $result['name'];
		$display = 1;
		if ($result['category_name'] != $categoryName) {
			$display = 0;
		}
		if ($result['nodisplay'] == 1) {
			$display = 0;
		}
		if (($display == 1) and(isset($displayResult[$field]))) {
			$display = $displayResult[$field];
		}
		if ($display == 1) {
			$empty = false;
			$label = $result['label'];
			$type = $result['type_id'];

			if ($result['line'] == 0) {
				if (!empty($result['description'])) {
					$wcrud->fieldSet($field . '_paraph', 'paraph',$result['description']);
				}
			}
			switch ($type) {
				case 2 :
					if ($result['line'] == 0) {
						$wcrud->fieldSet($field, 'integer');
					}
					else {
						$wcrud->fieldLineSet($field, 'integer');
					}
					break;
				case 3 :
					if ($result['line'] == 0) {
						$wcrud->fieldSet($field, 'number');
					}
					else {
						$wcrud->fieldLineSet($field, 'number');
					}
					break;
				case 4 :
					if ($result['line'] == 0) {
						$wcrud->fieldSet($field, 'date');
					}
					else {
						$wcrud->fieldLineSet($field, 'date');
					}
					$wcrud->defaultValueSet($field, ' ');
					$wcrud->formatSet($field, 'd/m/Y');
					break;
				case 5 :
					if ($result['line'] == 0) {
						$wcrud->fieldSet($field, 'currency');
					}
					else {
						$wcrud->fieldLineSet($field, 'currency');
					}
					$wcrud->formatSet($field, 'euro');
					break;
				case 6 :
					if ($result['line'] == 0) {
						$wcrud->fieldSet($field, 'display');
					}
					else {
						$wcrud->fieldLineSet($field, 'display');
					}
					break;
				default :
					if ($result['line'] == 0) {
						$wcrud->fieldSet($field, 'text');
					}
					else {
						$wcrud->fieldLineSet($field, 'text');
					}
			}
			$wcrud->labelSet($field, $label.' :');
			$wcrud->readonlySet($field);
		}
	}

	if ($empty) {
		$return = '';
	}
	else {
		$return = $wcrud->fetchCrudEdit($id);
	}
	return $return;
}

?>