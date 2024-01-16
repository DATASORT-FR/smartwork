<?php
/**
* This file contains classes and function for the users management.
*
* @package    administration_application
* @version    1.2
* @date       12 November 2019
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the users management.
*/
class object_application_status extends BUS_object
{

	/**
	* constructor object_adm_user
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->idSet('id');

		/* Table structure for the object */
		$this->tableSet('adm_application_status');

		$this->fieldTableSet('id');
		$this->fieldTableSet('label');
		$this->fieldAttrSet('label', 'string', array(
			'required' => true,
			'size' => 50));
			
		$this->orderTableSet(0,'id');

	}
	
}