<?php
/**
* This file contains classes and function for the domains management.
*
* @package    use_domain
* @subpackage business_process
* @version    1.0
* @date       20 février 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the diagrams management.
*/
class object_domain extends BUS_object
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
		$this->tableSet('dmg_domain');

		$this->fieldTableSet('id');
		$this->fieldTableSet('company_id');
		$this->fieldTableSet('diagram_name','dmg_domain','name');
		$this->fieldTableSet('name');
		$this->fieldAttrSet('name', 'string', array(
			'required' => true,
			'size' => 20,
			'case' => 'upper'));
		$this->fieldTableSet('label');
		$this->fieldAttrSet('label', 'string', array(
			'size' => 100));

		$this->fieldCompoSet('code', 'append', 'name');
		$this->fieldCompoSet('code', 'append', ' - ');
		$this->fieldCompoSet('code', 'append', 'label');

		$this->whereTableSet('name');
		$this->whereTableSet('label');
		
		$this->orderTableSet(0,'id');	
		$this->orderTableSet(1,'name');
		$this->orderTableSet(1,'id');
	}

     public static function _copy($domainId, $newName = '') {
		$newDomainId = 0;

		$tbDomain = new Smart_select('dmg_domain', 'dgm');
		$tbDomain->fieldSet('name');
		$tbDomain->fieldSet('label');
		$tbDomain->fieldSet('company_id');
		$tbDomain->whereSet('id',$domainId);
		$domain = $tbDomain->find();

		$name = $domain['name'];
		$label = $domain['label'];
		$companyId = $domain['company_id'];
		if (empty($newName)) {
			$newName = $name;
		}

		$tbDomain = new Smart_select('dmg_domain', 'dgm');
		$tbDomain->fieldSet('id');
		$tbDomain->whereSet('name',$newName);
		$domain = $tbDomain->find();
		if (empty($domain)) {
			$tbDomain = new Smart_record('dmg_domain', 'dgm');
			$tbDomain->fieldSet('name', $newName);
			$tbDomain->fieldSet('label', $label);
			$tbDomain->fieldSet('company_id', $companyId);
			$newDomainId = $tbDomain->insert();

			if ($newDomainId != 0) {
				$tbCategory = new Smart_select('dmg_variable_category', 'dgm');
				$tbCategory->fieldSet('id');
				$tbCategory->whereSet('domain_id',$domainId);
				$tbCategory->orderSet('sequence');
				$categoryList = $tbCategory->findAll();		
				for ($i=0; $i < count($categoryList); $i++) {
					$newCategoryId = 0;
					$category = $categoryList[$i];
					$categoryId = $category['id'];
					$newCategoryId = object_variable_category::_copy($categoryId, $newDomainId);
					if ($newCategoryId == 0) {
						$newDomainId = 0;
						break;
					}
				}
			}

			if ($newDomainId != 0) {
				$tbCategory = new Smart_select('dmg_result_category', 'dgm');
				$tbCategory->fieldSet('id');
				$tbCategory->whereSet('domain_id',$domainId);
				$tbCategory->orderSet('sequence');
				$categoryList = $tbCategory->findAll();		
				for ($i=0; $i < count($categoryList); $i++) {
					$newCategoryId = 0;
					$category = $categoryList[$i];
					$categoryId = $category['id'];
					$newCategoryId = object_result_category::_copy($categoryId, $newDomainId);
					if ($newCategoryId == 0) {
						$newDomainId = 0;
						break;
					}
				}
			}

			if ($newDomainId != 0) {
				$tbField = new Smart_select('dmg_field', 'dgm');
				$tbField->fieldSet('id');
				$tbField->fieldSet('nature');
				$tbField->whereSet('domain_id',$domainId);
				$tbField->orderSet('nature');
				$tbField->orderSet('category_id');
				$tbField->orderSet('sequence');
				$fieldList = $tbField->findAll();		
				for ($i=0; $i < count($fieldList); $i++) {
					$newFieldId = 0;
					$field = $fieldList[$i];
					$fieldId = $field['id'];
					switch ($field['nature']) {
						case 1 :
							$newFieldId = object_field_variable::_copy($fieldId, $newDomainId);
							break;
						case 2 :
							$newFieldId = object_field_table::_copy($fieldId, $newDomainId);
							break;
						case 3 :
							$newFieldId = object_field_result::_copy($fieldId, $newDomainId);
							break;
					}
					if ($newFieldId == 0) {
						$newDomainId = 0;
						break;
					}
				}
			}
	
			if ($newDomainId != 0) {
				$tbDiagram = new Smart_select('dmg_diagram', 'dgm');
				$tbDiagram->fieldSet('id');
				$tbDiagram->whereSet('domain_id',$domainId);
				$diagramList = $tbDiagram->findAll();		
				for ($i=0; $i < count($diagramList); $i++) {
					$newDiagramId = 0;
					$diagram = $diagramList[$i];
					$diagramId = $diagram['id'];
					$newDiagramId = object_diagram::_copy($diagramId, $newDomainId);
					if ($newDiagramId == 0) {
						$newDomainId = 0;
						break;
					}
				}
			}

			if ($newDomainId != 0) {
				$tbContent = new Smart_select('dmg_content', 'dgm');
				$tbContent->fieldSet('id');
				$tbContent->fieldSet('type_id');
				$tbContent->whereSet('domain_id',$domainId);
				$tbContent->orderSet('type_id');
				$tbContent->orderSet('id');
				$contentList = $tbContent->findAll();		
				for ($i=0; $i < count($contentList); $i++) {
					$newContentId = 0;
					$content = $contentList[$i];
					$contentId = $content['id'];
					$contentTypeId = $content['type_id'];
					switch ($contentTypeId) {
						case 1 :
							$newContentId = object_notice::_copy($contentId, $newDomainId);
							break;
						case 2 :
							$newContentId = object_question::_copy($contentId, $newDomainId);
							break;
						case 3 :
							$newContentId = object_content::_copy($contentId, $newDomainId);
							break;
						case 4 :
							$newContentId = object_processus::_copy($contentId, $newDomainId);
							break;
					}
					if ($newContentId == 0) {
						$newDomainId = 0;
						break;
					}
				}
			}
		}
		return $newDomainId;
	}

    public function copy($domainId)
    {
		$newDomainId = 0;
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('info', $this->dbnameGet() . ' - Object Insert for ' . $this->nameGet(),  __CLASS__, func_get_args(), 'arguments');

		$argArray = array();
		$db = PDO_extend::ws_open('dgm');
		try {
			$db->beginTransaction();
			$tbDomain = new Smart_record('dmg_domain', 'dgm');
			$argArray = $tbDomain->findId('id', $domainId);
			if ($argArray) {
				$name = $argArray['name'];
				$newName = $name . '-1';
				$newDomainId = self::_copy($domainId, $newName);
			}
		}
		catch (exception $e) {
			$newDomainId = 0;
		}
		if ($newDomainId != 0) {
			$db->commit();
			$fct_return->returnSet($newDomainId);
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

   public static function _delete($domainId) {
		$tbDiagram = new Smart_select('dmg_diagram', 'dgm');
		$tbDiagram->fieldSet('id');
		$tbDiagram->whereSet('domain_id',$domainId);
		$diagramList = $tbDiagram->findAll();
		for ($n=0; $n < count($diagramList); $n++) {
			$item = $diagramList[$n];
			$diagramId = $item['id'];
			object_diagram::_delete($diagramId);
		}
				
		$tbField = new Smart_select('dmg_field', 'dgm');
		$tbField->fieldSet('id');
		$tbField->fieldSet('nature');
		$tbField->whereSet('domain_id',$domainId);
		$fieldList = $tbField->findAll();
		for ($i=0; $i < count($fieldList); $i++) {
			$item = $fieldList[$i];
			$fieldId = $item['id'];
			$fieldNature = $item['nature'];
			object_field::_delete($fieldId, $fieldNature);
		}
				
		$tbDomain = new Smart_record('dmg_domain', 'dgm');
		$tbDomain->idSet($domainId);
		$tbDomain->delete();
	}
	
    public function delete($domainId, $dbName = '')
	{
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('info', $this->dbnameGet() . ' - Object Insert for ' . $this->nameGet(),  __CLASS__, func_get_args(), 'arguments');

		$item = array();

		$argArray = array();
		$db = PDO_extend::ws_open('dgm');
		try {
			$db->beginTransaction();
			$tbDomain = new Smart_record('dmg_domain', 'dgm');
			$argArray = $tbDomain->findId('id', $domainId);
			if ($argArray) {
				self::_delete($domainId);
			}
			else {
				$domainId = 0;
			}
		}
		catch (exception $e) {
			$domainId = 0;
		}
		if ($domainId != 0) {
			$db->commit();
			$fct_return->returnSet($domainId);
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