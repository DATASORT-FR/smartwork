<?php
/**
* This file contains classes and function for the features management.
*
* @package    administration_feature
* @version    1.1
* @date       25 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the features management.
*/
class object_feature extends BUS_object
{

	/**
	* constructor adm_feature
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->idSet('id');
		$this->selectLabelFieldSet('title');

		/* Table structure for the object */
		$this->tableSet('adm_feature');
		$this->joinTableSet('adm_application', 'id','adm_feature','application_id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('code');
		$this->fieldAttrSet('code', 'string', array(
			'required' => true,
			'size' => 10,
			'case' => 'upper'));
		$this->fieldTableSet('label');
		$this->fieldAttrSet('label', 'string', array(
			'size' => 50));
		$this->fieldTableSet('application_id');
		$this->fieldTableSet('application', 'adm_application', 'code');
		$this->fieldCompoSet('title', 'append', 'code');
		$this->fieldCompoSet('title', 'append', ' - ');
		$this->fieldCompoSet('title', 'append', 'label');

		$this->whereTableSet('code');
		$this->whereTableSet('label');
		

		$this->orderTableSet(0,'application');
		$this->orderTableSet(0,'code');
		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'code');
		$this->orderTableSet(1,'id');
		$this->orderTableSet(2,'label');
		$this->orderTableSet(2,'id');
		$this->orderTableSet(3,'id');
		
	}

}