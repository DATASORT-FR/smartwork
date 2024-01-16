<?php
/**
* This file contains classes and functions for the menu management.
*
* @package   administration_application
* @version   1.3
* @date      09 Août 2016
* @author    Alain VANDEPUTTE
* @copyright datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the references management.
*/
class object_application_ref extends BUS_object
{

	/**
	* constructor adm_menu
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->idSet('id');

		/* Table structure for the object */
		$this->tableSet('adm_application_ref');
		$this->joinTableSet('adm_application', 'id','adm_application_ref','application_id');
		$this->joinTableSet('adm_feature', 'id','adm_application_ref','feature_id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('ref');
		$this->fieldAttrSet('ref', 'string', array(
			'required' => true,
			'size' => 100));
		$this->fieldTableSet('application_id');
		$this->fieldTableSet('application','adm_application','code');
		$this->fieldTableSet('alias');
		$this->fieldAttrSet('alias', 'string', array(
			'size' => 100));
		$this->fieldTableSet('feature_id');
		$this->fieldTableSet('feature','adm_feature','code');

		$this->whereTableSet('ref');
		$this->whereTableSet('application');
		$this->whereTableSet('feature');

		$this->fieldCompoSet('title','append','application');
		$this->fieldCompoSet('title','append',' - ');
		$this->fieldCompoSet('title','append','ref');
		
		$this->orderTableSet(0,'application');
		$this->orderTableSet(0,'ref');
		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'application');
		$this->orderTableSet(1,'feature');
		$this->orderTableSet(1,'ref');
		$this->orderTableSet(1,'id');
	}
	
}