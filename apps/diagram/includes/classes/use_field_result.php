<?php
/**
* This file contains classes and function for the results management.
*
* @package    use_field
* @subpackage business_process
* @version    1.0
* @date       02 Septembre 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the results management.
*/

class object_field_result extends BUS_object
{

	/**
	* constructor adm_application
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->dbnameSet('dgm');
		$this->idSet('id');
		$this->selectLabelFieldSet('code');

		/* Table structure for the object */
		$this->tableSet('dmg_field');
		$this->joinTableSet('dmg_domain', 'id','dmg_field','domain_id');
		$this->joinTableSet('dmg_result_category', 'id','dmg_field','category_id');
		$this->joinTableSet('dmg_result_type', 'id','dmg_field','type_id');
		$this->joinTableSet('dmg_result', 'field_id','dmg_field','id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('domain_id');
		$this->fieldTableSet('domain_name','dmg_domain','name');
		$this->fieldTableSet('name');
		$this->fieldAttrSet('name', 'string', array(
			'required' => true,
			'size' => 20,
			'case' => 'upper'));
		$this->fieldTableSet('label');
		$this->fieldAttrSet('label', 'string', array(
			'size' => 100));

		$this->fieldTableSet('nature');
		$this->fieldAttrSet('nature', 'integer');
		$this->filterSet('nature', 3);
		$this->fieldTableSet('category_id');
		$this->fieldTableSet('category_sequence','dmg_result_category','sequence');
		$this->fieldTableSet('category_name','dmg_result_category','name');
		$this->fieldTableSet('category_label','dmg_result_category','label');
		$this->fieldTableSet('category_description','dmg_result_category','description');
		$this->fieldAttrSet('category_description', 'text');

		$this->fieldTableSet('type_id');
		$this->fieldTableSet('type','dmg_result_type','code');
		$this->fieldTableSet('sequence');
		$this->fieldAttrSet('sequence', 'integer');
		$this->fieldTableSet('nodisplay');
		$this->fieldAttrSet('nodisplay', 'boolean');
		$this->fieldTableSet('line');
		$this->fieldAttrSet('line', 'boolean');
		$this->fieldTableSet('display_func');
		$this->fieldAttrSet('display_func', 'text');
		$this->fieldTableSet('description');
		$this->fieldAttrSet('description', 'text');

		$this->fieldTableSet('result_formula','dmg_result','formula');
		$this->fieldTableSet('result_function','dmg_result','formula_func');

		$this->fieldCompoSet('code', 'append', 'domain_name');
		$this->fieldCompoSet('code', 'append', ' - ');
		$this->fieldCompoSet('code', 'append', 'name');

		$this->whereTableSet('name');
		$this->whereTableSet('label');
		
		$this->orderTableSet(0,'domain_id');
		$this->orderTableSet(0,'category_sequence');
		$this->orderTableSet(0,'category_name');
		$this->orderTableSet(0,'sequence');
		$this->orderTableSet(0,'name');
		$this->orderTableSet(0,'id');

		$this->joinObjectSet('object_result', 'field_id', 'id');		
		$this->fieldObjectSet('formula', 'object_result');
		$this->fieldObjectSet('formula_func', 'object_result');
	}

    private static function _maxSequence($domainId, $categoryId)
    {
		$sequence = 0;
		$tbField = new Smart_select('dmg_field', 'dgm');
		$tbField->fieldSet('id');
		$tbField->fieldSet('name');
		$tbField->fieldSet('label');
		$tbField->fieldSet('sequence');
		$tbField->whereSet('nature', 3);
		$tbField->whereSet('domain_id', $domainId, 'and');
		$tbField->whereSet('category_id', $categoryId, 'and');
		$tbField->orderSet('sequence', 'DESC');
		$returnList = $tbField->find();
		if (!empty($returnList['sequence'])) {
			$sequence = $returnList['sequence'];
		}
		return $sequence;
	}

