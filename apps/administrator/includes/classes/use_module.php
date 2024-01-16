<?php
/**
* This file contains classes and function for the modules management.
*
* @package   administration_module
* @version    1.1
* @date       25 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the modules management.
*/
class object_module extends BUS_object
{

	/**
	* constructor adm_module
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->idSet('id');
		$this->selectLabelFieldSet('title');

		/* Table structure for the object */
		$this->tableSet('adm_module');

		$this->fieldTableSet('id');
		$this->fieldTableSet('code');
		$this->fieldAttrSet('code', 'string', array(
			'required' => true,
			'size' => 10,
			'case' => 'upper'));
		$this->fieldTableSet('label');
		$this->fieldAttrSet('label', 'string', array(
			'size' => 50));
		$this->fieldCompoSet('title', 'append', 'code');
		$this->fieldCompoSet('title', 'append', ' - ');
		$this->fieldCompoSet('title', 'append', 'label');

		$this->whereTableSet('code');
		$this->whereTableSet('label');
		

		$this->orderTableSet(0,'code');
		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'label');
		$this->orderTableSet(1,'id');
		$this->orderTableSet(2,'id');
		
	}

}