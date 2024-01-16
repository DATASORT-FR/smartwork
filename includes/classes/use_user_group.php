<?php
/**
* This file contains classes and functions for the users groups management.
*
* @package    administration_user
* @version    1.2
* @date       25 juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Class for user management.
*/
class object_user_group extends BUS_object
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
		$this->tableSet('adm_user_group');
		$this->joinTableSet('adm_group', 'id','adm_user_group','group_id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('user_id');
		$this->fieldTableSet('group_id');
		$this->fieldTableSet('group_code', 'adm_group', 'code');
		$this->fieldTableSet('group_label', 'adm_group', 'label');

		$this->whereTableSet('group_code');
		$this->whereTableSet('group_label');

		$this->orderTableSet(0,'group_code');
		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'group_label');
		$this->orderTableSet(1,'id');
		$this->orderTableSet(2,'id');
	}

}