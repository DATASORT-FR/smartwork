<?php
/**
* This file contains classes and function for the users management.
*
* @package    administration_user
* @version    1.2
* @date       25 November 2013
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the users management.
*/
class object_user extends BUS_object
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
		$this->tableSet('adm_user');
		$this->joinTableSet('adm_user_status', 'id','adm_user','status_id');
		$this->joinTableSet('adm_application', 'id','adm_user','source_id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('date_creation');
		$this->fieldAttrSet('date_creation', 'date', array(
			'auto' => true));
		$this->fieldTableSet('date_update');
		$this->fieldAttrSet('date_update', 'date', array(
			'auto' => true));
		$this->fieldTableSet('status_id');
		$this->fieldAttrSet('status_id', 'boolean');
		$this->fieldTableSet('status','adm_user_status','label');
		$this->fieldTableSet('source_id');
		$this->fieldTableSet('source_code','adm_application','code');
		$this->fieldTableSet('source_label','adm_application','label');
		$this->fieldTableSet('surname');
		$this->fieldAttrSet('surname', 'string', array(
			'size' => 50));
		$this->fieldTableSet('lastname');
		$this->fieldAttrSet('lastname', 'string', array(
			'required' => true,
			'size' => 32));
		$this->fieldTableSet('firstname');
		$this->fieldAttrSet('firstname', 'string', array(
			'size' => 32));
		$this->fieldCompoSet('code', 'append', 'firstname');
		$this->fieldCompoSet('code', 'append', ' ');
		$this->fieldCompoSet('code', 'append', 'lastname');
		$this->fieldTableSet('email');
		$this->fieldAttrSet('email', 'string', array(
			'required' => true,
			'size' => 50));
		$this->fieldTableSet('login');
		$this->fieldAttrSet('login', 'string', array(
			'required' => true,
			'size' => 50));
		$this->fieldTableSet('password');
		$this->fieldAttrSet('password', 'encrypted', array(
			'required' => true,
			'encrypted' => true,
			'size' => 15));

		$this->whereTableSet('lastname');
		$this->whereTableSet('firstname');

		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'lastname');
		$this->orderTableSet(1,'firstname');
		$this->orderTableSet(1,'id');
		$this->orderTableSet(2,'partner_description');
		$this->orderTableSet(2,'lastname');
		$this->orderTableSet(2,'firstname');
		$this->orderTableSet(2,'id');
		$this->orderTableSet(3,'email');
		$this->orderTableSet(3,'id');

		/* linked objects */
		$this->joinObjectSet('object_user_partner', 'user_id', 'id');		
		$this->dataObjectSet('partner_list','object_user_partner','partner_id');

		$this->joinObjectSet('object_user_group', 'user_id', 'id');
		$this->dataObjectSet('group_list','object_user_group','group_id');


	}
	
}