<?php
/**
* This file contains classes and function for business object.
*
* @package    object_file
* @version    1.0
* @date       29 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for business object.
*/
class object_file
{

     /**
    * field types
    *
    * @var array
    * @static
    * @access protected
    */
	private static $_fieldType = array(
		'text',
		'checkbox',
		'choice',
		'color',
		'datagrid',
		'date',
		'datetime',
		'editor',
		'email',
		'file',
		'hidden',
		'image',
		'integer',
		'number',
		'password',
		'radio',
		'tel',
		'textlist',
		'textarea',
		'list',
		'listmultiple',
		'listmultiple_order'
	);

	private static $_fieldTypeTransco = array(
		'text'=>'string',
		'checkbox'=>'boolean',
		'choice'=>'boolean',
		'color',
		'datagrid'=>'array',
		'date'=>'date',
		'datetime'=>'date',
		'editor'=>'string',
		'email'=>'string',
		'file'=>'string',
		'hidden'=>'string',
		'image'=>'string',
		'integer'=>'number',
		'number'=>'number',
		'password'=>'string',
		'radio'=>'boolean',
		'tel'=>'string',
		'textlist'=>'string',
		'textarea'=>'string',
		'list'=>'string',
		'listmultiple'=>'array',
		'listmultiple_order'=>'array'
	);

	/**
    * Instance identifier
    *
    * @var object
    * @static
    * @access private
    */
	private static $_instance;

    private $_name;
    private $_id;
    private $_items = array();
	private $_fieldAttr = array();


	private function initAttrField() {
		$fieldAttr = array();

		$fieldAttr['type'] = self::$_fieldTypeTransco[self::$_fieldType[0]];
		$fieldAttr['fieldtype'] = self::$_fieldType[0];
		$fieldAttr['encrypted'] = false;
		$fieldAttr['readonly'] = false;
		$fieldAttr['required'] = false;
		$fieldAttr['size'] = 0;
		$fieldAttr['cols'] = 0;
		$fieldAttr['rows'] = 0;
		$fieldAttr['case'] = '';
		$fieldAttr['pattern'] = '';
		$fieldAttr['format'] = '';
			
		return $fieldAttr;
	}
	
	private function initField($fieldName) {
		$ws = workspace::ws_open();

		$atemp = explode('(', $fieldName);
		
		$field = $atemp[0];
		$fieldAttr = $this->initAttrField();
		if (isset($atemp[1])) {
			$atemp = explode(')', $atemp[1]);
			$atemp = explode(',', $atemp[0]);
			
			if (!empty($atemp[0])) {
				$fieldAttr['type'] = $atemp[0];
			}
			if (!empty($atemp[1])) {
				$fieldAttr['fieldtype'] = $atemp[1];
			}
			
			if (!empty($atemp[2])) {
				$fieldAttr['encrypted'] = workspace::convBool($atemp[2]);
			}
			
			if (!empty($atemp[3])) {
				$fieldAttr['readonly'] = workspace::convBool($atemp[3]);
			}
			
			if (!empty($atemp[4])) {
				$fieldAttr['required'] = workspace::convBool($atemp[4]);
			}
			
			if (!empty($atemp[5])) {
				$fieldAttr['size'] = workspace::convInt($atemp[5]);
			}

			if (!empty($atemp[6])) {
				$fieldAttr['cols'] = workspace::convInt($atemp[6]);
			}
			
			if (!empty($atemp[7])) {
				$fieldAttr['rows'] = workspace::convInt($atemp[7]);
			}
			
			if (!empty($atemp[8])) {
				$fieldAttr['case'] = $atemp[8];
			}
			
			if (!empty($atemp[9])) {
				$fieldAttr['pattern'] = $atemp[9];
			}
			
			if (!empty($atemp[10])) {
				$fieldAttr['format'] = $atemp[10];
			}
			
			$this->_fieldAttr[$field] = $fieldAttr;
		}
	
		return $field;
	}

