<?php
/**
* This file contains classes and function for the results management.
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
* Classes for the results management.
*/

class object_result extends BUS_object
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
		$this->tableSet('dmg_result');
		$this->joinTableSet('dmg_field', 'id','dmg_result','field_id');
		$this->joinTableSet('dmg_domain', 'id','dmg_field','domain_id');
		$this->joinTableSet('dmg_result_category', 'id','dmg_field','category_id');
		$this->joinTableSet('dmg_result_type', 'id','dmg_field','type_id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('domain_id','dmg_field','domain_id');
		$this->fieldTableSet('domain_name','dmg_domain','name');
		$this->fieldTableSet('field_id');
		$this->fieldTableSet('name','dmg_field','name');
		$this->fieldTableSet('category_id','dmg_field','category_id');
		$this->fieldTableSet('category_name','dmg_result_category','name');
		$this->fieldTableSet('type_id','dmg_field','type_id');
		$this->fieldTableSet('type','dmg_result_type','code');
		$this->fieldTableSet('sequence', 'dmg_field', 'sequence');
		$this->fieldAttrSet('sequence', 'integer');
		$this->fieldTableSet('nodisplay', 'dmg_field', 'nodisplay');
		$this->fieldAttrSet('nodisplay', 'boolean');
		$this->fieldTableSet('display_func', 'dmg_field', 'display_func');
		$this->fieldAttrSet('display_func', 'text');
		$this->fieldTableSet('label','dmg_field','label');

		$this->fieldTableSet('formula');
		$this->fieldAttrSet('formula', 'text');
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