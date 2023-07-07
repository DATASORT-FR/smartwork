<?php
/**
* This file contains classes and function for the slides management.
*
* @package    use_slide
* @subpackage business_process
* @version    1.0
* @date       13 June 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

if (!function_exists('noticeTitleInit')) {
	function noticeTitleInit($argArray) {
		$titleNotice = '';
		if ((!empty($argArray['notice_image'])) or (!empty($argArray['notice_description']))) {
			$titleNotice = $argArray['title'];
		}
		return $titleNotice;
	}
}

/**
* Classes for the slides management.
*/
class object_slide extends BUS_object
{

	/**
	* constructor slides
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->dbnameSet('dgm');
		$this->idSet('id');
		$this->selectLabelFieldSet('title_code');

		/* Table structure for the object */
		$this->tableSet('dmg_slide');
		$this->tableSet('dmg_process', 'dmg_diagram');
		$this->joinTableSet('dmg_slide_type', 'id','dmg_slide','type_id');
		$this->joinTableSet('dmg_domain', 'id','dmg_slide','domain_id');
		$this->joinTableSet('dmg_process', 'id','dmg_slide','process_id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('domain_id');
		$this->fieldTableSet('domain_name','dmg_domain','name');
		$this->fieldTableSet('reference');
		$this->fieldTableSet('label');
		$this->fieldAttrSet('label', 'string', array(
			'required' => true,
			'size' => 100));
		$this->fieldTableSet('title');
		$this->fieldAttrSet('title', 'string', array(
			'required' => true,
			'size' => 100));
		$this->fieldTableSet('type_id');
		$this->fieldTableSet('type','dmg_slide_type','code');
		$this->fieldTableSet('sequence');
		$this->fieldAttrSet('sequence', 'integer');
		$this->fieldTableSet('image');
		$this->fieldAttrSet('image', 'string', array(
			'size' => 255));
		$this->fieldTableSet('image_display');
		$this->fieldAttrSet('image_display', 'boolean');
		$this->fieldTableSet('description');
		$this->fieldAttrSet('description', 'text');
		$this->fieldTableSet('notice_id');
		$this->fieldTableSet('process_id');
		$this->fieldTableSet('process_name','dmg_process','name');
		$this->fieldTableSet('variable_contentid');
		$this->fieldTableSet('result_contentid');

		$this->fieldCompoSet('code', 'append', 'label');
		$this->fieldCompoSet('title_code', 'append', 'label');
		$this->fieldCompoSet('title_code', 'append', ' (');
		$this->fieldCompoSet('title_code', 'append', 'reference');
		$this->fieldCompoSet('title_code', 'append', ')');

		$this->whereTableSet('label');
		$this->whereTableSet('title');
		$this->whereTableSet('description');

		$this->orderTableSet(0,'domain_id');
		$this->orderTableSet(0,'type_id');
		$this->orderTableSet(0,'sequence');
		$this->orderTableSet(0,'label');
		$this->orderTableSet(0,'id');
		
		$this->joinObjectSet('object_slide_link','slide_id', 'id');		
		$this->dataObjectSet('link_list','object_slide_link', 'link_id');

		$this->joinObjectSet('object_slide_variable','slide_id', 'id');		
		$this->dataObjectSet('variable_list','object_slide_variable', 'field_id');

		$this->joinObjectSet('object_slide_variable_1','slide_id', 'id');		
		$this->dataObjectSet('variable_1_list','object_slide_variable_1', 'field_id');

		$this->joinObjectSet('object_slide_result','slide_id', 'id');		
		$this->dataObjectSet('result_list','object_slide_result', 'field_id');

		$this->joinObjectSet('object_slide_result_1','slide_id', 'id');		
		$this->dataObjectSet('result_1_list','object_slide_result_1', 'field_id');

		$this->joinObjectSet('object_notice', 'id', 'notice_id');		
		$this->fieldObjectSet('notice_domain', 'object_notice', 'domain_id');
		$this->fieldObjectSet('notice_type', 'object_notice', 'type_id');
		$this->fieldObjectSet('notice_label', 'object_notice', 'label');
		$this->fieldObjectSet('notice_title', 'object_notice', 'title');
		$this->fieldObjectSet('notice_image', 'object_notice', 'image');
		$this->fieldObjectSet('notice_description', 'object_notice', 'description');

		$this->joinObjectSet('object_content_variables', 'id', 'variable_contentid',);		
		$this->fieldObjectSet('variable_domain', 'object_content_variables', 'domain_id');
		$this->fieldObjectSet('variable_type', 'object_content_variables', 'type_id');
		$this->fieldObjectSet('variable_label', 'object_content_variables', 'label');
		$this->fieldObjectSet('variable_title', 'object_content_variables', 'title');
		$this->fieldObjectSet('variable_image', 'object_content_variables', 'image');
		$this->fieldObjectSet('variable_description', 'object_content_variables', 'description');

		$this->joinObjectSet('object_content_results', 'id', 'result_contentid');		
		$this->fieldObjectSet('result_domain', 'object_content_results', 'domain_id');
		$this->fieldObjectSet('result_type', 'object_content_results', 'type_id');
		$this->fieldObjectSet('result_label', 'object_content_results', 'label');
		$this->fieldObjectSet('result_title', 'object_content_results', 'title');
		$this->fieldObjectSet('result_image', 'object_content_results', 'image');
		$this->fieldObjectSet('result_description', 'object_content_results', 'description');
	}

