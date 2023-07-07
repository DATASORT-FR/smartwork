<?php
/**
* This file contains classes and functions for the links management on slide.
*
* @package    use_slide
* @subpackage business_process
* @version    1.0
* @date       01 September 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Class for user management.
*/
class object_slide_link extends BUS_object
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
		$this->tableSet('dmg_slide_link');
		$this->joinTableSet('dmg_slide', 'id','dmg_slide_link','link_id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('slide_id');
		$this->fieldTableSet('link_id');
		$this->fieldTableSet('label', 'dmg_slide', 'label');
		$this->fieldTableSet('title', 'dmg_slide', 'title');

		$this->whereTableSet('label');
		$this->whereTableSet('title');

		$this->orderTableSet(0,'label');
		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'title');
		$this->orderTableSet(1,'id');
		$this->orderTableSet(2,'id');
	}

}