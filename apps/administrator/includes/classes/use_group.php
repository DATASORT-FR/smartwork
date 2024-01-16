<?php
/**
* This file contains classes and functions for the rights groups management.
*
* @package   administration_group
* @version    1.2
* @date       25 November 2013
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Class for user management.
*/
class object_group extends BUS_object
{

	/**
	* constructor adm_group
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->idSet('id');

		/* Table structure for the object */
		$this->tableSet('adm_group');
		$this->joinTableSet('adm_application', 'id','adm_group','application_id');

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
		$this->fieldTableSet('application','adm_application','code');
		$this->fieldCompoSet('order', 'append','application');
		$this->fieldCompoSet('description', 'append','label');

		$this->whereTableSet('code');
		$this->whereTableSet('label');

		$this->orderTableSet(0,'application');
		$this->orderTableSet(0,'code');
		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'code');
		$this->orderTableSet(1,'id');
		$this->orderTableSet(2,'id');
	}

}