<?php
/**
* This file contains classes and function for the applications management.
*
* @package    administration_task
* @version    1.2
* @date       27 Juillet 2023
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the applications management.
*/

class object_task extends BUS_object
{

	/**
	* constructor adm_application
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->dbnameSet('task');
		$this->idSet('id');
		$this->creationDateSet('date_creation');
		$this->updateDateSet('date_update');
		$this->changeDateSet('date_status', 'status_id');

		/* Table structure for the object */
		$this->tableSet('tb_task', 'adm_task');
		$this->tableSet('tb_task_type','adm_task_type');
		$this->tableSet('tb_task_operation','adm_task_operation');
		$this->tableSet('tb_task_status','adm_task_status');
		$this->tableSet('tb_task_return','adm_task_return');
		
		$this->joinTableSet('tb_task_type', 'id','tb_task','type_id');
		$this->joinTableSet('tb_task_operation', 'id','tb_task','operation_id');
		$this->joinTableSet('tb_task_status', 'id','tb_task','status_id');
		$this->joinTableSet('tb_task_return', 'id','tb_task','return_id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('date_creation');
		$this->fieldAttrSet('date_creation', 'date', array(
			'auto' => true));
		$this->fieldTableSet('date_update');
		$this->fieldAttrSet('date_update', 'date', array(
			'auto' => true));

		$this->fieldTableSet('type_id');
		$this->fieldTableSet('type_code', 'tb_task_type', 'code');
		$this->fieldFctSet('type', 'workspace::codeToLabel', 'type_code');
		
		$this->fieldTableSet('operation_id');
		$this->fieldTableSet('operation_code', 'tb_task_operation', 'code');
		$this->fieldFctSet('operation', 'workspace::codeToLabel', 'operation_code');

		$this->fieldTableSet('status_id');
		$this->fieldTableSet('status_code', 'tb_task_status', 'code');
		$this->fieldFctSet('status', 'workspace::codeToLabel', 'status_code');
		
		$this->fieldTableSet('date_status');
		$this->fieldAttrSet('date_status', 'date', array(
			'auto' => true));
			
		$this->fieldTableSet('return_id');
		$this->fieldTableSet('return_code', 'tb_task_return', 'code');
		$this->fieldFctSet('return', 'workspace::codeToLabel', 'return_code');

		$this->fieldTableSet('code');
		$this->fieldAttrSet('code', 'string', array(
			'size' => 10,
			'case' => 'upper'));

		$this->fieldTableSet('name');
		$this->fieldAttrSet('name', 'string', array(
			'size' => 50));
		$this->fieldTableSet('source_id');
		$this->fieldAttrSet('source_id', 'integer');
		$this->fieldTableSet('target_id');
		$this->fieldAttrSet('target_id', 'integer');
		$this->fieldTableSet('parameters');

		$this->orderTableSet(0,'date_creation');
		$this->orderTableSet(0,'name');
		$this->orderTableSet(0,'id');
	}

}