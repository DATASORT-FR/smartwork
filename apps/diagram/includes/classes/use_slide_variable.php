<?php
/**
* This file contains classes and functions for the variables management on slide.
*
* @package    use_slide
* @subpackage business_process
* @version    1.0
* @date       02 March 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Class for user management.
*/
class object_slide_variable extends BUS_object
{

	/**
	* constructor adm_group
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->dbnameSet('dgm');
		$this->idSet('id');
		$this->selectLabelFieldSet('label');

		/* Table structure for the object */
		$this->tableSet('dmg_slide_variable');
		$this->joinTableSet('dmg_field', 'id','dmg_slide_variable','field_id');
		$this->joinTableSet('dmg_variable_category', 'id','dmg_field','category_id');
		$this->joinTableSet('dmg_variable', 'field_id','dmg_field','id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('type');
		$this->fieldAttrSet('type', 'integer');
		$this->filterSet('type', 0);
		$this->fieldTableSet('slide_id');
		$this->fieldTableSet('field_id');
		$this->fieldTableSet('name', 'dmg_field', 'name');
		$this->fieldTableSet('label', 'dmg_field', 'label');
		$this->fieldTableSet('type_id', 'dmg_field', 'type_id');

		$this->fieldTableSet('category_id', 'dmg_field', 'category_id');
		$this->fieldTableSet('category_sequence','dmg_variable_category','sequence');
		$this->fieldTableSet('category_name','dmg_variable_category','name');
		$this->fieldTableSet('category_label','dmg_variable_category','label');

		$this->fieldTableSet('sequence', 'dmg_field', 'sequence');
		$this->fieldTableSet('nodisplay', 'dmg_field', 'nodisplay');
		$this->fieldTableSet('line', 'dmg_field', 'line');
		$this->fieldTableSet('display_func', 'dmg_field', 'display_func');
		$this->fieldTableSet('no_label', 'dmg_field', 'no_label');
		$this->fieldTableSet('description', 'dmg_field', 'description');

		$this->fieldTableSet('variable_size','dmg_variable','size');
		$this->fieldTableSet('variable_format','dmg_variable','format');
		$this->fieldTableSet('variable_mandatory','dmg_variable','mandatory');
		$this->fieldTableSet('variable_value','dmg_variable','value');
		$this->fieldTableSet('variable_object_items','dmg_variable','object_items');
		$this->fieldTableSet('variable_nolabel','dmg_variable','nolabel');

		$this->whereTableSet('name');
		$this->whereTableSet('label');

		$this->orderTableSet(0,'name');
		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'label');
		$this->orderTableSet(1,'id');
		$this->orderTableSet(2,'id');
	}

}