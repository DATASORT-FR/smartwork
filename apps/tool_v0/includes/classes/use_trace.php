<?php
/**
* This file contains classes for trace administration
*
* @package    use_trace
* @subpackage business_process
* @version    1.2
* @date       25 juillet 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

class object_trace extends BUS_object_rest
{

	/**
	* constructor result field
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->clientSet(TRACE_SERVERNAME . '/traces/');
		$this->idSet('id');
	}
	
    public function init($domainId, $reference, $session, $user)
    {
		$argArray = array(
			'domain_id' => $domainId,
			'reference' => $reference,
			'session' => $session,
			'user' => $user
		);
		$fct_return = $this->insert($argArray);
		return $fct_return;	
	}

}
