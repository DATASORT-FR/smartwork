<?php
/**
* This file contains classes and function for the "result categories" management.
*
* @package    use_disagram
* @subpackage business_process
* @version    1.0
* @date       02 Octobre 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the "result categories" management.
*/
class object_result_category extends BUS_object
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
		$this->tableSet('dmg_result_category');
		$this->joinTableSet('dmg_domain', 'id','dmg_result_category','domain_id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('domain_id');
		$this->fieldTableSet('domain_name','dmg_domain','name');
		$this->fieldTableSet('name');
		$this->fieldAttrSet('name', 'string', array(
			'required' => true,
			'size' => 20,
			'case' => 'upper'));
		$this->fieldTableSet('sequence');
		$this->fieldAttrSet('sequence', 'integer');
		$this->fieldTableSet('label');
		$this->fieldAttrSet('label', 'string', array(
			'size' => 100));
		$this->fieldTableSet('description');
		$this->fieldAttrSet('description', 'text');

		$this->fieldCompoSet('code', 'append', 'domain_name');
		$this->fieldCompoSet('code', 'append', ' - ');
		$this->fieldCompoSet('code', 'append', 'name');

		$this->whereTableSet('name');
		$this->whereTableSet('label');
		
		$this->orderTableSet(0,'domain_id');
		$this->orderTableSet(0,'sequence');
		$this->orderTableSet(0,'name');
		$this->orderTableSet(0,'id');
	}

    private static function _maxSequence($domainId)
    {
		$tbCategory = new Smart_select('dmg_result_category', 'dgm');
		$tbCategory->fieldSet('id');
		$tbCategory->fieldSet('name');
		$tbCategory->fieldSet('label');
		$tbCategory->fieldSet('sequence');
		$tbCategory->whereSet('domain_id',$domainId);
		$tbCategory->orderSet('sequence','DESC');
		$returnList = $tbCategory->find();
		$sequence = $returnList['sequence'];
		return $sequence;
	}

     public static function _copy($categoryId, $newDomainId, $newName = '') {
		$newCategoryId = 0;
		
		$tbCategory = new Smart_select('dmg_result_category', 'dgm');
		$tbCategory->fieldSet('id');
		$tbCategory->fieldSet('domain_id');
		$tbCategory->fieldSet('name');
		$tbCategory->fieldSet('sequence');
		$tbCategory->fieldSet('label');
		$tbCategory->fieldSet('description');
		$tbCategory->whereSet('id',$categoryId);
		$category = $tbCategory->find();

		$categoryDomainId = $category['domain_id'];
		$categoryName = $category['name'];
		$categorySequence= $category['sequence'];
		$categoryLabel = $category['label'];
		$categoryDescription = $category['description'];
		if (empty($newName)) {
			$newName = $category['name'];
		}
		
		$tbCategory = new Smart_select('dmg_result_category', 'dgm');
		$tbCategory->fieldSet('id');
		$tbCategory->whereSet('domain_id',$newDomainId);
		$tbCategory->whereSet('name',$newName, 'and');
		$category = $tbCategory->find();
		if (empty($category)) {
			$sequence = self::_maxSequence($newDomainId);

			$tbCategory = new Smart_record('dmg_result_category', 'dgm');
			$tbCategory->fieldSet('domain_id', $newDomainId);
			$tbCategory->fieldSet('name', $newName);
			$tbCategory->fieldSet('sequence', $sequence + 1);
			$tbCategory->fieldSet('label', $categoryLabel);
			$tbCategory->fieldSet('description', $categoryDescription);
			$newCategoryId = $tbCategory->insert();
		
		}
		return $newCategoryId;
	}

    public function copy($categoryId)
    {
		$newCategoryId = 0;
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('info', $this->dbnameGet() . ' - Object Insert for ' . $this->nameGet(),  __CLASS__, func_get_args(), 'arguments');

		$argArray = array();
		$db = PDO_extend::ws_open('dgm');
		try {
			$db->beginTransaction();
			$tbCategory = new Smart_record('dmg_result_category', 'dgm');
			$argArray = $tbCategory->findId('id', $categoryId);
			if ($argArray) {
				$name = $argArray['name'];
				$newName = $name . '-1';
				$newDomainId = $argArray['domain_id'];
				$newCategoryId = self::_copy($categoryId, $newDomainId, $newName);
			}
		}
		catch (exception $e) {
			$newCategoryId = 0;
		}
		if ($newCategoryId != 0) {
			$db->commit();
			$fct_return->returnSet($newCategoryId);
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
		$sequence = self::_maxSequence($domainId);
		$this->valueSet('sequence',$sequence + 1);
		$fct_return = parent::insert($argArray);
		return $fct_return;
	}
	
    public function organizeSequence($domainId)
    {
		$tbCategory = new Smart_select('dmg_result_category', 'dgm');
		$tbCategory->fieldSet('id');
		$tbCategory->fieldSet('sequence');
		$tbCategory->whereSet('domain_id',$domainId);
		$tbCategory->orderSet('sequence');

		$tbCategory_item = new Smart_record('dmg_result_category', 'dgm');
		$sequence = 1;
		$returnList = $tbCategory->findAll();
		for ($i=0; $i < count($returnList); $i++) {
			$tbCategory_item->idSet($returnList[$i]['id']);
			$tbCategory_item->fieldSet('sequence', $sequence);
			$tbCategory_item->update();			
			$sequence = $sequence + 1;
		}
	}

    public function levelUp($id)
    {
		$fct_return = new Return_function;
		$tbCategory = new Smart_select('dmg_result_category', 'dgm');
		$tbCategory->fieldSet('domain_id');
		$tbCategory->fieldSet('name');
		$tbCategory->fieldSet('label');
		$tbCategory->fieldSet('sequence');
		$tbCategory->whereSet('id',$id);
		$return = $tbCategory->find();
		
		$sequence = $return['sequence'];
		$domainId = $return['domain_id'];
		$sequence = $sequence - 1.5;
		$tbCategory = new Smart_record('dmg_result_category', 'dgm');
		$tbCategory->idSet($id);
		$tbCategory->fieldSet('sequence', $sequence);
		$tbCategory->update();
		$this->organizeSequence($domainId);
		return $fct_return;
	}
}