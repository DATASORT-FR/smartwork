<?php
/**
* This file contains classes and function for the forum categories management.
*
* @package    forum_administration
* @version    1.0
* @date       29 December 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the forum categories management.
*/

class object_forum_category extends BUS_object
{

	/**
	* constructor frm_category
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->dbnameSet('forum');
		$this->idSet('id');
		$this->creationDateSet('date_creation');
		$this->updateDateSet('date_update');
		$this->selectLabelFieldSet('description');

		/* Table structure for the object */
		$this->tableSet('frm_category');

		$this->fieldTableSet('id');
		$this->fieldTableSet('date_creation');
		$this->fieldAttrSet('date_creation', 'date', array(
			'auto' => true));
		$this->fieldTableSet('date_update');
		$this->fieldAttrSet('date_update', 'date', array(
			'auto' => true));
		$this->fieldTableSet('application');
		$this->fieldAttrSet('application', 'string');
		$this->fieldTableSet('name');
		$this->fieldAttrSet('name', 'string', array(
			'size' => 30));
		$this->fieldTableSet('sequence');
		$this->fieldAttrSet('sequence', 'integer');
		$this->fieldTableSet('label');
		$this->fieldAttrSet('label', 'string', array(
			'size' => 100));

		$this->fieldCompoSet('description','append','application');
		$this->fieldCompoSet('description','append',' - ');
		$this->fieldCompoSet('description','append','name');

		$this->whereTableSet('name');
		$this->whereTableSet('label');

		$this->orderTableSet(0,'application');
		$this->orderTableSet(0,'sequence');
		$this->orderTableSet(0,'name');
		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'application');
		$this->orderTableSet(1,'name');
		$this->orderTableSet(1,'id');
		$this->orderTableSet(2,'id');
	}

    public function maxSequence($application='')
    {
		$tbCategory = new Smart_select('frm_category', 'forum');
		$tbCategory->fieldSet('id');
		$tbCategory->fieldSet('name');
		$tbCategory->fieldSet('label');
		$tbCategory->fieldSet('sequence');
		if (!empty($application)) {
			$tbCategory->whereSet('application',$application);
		}
		$tbCategory->orderSet('sequence', 'DESC');
		$returnList = $tbCategory->find();
		$sequence = $returnList['sequence'];
		return $sequence;
	}

    public function insert($argArray, $dbName='')
    {
		$application = '';
		if(isset($argArray['application'])) {
			$application = $argArray['application'];
		}
		$sequence = $this->maxSequence($application);
		$this->valueSet('sequence',$sequence + 1);
		$fct_return = parent::insert($argArray, $dbName);
		return $fct_return;
	}
	
    public function organizeSequence($application)
    {
		$tbCategory = new Smart_select('frm_category', 'forum');
		$tbCategory->fieldSet('id');
		$tbCategory->fieldSet('name');
		$tbCategory->fieldSet('sequence');
		$tbCategory->whereSet('application',$application);
		$tbCategory->orderSet('sequence');
		$returnList = $tbCategory->findAll();

		$tbCategoryItem = new Smart_record('frm_category', 'forum');
		$sequence = 1;
		for ($i=0; $i < count($returnList); $i++) {
			$tbCategoryItem->idSet($returnList[$i]['id']);
			$tbCategoryItem->fieldSet('sequence', $sequence);
			$tbCategoryItem->update();			
			$sequence = $sequence + 1;
		}
	}

    public function levelUp($id)
    {
		$fct_return = new Return_function;
		$tbCategory = new Smart_select('frm_category', 'forum');
		$tbCategory->fieldSet('application');
		$tbCategory->fieldSet('name');
		$tbCategory->fieldSet('label');
		$tbCategory->fieldSet('sequence');
		$tbCategory->whereSet('id',$id);
		$return = $tbCategory->find();
		
		$application = $return['application'];
		$sequence = $return['sequence'];
		$sequence = $sequence - 1.5;
		$tbCategory = new Smart_record('frm_category', 'forum');
		$tbCategory->idSet($id);
		$tbCategory->fieldSet('sequence', $sequence);
		$tbCategory->update();
		$this->organizeSequence($application);
		return $fct_return;
	}

}