	private function loadFile() {
		$ws = workspace::ws_open();
		$lines = array();
		$items = array();
		
		$filePath = $ws->paramGet('FILES_DIR');
		$fileName = $this->_name . '.txt';
		if (file_exists($filePath . $fileName)) {
			$lines = file($filePath . $fileName);
		}
		
		$this->_id = 0;
		foreach ($lines as $lineNum=>$line) {
			$line = trim($line);
			if (!empty($line)) {
				$item = array();
				$columns = explode(';', $line);
				if ($lineNum == 0) {
					$header = array();				
					foreach ($columns as $i=>$colValue) {
						$field = $this->initField($colValue);
						$header[$i] = $field;
					}
				}
				else {
					foreach ($columns as $i => $colValue) {
						if (!empty($header[$i])) {
							$field = $header[$i];
							$fieldAttr = $this->_fieldAttr[$field];
							if ($field != 'id') {
								if ($fieldAttr['type'] == 'array') {
									$value = array();
									$colValue = str_replace("/s", '', $colValue);
									$atemp = explode('{',$colValue);
									if (isset($atemp[1])) {
									$atemp = explode('}',$atemp[1]);
										if (isset($atemp[0])) {
											if (!empty($atemp[0])) {
												$atemp = explode('|',$atemp[0]);
												foreach($atemp as $stemp) {
													$listId = array();
													$listId['listid'] = $stemp;
													$value[] = $listId;
												}
											}
										}
									}
								}
								else {
									$value = $colValue;
								}
								$item[$field] = $value;
							}
						}
					}
					$item['id'] = $lineNum;
					$this->_id = $lineNum;
					$items[] = $item;
				}
				$this->_items = $items;
			}
		}
	}

	private function writeFile() {
		$ws = workspace::ws_open();
		$items = $this->_items;
		
		$filePath = $ws->paramGet('FILES_DIR');
		$fileName = $this->_name . '.txt';
		$fp = fopen($filePath . $fileName, 'w');
		
		$i = 0;
		$header = '';
		foreach($this->_fieldAttr as $field=>$fieldAttr) {
			if ($field != 'id') {
				if ($i != 0) {
					$header .= ';';
				}
				$attrStr = '(';
				$attrStr .= $fieldAttr['type'] . ',';
				$attrStr .= $fieldAttr['fieldtype'] . ',';
				if ($fieldAttr['encrypted'] == true) {
					$attrStr .= '1,';
				}
				else {
					$attrStr .= '0,';
				}
				if ($fieldAttr['readonly'] == true) {
					$attrStr .= '1,';
				}
				else {
					$attrStr .= '0,';
				}
				if ($fieldAttr['required'] == true) {
					$attrStr .= '1,';
				}
				else {
					$attrStr .= '0,';
				}
				$attrStr .= $fieldAttr['size'] . ',';
				$attrStr .= $fieldAttr['cols'] . ',';
				$attrStr .= $fieldAttr['rows'] . ',';
				$attrStr .= $fieldAttr['case'] . ',';
				$attrStr .= $fieldAttr['pattern'] . ',';
				$attrStr .= $fieldAttr['format']; 
				$attrStr .= ')';

				$header .= $field . $attrStr;
				$i++;
			}
		}
		
        fwrite($fp, $header . "\r\n");
		$lineNum = 1;
		foreach($items as $item) {
			$line = '';
			$i = 1;
			foreach($this->_fieldAttr as $field=>$fieldAttr) {
				if ($field != 'id') {
					if (isset($item[$field])) {
						if ($i != 1) {
							$line .= ';';
						}
						if ($fieldAttr['type'] == 'array') {
							$value = '{';
							$j = 1;
							foreach($item[$field] as $listId) {
								$stemp = $listId['listid'];
								if (!empty($stemp)) {
									if ($j != 1) {
										$value .= '|';
									}
									$value .= $stemp;
									$j++;
								}
							}
							$value .= '}';
						}
						else {
							$value = $item[$field];
						}
						$line .= $value;
					}
					else {
						$line .= '';
					}
					$i++;
				}
			}
            fwrite($fp, $line . "\r\n");
			$lineNum++;
		}
		fclose($fp);
	}
	
/* Public functions */
	
