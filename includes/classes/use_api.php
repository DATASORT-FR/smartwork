<?php
/**
* This file contains classes and function for API defintions.
*
* @package    administration_api
* @version    1.0
* @date       16 March 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for API object.
*/
class API_object
{

    /**
    * Instance identifier
    *
    * @var object
    * @static
    * @access private
    */
	private static $_instance;
	
    private $_objectName;
	private $_allList;
	private $_field = array();
	private $_createFunc = '';
	
/* Private functions */
	
	/**
	* find list of items
	*
	* @param array - list of filter fields
	*
	* @return array - list of items
	*
    * @access private
	*/
    private function getItems($params) {
		$returnList = array();
		$fct_return = new return_function;

		$objectName = $this->_objectName;
		$objectRef = new $objectName;
		foreach($params as $key=>$value) {
			$objectRef->filterSet($key, $value);
		}
		$itemList = $objectRef->displayList()->returnGet();
		if (!empty($itemList)) {
			if ($this->_allList) {
				$returnList = $itemList;
			}
			else {
				$returnList = array();
				for ($i=0; $i < count($itemList); $i++) {
					$item = $itemList[$i];
					$returnItem = array();
					for ($j=0; $j < count($this->_field); $j++) {
						$fieldItem = $this->_field[$j];
						if (isset($item[$fieldItem['field']])) {
							$returnItem[$fieldItem['field']] = $item[$fieldItem['field']];
						}
					}
					$returnList[] = $returnItem;
				}
			}
			$fct_return->returnSet($returnList);
		}
		else {
			$fct_return->errorSet($returnList);
		}
		return $fct_return;
	}

	/**
	* find item by id
	*
	* @param int - id of the item
	*
	* @return array - item fields
	*
    * @access private
	*/
    private function getItem($id){
		$objectName = $this->_objectName;
		$objectRef = new $objectName;
		$return = $objectRef->display($id);
		return $return;		
	}
	
	/**
	* create item
	*
	* @param array - item fields with value
	*
	* @return int - id of the item
	*
    * @access private
	*/
    private function createItem($params) {
		$objectName = $this->_objectName;
		$function = $this->_createFunc;

		$objectRef = new $objectName;
		if (empty($function)) {
			$return = $objectRef->insert($params);
		}
		else {
			if (isset($params[0])) {
				$return = $objectRef->$function($params[0]);
			}
			else {
				$return = $objectRef->$function($params);
			}
		}
		return $return;
	}
	
	/**
	* delete item by id
	*
	* @param int - id of the item
	*
	* @return no
	*
    * @access private
	*/
    private function deleteItem($id){
		
		$objectName = $this->_objectName;
		$objectRef = new $objectName;
		$return = $objectRef->delete($id);

		return $return;
	}

	/**
	* update item by id
	*
	* @param int - id of the item
	*        array - item fields with value
	*
	* @return no
	*
    * @access private
	*/
    private function updateItem($id, $params){
	
		$params['id'] = $id;
		$objectName = $this->_objectName;
		$objectRef = new $objectName;
		$return = $objectRef->update($params);

		return $return;
	}

	/**
	* find field in the object structure by nama
	*
	* @param string - field name
	*
	* @return integer - field number (0 if the field is not found)
	*
    * @access private
	*/
    private function findField($field)
    {
		$index = 0;
		for ($i=0; $i < count($this->_field); $i++) {
			$fieldItem = $this->_field[$i];
			if ($fieldItem['field'] == $field) {
				$index = $i + 1;
			}
		}
		return $index;
	}
	
	/**
	* Initialize object fields
	*
	* @param string - field name in the object
	*
	* @return integer - field number (0 if the field is not found)
	*
    * @access private
	*/
	private function fieldAdd($field) {
		$fieldItem = array();

		$this->_allList = false;
		$fieldItem['field'] = $field;
		$this->_field[] = $fieldItem;
		$index = $this->findField($field);
		if ($index > 0) {
			$fieldItem = $this->_field[$index - 1];
			$fieldItem['index'] = $index;
			$this->_field[$index - 1] = $fieldItem;
		}
		return $index;
	}
	
/* Public functions */
	
