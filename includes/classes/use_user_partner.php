<?php
/**
* This file contains classes and function for the users partners management.
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
class object_user_partner extends BUS_object
{

	/**
	* constructor adm_user_partner
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->idSet('id');

		/* Table structure for the object */
		$this->tableSet('adm_user_partner');
		$this->joinTableSet('adm_partner', 'id','adm_user_partner','partner_id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('user_id');
		$this->fieldTableSet('partner_id');
		$this->fieldTableSet('partner_code', 'adm_partner', 'code');
		$this->fieldTableSet('partner_label', 'adm_partner', 'label');

		$this->whereTableSet('partner_code');
		$this->whereTableSet('partner_label');

		$this->orderTableSet(0,'partner_code');
		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'partner_label');
		$this->orderTableSet(1,'id');
		$this->orderTableSet(2,'id');
	}

}