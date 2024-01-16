<?php
/**
* This file contains classes and function for the task status management.
*
* @package    administration_task
* @version    1.0
* @date       29 July 2023
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the task status management.
*/

class object_task_status extends BUS_object
{

	/**
	* constructor task_status
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->dbnameSet('task');
		$this->idSet('id');
		$this->selectLabelFieldSet('label');

		/* Table structure for the object */
		$this->tableSet('tb_task_status', 'adm_task_status');

		$this->fieldTableSet('id');
		$this->fieldTableSet('code');
		$this->fieldAttrSet('code', 'string', array(
			'size' => 10,
			'case' => 'upper'));
		$this->fieldFctSet('label', 'workspace::codeToLabel', 'code');

		$this->whereTableSet('label');

		$this->orderTableSet(0,'id');
	}
}