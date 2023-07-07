<?php
/**
* This file contains classes and function for the nodes management.
*
* @package    use_node
* @subpackage business_process
* @version    1.0
* @date       19 March 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the variables management.
*/
class object_node extends BUS_object_rest
{

	/**
	* constructor result field
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->clientSet(TRACE_SERVERNAME . '/nodes/');
		$this->idSet('id');
	}

}
