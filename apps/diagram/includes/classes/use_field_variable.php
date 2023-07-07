<?php
/**
* This file contains classes and function for the variables management.
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
* Classes for the variables management.
*/

class object_field_variable extends BUS_object
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
		$this->joinTableSet('dmg_variable_category', 'id','dmg_field','category_id');
		$this->joinTableSet('dmg_variable_type', 'id','dmg_field','type_id');
		$this->joinTableSet('dmg_variable', 'field_id','dmg_field','id');

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
		$this->filterSet('nature', 1);
		$this->fieldTableSet('category_id');
		$this->fieldTableSet('category_sequence','dmg_variable_category','sequence');
		$this->fieldTableSet('category_name','dmg_variable_category','name');
		$this->fieldTableSet('category_label','dmg_variable_category','label');
		$this->fieldTableSet('category_description','dmg_variable_category','description');
		$this->fieldAttrSet('category_description', 'text');

		$this->fieldTableSet('type_id');
		$this->fieldTableSet('type','dmg_variable_type','code');
		$this->fieldTableSet('sequence');
		$this->fieldAttrSet('sequence', 'integer');
		$this->fieldTableSet('nodisplay');
		$this->fieldAttrSet('nodisplay', 'boolean');
		$this->fieldTableSet('line');
		$this->fieldAttrSet('line', 'boolean');
		$this->fieldTableSet('display_func');
		$this->fieldAttrSet('display_func', 'text');
		$this->fieldTableSet('no_label');
		$this->fieldAttrSet('no_label', 'boolean');
		$this->fieldTableSet('description');
		$this->fieldAttrSet('description', 'text');

		$this->fieldTableSet('variable_size','dmg_variable','size');
		$this->fieldTableSet('variable_format','dmg_variable','format');
		$this->fieldTableSet('variable_mandatory','dmg_variable','mandatory');
		$this->fieldTableSet('variable_value','dmg_variable','value');
		$this->fieldTableSet('variable_object_items','dmg_variable','object_items');
		$this->fieldTableSet('variable_nolabel','dmg_variable','nolabel');
		
		$this->fieldCompoSet('code', 'append', 'domain_name');
		$this->fieldCompoSet('code', 'append', ' - ');
		$this->fieldCompoSet('code', 'append', 'name');

		$this->fieldCompoSet('label_select', 'append', 'name');
		$this->fieldCompoSet('label_select', 'append', ' - ');
		$this->fieldCompoSet('label_select', 'append', 'label');
		$this->selectLabelFieldSet('label_select');
		
		$this->whereTableSet('name');
		$this->whereTableSet('label');
		
		$this->orderTableSet(0,'domain_id');
		$this->orderTableSet(0,'category_sequence');
		$this->orderTableSet(0,'category_name');
		$this->orderTableSet(0,'sequence');
		$this->orderTableSet(0,'name');
		$this->orderTableSet(0,'id');

		$this->orderTableSet(1,'domain_id');
		$this->orderTableSet(1,'name');
		$this->orderTableSet(1,'id');

		$this->joinObjectSet('object_variable', 'field_id', 'id');		
		$this->fieldObjectSet('size', 'object_variable');
		$this->fieldObjectSet('format', 'object_variable');
		$this->fieldObjectSet('mandatory', 'object_variable');
		$this->fieldObjectSet('value', 'object_variable');
		$this->fieldObjectSet('object_items','object_variable');
		$this->fieldObjectSet('nolabel','object_variable');
	}
 
    private static function _maxSequence($domainId, $categoryId)
    {
		$sequence = 0;
		$tbField = new Smart_select('dmg_field', 'dgm');
		$tbField->fieldSet('id');
		$tbField->fieldSet('name');
		$tbField->fieldSet('label');
		$tbField->fieldSet('sequence');
		$tbField->whereSet('nature', 1);
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
			if ($fieldNature == 1) {
				$tbVariableCategory = new Smart_select('dmg_variable_category', 'dgm');
				$tbVariableCategory->fieldSet('id');
				$tbVariableCategory->fieldSet('name');
				$tbVariableCategory->whereSet('id',$fieldCategoryId);
				$category = $tbVariableCategory->find();
				if ($category) {
					$categoryName = $category['name'];
					$tbVariableCategory = new Smart_select('dmg_variable_category', 'dgm');
					$tbVariableCategory->fieldSet('id');
					$tbVariableCategory->whereSet('domain_id',$newDomainId);
					$tbVariableCategory->whereSet('name',$categoryName, 'and');
					$category = $tbVariableCategory->find();
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
		
				$tbVariable = new Smart_select('dmg_variable', 'dgm');
				$tbVariable->fieldSet('id');
				$tbVariable->fieldSet('field_id');
				$tbVariable->fieldSet('size');
				$tbVariable->fieldSet('format');
				$tbVariable->fieldSet('mandatory');
				$tbVariable->fieldSet('value');
				$tbVariable->fieldSet('object_items');
				$tbVariable->fieldSet('nolabel');
				$tbVariable->whereSet('field_id',$fieldId);
				$variable = $tbVariable->find();

				$objectItems = '';
				$atemp = explode(';', $variable['object_items']);
				foreach($atemp as $key=>$fieldObjectId) {
					$tbField = new Smart_select('dmg_field', 'dgm');
					$tbField->fieldSet('name');
					$tbField->whereSet('id',$fieldObjectId);
					$field = $tbField->find();
					$fieldObjectName = $field['name'];
					
					$tbField = new Smart_select('dmg_field', 'dgm');
					$tbField->fieldSet('id');
					$tbField->whereSet('domain_id',$newDomainId);
					$tbField->whereSet('name',$fieldObjectName, 'and');
					$field = $tbField->find();
					if (!empty($field)) {
						$newFieldObjectId = $field['id'];
						if (!empty($objectItems)) {
							$objectItems .= ';';
						}
						$objectItems .= $newFieldObjectId;

					}
				}
				
				$tbVariable = new Smart_record('dmg_variable', 'dgm');
				$tbVariable->fieldSet('field_id', $newFieldId);
				$tbVariable->fieldSet('size', $variable['size']);
				$tbVariable->fieldSet('format', $variable['format']);
				$tbVariable->fieldSet('mandatory', $variable['mandatory']);
				$tbVariable->fieldSet('value', $variable['value']);
				$tbVariable->fieldSet('object_items', $objectItems);
				$tbVariable->fieldSet('nolabel', $variable['nolabel']);
				$tbVariable->insert();
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
				if ($argArray['nature'] == 1) {
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
	
    private function organizeSequence($domainId, $categoryId)
    {
		$tbField = new Smart_select('dmg_field', 'dgm');
		$tbField->fieldSet('id');
		$tbField->fieldSet('sequence');
		$tbField->whereSet('nature', 1);
		$tbField->whereSet('domain_id',$domainId, 'and');
		$tbField->whereSet('category_id',$categoryId, 'and');
		$tbField->orderSet('sequence');

		$tbFielIitem = new Smart_record('dmg_field', 'dgm');
		$sequence = 1;
		$returnList = $tbField->findAll();
		for ($i=0; $i < count($returnList); $i++) {
			$tbFielIitem->idSet($returnList[$i]['id']);
			$tbFielIitem->fieldSet('sequence', $sequence);
			$tbFielIitem->update();			
			$sequence = $sequence + 1;
		}
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
			$variableCategory = new object_variable_category();
			$variableCategory->levelUp($categoryId);
		}
		return $fct_return;
	}

}