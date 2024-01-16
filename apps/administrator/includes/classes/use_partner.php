<?php
/**
* This file contains classes and function for the companys management.
*
* @package   administration_partner
* @version    1.0
* @date       19 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the companys management.
*/
class object_partner extends BUS_object
{

	/**
	* constructor adm_company
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->idSet('id');

		/* Table structure for the object */
		$this->tableSet('adm_partner');

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
		$this->whereTableSet('label');

		$this->orderTableSet(0,'code');
		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'label');
		$this->orderTableSet(1,'code');
		$this->orderTableSet(1,'id');
		$this->orderTableSet(2,'id');
	}

}