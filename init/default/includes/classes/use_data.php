<?php
/**
* This file contains classes and functions for the data file management.
*
* @package   use_data
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
class object_data extends BUS_object
{
	private $_client;

	/**
	* constructor keyitem
    *
    * @access public
	*/
    public function __construct()
    {
		parent::__construct();
		$this->nameSet(get_class());
		
		$ws = workspace::ws_open();
		$serverpath =$ws->paramGet('ADMARTICLEWS_SERVERNAME');
		$this->_client = new WorkSoapClient($serverpath, array('wsdl_cache' => 0, 'trace' => 1, 'keep_alive' => 1));
		$this->_client->soap_defencoding = 'UTF-8';
		$this->_client->decode_utf8 = false;
		
		$param = array();
		if ($this->_client->connected($param) != 1) {
			$param['login'] = $ws->paramGet('ADMARTICLEWS_LOGIN');
			$param['password'] = $ws->paramGet('ADMARTICLEWS_PASSWORD');
			$this->_client->connect($param);
		}
	}

 	/**
	* Display list of objects
	*
	* @param integer - define the display order
	*
	* @param string - filter to display list
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
	*         return : array (objects to display)
	*  			- id : integer
	*  			- [other field name] : string 
	*
    * @access public
	*/
   public function displayList($order=0, $search_text="", $sort="", $sortOrder=0) {

		$ws = workspace::ws_open();
		$fct_return = new return_function;
		$ws->logSys('debug', 'Object DisplayList for ' . $this->nameGet(),  __CLASS__, func_get_args(), 'arguments');
		$error = '';
		
		try {
			$param = array();
			$param['page'] = -1;
			$list = get_object_vars($this->_client->getListFile($param));
			$displayList = $list['list'];
			$returnList = array();
			for ($temp=0; $temp < count($displayList); $temp++) {
				$line = array();
				$item = get_object_vars($displayList[$temp]);
				$line['id'] = $item['id'];
				$line['file_name'] = $item['file_name'];
				$returnList[] = $line;
			}
			$fct_return->returnSet($returnList);
			$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'function KO for ' . $this->nameGet() . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
		}
		return $fct_return;	
	}

 	/**
	* Display list of objects for select list
	*
	* @param string - define the display field for code
	*
	* @param string - define the display field for description
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
	*         return : array (objects to display)
	*  			- id : integer
	*  			- [other field name] : string 
	*
    * @access public
	*/
    public function displaySelect($defaultValue="",$defaultDescription="", $fieldId="") {

		$ws = workspace::ws_open();
		$fct_return = new return_function;
		$ws->logSys('debug', 'Object DisplaySelect for ' . $this->nameGet(),  __CLASS__, func_get_args(), 'arguments');
		$error = '';
		
		try {
			$param = array();
			$param['page'] = -1;
			$list = get_object_vars($this->_client->getListFile($param));
			$displayList = $list['list'];
			$returnList = array();
			if (($defaultValue <> "") or ($defaultDescription <> "")) {
				$lineSelect = array();
				$lineSelect['id'] = $defaultValue;
				$lineSelect['description'] = $defaultDescription;
				$returnList[] = $lineSelect;
			}

			for ($temp=0; $temp < count($displayList); $temp++) {
				$lineSelect = array();
				$item = get_object_vars($displayList[$temp]);
				$lineSelect['id'] = $item['id'];
				$lineSelect['description'] = $item['file_name'];
				$returnList[] = $lineSelect;
			}			
			$fct_return->returnSet($returnList);			
			$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'function KO for ' . $this->nameGet() . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
		}
		return $fct_return;	
	}
	
	/**
	* Display object information
	*
	* @param integer - object identifier to display
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
    *         return : array of informations 
	*  			- id : integer
	*  			- file_name : string 
	*  			- content : string 
	*
    * @access public
	*/
	public function display($id) {

		$ws = workspace::ws_open();
		$fct_return = new return_function;
		$ws->logSys('debug', 'Object Display for ' . $this->nameGet(),  __CLASS__, func_get_args(), 'arguments');
		$error = '';
		
		try {
			$return = get_object_vars($this->_client->getFile($id));
			$fct_return->returnSet($return);
			$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'function KO for ' . $this->nameGet() . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
		}
		return $fct_return;	
	}
	

	/**
	* Create object with informations
	*
	* @argArray  Array of string
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
    *         return : integer (created module identifier) 
	*
    * @access public
	*/
	public function insert($argArray, $dbName = '') {

		$ws = workspace::ws_open();
		$fct_return = new return_function;
		$ws->logSys('debug', 'Object Insert for ' . $this->nameGet(),  __CLASS__, func_get_args(), 'arguments');
		$error = '';
		
		try {
			$id = 0;

			$fct_return->returnSet($id);
			$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'function KO for ' . $this->nameGet() . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			$this->Msg('insert','KO', $argArray);
		}
		return $fct_return;	
	}

  	/**
	* Update object with informations
	*
	* @argArray  Array of string (
	*				'id' key : mandatory
	*				'fille_name'
	*				'content'
	*			)
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
    *         return : integer (created module identifier) 
	*
    * @access public
	*/
	public function update($argArray, $dbName = '') {

		$ws = workspace::ws_open();
		$fct_return = new return_function;
		$ws->logSys('debug', 'Object DisplaySelect for ' . $this->nameGet(),  __CLASS__, func_get_args(), 'arguments');
		$error = '';
		
		try {
			$id = $argArray['id'];
			$fileName = $argArray['file_name'];
			$content = $argArray['content'];

			$param = array();
			$param['id'] = $id;
			$param['file_name'] = $fileName;
			$param['content'] = $content;
			$return = $this->_client->setFile($param);
			$fct_return->returnSet($return);
			$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'function KO for ' . $this->nameGet() . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			$this->Msg('update','KO', $argArray);
		}
		return $fct_return;	
	}
	
	/**
	* Delete object
	*
	* @param integer - object identifier to delete 
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
	*
    * @access public
	*/
	public function delete($id, $dbName = '') {

		$argArray = array();
		$ws = workspace::ws_open();
		$fct_return = new return_function;
		$ws->logSys('debug', 'Object DisplaySelect for ' . $this->nameGet(),  __CLASS__, func_get_args(), 'arguments');
		$error = '';
		
		try {

			$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'function KO for ' . $this->nameGet() . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			$this->Msg('delete','KO', $argArray);
		}
		return $fct_return;	
	}
	
  	/**
	* Update object with informations
	*
	* @findArray  Array of string (key ==> value)
	* @argArray  Array of string (key ==> value, 'id' key : mandatory)
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
    *         return : integer (created module identifier) 
	*
    * @access public
	*/
	public function edit($findArray, $argArray) {

		$ws = workspace::ws_open();
		$fct_return = new return_function;
		$ws->logSys('debug', 'Object DisplaySelect for ' . $this->nameGet(),  __CLASS__, func_get_args(), 'arguments');
		$error = '';
		
		try {

			$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'function KO for ' . $this->nameGet() . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			$this->Msg('edit','KO', $argArray);
		}
		return $fct_return;	
	}

}