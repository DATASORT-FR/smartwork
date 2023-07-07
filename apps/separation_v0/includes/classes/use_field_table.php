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
* Classes for the variables management.
*/
class object_field_table extends BUS_object_rest
{

	/**
	* constructor result field
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->clientSet(TRACE_SERVERNAME . '/tables/');
		$this->idSet('id');
	}

}