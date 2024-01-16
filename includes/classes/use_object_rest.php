<?php
/**
* This file contains classes and function for business object.
*
* @package    object_rest
* @version    1.0
* @date       29 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for REST business object.
*/
class BUS_object_rest extends BUS_object
{

    /**
    * Instance identifier
    *
    * @var object
    * @static
    * @access private
    */
	private static $_instance;
 
    /**
    * private variables
    *
    * @var object
    * @access private
    */
	private $_name;
	private $_id;
	private $_client;

/* Public functions */
	
	/**
	* constructor bus_object
    *
    * @access public
	*/
    public function __construct() {
		parent::__construct();
		$this->_name = get_class();
		$this->_id = '';
	}
	
	/**
	* constructor by instance bus_object
    *
	* @return object The bus_object instance
	*
    * @static
    * @access public
	*/
	public static function ws_open() {
		if (!isset(self::$_instance)) {
			self::$_instance = new BUS_object();
		}
		return self::$_instance;
	}

	/**
	* Initialize client
	*
	* @param string - url of Rest API
	*
	* @return No
	*
    * @access public
	*/
	public function clientSet($serverpath) {
		$this->_client = new WorkRestClient($serverpath);
	}
	
	/**
	* Get object name
	*
	* @return string object name
	*
    * @access public
	*/
	public function nameGet() {
		return $this->_name;
	}

	/**
	* Initialize object name
	*
	* @param string - object name
	*
	* @return No
	*
    * @access public
	*/
	public function nameSet($name) {
		$this->_name = $name;
	}

	/**
	* Get id field name
	*
	* @return string id field name
	*
    * @access public
	*/
	public function idGet() {
		return $this->_id;
	}

	/**
	* Initialize id field name
	*
	* @param string - id field name
	*
	* @return No
	*
    * @access public
	*/
	public function idSet($id) {
		$this->_id = $id;
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
		$argArray = array();
		try {
			$api = $this->_client;
			$filterArray = $this->filterGet();
			for ($i=0; $i < count($filterArray); $i++) {
				$filterItem = $filterArray[$i];
				$argArray[$filterItem['field']] = $filterItem['value'];
			}
			if (count($argArray) > 0) {
				$fct_return = $api->get('', $argArray);
			}
			else {
				$fct_return = $api->get();
			}
			if (empty($fct_return->returnGet())) {
				$fct_return->returnSet(array());
			}
		}
		catch (exception $e) {
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
		try {
			$returnList = array();

			$fct_return->returnSet($returnList);			
			$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			$fct_return->errorSet();
			$ws->logSys('error', 'function KO for ' . $this->nameGet() . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
		}
		return $fct_return;	
	}
	

	/**
	* Display object informations
	*
	* @param integer - object identifier to display
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
    *         return : array of informations 
	*  			- id : integer
	*  			- description : string 
	*  			- code : string 
	*
    * @access public
	*/
	public function display($id) {
		$ws = workspace::ws_open();
		$fct_return = new return_function;
		$ws->logSys('debug', 'Object Display item for ' . $this->nameGet(),  __CLASS__, func_get_args(), 'arguments');
		try {
			$api = $this->_client;
			$fct_return = $api->get($id);
			$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
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
		$ws->logSys('debug', 'Object insert for ' . $this->nameGet(),  __CLASS__, func_get_args(), 'arguments');
		try {
			$api = $this->_client;
			$fct_return = $api->post($argArray);
			$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			$fct_return->errorSet();
			$ws->logSys('error', 'function KO for ' . $this->nameGet() . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
		}
		return $fct_return;	
	}

  	/**
	* Update object with informations
	*
	* @argArray  Array of string ('id' key : mandatory)
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
		$ws->logSys('debug', 'Object Update item for ' . $this->nameGet(),  __CLASS__, func_get_args(), 'arguments');
		try {
			$api = $this->_client;
			$fct_return = $api->put($argArray);
			$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			$fct_return->errorSet();
			$ws->logSys('error', 'function KO for ' . $this->nameGet() . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
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
		$ws->logSys('debug', 'Object Delete item for ' . $this->nameGet(),  __CLASS__, func_get_args(), 'arguments');
		try {
			$api = $this->_client;
			$fct_return = $api->delete($id);
			$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			$fct_return->errorSet();
			$ws->logSys('error', 'function KO for ' . $this->nameGet() . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
		}
		return $fct_return;	
	}

}

