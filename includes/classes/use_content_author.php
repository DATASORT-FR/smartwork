<?php
/**
* This file contains classes and functions for the content author management.
*
* @package   content_author
* @version   1.0
* @date      17 May 2017
* @author    Alain VANDEPUTTE
* @copyright datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the content category management.
*/
class object_content_author extends BUS_object
{

	/**
	* constructor object_content
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

		$this->fieldTableSet('id');
		$this->fieldTableSet('lastname');
		$this->fieldAttrSet('lastname', 'string', array(
			'required' => true,
			'size' => 32));
		$this->fieldTableSet('firstname');
		$this->fieldAttrSet('firstname', 'string', array(
			'size' => 32));
		$this->fieldTableSet('surname');
		$this->fieldAttrSet('surename', 'string', array(
			'size' => 50));
		$this->fieldTableSet('email');
		$this->fieldAttrSet('email', 'string', array(
			'required' => true,
			'size' => 50));

		$this->fieldCompoSet('label','append','firstname');
		$this->fieldCompoSet('label','append',' ');
		$this->fieldCompoSet('label','append','lastname');

		$this->whereTableSet('lastname');
		$this->whereTableSet('firstname');

		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'lastname');
		$this->orderTableSet(1,'firstname');
		$this->orderTableSet(1,'id');
		$this->orderTableSet(2,'email');
		$this->orderTableSet(2,'id');
	}

}