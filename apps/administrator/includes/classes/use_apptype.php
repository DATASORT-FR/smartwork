<?php
/**
* This file contains classes and function for the app type management.
*
* @package    administration_application
* @version    1.2
* @date       10 Février 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the applications management.
*/
class object_apptype extends BUS_object
{

	/**
	* constructor adm_application
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
//		$this->idSet('id');
		$this->selectLabelFieldSet('label');
		/* Table structure for the object */
		$this->tableSet('adm_apptype');
		$this->fieldTableSet('id');
		$this->fieldTableSet('code');
		$this->fieldAttrSet('code', 'string', array(
			'required' => true,
			'size' => 10,
			'case' => 'upper'));
		$this->fieldTableSet('label');
		$this->fieldAttrSet('label', 'string', array(
			'size' => 50));
			
		$this->whereTableSet('code');

		$this->orderTableSet(0,'code');
		$this->orderTableSet(0,'id');

	}

}