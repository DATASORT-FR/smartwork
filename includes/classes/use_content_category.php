<?php
/**
* This file contains classes and functions for the content category management.
*
* @package   content_category
* @version   1.0
* @date      17 May 2017
* @author    Alain VANDEPUTTE
* @copyright datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the content category management.
*/
class object_content_category extends BUS_object
{

	/**
	* constructor object_content
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet('Page');
		$this->dbnameSet('content');
		$this->idSet('id');
		$this->creationDateSet('date_creation');
		$this->updateDateSet('date_update');
		$this->changeDateSet('date_status', 'status_id');
		$this->selectLabelFieldSet('label');

		/* Table structure for the object */
		$this->tableSet('tb_category','cms_category');
		$this->tableSet('tb_status','cms_status');
		$this->tableSet('tb_parent','cms_category');
		
		$this->joinTableSet('tb_status', 'id','tb_category','status_id');
		$this->joinTableSet('tb_parent', 'id','tb_category','parent_id');		

		$this->fieldTableSet('id');
		$this->fieldTableSet('date_creation');
		$this->fieldAttrSet('date_creation', 'date', array(
			'auto' => true));
		$this->fieldTableSet('date_update');
		$this->fieldAttrSet('date_update', 'date', array(
			'auto' => true));
		$this->fieldTableSet('application_id');
		$this->fieldTableSet('code');
		$this->fieldAttrSet('code', 'string', array(
			'required' => true,
			'size' => 10,
			'case' => 'upper'));
		$this->fieldTableSet('status_id');
		$this->fieldAttrSet('status_id', 'integer');
		$this->fieldTableSet('status', 'tb_status', 'label');
		$this->fieldTableSet('date_status');
		$this->fieldAttrSet('date_status', 'date');

		$this->fieldTableSet('parent_id');
		$this->fieldAttrSet('parent_id', 'integer');
		$this->fieldTableSet('parent', 'tb_parent', 'code');

		$this->fieldTableSet('label');
		$this->fieldAttrSet('label', 'string', array(
			'size' => 100));
		$this->fieldTableSet('description');
		
		$this->whereTableSet('code');
		$this->whereTableSet('label');

		$this->orderTableSet(0,'application_id');
		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'application_id');
		$this->orderTableSet(1,'code');
		$this->orderTableSet(1,'id');
		$this->orderTableSet(2,'application_id');
		$this->orderTableSet(2,'label');
		$this->orderTableSet(2,'id');		
	}

}