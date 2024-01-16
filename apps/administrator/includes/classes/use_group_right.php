<?php
/**
* This file contains classes and functions for the menu management.
*
* @package   administration_group
* @version   1.2
* @date      25 November 2013
* @author    Alain VANDEPUTTE
* @copyright datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the users management.
*/
class object_group_right extends BUS_object
{

	/**
	* constructor adm_application
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->idSet('id');

		/* Table structure for the object */
		$this->tableSet('adm_group_right');
		$this->joinTableSet('adm_feature', 'id','adm_group_right','feature_id');
		$this->joinTableSet('adm_module', 'id','adm_group_right','module_id');
		$this->joinTableSet('adm_group', 'id','adm_group_right','group_id');
		$this->tableSet('adm_ref_yesno1','adm_ref_yesno');
		$this->joinTableSet('adm_ref_yesno1', 'id','adm_group_right','right_read');
		$this->tableSet('adm_ref_yesno2','adm_ref_yesno');
		$this->joinTableSet('adm_ref_yesno2', 'id','adm_group_right','right_create');
		$this->tableSet('adm_ref_yesno3','adm_ref_yesno');
		$this->joinTableSet('adm_ref_yesno3', 'id','adm_group_right','right_update');
		$this->tableSet('adm_ref_yesno4','adm_ref_yesno');
		$this->joinTableSet('adm_ref_yesno4', 'id','adm_group_right','right_delete');
		$this->tableSet('adm_ref_yesno5','adm_ref_yesno');
		$this->joinTableSet('adm_ref_yesno5', 'id','adm_group_right','right_event');
		
		$this->fieldTableSet('id');
		$this->fieldTableSet('group_id');
		$this->fieldTableSet('group_code','adm_group','code');
		$this->fieldTableSet('feature_id');
		$this->fieldTableSet('feature_code','adm_feature','code');
		$this->fieldTableSet('module_id');
		$this->fieldTableSet('module_code','adm_module','code');
		$this->fieldTableSet('right_read');
		$this->fieldAttrSet('right_read', 'boolean');
		$this->fieldTableSet('right_read_label','adm_ref_yesno1','label');
		$this->fieldTableSet('right_create');
		$this->fieldAttrSet('right_create', 'boolean');
		$this->fieldTableSet('right_create_label','adm_ref_yesno2','label');
		$this->fieldTableSet('right_update');
		$this->fieldAttrSet('right_update', 'boolean');
		$this->fieldTableSet('right_update_label','adm_ref_yesno3','label');
		$this->fieldTableSet('right_delete');
		$this->fieldAttrSet('right_delete', 'boolean');
		$this->fieldTableSet('right_delete_label','adm_ref_yesno4','label');
		$this->fieldTableSet('right_event');
		$this->fieldAttrSet('right_event', 'boolean');
		$this->fieldTableSet('right_event_label','adm_ref_yesno5','label');
		
		$this->fieldCompoSet('code','append','feature_code');
		$this->fieldCompoSet('code','append',' ');
		$this->fieldCompoSet('code','append','module_code');
		$this->fieldCompoSet('label','append','group_code');
		$this->fieldCompoSet('label','append','-');
		$this->fieldCompoSet('label','append','feature_code');
		$this->fieldCompoSet('label','append',' ');
		$this->fieldCompoSet('label','append','module_code');

		$this->whereTableSet('group_code');
		$this->whereTableSet('feature_code');

		$this->orderTableSet(0,'group_code');
		$this->orderTableSet(0,'feature_code');
		$this->orderTableSet(0,'module_code');
		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'id');
	}
}