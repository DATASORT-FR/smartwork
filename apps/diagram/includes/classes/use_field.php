<?php
/**
* This file contains classes and function for the fields management.
*
* @package    use_diagram
* @subpackage business_process
* @version    1.0
* @date       02 Octobre 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the fields management.
*/
class object_field extends BUS_object
{

	/**
	* constructor adm_feature
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
		$this->fieldTableSet('category_id');
		$this->fieldTableSet('type_id');
		$this->fieldTableSet('nodisplay');
		$this->fieldAttrSet('nodisplay', 'boolean');
		$this->fieldTableSet('line');
		$this->fieldAttrSet('line', 'boolean');
		$this->fieldTableSet('display_func');
		$this->fieldAttrSet('display_func', 'text');
		$this->fieldTableSet('description');
		$this->fieldAttrSet('description', 'text');

		$this->fieldCompoSet('code', 'append', 'domain_name');
		$this->fieldCompoSet('code', 'append', ' - ');
		$this->fieldCompoSet('code', 'append', 'name');

		$this->whereTableSet('name');
		$this->whereTableSet('label');
		
		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'domain_id');
		$this->orderTableSet(1,'name');
		$this->orderTableSet(1,'id');
	}
 
    public function copy($fieldId)
    {
		$newFieldId =  0;
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
				$name = $argArray['name'];
				$newName = $name . '-1';
				$newDomainId = $argArray['domain_id'];
				switch ($argArray['nature']) {
					case 1 :
						$newFieldId = object_field_variable::_copy($fieldId, $newDomainId, $newName);
						break;
					case 2 :
						$newFieldId = object_field_table::_copy($fieldId, $newDomainId, $newName);
						break;
					case 3 :
						$newFieldId = object_field_result::_copy($fieldId, $newDomainId, $newName);
						break;
				}
			}
		}
		catch (exception $e) {
			$newFieldId =  0;
		}
		if ($newFieldId != 0) {
			$db->commit();
			$fct_return->returnSet($newDiagramId);
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

   public static function _delete($fieldId, $fieldNature = '') {

		if (empty($fieldNature)) {
			$tbField = new Smart_select('dmg_field', 'dgm');
			$tbField->fieldSet('id');
			$tbField->fieldSet('nature');
			$tbField->whereSet('id',$fieldId);
			$field = $tbField->find();
			$fieldNature = $field['nature'];
		}
		switch ($fieldNature) {
			case 1 :
				$tbVariable = new Smart_select('dmg_variable', 'dgm');
				$tbVariable->fieldSet('id');
				$tbVariable->whereSet('field_id',$fieldId);
				$variable = $tbVariable->find();

				$tbVariable = new Smart_record('dmg_variable', 'dgm');
				$tbVariable->idSet($variable['id']);
				$tbVariable->delete();
				break;
			case 2 :
				$tbTable = new Smart_select('dmg_table', 'dgm');
				$tbTable->fieldSet('id');
				$tbTable->whereSet('field_id',$fieldId);
				$table = $tbTable->find();

				$tbTable = new Smart_record('dmg_table', 'dgm');
				$tbTable->idSet($table['id']);
				$tbTable->delete();
				break;
			case 3 :
				$tbResult = new Smart_select('dmg_result', 'dgm');
				$tbResult->fieldSet('id');
				$tbResult->whereSet('field_id',$fieldId);
				$result = $tbResult->find();

				$tbResult = new Smart_record('dmg_result', 'dgm');
				$tbResult->idSet($result['id']);
				$tbResult->delete();
				break;
		}

		$tbField = new Smart_record('dmg_field', 'dgm');
		$tbField->idSet($fieldId);
		$tbField->delete();
	}
	
    public function delete($fieldId, $dbName = '')
	{
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('info', $this->dbnameGet() . ' - Object Insert for ' . $this->nameGet(),  __CLASS__, func_get_args(), 'arguments');

		$argArray = array();
		$db = PDO_extend::ws_open('dgm');
		try {
			$db->beginTransaction();
			$tbDomain = new Smart_record('dmg_domain', 'dgm');
			$argArray = $tbDomain->findId('id', $fieldId);
			if ($argArray) {
				$fieldNature = $argArray['nature'];
				self::_delete($fieldId, $fieldNature);
				
			}
			else {
				$fieldId = 0;
			}
		}
		catch (exception $e) {
			$fieldId = 0;
		}
		if ($fieldId != 0) {
			$db->commit();
			$fct_return->returnSet($fieldId);
			$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
			$this->Msg('delete','OK', $argArray);
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
			$this->Msg('delete','KO', $argArray);
		}
		return $fct_return;
	}

}