<?php
/**
* This file contains classes and function for the forum status management.
*
* @package    forum_administration
* @version    1.0
* @date       29 December 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the forum status management.
*/

class object_forum_status extends BUS_object
{

	/**
	* constructor frm_status
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->dbnameSet('forum');
		$this->idSet('id');
		$this->selectLabelFieldSet('label');

		/* Table structure for the object */
		$this->tableSet('frm_status');

		$this->fieldTableSet('id');
		$this->fieldTableSet('label');
		$this->fieldAttrSet('label', 'string', array(
			'size' => 100));

		$this->whereTableSet('label');

		$this->orderTableSet(0,'id');
	}
}