    public static function _maxSequence($domainId, $typeId)
    {
		$sequence = 0;
		$tbSlide = new Smart_select('dmg_slide', 'dgm');
		$tbSlide->fieldSet('id');
		$tbSlide->fieldSet('title');
		$tbSlide->fieldSet('sequence');
		$tbSlide->whereSet('domain_id', $domainId, 'and');
		$tbSlide->whereSet('type_id', $typeId, 'and');
		$tbSlide->orderSet('sequence', 'DESC');
		$returnList = $tbSlide->find();
		if (!empty($returnList['sequence'])) {
			$sequence = $returnList['sequence'];
		}
		return $sequence;
	}
	
    public static function _newReference($domainId)
    {
		$reference = 1;
		$tbSlide = new Smart_select('dmg_slide', 'dgm');
		$tbSlide->fieldSet('id');
		$tbSlide->fieldSet('reference');
		$tbSlide->whereSet('domain_id', $domainId);
		$tbSlide->orderSet('reference');
		$tbSlide->orderSet('id');
		$list = $tbSlide->findAll();
		if (count($list) > 0) {
			$reference = count($list);
			if ($reference <= $list[count($list) - 1]['reference']) {
				$reference = $list[count($list) - 1]['reference'] + 1;
			}
		}
		return $reference;
	}
	
    public function organizeSequence($domainId, $typeId)
    {
		$sequence = 1;
		$tbSlide = new Smart_select('dmg_slide', 'dgm');
		$tbSlide->fieldSet('id');
		$tbSlide->fieldSet('sequence');
		$tbSlide->whereSet('domain_id',$domainId, 'and');
		$tbSlide->whereSet('type_id', $typeId, 'and');
		$tbSlide->orderSet('sequence');
		$returnList = $tbSlide->findAll();
		for ($i=0; $i < count($returnList); $i++) {
			$tbSlide = new Smart_record('dmg_slide', 'dgm');
			$tbSlide->idSet($returnList[$i]['id']);
			$tbSlide->fieldSet('sequence', $sequence);
			$tbSlide->update();			
			$sequence = $sequence + 1;
		}
	}
	