	/**
	* Get field type for a field
	*
	* @param string - field name in the object
	*
	* @return Array 
	* 			type 	 => field type
	* 			size     => field size
	* 			required => filed required or not
	* 			case 	 => "upper" ou "lower"
	*
    * @access public
	*/
	public function fieldAttrGet($field) {
		$fieldAttr = array();
		
		if (isset($this->_fieldAttr[$field])) {
			$fieldAttr = $this->_fieldAttr[$field];
			return $fieldAttr;
		}
		else {
			return null;
		}
	}
	

	/**
	* Initialize field type
	*
	* @param string - field name in the object
	*
	* @param array  - field attributes (size, required, case)
	*
	* @return No
	*
    * @access public
	*/
	public function fieldAttrSet($field, $attr = array()) {
		
		$fieldtype = '';
		if (!empty($attr['type'])) {
			$fieldtype = $attr['type'];
		}
		if (in_array($fieldtype, self::$_fieldType)) {
			$fieldAttr = $this->initAttrField();

			$fieldAttr['type'] = self::$_fieldTypeTransco[$fieldtype];
			$fieldAttr['fieldtype'] = $fieldtype;
		
			if (isset($attr['encrypted'])) {
				$fieldAttr['encrypted'] = $attr['encrypted'];
			}
			
			if (isset($attr['readonly'])) {
				$fieldAttr['readonly'] = $attr['readonly'];
			}

			if (isset($attr['required'])) {
				$fieldAttr['required'] = $attr['required'];
			}
			if (isset($attr['size'])) {
				$fieldAttr['size'] = $attr['size'];
			}
			
			if (isset($attr['cols'])) {
				$fieldAttr['cols'] = $attr['cols'];
			}
			if (isset($attr['rows'])) {
				$fieldAttr['rows'] = $attr['rows'];
			}
			if (isset($attr['case'])) {
				$fieldAttr['case'] = $attr['case'];
			}
			if (isset($attr['pattern'])) {
				$fieldAttr['pattern'] = $attr['pattern'];
			}
			if (isset($attr['format'])) {
				$fieldAttr['format'] = $attr['format'];
			}
			$this->_fieldAttr[$field] = $fieldAttr;
		}
		
	}

