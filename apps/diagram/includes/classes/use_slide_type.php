<?php
/**
* This file contains classes and function for the slides management.
*
* @package    use_slide
* @subpackage business_process
* @version    1.0
* @date       22 June 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the diagrams management.
*/
class object_slide_type extends BUS_object
{

	/**
	* constructor adm_feature
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->dbnameSet('dgm');
		$this->idSet('id');
		$this->selectLabelFieldSet('code');

		/* Table structure for the object */
		$this->tableSet('dmg_slide_type');

		$this->fieldTableSet('id');
		$this->fieldTableSet('code');
		$this->fieldAttrSet('code', 'string', array(
			'required' => true,
			'size' => 20,
			'case' => 'upper'));
		$this->fieldTableSet('label');
		$this->fieldAttrSet('label', 'string', array(
			'size' => 100));
		$this->fieldFctSet('labelTrad','labelTrad','label');

		$this->whereTableSet('code');
		$this->whereTableSet('label');
		
		$this->orderTableSet(0,'id');		
		$this->orderTableSet(1,'code');
	}

}