    public static function _copy($slideId, $newDomainId, $newLabel = '')
    {
		$item = array();

		$tbSlide = new Smart_select('dmg_slide', 'dgm');
		$tbSlide->fieldSet('id');
		$tbSlide->fieldSet('domain_id');
		$tbSlide->fieldSet('type_id');
		$tbSlide->fieldSet('reference');
		$tbSlide->fieldSet('label');
		$tbSlide->fieldSet('title');
		$tbSlide->fieldSet('sequence');
		$tbSlide->fieldSet('image');
		$tbSlide->fieldSet('image_display');
		$tbSlide->fieldSet('description');
		$tbSlide->fieldSet('notice_id');
		$tbSlide->fieldSet('process_id');
		$tbSlide->fieldSet('variable_contentid');
		$tbSlide->fieldSet('result_contentid');
		$tbSlide->whereSet('id', $slideId);
		$item = $tbSlide->find();

		$domainId = $item['domain_id'];
		$slideTypeId = $item['type_id'];
		$slideReference = $item['reference'];
		$slideSequence = $item['sequence'];
		$slideLabel = $item['label'];
		if (empty($newLabel)) {
			$newLabel = $slideLabel;
		}
		$slideTitle = $item['title'];
		$slideProcessId = $item['process_id'];
		$slideImage = $item['image'];
		$slideImageDisplay = $item['image_display'];
		$slideDescription = $item['description'];	
		if ($domainId != $newDomainId) {
			$slideNoticeId = object_content::_copy($item['notice_id'], $newDomainId);
			$slideVariableContentId = object_content::_copy($item['variable_contentid'], $newDomainId);
			$slideResultContentId = object_content::_copy($item['result_contentid'], $newDomainId);
		}
		else {
			$slideNoticeId = $item['notice_id'];
			$slideVariableContentId = $item['variable_contentid'];
			$slideResultContentId = $item['result_contentid'];
		}

		if ($domainId == $newDomainId) {
			$slideSequence = self::_maxSequence($domainId, $slideTypeId) + 1;		
			$slideReference = self::_newReference($domainId);
		}
		$tbSlide = new Smart_record('dmg_slide', 'dgm');
		$tbSlide->fieldSet('domain_id', $newDomainId);
		$tbSlide->fieldSet('type_id', $slideTypeId);
		$tbSlide->fieldSet('reference', $slideReference);
		$tbSlide->fieldSet('label', $newLabel);
		$tbSlide->fieldSet('title', $slideTitle);
		$tbSlide->fieldSet('sequence', $slideSequence);
		$tbSlide->fieldSet('image', $slideImage);
		$tbSlide->fieldSet('image_display', $slideImageDisplay);
		$tbSlide->fieldSet('description', $slideDescription);
		$tbSlide->fieldSet('process_id', $slideProcessId);
		$tbSlide->fieldSet('notice_id', $slideNoticeId);
		$tbSlide->fieldSet('variable_contentid', $slideVariableContentId);
		$tbSlide->fieldSet('result_contentid', $slideResultContentId);
		$newSlideId = $tbSlide->insert();
		
		// slide variables
		$tbSlideVariable = new Smart_select('dmg_slide_variable', 'dgm');
		$tbSlideVariable->fieldSet('id');
		$tbSlideVariable->fieldSet('type');
		$tbSlideVariable->fieldSet('slide_id');
		$tbSlideVariable->fieldSet('field_id');
		$tbSlideVariable->whereSet('slide_id',$slideId);
		$list = $tbSlideVariable->findAll();
		for ($i=0; $i < count($list); $i++) {
			$item = $list[$i];
			$fieldId = $item['field_id'];
			$typeId = $item['type'];
			
			$tbField = new Smart_select('dmg_field', 'dgm');
			$tbField->fieldSet('name');
			$tbField->whereSet('id',$fieldId);
			$field = $tbField->find();

			if (!empty($field)) {
				$fieldName = $field['name'];
					
				$tbField = new Smart_select('dmg_field', 'dgm');
				$tbField->fieldSet('id');
				$tbField->whereSet('domain_id',$newDomainId);
				$tbField->whereSet('name',$fieldName, 'and');
				$field = $tbField->find();
			}

			if (!empty($field)) {
				$newFieldId = $field['id'];
			
				$tbSlideVariable = new Smart_record('dmg_slide_variable', 'dgm');
				$tbSlideVariable->fieldSet('type', $typeId);
				$tbSlideVariable->fieldSet('slide_id', $newSlideId);
				$tbSlideVariable->fieldSet('field_id', $newFieldId);
				$tbSlideVariable->insert();
			}
		}

		// slide results
		$tbSlideResult = new Smart_select('dmg_slide_result', 'dgm');
		$tbSlideResult->fieldSet('id');
		$tbSlideResult->fieldSet('type');
		$tbSlideResult->fieldSet('slide_id');
		$tbSlideResult->fieldSet('field_id');
		$tbSlideResult->whereSet('slide_id',$slideId);
		$list = $tbSlideResult->findAll();
		for ($i=0; $i < count($list); $i++) {
			$item = $list[$i];
			$fieldId = $item['field_id'];
			$typeId = $item['type'];
			
			$tbField = new Smart_select('dmg_field', 'dgm');
			$tbField->fieldSet('name');
			$tbField->whereSet('id',$fieldId);
			$field = $tbField->find();

			if (!empty($field)) {
				$fieldName = $field['name'];
					
				$tbField = new Smart_select('dmg_field', 'dgm');
				$tbField->fieldSet('id');
				$tbField->whereSet('domain_id',$newDomainId);
				$tbField->whereSet('name',$fieldName, 'and');
				$field = $tbField->find();
			}

			if (!empty($field)) {
				$newFieldId = $field['id'];
			
				$tbSlideResult = new Smart_record('dmg_slide_result', 'dgm');
				$tbSlideResult->fieldSet('type', $typeId);
				$tbSlideResult->fieldSet('slide_id', $newSlideId);
				$tbSlideResult->fieldSet('field_id', $newFieldId);
				$tbSlideResult->insert();
			}
		}

		return $newSlideId;
	}
	
