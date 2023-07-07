<?php
/**
* This file contains classes and function for the question management.
*
* @package    use_question
* @subpackage business_process
* @version    1.0
* @date       05 May 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the questions management.
*/
class object_question extends BUS_object
{

	/**
	* constructor questions
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
		$this->tableSet('dmg_content');
		$this->joinTableSet('dmg_domain', 'id','dmg_content','domain_id');
		$this->joinTableSet('dmg_content_type', 'id','dmg_content','type_id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('domain_id');
		$this->fieldTableSet('domain_name','dmg_domain','name');
		$this->fieldTableSet('type_id');
		$this->fieldAttrSet('type_id', 'integer');
		$this->filterSet('type_id', 2);
		$this->fieldTableSet('type','dmg_content_type','code');
		$this->fieldTableSet('label');
		$this->fieldAttrSet('label', 'string', array(
			'required' => true,
			'size' => 100));
		$this->fieldTableSet('title');
		$this->fieldAttrSet('title', 'string', array(
			'required' => true,
			'size' => 100));
		$this->fieldTableSet('image');
		$this->fieldAttrSet('image', 'string', array(
			'size' => 255));
		$this->fieldTableSet('description');
		$this->fieldAttrSet('description', 'text');
		$this->fieldTableSet('comp_image');
		$this->fieldAttrSet('comp_image', 'string', array(
			'size' => 255));
		$this->fieldTableSet('comp_description');
		$this->fieldAttrSet('comp_description', 'text');

		$this->fieldCompoSet('code', 'append', 'label');
		$this->fieldCompoSet('title_code', 'append', 'label');
		$this->fieldCompoSet('title_code', 'append', ' (');
		$this->fieldCompoSet('title_code', 'append', 'id');
		$this->fieldCompoSet('title_code', 'append', ')');

		$this->whereTableSet('label');

		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'domain_id');
		$this->orderTableSet(1,'type_id');
		$this->orderTableSet(1,'label');
		$this->orderTableSet(1,'id');
	}

}