<?php
/**
* This file contains classes and function for the task operation management.
*
* @package    administration_task
* @version    1.0
* @date       29 July 2023
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the task operation management.
*/

class object_task_operation extends BUS_object
{

	/**
	* constructor task_operation
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
		$this->tableSet('tb_task_operation', 'adm_task_operation');
		$this->tableSet('tb_task_type','adm_task_type');
		
		$this->joinTableSet('tb_task_type', 'id','tb_task_operation','type_id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('type_id');
		$this->fieldTableSet('type_code', 'tb_task_type', 'code');
		$this->fieldFctSet('type', 'workspace::codeToLabel', 'type_code');
		$this->fieldTableSet('code');
		$this->fieldAttrSet('code', 'string', array(
			'size' => 10,
			'case' => 'upper'));
		$this->fieldFctSet('label', 'workspace::codeToLabel', 'code');

		$this->whereTableSet('label');

		$this->orderTableSet(0,'id');
	}
}