<?php
/**
* This file contains classes and functions for the job management.
*
* @package   use_job
* @subpackage business_process
* @version   1.0
* @date      30 May 2017
* @author    Alain VANDEPUTTE
* @copyright datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the users management.
*/
class object_job
{
	private $_client;

	/**
	* constructor object_job
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
	* getCountJob
    *
    * @access public
	*/
    public function getCountJob()
	{
		$param = array();
		$param['exploration'] = 60;
		$list = $this->_client->getCountArticle($param);
		$item = get_object_vars($list[0]);
		$offersNb = $item['count'];

		$param = array();
		$param['exploration'] = 60;
		$param['segment'] = STATUS_ACTIVE;
		$list = $this->_client->getCountArticle($param);
		$item = get_object_vars($list[0]);
		$activesNb = $item['count'];
		
		$return = array();
		$return['all'] = $offersNb;
		$return['actives'] = $activesNb;
		return $return;
	}

	/**
	* getCountJobName
    *
    * @access public
	*/
    public function getCountJobName()
	{
		$param = array();
		$param['exploration'] = 60;
		$param['segment'] = STATUS_ACTIVE;
		$param['group'] = 'job_name';
		$list = $this->_client->getCountArticle($param);
		$return = array();
		for ($i=0; $i < count($list); $i++) {
			$item = get_object_vars($list[$i]);
			$return[] = $item;
		}
		return $return;
	}

	/**
	* getCountJobObject
    *
    * @access public
	*/
    public function getCountJobObject()
	{
		$param = array();
		$param['exploration'] = 60;
		$param['segment'] = STATUS_ACTIVE;
		$param['group'] = 'job_object';
		$list = $this->_client->getCountArticle($param);
		$return = array();
		for ($i=0; $i < count($list); $i++) {
			$item = get_object_vars($list[$i]);
			$return[] = $item;
		}
		return $return;
	}
	
	/**
	* getCountSiteSource
    *
    * @access public
	*/
    public function getCountSiteSource($exploration=7)
	{
		$param = array();
		$param['exploration'] = $exploration;
		$param['segment'] = STATUS_ACTIVE;
		$param['group'] = 'site_source';
		$list = $this->_client->getCountArticle($param);
		$return = array();
		for ($i=0; $i < count($list); $i++) {
			$item = get_object_vars($list[$i]);
			$return[] = $item;
		}
		return $return;
	}
	
	static function cmpbyDate($a, $b)
    {
        return ($a['date'] <=> $b['date']);
    }
	
	/**
	* getCountByDay
    *
    * @access public
	*/
    public function getCountByDay($exploration=7, $sitesource='')
	{
		$param = array();
		$param['exploration'] = $exploration;
		$param['date'] = 1;
		if (!empty($sitesource)) {
			$param['site_source'] = $sitesource;
		}
		$list = $this->_client->getCountArticle($param);
		$return = array();
		for ($i=0; $i < count($list); $i++) {
			$item = get_object_vars($list[$i]);
			$return[] = $item;
		}
		
		$dateValue = DateTime::createFromFormat('Y-m-d',date("Y-m-d"));
		for ($i=0; $i < $exploration; $i++) {
			date_sub($dateValue, date_interval_create_from_date_string('1 days'));
			$strDate = $dateValue->format("Y-m-d"); 
			if (!arraySearch($strDate, $return)) {
				$item=array();
				$item['group'] = "";
				$item['ssgroup'] = "";
				$item['date'] = $strDate;
				$item['count'] = 0;
				$return[] = $item;
			}
		}
		usort($return, "self::cmpbyDate");
		
		foreach($return as $key=>$item) {
			$strDate = $item['date'];
			$item['date'] = substr($strDate, 8, 2) . '-' . substr($strDate, 5, 2) . '-' . substr($strDate, 0, 4);
			$return[$key] = $item;
		}
		return $return;
	}
	
	/**
	* getJob
    *
    * @access public
	*/
    public function getJob($reference)
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
	* getListJob
    *
    * @access public
	*/
    public function getListJob($param = array())
	{
		$return = $this->_client->getListArticle($param);
		return get_object_vars($return);
	}

	/**
	* getListJobName
    *
    * @access public
	*/
    public function getListJobName($param = array())
	{
		$return = $this->_client->getListJobName($param);
		return get_object_vars($return);
	}
		
	/**
	* getSelectJobName
    *
    * @access public
	*/
    public function getSelectJobName($defaultValue="",$defaultDescription="")
	{
		$param = array();
		$param['page'] = -1;
		$list = get_object_vars($this->_client->getListJobName($param));
		$displayList = $list['list'];
		$lineSelect = array();
		$returnList = array();
		if (($defaultValue <> "") or ($defaultDescription <> "")) {
			$lineSelect['id'] = $defaultValue;
			$lineSelect['description'] = $defaultDescription;
			$returnList[] = $lineSelect;
		}

		for ($temp=0; $temp < count($displayList); $temp++) {
			$lineSelect['id'] = $displayList[$temp];
			$lineSelect['description'] = $displayList[$temp];
			$returnList[] = $lineSelect;
		}
		return $returnList;
	}

	/**
	* getListJobObject
    *
    * @access public
	*/
    public function getListJobObject($param = array())
	{
		$return = $this->_client->getListJobName($param);
		return get_object_vars($return);
	}
		
	/**
	* getSelectJobObject
    *
    * @access public
	*/
    public function getSelectJobObject($defaultValue="",$defaultDescription="")
	{
		$param = array();
		$param['page'] = -1;
		$list = get_object_vars($this->_client->getListJobObject($param));
		$displayList = $list['list'];
		$lineSelect = array();
		$returnList = array();
		if (($defaultValue <> "") or ($defaultDescription <> "")) {
			$lineSelect['id'] = $defaultValue;
			$lineSelect['description'] = $defaultDescription;
			$returnList[] = $lineSelect;
		}

		for ($temp=0; $temp < count($displayList); $temp++) {
			$lineSelect['id'] = $displayList[$temp];
			$lineSelect['description'] = $displayList[$temp];
			$returnList[] = $lineSelect;
		}
		return $returnList;
	}

	/**
	* getListSiteSource
    *
    * @access public
	*/
    public function getListSiteSource($param = array())
	{
		$return = $this->_client->getListSiteSource($param);
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

}