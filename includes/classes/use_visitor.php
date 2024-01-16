<?php
/**
* This file contains classes and functions for the visitors statistics.
*
* @package   administration_visitor
* @version   1.0
* @date      26 April 2021
* @author    Alain VANDEPUTTE
* @copyright datasort.fr
*/

defined('_WSEXEC') or die();

if (!defined('SMARTLOGWS_SERVERNAME')) {
	define('SMARTLOGWS_SERVERNAME', '');
}
if (!defined('SMARTLOGWS_LOGIN')) {
	define('SMARTLOGWS_LOGIN', '');
}
if (!defined('SMARTLOGWS_PASSWORD')) {
	define('SMARTLOGWS_PASSWORD', '');
}

/**
* Classes for the users management.
*/
class object_visitor
{
	private $_client;

	/**
	* constructor object_visitor
    *
    * @access public
	*/
    public function __construct()
    {
		$ws = workspace::ws_open();
		if (defined('APP_SMARTLOGWS_SERVERNAME')) {
			$ws->paramSet('SMARTLOGWS_SERVERNAME', APP_SMARTLOGWS_SERVERNAME);
		}
		else {
			$ws->paramSet('SMARTLOGWS_SERVERNAME', SMARTLOGWS_SERVERNAME);
		}
		if (defined('APP_SMARTLOGWS_LOGIN')) {
			$ws->paramSet('SMARTLOGWS_LOGIN', APP_SMARTLOGWS_LOGIN);
		}
		else {
			$ws->paramSet('SMARTLOGWS_LOGIN', SMARTLOGWS_LOGIN);
		}
		if (defined('APP_SMARTLOGWS_PASSWORD')) {
			$ws->paramSet('SMARTLOGWS_PASSWORD', APP_SMARTLOGWS_PASSWORD);
		}
		else {
			$ws->paramSet('SMARTLOGWS_PASSWORD', SMARTLOGWS_PASSWORD);
		}
		if (defined('APP_SMARTLOGWS_APPNAME')) {
			$ws->paramSet('SMARTLOGWS_APPNAME', APP_SMARTLOGWS_APPNAME);
		}
		else {
			$ws->paramSet('SMARTLOGWS_APPNAME', '');
		}
		
		$this->_client = new WorkSoapClient($ws->paramGet('SMARTLOGWS_SERVERNAME'), array('wsdl_cache' => 0, 'trace' => 1, 'keep_alive' => 1));
		$this->_client->soap_defencoding = 'UTF-8';
		$this->_client->decode_utf8 = false;
		
		$param = array();
		if ($this->_client->connected($param) != 1) {
			$param['login'] = $ws->paramGet('SMARTLOGWS_LOGIN');
			$param['password'] = $ws->paramGet('SMARTLOGWS_PASSWORD');
			$this->_client->connect($param);
		}
	}

	/**
	* getCountByDay
    *
    * @access public
	*/
    public function getCountByDay($exploration=7)
	{
		$ws = workspace::ws_open();
		
		$param = array();
		if (!empty($ws->paramGet('SMARTLOGWS_APPNAME'))) {
			$param['application'] = $ws->paramGet('SMARTLOGWS_APPNAME');
		}
		$param['exploration'] = $exploration;
		$param['date'] = 'date';
		$return = $this->_client->getCountUser($param);
		
		foreach($return as $key=>$item) {
			$item = get_object_vars($item);
			$strDate = $item['date'];
			$item['date'] = substr($strDate, 8, 2) . '-' . substr($strDate, 5, 2) . '-' . substr($strDate, 0, 4);
			$return[$key] = $item;
		}
		
		return $return;
	}

	/**
	* getCountToday
    *
    * @access public
	*/
    public function getCountToday()
	{
		$ws = workspace::ws_open();

		$param = array();
		if (!empty($ws->paramGet('SMARTLOGWS_APPNAME'))) {
			$param['application'] = $ws->paramGet('SMARTLOGWS_APPNAME');
		}
		$return = $this->_client->getCountUserDay($param);
		
		foreach($return as $key=>$item) {
			$item = get_object_vars($item);
			$strDate = $item['date'];
			$item['date'] = substr($strDate, 11, 8);
			$return[$key] = $item;
		}
		
		return $return;
	}

	/**
	* getListUrl
    *
    * @access public
	*/
    public function getListUrl($exploration=7)
	{
		$ws = workspace::ws_open();

		$param = array();
		if (!empty($ws->paramGet('SMARTLOGWS_APPNAME'))) {
			$param['application'] = $ws->paramGet('SMARTLOGWS_APPNAME');
		}
		$param['exploration'] = $exploration;
		$param['limit'] = 30;

		$return = $this->_client->getListUrl($param);

		foreach($return as $key=>$item) {
			$item = get_object_vars($item);
			$return[$key] = $item;
		}
		
		return $return;
	}

	/**
	* getListUrlDay
    *
    * @access public
	*/
    public function getListUrlDay()
	{
		$ws = workspace::ws_open();

		$param = array();
		if (!empty($ws->paramGet('SMARTLOGWS_APPNAME'))) {
			$param['application'] = $ws->paramGet('SMARTLOGWS_APPNAME');
		}
		$return = $this->_client->getListUrlDay($param);
		
		foreach($return as $key=>$item) {
			$item = get_object_vars($item);
			$return[$key] = $item;
		}
		
		return $return;
	}

	/**
	* getListNavigation
    *
    * @access public
	*/
    public function getListNavigation($exploration=7)
	{
		$ws = workspace::ws_open();

		$param = array();
		if (!empty($ws->paramGet('SMARTLOGWS_APPNAME'))) {
			$param['application'] = $ws->paramGet('SMARTLOGWS_APPNAME');
		}
		$param['exploration'] = $exploration;
		$return = $this->_client->getListNavigation($param);

		foreach($return as $key=>$item) {
			$item = get_object_vars($item);
			$return[$key] = $item;
		}
		
		return $return;
	}

}