	/**
	* constructor API_object
    *
    * @access public
	*/
    public function __construct() {
		$this->_objectName = '';
		$this->_allList = true;
	}
	
	
	/**
	* constructor by instance API_object
    *
	* @return object The API_object instance
	*
    * @static
    * @access public
	*/
	public static function ws_open() {
		if (!isset(self::$_instance)) {
			self::$_instance = new API_object();
		}
		return self::$_instance;
	}

	/**
	* Get api object name
	*
	* @return string API object name
	*
    * @access public
	*/
	public function objectNameGet() {
		return $this->_objectName;
	}

	/**
	* Initialize API Object name
	*
	* @param string - API Object name
	*
	* @return No
	*
    * @access public
	*/
	public function objectNameSet($name) {
		$this->_objectName = $name;
	}

	/**
	* add field in the display list
	*
	* @param string - field name in the object
	*
	* @return integer - field number (0 if the field is not found)
	*
    * @access public
	*/
	public function listSet($field) {
		$index = 0;
		
		$control = true;
		if ($control) {
			if ($this->findField($field)) {
				$control = false;
			}
		}
		if ($control) {
			$index = $this->fieldAdd($field);
		}
		return $index;
	}

	/**
	* add field in the display list
	*
	* @param string - field name in the object
	*
	* @return integer - field number (0 if the field is not found)
	*
    * @access public
	*/
	public function createSet($value) {
		$this->_createFunc = $value;
	}
	
	/**
	* build the API parameters and process
	*
	* @param No
	*
	* @return No
	*
    * @access public
	*/
	public function build() {
		$returnOk = false;
		$response = array();
		$ws = workspace::ws_open();

		$httpVerb = $ws->paramGet('HTTP_VERB');
		$pageSpec = $ws->paramGet('PAGE_SPEC');
		switch($httpVerb) {
			case 'GET':
				$id = $ws->paramGet('ID');
				$params = $ws->_arrayGet;
				if (!empty($id)) {
					$id = intval($id);
					$return = $this->getItem($id);
					$returnOk = $return->statusGet();
				}
				else {
					if (empty($pageSpec)) {
						$return = $this->getItems($params);
						$returnOk = $return->statusGet();
					}
				}
				if ($returnOk) {
					header("HTTP/1.0 200 OK");
					$response = $return->returnGet();
				}
				else {
					header("HTTP/1.0 404 Not Found");
				}
				break;
			case 'POST':
				$params = $_POST;
				if (count($params) == 0) {
					$params = json_decode(file_get_contents("php://input"), true);
				}
				if (!empty($pageSpec)) {
					if ($pageSpec == 'filter') {
						$return = $this->getItems($params);
						$returnOk = $return->statusGet();
					}
				}
				else {
					$return = $this->createItem($params);
					$returnOk = $return->statusGet();
				}
				if ($returnOk) {
					header("HTTP/1.0 201 CREATED");
					if (is_array($return->returnGet())) {
						$response = $return->returnGet();
					}
					else {
						$id = $return->returnGet();
						$response['id'] = $id;
					}
				}
				else {
					header("HTTP/1.0 400 Bad Request");
				}
				break;
			case 'PUT':
				$id = $ws->paramGet('ID');
				$id = intval($id);
				$params = array();
				$params = json_decode(file_get_contents("php://input"), true);
				if (empty($pageSpec)) {
					$return = $this->updateItem($id, $params);
					$returnOk = $return->statusGet();
				}
				if ($returnOk) {
					header("HTTP/1.0 200 OK");
					if (is_array($return->returnGet())) {
						$response = $return->returnGet();
					}
					else {
						$return = $this->getItem($id);
						if ($return->statusGet()) {
							$response = $return->returnGet();
						}
						else {
							$response['id'] = $id;
						}
					}
				}
				else {
					header("HTTP/1.0 404 Not Found");
				}
				break;
			case 'DELETE':
				$id = $ws->paramGet('ID');
				$id = intval($id);
				if (empty($pageSpec)) {
					$return = $this->deleteItem($id);
					$returnOk = $return->statusGet();
				}
				if ($return->statusGet()) {
					header("HTTP/1.0 200 OK");
					$response['id'] = $id;
				}
				else {
					header("HTTP/1.0 404 Not Found");
				}
				break;
			default:
				header("HTTP/1.0 405 Method Not Allowed");
			break;
		}
		if (!empty($response)) {
			header('Content-Type: application/json');
			echo json_encode($response, JSON_PRETTY_PRINT);
		}
		else {
			exit();
		}
	}

}
