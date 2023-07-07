<?php
/**
* This file contains classes and function for the variables management.
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
* Classes for the variables management.
*/

class object_variable extends BUS_object
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
		$this->tableSet('dmg_variable');
		$this->joinTableSet('dmg_field', 'id','dmg_variable','field_id');
		$this->joinTableSet('dmg_domain', 'id','dmg_field','domain_id');
		$this->joinTableSet('dmg_variable_category', 'id','dmg_field','category_id');
		$this->joinTableSet('dmg_variable_type', 'id','dmg_field','type_id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('domain_id','dmg_field','domain_id');
		$this->fieldTableSet('domain_name','dmg_domain','name');
		$this->fieldTableSet('field_id');
		$this->fieldTableSet('name','dmg_field','name');
		$this->fieldTableSet('category_id','dmg_field','category_id');
		$this->fieldTableSet('category_name','dmg_variable_category','name');
		$this->fieldTableSet('type_id','dmg_field','type_id');
		$this->fieldTableSet('type','dmg_variable_type','code');
		$this->fieldTableSet('sequence', 'dmg_field', 'sequence');
		$this->fieldAttrSet('sequence', 'integer');
		$this->fieldTableSet('nodisplay', 'dmg_field', 'nodisplay');
		$this->fieldAttrSet('nodisplay', 'boolean');
		$this->fieldTableSet('display_func', 'dmg_field', 'display_func');
		$this->fieldAttrSet('display_func', 'text');
		$this->fieldTableSet('label','dmg_field','label');
		$this->fieldTableSet('no_label', 'dmg_field', 'nodisplay');
		$this->fieldAttrSet('no_label', 'boolean');

		$this->fieldTableSet('size');
		$this->fieldAttrSet('size', 'integer');
		$this->fieldTableSet('format');
		$this->fieldAttrSet('format', 'string', array(
			'size' => 20));
		$this->fieldTableSet('mandatory');
		$this->fieldAttrSet('mandatory', 'boolean');
		$this->fieldTableSet('value');
		$this->fieldAttrSet('value', 'text');
		$this->fieldTableSet('object_items');
		$this->fieldAttrSet('object_items', 'text');
		$this->fieldTableSet('nolabel');
		$this->fieldAttrSet('nolabel', 'boolean');

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