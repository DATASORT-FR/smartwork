<?php
/**
* This file contains classes and function for the tables management.
*
* @package    use_field
* @subpackage business_process
* @version    1.0
* @date       02 Septembre 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the tables management.
*/

class object_table extends BUS_object
{

	/**
	* constructor adm_application
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->dbnameSet('dgm');
		$this->idSet('id');

		/* Table structure for the object */
		$this->tableSet('dmg_table');
		$this->joinTableSet('dmg_field', 'id','dmg_table','field_id');
		$this->joinTableSet('dmg_domain', 'id','dmg_field','domain_id');
		$this->joinTableSet('dmg_table_type', 'id','dmg_field','type_id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('domain_id','dmg_field','domain_id');
		$this->fieldTableSet('domain_name','dmg_domain','name');
		$this->fieldTableSet('field_id');
		$this->fieldTableSet('name','dmg_field','name');
		$this->fieldTableSet('type_id','dmg_field','type_id');
		$this->fieldTableSet('type','dmg_table_type','code');
		$this->fieldTableSet('label','dmg_field','label');

		$this->fieldTableSet('col1_field');
		$this->fieldTableSet('col1_byrange');
		$this->fieldAttrSet('col1_byrange', 'boolean');

		$this->fieldTableSet('col2_field');
		$this->fieldTableSet('col2_byrange');
		$this->fieldAttrSet('col2_byrange', 'boolean');

		$this->fieldTableSet('col3_field');
		$this->fieldTableSet('col3_byrange');
		$this->fieldAttrSet('col3_byrange', 'boolean');

		$this->fieldTableSet('formula_func');
		$this->fieldAttrSet('formula_func', 'text');

		$this->fieldCompoSet('code', 'append', 'domain_name');
		$this->fieldCompoSet('code', 'append', ' - ');
		$this->fieldCompoSet('code', 'append', 'name');

		$this->whereTableSet('name');
		$this->whereTableSet('label');

		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'domain_id');
		$this->orderTableSet(1,'name');
		$this->orderTableSet(1,'id');
	}

}