    public static function _delete($slideId)
    {
		// slides variables delete
		$tbSlideVariable = new Smart_select('dmg_slide_variable', 'dgm');
		$tbSlideVariable->fieldSet('id');
		$tbSlideVariable->whereSet('slide_id',$slideId);
		$variableList = $tbSlideVariable->findAll();
		for ($j=0; $j < count($variableList); $j++) {
			$item = $variableList[$j];
			$slideVariableId = $item['id'];
			$tbSlideVariable = new Smart_record('dmg_slide_variable', 'dgm');
			$tbSlideVariable->idSet($slideVariableId);
			$tbSlideVariable->delete();
		}
		
		// slides results delete
		$tbSlideResult = new Smart_select('dmg_slide_result', 'dgm');
		$tbSlideResult->fieldSet('id');
		$tbSlideResult->whereSet('slide_id',$slideId);
		$variableList = $tbSlideResult->findAll();
		for ($j=0; $j < count($variableList); $j++) {
			$item = $variableList[$j];
			$slideResultId = $item['id'];
			$tbSlideResult = new Smart_record('dmg_slide_result', 'dgm');
			$tbSlideResult->idSet($slideResultId);
			$tbSlideResult->delete();
		}
			
		$tbSlide = new Smart_record('dmg_slide', 'dgm');
		$tbSlide->idSet($slideId);
		$tbSlide->delete();
	}

    public function copy($slideId)
    {
		$newSlideId = 0;
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('info', $this->dbnameGet() . ' - Object Insert for ' . $this->nameGet(),  __CLASS__, func_get_args(), 'arguments');

		$argArray = array();
		$db = PDO_extend::ws_open('dgm');
		try {
			$db->beginTransaction();
			$tbSlide = new Smart_record('dmg_slide', 'dgm');
			$argArray = $tbSlide->findId('id', $slideId);
			if ($argArray) {
				$label = $argArray['label'];
				$newLabel = $label . '-1';
				$newDomainId = $argArray['domain_id'];
				$newSlideId = self::_copy($slideId, $newDomainId, $newLabel);
			}
		}
		catch (exception $e) {
			$newSlideId = 0;
		}
		if ($newSlideId != 0) {
			$db->commit();
			$fct_return->returnSet($newSlideId);
			$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
			$this->Msg('copy','OK', $argArray);
		}
		else {
			$db->rollBack();
			$fct_return->errorSet(0);
			if (isset($e)) {
				$ws->logSys('error', 'function KO for ' . $this->nameGet() . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			}
			else {
				$ws->logSys('error', 'function KO for ' . $this->nameGet() . " ", __CLASS__);
			}
			$this->Msg('copy','KO', $argArray);
		}
		return $fct_return;
	}
	
    public function insert($argArray, $dbName = '')
    {
		$list = array();
		if (!isset($argArray['domain_id'])) {
			$domainId = $this->valueGet('domain_id');
		}
		else {
			$domainId = $argArray['domain_id'];
		}
		if (!isset($argArray['type_id'])) {
			$slideTypeId = $this->valueGet('type_id');
		}
		else {
			$slideTypeId = $argArray['type_id'];
		}
		$slideSequence = self::_maxSequence($domainId, $slideTypeId) + 1;
		$slideReference = self::_newReference($domainId);
		$argArray['sequence'] = $slideSequence + 1;
		$argArray['reference'] = $slideReference;
		$fct_return = parent::insert($argArray, $dbName);
		return $fct_return;
	}

    public function levelUp($id)
    {
		$fct_return = new Return_function;
		$tbSlide = new Smart_select('dmg_slide', 'dgm');
		$tbSlide->fieldSet('domain_id');
		$tbSlide->fieldSet('type_id');
		$tbSlide->fieldSet('title');
		$tbSlide->fieldSet('sequence');
		$tbSlide->whereSet('id',$id);
		$return = $tbSlide->find();
		
		$sequence = $return['sequence'];
		$domainId = $return['domain_id'];
		$typeId = $return['type_id'];
		if ($sequence > 1) {
			$sequence = $sequence - 1.5;
			$tbSlide = new Smart_record('dmg_slide', 'dgm');
			$tbSlide->idSet($id);
			$tbSlide->fieldSet('sequence', $sequence);
			$tbSlide->update();
			$this->organizeSequence($domainId, $typeId);
		}
		return $fct_return;
	}

}