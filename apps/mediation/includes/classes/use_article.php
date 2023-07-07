<?php
/**
* This file contains classes and functions for the article management.
*
* @package   use_article
* @subpackage business_process
* @version   1.0
* @date      31 October 2017
* @author    Alain VANDEPUTTE
* @copyright datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the articles management.
*/
class object_article
{
	private $_client;

	/**
	* constructor object_article
    *
    * @access public
	*/
    public function __construct()
    {
		$ws = workspace::ws_open();
		$serverpath =$ws->paramGet('ARTICLEWS_SERVERNAME');
		$this->_client = new WorkSoapClient($serverpath, array('wsdl_cache' => 0, 'trace' => 1, 'keep_alive' => 1));
		$this->_client->soap_defencoding = 'UTF-8';
		$this->_client->decode_utf8 = false;
		
		$param = array();
		if ($this->_client->connected($param) != 1) {
			$param['login'] = $ws->paramGet('ARTICLEWS_LOGIN');
			$param['password'] = $ws->paramGet('ARTICLEWS_PASSWORD');
			$this->_client->connect($param);
		}
	}

	/**
	* getCompany
    *
    * @access public
	*/
    public function getCompany($reference)
	{
		$return = $this->_client->getCompany($reference);
		return get_object_vars($return);
	}

	/**
	* getContact
    *
    * @access public
	*/
    public function getContact($reference)
	{
		$return = $this->_client->getContact($reference);
		return get_object_vars($return);
	}
	
	/**
	* getCountArticle
    *
    * @access public
	*/
    public function getCountArticle()
	{
		$offersNb = 0;
		$param = array();
//		$param['exploration'] = 60;
		$list = $this->_client->getCountArticle($param);
		$item = get_object_vars($list[0]);
		$offersNb = $item['count'];

		$activesNb = 0;
		$param = array();
//		$param['exploration'] = 60;
		$param['segment'] = STATUS_ACTIVE;
		$list = $this->_client->getCountArticle($param);
		$item = get_object_vars($list[0]);
		$activesNb = $item['count'];
		
		$return = array();
		$return['all'] = $offersNb;
		$return['actifs'] = $activesNb;
		return $return;
	}

	/**
	* getArticle
    *
    * @access public
	*/
    public function getArticle($reference)
	{
		$return = $this->_client->getArticle($reference);
		return get_object_vars($return);
	}
	
	/**
	* getListAdrCity
    *
    * @access public
	*/
    public function getListAdrCity($param = array())
	{
		$return =  $this->_client->getListAdrCity($param);
		return get_object_vars($return);
	}

	/**
	* getListArticle
    *
    * @access public
	*/
    public function getListArticle($param = array())
	{
		$return = $this->_client->getListArticle($param);
		return get_object_vars($return);
	}

	/**
	* getListCategory
    *
    * @access public
	*/
    public function getListCategory($param = array())
	{
		$return = $this->_client->getListCategory($param);
		return get_object_vars($return);
	}

	/**
	* getListCompany
    *
    * @access public
	*/
    public function getListCompany($param = array())
	{
		$return = $this->_client->getListCompany($param);
		return get_object_vars($return);
	}

	/**
	* getListCompanyRandom
    *
    * @access public
	*/
    public function getListCompanyRandom($param = array())
	{
		$return = $this->_client->getListCompanyRandom($param);
		return get_object_vars($return);
	}

	/**
	* getListContact
    *
    * @access public
	*/
    public function getListContact($param = array())
	{
		$return = $this->_client->getListContact($param);
		return get_object_vars($return);
	}

	/**
	* getListSubCategory
    *
    * @access public
	*/
    public function getListSubCategory($param = array())
	{
		$return = $this->_client->getListSubCategory($param);
		return get_object_vars($return);
	}

	/**
	* getListSubThematic
    *
    * @access public
	*/
    public function getListSubThematic($param = array())
	{
		$return = $this->_client->getListSubThematic($param);
		return get_object_vars($return);
	}
	
	/**
	* getListTag
    *
    * @access public
	*/
    public function getListTag($param = array())
	{
		$return = $this->_client->getListTag($param);
		return get_object_vars($return);
	}

	/**
	* getListThematic
    *
    * @access public
	*/
    public function getListThematic($param = array())
	{
		$return = $this->_client->getListThematic($param);
		return get_object_vars($return);
	}

}