    public static function _copy($fieldId, $newDomainId, $newName = '') {
		$newFieldId = 0;
		
		$tbField = new Smart_select('dmg_field', 'dgm');
		$tbField->fieldSet('id');
		$tbField->fieldSet('domain_id');
		$tbField->fieldSet('name');
		$tbField->fieldSet('label');
		$tbField->fieldSet('nature');
		$tbField->fieldSet('category_id');
		$tbField->fieldSet('type_id');
		$tbField->fieldSet('nodisplay');
		$tbField->fieldSet('line');
		$tbField->fieldSet('display_func');
		$tbField->fieldSet('description');
		$tbField->whereSet('id',$fieldId);
		$field = $tbField->find();

		$fieldDomainId = $field['domain_id'];
		$fieldName = $field['name'];
		$fieldLabel = $field['label'];
		$fieldNature = $field['nature'];
		$fieldCategoryId = $field['category_id'];
		$fieldTypeId = $field['type_id'];
		$fieldNoDisplay = $field['nodisplay'];
		$fieldLine = $field['line'];
		$fieldDisplayFunc = $field['display_func'];
		$fieldDescription = $field['description'];
		$categoryName = '';
		$newCategoryId = 0;
		if (empty($newName)) {
			$newName = $field['name'];
		}
		
		$tbField = new Smart_select('dmg_field', 'dgm');
		$tbField->fieldSet('id');
		$tbField->whereSet('domain_id',$newDomainId);
		$tbField->whereSet('name',$newName, 'and');
		$field = $tbField->find();
		if (empty($field)) {
			if ($fieldNature == 3) {
				$tbResultCategory = new Smart_select('dmg_result_category', 'dgm');
				$tbResultCategory->fieldSet('id');
				$tbResultCategory->fieldSet('name');
				$tbResultCategory->whereSet('id',$fieldCategoryId);
				$category = $tbResultCategory->find();
				if ($category) {
					$categoryName = $category['name'];
					$tbResultCategory = new Smart_select('dmg_result_category', 'dgm');
					$tbResultCategory->fieldSet('id');
					$tbResultCategory->whereSet('domain_id',$newDomainId);
					$tbResultCategory->whereSet('name',$categoryName, 'and');
					$category = $tbResultCategory->find();
					$newCategoryId = $category['id'];
				}
				
				$sequence = self::_maxSequence($newDomainId, $newCategoryId);
				
				$tbField = new Smart_record('dmg_field', 'dgm');
				$tbField->fieldSet('domain_id', $newDomainId);
				$tbField->fieldSet('name', $newName);
				$tbField->fieldSet('label', $fieldLabel);
				$tbField->fieldSet('nature', $fieldNature);
				$tbField->fieldSet('category_id', $newCategoryId);
				$tbField->fieldSet('type_id', $fieldTypeId);
				$tbField->fieldSet('sequence', $sequence + 1);
				$tbField->fieldSet('nodisplay', $fieldNoDisplay);
				$tbField->fieldSet('line', $fieldLine);
				$tbField->fieldSet('display_func', $fieldDisplayFunc);
				$tbField->fieldSet('description', $fieldDescription);
				$newFieldId = $tbField->insert();
		
				$tbResult = new Smart_select('dmg_result', 'dgm');
				$tbResult->fieldSet('id');
				$tbResult->fieldSet('field_id');
				$tbResult->fieldSet('formula');
				$tbResult->fieldSet('formula_func');
				$tbResult->whereSet('field_id',$fieldId);
				$result = $tbResult->find();

				$tbResult = new Smart_record('dmg_result', 'dgm');
				$tbResult->fieldSet('field_id', $newFieldId);
				$tbResult->fieldSet('formula', $result['formula']);
				$tbResult->fieldSet('formula_func', $result['formula_func']);
				$tbResult->insert();
			}
		}
		return $newFieldId;
	}
 
    public function copy($fieldId)
    {
		$newFieldId = 0;
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('info', $this->dbnameGet() . ' - Object Insert for ' . $this->nameGet(),  __CLASS__, func_get_args(), 'arguments');

		$argArray = array();
		$db = PDO_extend::ws_open('dgm');
		try {
			$db->beginTransaction();
			$tbField = new Smart_record('dmg_field', 'dgm');
			$argArray = $tbField->findId('id', $fieldId);
			if ($argArray) {
				if ($argArray['nature'] == 3) {
					$name = $argArray['name'];
					$newName = $name . '-1';
					$newDomainId = $argArray['domain_id'];
					$newFieldId = self::_copy($fieldId, $newDomainId, $newName);
				}
			}
		}
		catch (exception $e) {
			$newFieldId = 0;
		}
		if ($newFieldId != 0) {
			$db->commit();
			$fct_return->returnSet($newFieldId);
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
		$domainId = $this->valueGet('domain_id');
		$categoryId = $argArray['category_id'];
		$sequence = self::_maxSequence($domainId, $categoryId);
		$this->valueSet('sequence',$sequence + 1);
		$fct_return = parent::insert($argArray, $dbName);
		return $fct_return;
	}
	
    public function organizeSequence($domainId, $categoryId)
    {
		$tbField = new Smart_select('dmg_field', 'dgm');
		$tbField->fieldSet('id');
		$tbField->fieldSet('sequence');
		$tbField->whereSet('nature', 3);
		$tbField->whereSet('domain_id',$domainId, 'and');
		$tbField->whereSet('category_id',$categoryId, 'and');
		$tbField->orderSet('sequence');

		$tbFielditem = new Smart_record('dmg_field', 'dgm');
		$sequence = 1;
		$returnList = $tbField->findAll();
		for ($i=0; $i < count($returnList); $i++) {
			$tbFielditem->idSet($returnList[$i]['id']);
			$tbFielditem->fieldSet('sequence', $sequence);
			$tbFielditem->update();			
			$sequence = $sequence + 1;
		}
	}

    public function levelUp($id)
    {
		$fct_return = new Return_function;
		$tbField = new Smart_select('dmg_field', 'dgm');
		$tbField->fieldSet('domain_id');
		$tbField->fieldSet('category_id');
		$tbField->fieldSet('name');
		$tbField->fieldSet('label');
		$tbField->fieldSet('sequence');
		$tbField->whereSet('id',$id);
		$return = $tbField->find();
		
		$sequence = $return['sequence'];
		$domainId = $return['domain_id'];
		$categoryId = $return['category_id'];
		if ($sequence > 1) {
			$sequence = $sequence - 1.5;
			$tbField = new Smart_record('dmg_field', 'dgm');
			$tbField->idSet($id);
			$tbField->fieldSet('sequence', $sequence);
			$tbField->update();
			$this->organizeSequence($domainId, $categoryId);
		}
		else {
			$resultCategory = new object_result_category();
			$resultCategory->levelUp($categoryId);
		}
		return $fct_return;
	}

}