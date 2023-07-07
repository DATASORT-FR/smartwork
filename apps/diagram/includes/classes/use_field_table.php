<?php
/**
* This file contains classes and function for the tables management.
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
* Classes for the tables management.
*/

class object_field_table extends BUS_object
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
		$this->joinTableSet('dmg_table_type', 'id','dmg_field','type_id');
		$this->joinTableSet('dmg_table', 'field_id','dmg_field','id');

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
		$this->filterSet('nature', 2);
		$this->fieldTableSet('type_id');
		$this->fieldTableSet('type','dmg_table_type','code');

		$this->fieldTableSet('table_col1_field','dmg_table', 'col1_field');
		$this->fieldTableSet('table_col1_byrange','dmg_table', 'col1_byrange');
		
		$this->fieldTableSet('table_col2_field','dmg_table', 'col2_field');
		$this->fieldTableSet('table_col2_byrange','dmg_table', 'col2_byrange');
		
		$this->fieldTableSet('table_col3_field','dmg_table', 'col3_field');
		$this->fieldTableSet('table_col3_byrange','dmg_table', 'col3_byrange');

		$this->fieldTableSet('table_function','dmg_table','formula_func');

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

		$this->joinObjectSet('object_table', 'field_id', 'id');		
		$this->fieldObjectSet('col1_field', 'object_table');
		$this->fieldObjectSet('col1_byrange', 'object_table');
		$this->fieldObjectSet('col2_field', 'object_table');
		$this->fieldObjectSet('col2_byrange', 'object_table');
		$this->fieldObjectSet('col3_field', 'object_table');
		$this->fieldObjectSet('col3_byrange', 'object_table');
		$this->fieldObjectSet('formula_func','object_table');

		$this->joinObjectSet('object_table_value', 'field_id', 'id');		
		$this->dataObjectSet('table_data','object_table_value');
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
			if ($fieldNature == 2) {
				$newCategoryId = 0;
				$tbField = new Smart_record('dmg_field', 'dgm');
				$tbField->fieldSet('domain_id', $newDomainId);
				$tbField->fieldSet('name', $newName);
				$tbField->fieldSet('label', $fieldLabel);
				$tbField->fieldSet('nature', $fieldNature);
				$tbField->fieldSet('category_id', $newCategoryId);
				$tbField->fieldSet('type_id', $fieldTypeId);
				$tbField->fieldSet('nodisplay', $fieldNoDisplay);
				$tbField->fieldSet('line', $fieldLine);
				$tbField->fieldSet('display_func', $fieldDisplayFunc);
				$tbField->fieldSet('description', $fieldDescription);
				$newFieldId = $tbField->insert();
		
				$tbTable = new Smart_select('dmg_table', 'dgm');
				$tbTable->fieldSet('id');
				$tbTable->fieldSet('field_id');
				$tbTable->fieldSet('col1_field');
				$tbTable->fieldSet('col1_byrange');
				$tbTable->fieldSet('col2_field');
				$tbTable->fieldSet('col2_byrange');
				$tbTable->fieldSet('col3_field');
				$tbTable->fieldSet('col3_byrange');
				$tbTable->fieldSet('formula_func');
				$tbTable->whereSet('field_id',$fieldId);
				$table = $tbTable->find();

				$tbTable = new Smart_record('dmg_table', 'dgm');
				$tbTable->fieldSet('field_id', $newFieldId);
				$tbTable->fieldSet('col1_field', $table['col1_field']);
				$tbTable->fieldSet('col1_byrange', $table['col1_byrange']);
				$tbTable->fieldSet('col2_field', $table['col2_field']);
				$tbTable->fieldSet('col2_byrange', $table['col2_byrange']);
				$tbTable->fieldSet('col3_field', $table['col3_field']);
				$tbTable->fieldSet('col3_byrange', $table['col3_byrange']);
				$tbTable->fieldSet('formula_func', $table['formula_func']);
				$tbTable->insert();

				$tbTableValue = new Smart_select('dmg_table_value', 'dgm');
				$tbTableValue->fieldSet('id');
				$tbTableValue->fieldSet('field_id');
				$tbTableValue->fieldSet('col1_min');
				$tbTableValue->fieldSet('col1_max');
				$tbTableValue->fieldSet('col2_min');
				$tbTableValue->fieldSet('col2_max');
				$tbTableValue->fieldSet('col3_min');
				$tbTableValue->fieldSet('col3_max');
				$tbTableValue->fieldSet('value');
				$tbTableValue->whereSet('field_id',$fieldId);
				$tableValueList = $tbTableValue->findAll();
				for ($i=0; $i < count($tableValueList); $i++) {
					$tableValue = $tableValueList[$i];
					$tbTableValue = new Smart_record('dmg_table_value', 'dgm');
					$tbTableValue->fieldSet('field_id', $newFieldId);
					$tbTableValue->fieldSet('col1_min', $tableValue['col1_min']);
					$tbTableValue->fieldSet('col1_max', $tableValue['col1_max']);
					$tbTableValue->fieldSet('col2_min', $tableValue['col2_min']);
					$tbTableValue->fieldSet('col2_max', $tableValue['col2_max']);
					$tbTableValue->fieldSet('col3_min', $tableValue['col3_min']);
					$tbTableValue->fieldSet('col3_max', $tableValue['col3_max']);
					$tbTableValue->fieldSet('value', $tableValue['value']);
					$tbTableValue->insert();
				}
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
				if ($argArray['nature'] == 2) {
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

}