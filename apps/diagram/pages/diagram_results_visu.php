<?php
/**
* Main file for diagram results design
*
* @package    Diagram 
* @subpackage controller
* @version    1.0
* @date       14 March 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();

$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$domainId = $ws->paramGet('ID');
if ($domainId != '') {
	$ws->sessionSet('object_domainId', $domainId);
}
else {
	$domainId = $ws->sessionGet('object_domainId');
}

if ($domainId != '') {
	$reference = '';
	$traceItem = array();
	$trace = new object_trace();
	$traceItem = $trace->init($domainId, $reference, session_id(), $ws->connected_id())->returnGet();
	$id = $traceItem['id'];

	$argArray = array(
		'id' => $id
	);
	$traceItem = $trace->update($argArray);
	
	$traceItem = $trace->display($id)->returnGet();
	$displayResult = $traceItem['display_value'];

	$wcrud = new wcrud('object_trace', $ws->extractPage(__FILE__));
	$wcrud->titleSet(false);
	$wcrud->pageSet(false);
	$wcrud->btreturnSet(false);
	$wcrud->btokSet(false);
	$wcrud->btresetSet(false);
	$wcrud->saveAutoSet(true);

	$categoryId = 0;
	$categoryName = '';
	$resultObject = new object_field_result();
	$resultObject->filterSet('domain_id',$domainId);
	$resultObject->filterSet('nature', 1);
	$resultList = $resultObject->displayList(0)->returnGet();
	if (count($resultList) > 0) {
		$wcrud->fieldSet('maintab', 'accordion');
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
			$new_categoryId = $result['category_id'];
			$new_categoryName = $result['category_name'];
			if ($new_categoryId != $categoryId) {
				if ($categoryId != 0) {
					$wcrud->fieldSet($categoryName . '_end', 'accordioncontentend');
				}
				$categoryId = $new_categoryId;
				$categoryName = $new_categoryName;
				$wcrud->fieldSet($categoryName, 'accordioncontent','maintab');
				$wcrud->labelSet($categoryName, $result['category_label']);
				if (!empty($result['category_description'])) {
					$wcrud->fieldSet($categoryName . '_paraph', 'paraph',$result['category_description']);
				}
			}
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
	if ($categoryId != 0) {
		$wcrud->fieldSet($categoryName . '_end', 'accordioncontentend');
	}
	if (count($resultList) > 0) {
		$wcrud->fieldSet('maintab_end', 'accordionend','maintab');
	}

	$wcrud->displayCrudEdit($id);

}
else {
	$ws->build('simple.tpl');
}

?>