	/**
	* constructor bus_object
    *
    * @access public
	*/
    public function __construct($name) {
		$ws = workspace::ws_open();
		
		$this->_name = $name;
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
			self::$_instance = new object_file();
		}
		return self::$_instance;
	}

	/**
	* Display list of business object
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
    public function displayList($order=0, $search_text="", $sort="", $sortOrder=0)
    {
		$ws = workspace::ws_open();
		$fct_return = new return_function;
		$ws->logSys('debug', 'Object DisplayList ',  __CLASS__, func_get_args(), 'arguments');
		
		$this->loadFile();
		$returnList = $this->_items;
		$fct_return->returnSet($returnList);
			
		return $fct_return;

	}
	
	/**
	* Display list of business object for select list
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
    public function displaySelect($defaultValue="",$defaultDescription="", $fieldId="")
    {

		$ws = workspace::ws_open();
		$fct_return = new return_function;
		$ws->logSys('debug', 'Object DisplayList ',  __CLASS__, func_get_args(), 'arguments');

		$returnList = array();
		$fct_return->returnSet($returnList);
			
		return $fct_return;
	}

	
	/**
	* Init list of business object for select list
	*
	* @param none
	*
	* @return  array (objects to display)
	*
    * @access public
	*/
    public function initSelect()
    {

		$returnList = array();
			
		return $returnList;
	}
	
	/**
	* Add item in list of business object for select list
	*
	* @param string - define the display field for code
	*
	* @param string - define the display field for description
	*
	* @return array (objects to display)
	*
    * @access public
	*/
    public function addSelect($selectList, $value="",$description="")
    {
		$returnList = $selectList;
		$lineSelect = array();
		
		if (($value <> "") or ($description <> "")) {
			$lineSelect['id'] = $value;
			$lineSelect['description'] = $description;
			$returnList[] = $lineSelect;
		}
		return $returnList;
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
	*  			- description : string 
	*  			- code : string 
	*
    * @access public
	*/
    public function display($id)
    {

		$ws = workspace::ws_open();
		$fct_return = new return_function;
		$ws->logSys('debug', 'Object Display ' . $id,  __CLASS__, func_get_args(), 'arguments');

		$this->loadFile();		
		if (isset($this->_items[$id - 1])) {
			$returnList = $this->_items[$id - 1];
		}
		else {
			$returnList = array();
		}

		$fct_return->returnSet($returnList);
			
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
    public function insert($argArray)
    {
		$ws = workspace::ws_open();
		$fct_return = new return_function;
		$ws->logSys('debug', 'Object Insert ',  __CLASS__, func_get_args(), 'arguments');

		$this->loadFile();		
		$item = array();
		foreach($this->_fieldAttr as $field=>$fieldAttr) {
			if (isset($argArray[$field])) {
				if ($field != 'id') {
					if ($fieldAttr['type'] == 'array') {
						$value = array();
						if (!empty($argArray[$field])) {
							foreach($argArray[$field] as $stemp) {
								$listId = array();
								$listId['listid'] = $stemp;
								$value[] = $listId;
							}
						}
					}
					else {
						$value = $argArray[$field];
					}
					$item[$field] = $value;
				}
			}
		}
		$item['id'] = $this->_id + 1;
		$this->_items[] = $item;
		$this->writeFile();
		$fct_return->returnSet($this->_id);
			
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
   public function update($argArray)
    {
		$ws = workspace::ws_open();
		$fct_return = new return_function;
		$ws->logSys('debug', 'Object Update ',  __CLASS__, func_get_args(), 'arguments');

		$this->loadFile();
		$id = 0;
		if (isset($argArray['id'])) {
			$id = $argArray['id'];
			if (isset($this->_items[$id - 1])) {
				$item = $this->_items[$id - 1];
				foreach($this->_fieldAttr as $field=>$fieldAttr) {
					if (isset($argArray[$field])) {
						if ($fieldAttr['type'] == 'array') {
							$value = array();
							if (!empty($argArray[$field])) {
								foreach($argArray[$field] as $stemp) {
									$listId = array();
									$listId['listid'] = $stemp;
									$value[] = $listId;
								}
							}
						}
						else {
							$value = $argArray[$field];
						}
						$item[$field] = $value;
					}
				}
				$this->_items[$id - 1] = $item;
				$this->writeFile();
			}
		}
		$fct_return->returnSet($id);
			
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
    public function delete($id)
    {
		$ws = workspace::ws_open();
		$fct_return = new return_function;
		$ws->logSys('debug', 'Object Delete ' . $id,  __CLASS__, func_get_args(), 'arguments');

		$this->loadFile();
		if (isset($this->_items[$id - 1])) {
			unset($this->_items[$id - 1]);
			$this->writeFile();
		}
		else {
			$id = 0;
		}
		$fct_return->returnSet($id);
			
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
	public function edit($findArray, $argArray)
    {

		$ws = workspace::ws_open();
		$fct_return = new return_function;
		$ws->logSys('debug', 'Object Edit ',  __CLASS__, func_get_args(), 'arguments');

		$id = 0;
		$fct_return->returnSet($id);
			
		return $fct_return;
	}

}

