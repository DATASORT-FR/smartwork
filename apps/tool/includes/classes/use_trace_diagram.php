<?php
/**
* This file contains classes and function for the diagram traces management.
*
* @package    use_trace
* @subpackage business_process
* @version    1.0
* @date       02 Septembre 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

class object_trace_diagram extends BUS_object_rest
{

	/**
	* constructor result field
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->clientSet(TRACE_SERVERNAME . '/tracediagrams/');
		$this->idSet('id');
	}
	
    public function init($diagramId, $reference, $session, $user)
    {
		$argArray = array(
			'diagram_id' => $diagramId,
			'reference' => $reference,
			'session' => $session,
			'user' => $user
		);
		$fct_return = $this->insert($argArray);
		return $fct_return;	
	}
	
}
