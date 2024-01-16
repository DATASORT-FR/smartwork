<?php
/**
* This file contains classes and function for business object.
*
* @package    object_global
* @version    1.0
* @date       29 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

const OK_CODE = array(
	'delete' => 'OK_110',
	'insert' => 'OK_111',
	'update' => 'OK_112',
	'edit' => 'OK_113',
	'archive' => 'OK_114',
	'copy' => 'OK_115',
	'other' => 'OK_119',
	'deletePending' => 'OK_120',
	'insertPending' => 'OK_121',
	'updatePending' => 'OK_122',
	'editPending' => 'OK_123',
	'archivePending' => 'OK_124',
	'importPending' => 'OK_125',
	'exportPending' => 'OK_126',
	);
const KO_CODE = array(
	'delete' => 'KO_110',
	'insert' => 'KO_111',
	'update' => 'KO_112',
	'edit' => 'KO_113',
	'archive' => 'KO_114',
	'copy' => 'KO_115',
	'exist' => 'KO_116',
	'not-exist' => 'KO_117',
	'other' => 'KO_119',
	'deletePending' => 'KO_120',
	'insertPending' => 'KO_121',
	'updatePending' => 'KO_122',
	'editPending' => 'KO_123',
	'archivePending' => 'KO_124',
	'importPending' => 'KO_125',
	'exportPending' => 'KO_126',
	);

/**
* Classes for business object.
*/
class BUS_object
{

    /**
    * field types
    *
    * @var array
    * @static
    * @access protected
    */
	protected static $_fieldtype = array(
		'string',
		'boolean',
		'date',
		'encrypted',
		'float',
		'integer',
		'number',
		'text',
	);

    /**
    * convert field types between data and object
    *
    * @var array
    * @static
    * @access protected
    */
	protected static $_convertfieldtype = array(
		'character varying' => 'string',
		'bigint' => 'integer',
		'integer' => 'integer',
		'smallint' => 'integer',
		'numeric'=> 'number',
		'timestamp without time zone' => 'date',
		'date' => 'date',
		'text' => 'text'
	);

    /**
    * Instance identifier
    *
    * @var object
    * @static
    * @access private
    */
	private static $_instance;
	
    private $_dbname;
    private $_name;
    private $_id;
	private $_client;
	private $_creationDate;
	private $_updateDate;
	private $_changeDate = array();
	
    private $_table = array();
	private $_join = array();

	private $_field = array();
    private $_order = array();
    private $_where = array();
    private $_filter = array();
    private $_value = array();
	private $_fieldAttr = array();
	private $_fieldCompo = array();
	private $_fieldFct = array();
	private $_arrayCode = array();
	private $_codeValueField = "code";
	private $_selectValueField = "id";
	private $_selectLabelField = "label";

    private $_object = array();
	private $_joinObject = array();
	private $_fieldObject = array();	
	
	/**
	* find table in the object structure by nama
	*
	* @param string - table map name
	*
	* @return integer - table number (0 if the table is not found)
	*
    * @access private
	*/
    private function findTable($table)
    {
		$index = 0;
		for ($i=0; $i < count($this->_table); $i++) {
			$tableItem = $this->_table[$i];
			if ($tableItem['table'] == $table) {
				$index = $i + 1;
			}
		}
		return $index;
	}
	
	/**
	* find join table in the object structure by nama
	*
	* @param string - table name
	*
	* @param string - field name
	*
	* @return integer - join table number (0 if the table is not found)
	*
    * @access private
	*/
    private function findJoinTable($table, $field)
    {
		$index = 0;
		for ($i=0; $i < count($this->_join); $i++) {
			$joinItem = $this->_join[$i];
			if (($joinItem['table'] == $table) and ($joinItem['field'] == $field)) {
				$index = $i + 1;
			}
		}
		return $index;
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
	* find field where number in the object structure by name
	*
	* @param string - field name
	*
	* @return integer - field where number (0 if the field is not found)
	*
    * @access private
	*/
    private function findWhere($field)
    {
		$index = 0;
		for ($i=0; $i < count($this->_where); $i++) {
			$whereItem = $this->_where[$i];
			if ($whereItem['field'] == $field) {
				$index = $i + 1;
			}
		}
		return $index;
	}
		
	/**
	* find order number for the field in the object structure by name
	*
	* @param integer - sort index
	*
	* @param string - field name
	*
	* @return integer - order number for the field in the sort index (0 if the field is not found)
	*
    * @access private
	*/
    private function findOrder($sortIndex, $field) 
	{
		$index = 0;
		for ($i=0; $i < count($this->_order); $i++) {
			$orderItem = $this->_order[$i];
			if (($orderItem['order'] == $sortIndex) and ($orderItem['field'] == $field)) {
				$index = $i + 1;
			}
		}
		return $index;
	}
	
	/**
	* find linked Object in the object structure by nama
	*
	* @param string - object name
	*
	* @return integer - object number (0 if the object is not found)
	*
    * @access private
	*/
    private function findObject($object)
    {
		$index = 0;
		for ($i=0; $i < count($this->_object); $i++) {
			$objectItem = $this->_object[$i];
			if ($objectItem['object'] == $object) {
				$index = $i + 1;
			}
		}
		return $index;
	}
	
	/**
	* find join object in the object structure by name
	*
	* @param string - object name
	*
	* @param string - field name
	*
	* @return integer - join object number (0 if the object is not found)
	*
    * @access private
	*/
    private function findJoinObject($object, $field)
    {
		$index = 0;
		for ($i=0; $i < count($this->_joinObject); $i++) {
			$joinObject_item = $this->_joinObject[$i];
			if (($joinObject_item['object'] == $object) and ($joinObject_item['field'] == $field)) {
				$index = $i + 1;
			}
		}
		return $index;
	}
	
	/**
	* constructor bus_object
    *
    * @access public
	*/
    public function __construct() {
		$this->_id = '';
		$this->_dbname = '';
		$this->_creationDate = '';
		$this->_updateDate = '';
	}
	
	/**
	* Display functionnal Message
	*
	* @param string - function ('delete', 'insert', 'update')
	* 		 string	- type of code (OK or KO)
	* 		 array	- Array of object values
	*
	* @return No
	*
    * @access public
	*/
   public function Msg($function, $type, $argArray=array())
    {
		$ws = workspace::ws_open();
		$logType = 'info';
		if (isset($this->_arrayCode[$function])) {
			$arrayCode = $this->_arrayCode[$function];
		}
		else {
			$arrayCode = array();			
		}
		switch ($type) {
			case 'OK' :
				$logType = 'info';
				if (isset(OK_CODE[$function])) {
					$code = OK_CODE[$function];
				}
				else {
					$code = OK_CODE['other'];
				}
				if (isset($arrayCode['OK'])) {
					if ($arrayCode['OK'] <> '') {
						$code = $arrayCode['OK'];
					}
				}
				break;
			case 'KO' :
				$logType = 'error';
				if (isset(KO_CODE[$function])) {
					$code = KO_CODE[$function];
				}
				else {
					$code = KO_CODE['other'];
				}
				if (isset($arrayCode['OK'])) {
					if ($arrayCode['OK'] <> '') {
						$code = $arrayCode['OK'];
					}
				}
				break;
		}
		$codeValue = '';
		if (isset($argArray[$this->_codeValueField])) {
			$codeValue = $argArray[$this->_codeValueField];
		}
		else {
			if (isset($argArray['code'])) {
				$codeValue = $argArray['code'];
			}
			else {
				if (isset($argArray['id'])) {
					$codeValue = $argArray['id'];
				}
			}
		}
		$ws->logfunc($logType, $code, array('name' => $this->nameGet(), 'code' => $codeValue));
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
	* find field filter number  in the object structure by name
	*
	* @param string - field name
	*
	* @return integer - field filter number (0 if the field is not found)
	*
    * @access public
	*/
    public function findFilter($field)
    {
		$index = 0;
		for ($i=0; $i < count($this->_filter); $i++) {
			$filterItem = $this->_filter[$i];
			if ($filterItem['field'] == $field) {
				$index = $i + 1;
			}
		}
		return $index;
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
		$this->objectSet($name);
		$this->_name = $name;
	}

	/**
	* Get object dbname
	*
	* @return string object dbname
	*
    * @access public
	*/
	public function dbnameGet() {
		return $this->_dbname;
	}

	/**
	* Initialize object dbname
	*
	* @param string - object dbname
	*
	* @return No
	*
    * @access public
	*/
	public function dbnameSet($dbname) {
		$this->_dbname = $dbname;
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
	* Get code for a function and a type (OK or KO)
	*
	* @param string - function ('delete', 'insert', 'update')
	* 		 string	- type of code (OK or KO)
	*
	* @return string code
	*
    * @access public
	*/
	public function codeGet($function, $type) {
		return $this->_arrayCode[$function][$type];
	}

	/**
	* Initialize code for a function and a type (OK or KO)
	*
	* @param string - function ('delete', 'insert', 'update')
	* 		 string - type of code (OK or KO)
	* 		 string - code value
	*
	* @return No
	*
    * @access public
	*/
	public function codeSet($function, $type, $value) {
		$this->_arrayCode[$function][$type] = $value;
	}

	/**
	* Get creationDate field name
	*
	* @return string creation Date field name
	*
    * @access public
	*/
	public function creationDateGet() {
		return $this->_creationDate;
	}

	/**
	* Initialize creationDate field name
	*
	* @param string - creation Date field name
	*
	* @return No
	*
    * @access public
	*/
	public function creationDateSet($creationDate) {
		$this->_creationDate = $creationDate;
	}

	/**
	* Get updateDate field name
	*
	* @return string update Date field name
	*
    * @access public
	*/
	public function updateDateGet() {
		return $this->_updateDate;
	}

	/**
	* Initialize updateDate field name
	*
	* @param string - update Date field name
	*
	* @return No
	*
    * @access public
	*/
	public function updateDateSet($updateDate) {
		$this->_updateDate = $updateDate;
	}
	
	/**
	* Get changeDate field name
	*
	* @return Array of tables 
	* 				field_date 		=> name of the date field
	* 				field_changed	=> field name whose value changes affect the date
	*
    * @access public
	*/
	public function changeDateGet() {
		return $this->_changeDate;
	}

	/**
	* Initialize changeDate field name
	*
	* @param string - name of the date field
	* @param string - field name whose value changes affect the date
	*
	* @return No
	*
    * @access public
	*/
	public function changeDateSet($changeDate, $fieldName) {
		$fieldItem['field_date'] = $changeDate;
		$fieldItem['field_changed'] = $fieldName;
		$this->_changeDate = $fieldItem;
	}

	/**
	* Get select label field
	*
	* @return string select label field
	*
    * @access public
	*/
	public function selectLabelFieldGet() {
		return $this->_selectLabelField;
	}

	/**
	* Initialize select label field
	*
	* @param string - select label field
	*
	* @return No
	*
    * @access public
	*/
	public function selectLabelFieldSet($field) {
		$this->_selectLabelField = $field;
	}

	/**
	* Get select Value field
	*
	* @return string select value field
	*
    * @access public
	*/
	public function selectValueFieldGet() {
		return $this->_selectValueField;
	}

	/**
	* Initialize select value field
	*
	* @param string - select value field
	*
	* @return No
	*
    * @access public
	*/
	public function selectValueFieldSet($field) {
		$this->_selectValueField = $field;
	}

	/**
	* Get code Value field
	*
	* @return string code value field
	*
    * @access public
	*/
	public function codeValueFieldGet() {
		return $this->_codeValueField;
	}

	/**
	* Initialize code value field
	*
	* @param string - code value field
	*
	* @return No
	*
    * @access public
	*/
	public function codeValueFieldSet($field) {
		$this->_codeValueField = $field;
	}

	/**
	* Initialize table
	*
	* @param string - table name
	*
	* @param string - table name in Database
	*
	* @return No
	*
    * @access public
	*/
	public function tableSet($table, $tablename = '') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		$control = true;
		if ($control) {
			if ($this->findTable($table)) {
				$control = false;
			}
		}
		if ($control) {
			if ($tablename == '') {
				$tablename = $table;
			}
			$tableItem['table'] = $table;
			$tableItem['tablename'] = $tablename;
			$this->_table[] = $tableItem;
		}
		if (!$control) {
			$ws->logSys('debug', 'Error on function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		}
	}

	/**
	* Initialize table join
	*
	* @param string - table name
	*
	* @param string - join field in the table
	*
	* @param string - source table
	*
	* @param string - join field in the source table
	*
	* @return No
	*
    * @access public
	*/
	public function joinTableSet($table, $field, $table_src, $field_src) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		$control = true;
		if ($control) {
			if ($this->findJoinTable($table, $field)) {
				$control = false;
			}
		}
		if (!$this->findTable($table_src)) {
			$control = false;
		}
		if ($control) {
			$tableFound = false;
			if ($this->findTable($table)) {
				$tableFound = true;
			}
			if (!$tableFound) {
				$this->tableSet($table);
			}
			$joinItem['table'] = $table;
			$joinItem['field'] = $field;
			$joinItem['table_src'] = $table_src;
			$joinItem['field_src'] = $field_src;
			$this->_join[] = $joinItem;
		}
		if (!$control) {
			$ws->logSys('debug', 'Error on function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		}
	}

	/**
	* Initialize object fields
	*
	* @param string - field name in the object
	*
	* @param string - field type in the object
	*
	* @param string - table name
	*
	* @param string - field name in the table
	*
	* @return integer - field number (0 if the field is not found)
	*
    * @access public
	*/
	public function fieldAdd($field, $type='table', $table = '', $fieldname = '') {
		$fieldItem['field'] = $field;
		$fieldItem['type'] = $type;
		$fieldItem['table'] = $table;
		$fieldItem['fieldname'] = $fieldname;
		$this->_field[] = $fieldItem;
		$index = $this->findField($field);
		if ($index > 0) {
			$fieldItem = $this->_field[$index - 1];
			$fieldItem['index'] = $index;
			$this->_field[$index - 1] = $fieldItem;
		}
		return $index;
	}
	
	/**
	* Get all fields in the business object
	*
	* @param string - field name in the object
	*
	* @return Array of tables 
	* 				index 		=> index number of the field in the object
	* 				field 		=> field name in the object
	* 				type 		=> field type 
	*
    * @access public
	*/
	public function fieldGet($field) {
		$index = $this->findField($field);
		if ($index > 0) {
			$fieldItem = $this->_field[$index - 1];
		}
		else {
			$fieldItem['index'] = 0;
			$fieldItem['field'] = $field;
			$fieldItem['type'] = '';
		}
		return $fieldItem;
	}

	/**
	* Get all table fields in the business object
	*
	* @param string - field name in the object
	*
	* @return Array of tables 
	* 				index 		=> index number of the field in the object
	* 				field 		=> field name in the object
	* 				type 		=> field type 
	* 				table 		=> table name in the object
	* 				fieldname 	=> field name in the database
	*
    * @access public
	*/
	public function fieldTableGet($field) {
		$index = $this->findField($field);
		if ($index > 0) {
			$fieldItem = $this->_field[$index - 1];
		}
		else {
			$fieldItem['index'] = 0;
			$fieldItem['field'] = $field;
			$fieldItem['type'] = '';
			$fieldItem['table'] = '';
			$fieldItem['fieldname'] = '';
		}
		return $fieldItem;
	}

	/**
	* Initialize object fields by function
	*
	* @param string - field name in the object
	*
	* @param string - function name
	*
	* @param string - field name first parameter of the function
	*
	* @param string - field name second parameter of the function
	*
	* @return No
	*
    * @access public
	*/
	public function fieldFctSet($field, $function = '', $fieldname0 = '', $fieldname1 = '') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		$control = true;
		if ($control) {
			if ($fieldname0 == ''){
				$control = false;
			}
			if ($function == '') {
				$control = false;
			}
			if ($this->findField($field)) {
				$control = false;
			}
		}
		if ($control) {
			$fieldItem = $this->fieldTableGet($field);
			if (($fieldItem['index'] > 0) and ($fieldItem['type'] != 'function')) {
				$control = false;
			}
		}
		if ($control) {
			$fieldFct = array();
			if (($fieldItem['index'] > 0) and ($fieldItem['type'] == 'function')) {
				$fieldFct = $this->_fieldFct[$field];
			}
			else {
				$this->fieldAdd($field, 'function');
				$this->fieldAttrSet($field, 'string', array('readonly' => true));
			}
			$fieldFct['function'] = $function;
			$fieldFct['fieldname0'] = $fieldname0;
			$fieldFct['fieldname1'] = $fieldname1;
			$this->_fieldFct[$field] = $fieldFct;
		}
		if (!$control) {
			$ws->logSys('debug', 'Error on function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		}
	}


	/**
	* Initialize all object fields
	*
	* @param string - table name
	*
	* @return No
	*
    * @access public
	*/
	public function allTableSet($table) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');

		$arrayField = PDO_extend::initSessionSchema($this->_dbname, $table);
		foreach($arrayField as $fieldItem) {
			$field = $fieldItem['name'];
			$fieldname = $field;
			$this->fieldAdd($field, 'table', $table, $fieldname);
			if (isset(self::$_convertfieldtype[$fieldItem['type']])) {
				$fieldType = self::$_convertfieldtype[$fieldItem['type']];
			}
			else {
				$fieldType = 'string';
			}
			$attr = array();
			if ($fieldType == 'string') {
				$attr['size'] = $fieldItem['size'];
			}
			if ($fieldType == 'date') {
				$attr['format'] = $ws->sessionGet('dateFormat');
			}
			$this->fieldAttrSet($field, $fieldType, $attr);
		}
		
	}

	/**
	* Initialize object fields
	*
	* @param string - field name in the object
	*
	* @param string - table name
	*
	* @param string - field name in the table
	*
	* @return No
	*
    * @access public
	*/
	public function fieldTableSet($field, $table = '', $fieldname = '') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		$control = true;
		if ($control) {
			if ($fieldname == ''){
				$fieldname = $field;
			}
			if ($table == '') {
				if (count($this->_table) >= 1) {
					$table = $this->_table[0]['table'];
				}
				else {
					$control = false;
				}
			}
		}
		if ($control) {
			if ($this->findField($field)) {
				$control = false;
			}
		}
		if ($control) {
			if (!$this->findTable($table)) {
				$control = false;
			}
		}
		if ($control) {
			$this->fieldAdd($field, 'table', $table, $fieldname);
		}
		if (!$control) {
			$ws->logSys('debug', 'Error on function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		}
	}

	/**
	* Initialize object compo fields
	*
	* @param string - field name in the object
	*
	* @param string - type of composition 
	*
	* @param string - value or source field name
	*
	* @return No
	*
    * @access public
	*/
	public function fieldCompoSet($field, $type, $value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		$control = true;
		if ($control) {
			$fieldItem = $this->fieldTableGet($field);
			if (($fieldItem['index'] > 0) and ($fieldItem['type'] != 'compo')) {
				$control = false;
			}
		}
		if ($control) {
			if (($fieldItem['index'] > 0) and ($fieldItem['type'] == 'compo')) {
				$fieldCompo = $this->_fieldCompo[$field];
			}
			else {
				$this->fieldAdd($field, 'compo');
				$this->fieldAttrSet($field, 'string', array('readonly' => true));
			}
			$fieldCompoItem['type'] = $type;
			$fieldCompoItem['field_src'] = $value;
			$fieldCompo[] = $fieldCompoItem;
			$this->_fieldCompo[$field] = $fieldCompo;
		}
		if (!$control) {
			$ws->logSys('debug', 'Error on function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		}
	}
	
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
	public function fieldAttrGet($name) {
		if (isset($this->_fieldAttr[$name])) {
			return $this->_fieldAttr[$name];
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
	* @param string - field type
	*
	* @param array  - field attributes (size, required, case)
	*
	* @return No
	*
    * @access public
	*/
	public function fieldAttrSet($field, $fieldtype='', $attr = array()) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		$control = true;
		if ($control) {
			if (!$this->findField($field)) {
				$control = false;
			}
		}
		if ($control) {
			if (!in_array($fieldtype, self::$_fieldtype)) {
				$fieldtype = self::$_fieldtype[0];
			}
		}
		if ($control) {
			$fieldAttr['fieldtype'] = $fieldtype;

			if (isset($attr['encrypted'])) {
				$fieldAttr['encrypted'] = $attr['encrypted'];
			}
			else {
				$fieldAttr['encrypted'] = false;
			}
			
			if (isset($attr['readonly'])) {
				$fieldAttr['readonly'] = $attr['readonly'];
			}
			else {
				$fieldAttr['readonly'] = false;
			}
			if (isset($attr['required'])) {
				$fieldAttr['required'] = $attr['required'];
			}
			else {
				$fieldAttr['required'] = false;
			}
			if (isset($attr['size'])) {
				$fieldAttr['size'] = $attr['size'];
			}
			else {
				$fieldAttr['size'] = 0;
			}
			if (isset($attr['cols'])) {
				$fieldAttr['cols'] = $attr['cols'];
			}
			else {
				$fieldAttr['cols'] = 0;
			}
			if (isset($attr['rows'])) {
				$fieldAttr['rows'] = $attr['rows'];
			}
			else {
				$fieldAttr['rows'] = 0;
			}
			if (isset($attr['case'])) {
				$fieldAttr['case'] = $attr['case'];
			}
			else {
				$fieldAttr['case'] = '';
			}
			if (isset($attr['pattern'])) {
				$fieldAttr['pattern'] = $attr['pattern'];
			}
			else {
				$fieldAttr['pattern'] = '';
			}
			if (isset($attr['decimal'])) {
				$fieldAttr['decimal'] = $attr['decimal'];
			}
			else {
				$fieldAttr['decimal'] = 2;
			}
			if (isset($attr['format'])) {
				$fieldAttr['format'] = $attr['format'];
			}
			else {
				$fieldAttr['format'] = '';
			}
			$this->_fieldAttr[$field] = $fieldAttr;
		}
		if (!$control) {
			$ws->logSys('debug', 'Error on function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		}
	}

	/**
	* Initialize fields in the business object used with a forced value
	*
	* @param string - field name in the object
	* @param string - value in the object
	*
	* @return No
	*
    * @access public
	*/
	public function valueSet($field, $value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		$control = true;
		if (!$this->findField($field)) {
			$control = false;
		}
		if ($control) {
			$this->_value[$field] = $value;
		}
		if (!$control) {
			$ws->logSys('debug', 'Error on function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		}
	}

	/**
	* Get forced field value in the business object
	*
	* @param string - field name in the object
	*
	* @return string - field value
	*
    * @access public
	*/
	public function valueGet($field) {

		if (isset($this->_value[$field])) {
			$value = $this->_value[$field];
		}
		else {
			$value = "";
		}
		return $value;
	}

	/**
	* Get all forced field value in the business object
	*
	* @param none
	*
	* @return array - field values
	*
    * @access public
	*/
	public function valueAllGet() {

		return $this->_value;
	}
	
	/**
	* Initialize object
	*
	* @param string - object name
	*        string - object name in the application
	*
	* @return No
	*
    * @access public
	*/
	public function objectSet($object, $objectname = '') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		$control = true;
		if ($control) {
			if ($this->findObject($object)) {
				$control = false;
			}
		}
		if ($control) {
			if ($objectname == '') {
				$objectname = $object;
			}
			$objectItem['object'] = $object;
			$objectItem['objectname'] = $objectname;
			$this->_object[] = $objectItem;
		}
		if (!$control) {
			$ws->logSys('debug', 'Error on function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		}
	}

	/**
	* Initialize business object join
	*
	* @param string - object name
	*
	* @param string - join field in the object
	*
	* @param string - source object
	*
	* @param string - join field in the source object
	*
	* @return No
	*
    * @access public
	*/
	public function joinObjectSet($object, $field, $field_src, $objectName='') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		$control = true;
		if ($objectName == '') {
			$objectName = $object;
		}
		if ($control) {
			if ($this->findJoinTable($object, $field)) {
				$control = false;
			}
		}
		if ($control) {
			$objectFound = false;
			if ($this->findObject($object)) {
				$objectFound = true;
			}
			if (!$objectFound) {
				$this->objectSet($object, $objectName);
			}
			$joinObject_item['object'] = $object;
			$joinObject_item['field'] = $field;
			$joinObject_item['field_src'] = $field_src;
			$this->_joinObject[] = $joinObject_item;
		}
		if (!$control) {
			$ws->logSys('debug', 'Error on function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		}
	}

	/**
	* Initialize linked business object field
	*
	* @param string - field name in the object
	*
	* @param string - linked object name
	*
	* @param string - field name in the linked object
	*
	* @return No
	*
    * @access public
	*/
	public function fieldObjectSet($field, $object, $field_src='') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		$control = true;
		if ($control) {
			if ($this->findField($field)) {
				$control = false;
			}
		}
		if ($control) {
			if (!$this->findObject($object)) {
				$control = false;
			}
		}
		if (empty($field_src)) {
			$field_src = $field;
		}
		if ($control) {
			$this->fieldAdd($field, 'first', $object, $field_src);
		}
		if (!$control) {
			$ws->logSys('debug', 'Error on function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		}
	}

	/**
	* Initialize linked business object list
	*
	* @param string - field name in the object
	*
	* @param string - linked object name
	*
	* @param string - field of the list in the linked object name
	*
	* @return No
	*
    * @access public
	*/
	public function listObjectSet($field, $object, $field_src) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		$control = true;
		if ($control) {
			if ($this->findField($field)) {
				$control = false;
			}
		}
		if ($control) {
			if (!$this->findObject($object)) {
				$control = false;
			}
		}
		if ($control) {
			$this->fieldAdd($field, 'list', $object, $field_src);
		}
		if (!$control) {
			$ws->logSys('debug', 'Error on function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		}
	}

	/**
	* Initialize linked business object datas
	*
	* @param string - field name in the object
	*
	* @param string - linked object name
	*
	* @return No
	*
    * @access public
	*/
	public function dataObjectSet($field, $object, $field_src='') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		$control = true;
		if ($control) {
			if ($this->findField($field)) {
				$control = false;
			}
		}
		if ($control) {
			if (!$this->findObject($object)) {
				$control = false;
			}
		}
		if ($control) {
			$this->fieldAdd($field, 'data', $object, $field_src);
		}
		if (!$control) {
			$ws->logSys('debug', 'Error on function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		}
	}

	/**
	* Initialize fields in the business object used in the where clause
	*
	* @param string - field name in the object
	*
	* @return No
	*
    * @access public
	*/
	public function whereTableSet($field) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		$control = true;
		if (!$this->findField($field)) {
			$control = false;
		}
		if ($control) {
			if ($this->findWhere($field)) {
				$control = false;
			}
		}
		if ($control) {
			$whereItem['field'] = $field;
			$this->_where[] = $whereItem;
		}
		if (!$control) {
			$ws->logSys('debug', 'Error on function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		}
	}

	/**
	* Initialize fields in the business object used in the filter clause
	*
	* @param string - field name in the object
	* @param string - value for the field name
	* @param string - operator for the filter
	*
	* @return No
	*
    * @access public
	*/
	public function filterSet($field, $value, $operator='=') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		$control = true;
		if ($control) {
			if ($this->findFilter($field)) {
				$control = false;
			}
		}
		if ($control) {
			$filterItem['field'] = $field;
			$filterItem['value'] = $value;
			$filterItem['operator'] = $operator;
			$this->_filter[] = $filterItem;
		}
		if (!$control) {
			$ws->logSys('debug', 'Error on function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		}
	}

	/**
	* Get filter field value in the business object
	*
	* @param string - field name in the object
	*
	* @return string - field value
	*
    * @access public
	*/
	public function filterGetValue($field) {
		$index = $this->findFilter($field);
		if ($index) {
			$value = $this->_filter[$index - 1]['value'];
		}
		return $value;
	}
	
	/**
	* Get filter field array
	*
	* @return string - array of filter field
	*				field : field name
	*				value : value of field for filter 
	*
    * @access public
	*/
	public function filterGet() {
		$value = $this->_filter;
		return $value;
	}
	
	/**
	* Initialize fields in the business object used to calculate order
	*
	* @param integer - order number
	*
	* @param string - field name in the object
	*
	* @return No
	*
    * @access public
	*/
	public function orderTableSet($sortIndex, $field) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		$control = true;
		if ($this->findOrder($sortIndex, $field)) {
			$control = false;
		}
		if ($control) {
			$orderItem['order'] = $sortIndex;
			$orderItem['field'] = $field;
			$this->_order[] = $orderItem;
		}
		if (!$control) {
			$ws->logSys('debug', 'Error on function ' . __FUNCTION__ . ' for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');
		}
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
    public function displayList()
    {

		$tbObject = array();
		
		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new return_function;
		$ws->logSys('debug', $this->_dbname . ' - Object DisplayList for ' . $this->_name,  __CLASS__, func_get_args(), 'arguments');
		$error = '';

		$whereArray = array();
		$order = '';
		$search_text = '';
		$sort = '';
		$sortOrder = '';
		$noident = 1;
		$argFunc = func_get_args();
		for($temp=0; $temp < count($argFunc); $temp++) {
			$atemp = explode(':', $argFunc[$temp]);
			if (count($atemp) > 1) {
				switch (strtoupper(trim($atemp[0]))) {
					case 'ORDER' :
						$order = trim($atemp[1]);
						break;
					case 'SEARCH' :
						$search_text = trim($atemp[1]);
						break;
					case 'SORT' :
						$sort = trim($atemp[1]);
						break;
					case 'SORTORDER' :
						$sortOrder = trim($atemp[1]);
						break;
					default :
						if (!empty(trim($atemp[0]))) {
							$whereArray[trim($atemp[0])] = trim($atemp[1]);
						}
				}
			}
			else {
				switch ($noident) {
					case 1 :
						$order = trim($argFunc[$temp]);
						break;
					case 2 :
						$search_text = trim($argFunc[$temp]);
						break;
					case 3 :
						$sort = trim($argFunc[$temp]);
						break;
					case 4 :
						$sortOrder = trim($argFunc[$temp]);
						break;
				}
				$noident++;
			}
		}
		
		if (!empty($order)) {
			$order = (int)$order;
		}
		else {
			$order = 0;
		}
		if (!empty($sortOrder)) {
			$sortOrder = (int)$sortOrder;
		}
		else {
			$sortOrder = 0;
		}
		
		if ($this->_id == '') {
			$this->_id = 'id';
		}
		
		try {
			/**
			* function processing by using smartorm
			*/
			for ($temp=0; $temp < count($this->_table); $temp++) {
				$tableItem = $this->_table[$temp];
				if ($temp == 0) {
					$tbObject[$temp] = new Smart_select($tableItem['tablename'], $this->_dbname);
				}
				else {
					for ($i=0; $i < count($this->_join); $i++) {
						$joinItem = $this->_join[$i];
						if ($joinItem['table'] == $tableItem['table']) {
							$temp_src = 0;
							for ($j=0; $j < count($this->_table); $j++) {
								$table_src_item = $this->_table[$j];
								if ($joinItem['table_src'] == $table_src_item['table']) {
									$temp_src = $j;
								}
							}
							$tbObject[$temp] =$tbObject[$temp_src]->joinSet($joinItem['field_src'], $tableItem['tablename'], $joinItem['field']);
						}
					}
				}
				for ($i=0; $i < count($this->_field); $i++) {
					$fieldItem = $this->_field[$i];
					if (($fieldItem['table'] == $tableItem['table']) and ($fieldItem['type'] == 'table')) {
						$tbObject[$temp]->fieldSet($fieldItem['fieldname'],$fieldItem['field']);
					}
				}
				if ($temp == 0) {
					$findId = false;
					for ($i=0; $i < count($this->_field); $i++) {
						$fieldItem = $this->_field[$i];
						if (($fieldItem['table'] == $tableItem['table']) and ($fieldItem['field'] == 'id')) {
							$findId = true;
						}
					}
					if (!$findId) {
						$tbObject[$temp]->fieldSet($this->_id,'id');
					}
				}
			}
			if ($search_text !='') {
				for ($temp=0; $temp < count($this->_table); $temp++) {
					$tableItem = $this->_table[$temp];
					for ($i=0; $i < count($this->_where); $i++) {
						$whereItem = $this->_where[$i];
						for ($j=0; $j < count($this->_field); $j++) {
							$fieldItem = $this->_field[$j];
							if (($whereItem['field'] == $fieldItem['field']) and ($fieldItem['table'] == $tableItem['table'])) {
								$tbObject[$temp]->whereSet($fieldItem['fieldname'], '%'.$search_text.'%');
							}
						}
					}
				}
			}
				
			if (count($whereArray) > 0) {
				for ($temp=0; $temp < count($this->_table); $temp++) {
					$tableItem = $this->_table[$temp];
					foreach ($whereArray as $key=>$value) {
						for ($j=0; $j < count($this->_field); $j++) {
							$fieldItem = $this->_field[$j];
							if (($key == $fieldItem['field']) and ($fieldItem['table'] == $tableItem['table'])) {
								$tbObject[$temp]->whereSet($fieldItem['fieldname'], $value);
							}
						}
					}
				}
			}

			for ($temp=0; $temp < count($this->_table); $temp++) {
				$tableItem = $this->_table[$temp];
	
				for ($i=0; $i < count($this->_filter); $i++) {
					$filterItem = $this->_filter[$i];
					$operator = '=';
					if (isset($filterItem['operator'])) {
						$operator = $filterItem['operator'];
					}
					for ($j=0; $j < count($this->_field); $j++) {
						$fieldItem = $this->_field[$j];
						if (($filterItem['field'] == $fieldItem['field']) and ($fieldItem['table'] == $tableItem['table'])) {
							$tbObject[$temp]->whereSet($fieldItem['fieldname'], $filterItem['value'], 'and', $operator);
						}
					}
				}
			}

			if (empty($sort)) {
				for ($i=0; $i < count($this->_order); $i++) {
					$orderItem = $this->_order[$i];
					if ($orderItem['order'] == $order) {
						for ($j=0; $j < count($this->_field); $j++) {
							$fieldItem = $this->_field[$j];
							if ($orderItem['field'] == $fieldItem['field']) {
								for ($temp=0; $temp < count($this->_table); $temp++) {
									$tableItem = $this->_table[$temp];
									if ($fieldItem['table'] == $tableItem['table']) {
										$tbObject[$temp]->orderSet($fieldItem['fieldname']);
									}
								}
							}
						}
					}
				}
			}
			else {
				for ($j=0; $j < count($this->_field); $j++) {
					$fieldItem = $this->_field[$j];
					if ($sort == $fieldItem['field']) {
						for ($temp=0; $temp < count($this->_table); $temp++) {
							$tableItem = $this->_table[$temp];
							if ($fieldItem['table'] == $tableItem['table']) {
								if ($sortOrder == 0) {
									$tbObject[$temp]->orderSet($fieldItem['fieldname']);
								}
								else {
									$tbObject[$temp]->orderSet($fieldItem['fieldname'], "DESC");
								}
							}
						}
					}
				}
			}

			$returnList = $tbObject[0]->findAll();
			$addFlag = false;
			if (count($returnList) > 0) {
				if ((count($this->_fieldCompo)) or (count($this->_fieldFct))) {
					$addFlag = true;
				}
			}
			
			if ($addFlag) {	
				for ($temp=0; $temp < count($returnList); $temp++) {
					$line = $returnList[$temp];
					for ($i=0; $i < count($this->_field); $i++) {
						$fieldItem = $this->_field[$i];
						if ($fieldItem['type'] == 'compo') {
							$fieldResult="";
							$fieldCompo = $this->_fieldCompo[$fieldItem['field']];
							for ($j=0; $j < count($fieldCompo); $j++) {
								$fieldCompoItem = $fieldCompo[$j];
								switch ($fieldCompoItem['type']) {
									case 'append':
										if ($this->findField($fieldCompoItem['field_src'])) {
											$fieldResult = $fieldResult.$line[$fieldCompoItem['field_src']] ;
										}
										else {
											$fieldResult = $fieldResult.$fieldCompoItem['field_src'] ;
										}
										break;
									case 'value':
										$fieldResult = $fieldCompoItem['field_src'] ;
										break;

									default :
										$fieldResult = $fieldCompoItem['field_src'] ;
								}
							}
							$line[$fieldItem['field']] = $fieldResult;
						}
						
						if ($fieldItem['type'] == 'function') {
							$fieldResult = "";
							$fieldFct = $this->_fieldFct[$fieldItem['field']];
							$function = $fieldFct['function'];
							$fieldname0 = $fieldFct['fieldname0'];
							$fieldname1 = $fieldFct['fieldname1'];
							if (!empty($function)) {
								if (empty($fieldname0)) {
									$fieldResult = $function();
								}
								else {
									if (empty($fieldname1)) {
										if (isset($line[$fieldname0])) {
											$fieldResult = $function($line[$fieldname0]);
										}
									}
									else {
										if ((isset($line[$fieldname0])) and (isset($line[$fieldname1]))) {
											$fieldResult = $function($line[$fieldname0], $line[$fieldname1]);
										}
									}
								}
							}
							$line[$fieldItem['field']] = $fieldResult;
						}

					}
					$returnList[$temp] = $line;
				}
			}
			$fct_return->returnSet($returnList);
			
			$ws->logSys('debug', 'function OK for ' . $this->_name, __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$returnList = array();
			$fct_return->errorSet($returnList);
			$ws->logSys('error', 'function KO for ' . $this->_name . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
		}
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
    public function displaySelect()
    {
		$ws = workspace::ws_open();
		$fct_return = new return_function;
		$ws->logSys('debug', 'Object DisplaySelect for ' . $this->_name,  __CLASS__, func_get_args(), 'arguments');
		$error = '';
		
		$defaultValue='';
		$defaultDescription='';
		$fieldId='';
		$order='';
		$noident = 1;
		$argFunc = func_get_args();
		for($temp=0; $temp < count($argFunc); $temp++) {
			$atemp = explode(':', $argFunc[$temp]);
			if (count($atemp) > 1) {
				switch (strtoupper(trim($atemp[0]))) {
					case 'VALUE' :
						$defaultValue = trim($atemp[1]);
						break;
					case 'DESCRIPTION' :
						$defaultDescription = $atemp[1];
						break;
					case 'ID' :
						$fieldId = trim($atemp[1]);
						break;
					case 'ORDER' :
						$order = trim($atemp[1]);
						break;
				}
			}
			else {
				switch ($noident) {
					case 1 :
						$defaultValue = trim($argFunc[$temp]);
						break;
					case 2 :
						$defaultDescription = $argFunc[$temp];
						break;
					case 3 :
						$fieldId = trim($argFunc[$temp]);
						break;
					case 4 :
						$order = trim($argFunc[$temp]);
						break;
				}
				$noident++;
			}
		}
		if (!empty($order)) {
			$order = (int)$order;
		}
		else {
			$order = 0;
		}
		
		try {
			if (empty($fieldId)) {
				$fieldId = $this->_selectValueField;
			}
			$fieldDescription =  $this->_selectLabelField;
			$lineSelect = array();
			$returnList = array();
			/**
			* function processing by using smartorm
			*/
			$displayList = $this->displayList($order)->returnGet();
			if (($defaultValue <> "") or ($defaultDescription <> "")) {
				$lineSelect['id'] = $defaultValue;
				$lineSelect['description'] = $defaultDescription;
				$returnList[] = $lineSelect;
			}

			for ($temp=0; $temp < count($displayList); $temp++) {
				$line = $displayList[$temp];
				$lineSelect['id'] = $line[$fieldId];
				$lineSelect['description'] = $line[$fieldDescription];
				$returnList[] = $lineSelect;
			}
			$fct_return->returnSet($returnList);
			
			$ws->logSys('debug', 'function OK for ' . $this->_name, __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'function KO for ' . $this->_name . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
		}
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
		
//		if (($value <> "") or ($description <> "")) {
			$lineSelect['id'] = $value;
			$lineSelect['description'] = $description;
			$returnList[] = $lineSelect;
//		}
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
		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', $this->_dbname . ' - Object Display for ' . $this->_name, __CLASS__, func_get_args(), 'arguments');

		if ($this->_id == '') {
			$this->_id = 'id';
		}
		
		try {
			/**
			* function processing by using smartorm
			*/
			for ($temp=0; $temp < count($this->_table); $temp++) {
				$tableItem = $this->_table[$temp];
				if ($temp == 0) {
					$tbObject[$temp] = new Smart_select($tableItem['tablename'], $this->_dbname);
				}
				else {
					for ($i=0; $i < count($this->_join); $i++) {
						$joinItem = $this->_join[$i];
						if ($joinItem['table'] == $tableItem['table']) {
							$temp_src = 0;
							for ($j=0; $j < count($this->_table); $j++) {
								$table_src_item = $this->_table[$j];
								if ($joinItem['table_src'] == $table_src_item['table']) {
									$temp_src = $j;
								}
							}
							$tbObject[$temp] =$tbObject[$temp_src]->joinSet($joinItem['field_src'], $tableItem['tablename'], $joinItem['field']);
						}
					}
				}
				for ($i=0; $i < count($this->_field); $i++) {
					$fieldItem = $this->_field[$i];
					if ($fieldItem['table'] == $tableItem['table']) {
						$tbObject[$temp]->fieldSet($fieldItem['fieldname'],$fieldItem['field']);
					}
				}
				if ($temp == 0) {
					$findId = false;
					for ($i=0; $i < count($this->_field); $i++) {
						$fieldItem = $this->_field[$i];
						if (($fieldItem['table'] == $tableItem['table']) and ($fieldItem['field'] == 'id')) {
							$findId = true;
						}
					}
					if (!$findId) {
						$tbObject[$temp]->fieldSet($this->_id,'id');
					}
				}
			}
			if (isset($tbObject[0])) {
				$tbObject[0]->whereSet($this->_id, $id, '', '=');
				$line = $tbObject[0]->find();

				if ($line) {
					for ($i=0; $i < count($this->_field); $i++) {
						$fieldItem = $this->_field[$i];
						if ($fieldItem['type'] == 'compo') {
							$fieldResult="";
							$fieldCompo = $this->_fieldCompo[$fieldItem['field']];
							for ($j=0; $j < count($fieldCompo); $j++) {
								$fieldCompoItem = $fieldCompo[$j];
								if ($fieldCompoItem['type'] == 'append') {
									if ($this->findField($fieldCompoItem['field_src'])) {
										$fieldResult = $fieldResult.$line[$fieldCompoItem['field_src']] ;
									}
									else {
										$fieldResult = $fieldResult.$fieldCompoItem['field_src'] ;
									}
								}
							}
							$line[$fieldItem['field']] = $fieldResult;
						}
						if ($fieldItem['type'] == 'function') {
							$fieldResult = "";
							$fieldFct = $this->_fieldFct[$fieldItem['field']];
							$function = $fieldFct['function'];
							$fieldname0 = $fieldFct['fieldname0'];
							$fieldname1 = $fieldFct['fieldname1'];
							if (!empty($function)) {
								if (empty($fieldname0)) {
									$fieldResult = $function();
								}
								else {
									if (empty($fieldname1)) {
										if (isset($line[$fieldname0])) {
											$fieldResult = $function($line[$fieldname0]);
										}
									}
									else {
										if ((isset($line[$fieldname0])) and (isset($line[$fieldname1]))) {
											$fieldResult = $function($line[$fieldname0], $line[$fieldname1]);
										}
									}
								}
							}
							$line[$fieldItem['field']] = $fieldResult;
						}
					}

					for ($temp=1; $temp < count($this->_object); $temp++) {
						$objectItem = $this->_object[$temp];
						$object = $objectItem['object'];
						$objectname = $objectItem['objectname'];
						$objectRef = new $objectname();
						for ($i=0; $i < count($this->_joinObject); $i++) {
							$joinObject_item = $this->_joinObject[$i];
							if ($joinObject_item['object'] == $object) {
								$objectRef->filterSet($joinObject_item['field'], $line[$joinObject_item['field_src']]);
							}
						}
						$object_join[$object] = $objectRef;
					}

					$objectLink = array();
					for ($i=0; $i < count($this->_field); $i++) {
						$fieldItem = $this->_field[$i];
						
						if ($fieldItem['type'] == 'first') {
							$object = $fieldItem['table'];
							if (!isset($objectLink[$object])) {
								$objectLink[$object] = array();
							}
							$objectLink[$object][$fieldItem['field']] = $fieldItem['fieldname'];
						}
				
						if ($fieldItem['type'] == 'data') {
							$objectRef = $object_join[$fieldItem['table']];
							$objectList = $objectRef->displayList();
							$line[$fieldItem['field']] = $objectList->returnGet();
						}

					}
					
					foreach($objectLink as $object=>$objectFields) {
						$objectRef = $object_join[$object];
						for ($j=0; $j < count($this->_joinObject); $j++) {
							$joinObject_item = $this->_joinObject[$j];
							if ($joinObject_item['object'] == $object) {
								if ($joinObject_item['field_src'] != 'id') {
									$objectRef->filterSet($joinObject_item['field'], $tbObject[0]->fieldGet($joinObject_item['field_src']));
								}
								else {
									$objectRef->filterSet($joinObject_item['field'], $id);
								}
							}
						}
						$objectList = $objectRef->displayList();
						$object_array = $objectList->returnGet();
						foreach($objectFields as $field=>$fieldName) {
							if (isset($object_array[0])) {
								$line[$field] = $object_array[0][$fieldName];
							}
							else {
								$line[$field] = '';
							}
						}
					}
					$fct_return->returnSet($line);
				}
			}
			$ws->logSys('debug', 'function OK for ' . $this->_name, __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$line = array();
			$fct_return->errorSet($line);
			$ws->logSys('error', 'function KO for ' . $this->_name . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
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
    public function insert($argArray, $dbName = '')
    {
		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('info', $this->_dbname . ' - Object Insert for ' . $this->_name,  __CLASS__, func_get_args(), 'arguments');

		$db = PDO_extend::ws_open($this->_dbname);
		try {
			/**
			* function processing by using smartorm
			*/
			$id = 0;
			$db->beginTransaction();
			$tableItem = $this->_table[0];
			$tbObject = new Smart_record($tableItem['tablename'], $this->_dbname);
			if ($this->_creationDate != '') {
				$tbObject->fieldSet($this->_creationDate, date('Y-m-d H:i:s'));
			}
			if ($this->_updateDate != '') {
				$tbObject->fieldSet($this->_updateDate, date('Y-m-d H:i:s'));				
			}
			if (isset($this->_changeDate['field_date'])) {
				if ($this->_changeDate['field_date'] != '') {
					$tbObject->fieldSet($this->_changeDate['field_date'], date('Y-m-d H:i:s'));				
				}
			}
			
			for ($i=0; $i < count($this->_field); $i++) {
				$fieldItem = $this->_field[$i];
				$field = $fieldItem['field'];
				if ((isset($argArray[$field])) and (isset($this->_fieldAttr[$field]))) {
					$fieldAttr = $this->_fieldAttr[$field];
					$encrypted = $fieldAttr['encrypted'];
					if ($encrypted) {
						$argArray[$field] = md5($argArray[$field]);
					}
				}
				if ($fieldItem['type'] == 'table') {
					if ($fieldItem['table'] == $tableItem['table']) {
						$forced = false;
						if (isset($this->_value[$fieldItem['field']])) {
							$forced = true;
							$forcedValue = $this->_value[$fieldItem['field']];
						}
						if ($forced) {
							$tbObject->fieldSet($fieldItem['fieldname'],$forcedValue);
						}
						else {
							if (isset($argArray[$fieldItem['field']])) {
								$tbObject->fieldSet($fieldItem['fieldname'],$argArray[$fieldItem['field']]);
							}
						}
						
						$index = $this->findFilter($fieldItem['fieldname']);
						if ($index) {
							$filterItem = $this->_filter[$index - 1];
							$operator = '=';
							if (isset($filterItem['operator'])) {
								$operator = $filterItem['operator'];
							}
							if ($operator == '=') {
								$tbObject->fieldSet($fieldItem['fieldname'],$filterItem['value']);
							}
						}
					}
				}
			}
			$id = $tbObject->insert();
		
			$objectLink = array();
			for ($i=0; $i < count($this->_field); $i++) {
				$fieldItem = $this->_field[$i];

				if ($fieldItem['type'] == 'first') {
					$object = $fieldItem['table'];
					if (!isset($objectLink[$object])) {
						$objectLink[$object] = array();
					}
					if (isset($this->_value[$fieldItem['field']])) {
						$objectLink[$object][$fieldItem['fieldname']] = $this->_value[$fieldItem['field']];
					}
					else {
						if (isset($argArray[$fieldItem['field']])) {
							$objectLink[$object][$fieldItem['fieldname']] = $argArray[$fieldItem['field']];
						}
					}
				}
				
				if ($fieldItem['type'] == 'data') {
					$object = $fieldItem['table'];
					$temp = $this->findObject($object);
					if ($temp) {
						$temp = $temp - 1;
						$objectItem = $this->_object[$temp];
						$objectname = $objectItem['objectname'];
						$objectRef = new $objectname();
						$insertArray = array();
						for ($j=0; $j < count($this->_joinObject); $j++) {
							$joinObjectItem = $this->_joinObject[$j];
							if ($joinObjectItem['object'] == $object) {
								if (isset($insertArray[$joinObjectItem['field']])) {
									if ($joinObjectItem['field_src'] != 'id') {
										$insertArray[$joinObjectItem['field']]= $argArray[$joinObjectItem['field_src']];
									}
									else {
										$insertArray[$joinObjectItem['field']]= $id;
									}
								}
							}
						}
						if (isset($argArray[$fieldItem['field']])) {
							$objectList = $argArray[$fieldItem['field']];
							if (is_array($objectList)) {
								for ($j=0; $j < count($objectList); $j++) {
									if (!empty($fieldItem['fieldname'])) {
										$insertArray[$fieldItem['fieldname']]= $objectList[$j];
									}
									else {
										foreach($objectList[$j] as $key=>$objectValue) {
											$insertArray[$key]= $objectValue;
										}
									}
									$objectReturnId = $objectRef->insert($insertArray, $dbName)->returnGet();
									if ($objectReturnId == 0) {
										$id = 0;
									}
								}
							}
						}
					}
				}
				
			}
			
			foreach($objectLink as $object=>$objectArgArray) {
				$temp = $this->findObject($object);
				if ($temp) {
					$temp = $temp - 1;
					$objectItem = $this->_object[$temp];
					$objectname = $objectItem['objectname'];
					$objectRef = new $objectname();
					$traitObject = true;
					for ($j=0; $j < count($this->_joinObject); $j++) {
						$joinObjectItem = $this->_joinObject[$j];
						if ($joinObjectItem['object'] == $object) {
							if ($joinObjectItem['field_src'] != 'id') {
								if (isset($argArray[$joinObjectItem['field_src']])) {
									$objectRef->filterSet($joinObjectItem['field'], $argArray[$joinObjectItem['field_src']]);
									$objectArgArray[$joinObjectItem['field']]= $argArray[$joinObjectItem['field_src']];
								}
								else {
									$traitObject = false;
								}
							}
							else {
								$objectRef->filterSet($joinObjectItem['field'], $id);
								$objectArgArray[$joinObjectItem['field']]= $id;
							}
						}
					}
					if ($traitObject) {
						$objectList = $objectRef->displayList();
						$object_array = $objectList->returnGet();
					
						foreach ($this->_value as $field=>$value) {
							$index = $this->findField($field);
							if ($index > 0) {
								$fieldItem = $this->_field[$index - 1];
								$objectRef->valueSet($fieldItem['fieldname'], $value);
							}
						}
						if (isset($object_array[0])) {
							$flagUpdate = false;
							foreach($objectArgArray as $field=>$value) {
								if (!empty($value)) {
									$flagUpdate = true;
								}
							}
							if ($flagUpdate) {
								$objectArgArray['id'] = $object_array[0]['id'];
								$objectLinkReturnId = $objectRef->update($objectArgArray, $dbName)->returnGet();
								if ($objectLinkReturnId == 0) {
									$id = 0;
								}
							}
						}
						else {
							$flagInsert = false;
							foreach($objectArgArray as $field=>$value) {
								if (!empty($value)) {
									$flagInsert = true;
								}
							}
							if ($flagInsert) {
								$objectLinkReturnId = $objectRef->insert($objectArgArray, $dbName)->returnGet();
								if ($objectLinkReturnId == 0) {
									$id = 0;
								}
								else {
									$objectInsertArray = array();
									for ($j=0; $j < count($this->_joinObject); $j++) {
										$joinObjectItem = $this->_joinObject[$j];
										if ($joinObjectItem['object'] == $object) {
											if ($joinObjectItem['field'] == 'id') {
												$objectInsertArray[$joinObjectItem['field_src']] = $objectLinkReturnId;
											}
										}
									}
									if (count($objectInsertArray) > 0) {
										$tbObject = new Smart_record($tableItem['tablename'], $this->_dbname);
										$tbObject->idSet($id );
										foreach ($objectInsertArray as $field=>$value) {
											$tbObject->fieldSet($field,$value);
										}
										$tbObject->update();
									}
								}
							}
						}
					}
				}
			}
		}
		catch (exception $e) {
			$id = 0;
		}

		if ($id != 0) {
			$db->commit();
			$fct_return->returnSet($id);
			$ws->logSys('debug', 'function OK for ' . $this->_name, __CLASS__, $fct_return->returnGet(),'results');
			$this->Msg('insert','OK', $argArray);
		}
		else {
			$db->rollBack();
			$id = 0;
			$fct_return->errorSet($id);
			if (isset($e)) {
				$ws->logSys('error', 'function KO for ' . $this->_name . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			}
			else {
				$ws->logSys('error', 'function KO for ' . $this->_name, __CLASS__);
			}
			$this->Msg('insert','KO', $argArray);
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
   public function update($argArray, $dbName = '')
    {

		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('info', $this->_dbname . ' - Object Update for ' . $this->_name,  __CLASS__, func_get_args(), 'arguments');

		$db = PDO_extend::ws_open($this->_dbname);
		if ($this->_id == '') {
			$this->_id = 'id';
		}
		try {
			/**
			* function processing by using smartorm
			*/
			$id = 0;
			$db->beginTransaction();
			if (isset($argArray['id'])) {
				$id = $argArray['id'];
				$tableItem = $this->_table[0];
				$tbObject = new Smart_record($tableItem['tablename'], $this->_dbname);
				if (isset($this->_changeDate['field_date'])) {
					if (($this->_changeDate['field_date'] != '') and ($this->_changeDate['field_changed'] != '')) {
						$tbObject->fieldFindSet($this->_changeDate['field_changed']);
					}
				}
				$oldValue = $tbObject->findId($this->_id, $id);
				if ($oldValue) {
					$flagUpdate = false;
					for ($i=0; $i < count($this->_field); $i++) {
						$fieldItem = $this->_field[$i];
						$field = $fieldItem['field'];
						if ((isset($argArray[$field])) and (isset($this->_fieldAttr[$field]))) {
							$fieldAttr = $this->_fieldAttr[$field];
							$encrypted = $fieldAttr['encrypted'];
							if ($encrypted) {
								$argArray[$field] = md5($argArray[$field]);
							}
						}
						if (($fieldItem['table'] == $tableItem['table']) and ($fieldItem['fieldname'] != 'id')) {
							$forced = false;
							if (isset($this->_value[$fieldItem['field']])) {
								$forced = true;
								$forcedValue = $this->_value[$fieldItem['field']];
							}
							if ($forced) {
								$tbObject->fieldSet($fieldItem['fieldname'],$forcedValue);
								$flagUpdate = true;
							}
							else {
								if (isset($argArray[$fieldItem['field']])) {
									$tbObject->fieldSet($fieldItem['fieldname'],$argArray[$fieldItem['field']]);
									$flagUpdate = true;
								}
							}
						}
					}
					if ($this->_updateDate != '') {
						$tbObject->fieldSet($this->_updateDate, date('Y-m-d H:i:s'));				
					}
				
					if (isset($this->_changeDate['field_date'])) {
						if (($this->_changeDate['field_date'] != '') and ($this->_changeDate['field_changed'] != '')) {
							if (isset($argArray[$this->_changeDate['field_changed']])) {
								if ($argArray[$this->_changeDate['field_changed']] != $oldValue[$this->_changeDate['field_changed']]) {
									$tbObject->fieldSet($this->_changeDate['field_date'], date('Y-m-d H:i:s'));
								}
							}
						}
					}
					if ($flagUpdate) {
						$tbObject->update();
					}
				}
			
				$objectLink = array();
				for ($i=0; $i < count($this->_field); $i++) {
					$fieldItem = $this->_field[$i];
					if (isset($argArray[$fieldItem['field']])) {
					
						if ($fieldItem['type'] == 'first') {
							$object = $fieldItem['table'];
							if (!isset($objectLink[$object])) {
								$objectLink[$object] = array();
							}
						
							if (isset($this->_value[$fieldItem['field']])) {
								$objectLink[$object][$fieldItem['fieldname']] = $this->_value[$fieldItem['field']];
							}
							else {
								if (isset($argArray[$fieldItem['field']])) {
									$objectLink[$object][$fieldItem['fieldname']] = $argArray[$fieldItem['field']];
								}
							}
						}
				
						if ($fieldItem['type'] == 'data') {
							$object = $fieldItem['table'];
							$temp = $this->findObject($object);
							if ($temp) {
								$temp = $temp - 1;
								$objectItem = $this->_object[$temp];
								$objectname = $objectItem['objectname'];
								$objectRef = new $objectname();
								for ($j=0; $j < count($this->_joinObject); $j++) {
									$joinObjectItem = $this->_joinObject[$j];
									if ($joinObjectItem['object'] == $object) {
										$objectRef->filterSet($joinObjectItem['field'], $argArray[$joinObjectItem['field_src']]);
									}
								}
								$objectList = $objectRef->displayList();
								if ($objectList->statusGet()) {
									$objectArray = $objectList->returnGet();
								}
								else {
									$objectArray = array();
								}
								for ($j=0; $j < count($objectArray); $j++) {
									$objectReturnId = $objectRef->delete($objectArray[$j]['id'], $dbName)->returnGet();
									if ($objectReturnId == 0) {
										$id = 0;
									}
								}
								if ($id != 0) {
									$insertArray = array();
									for ($j=0; $j < count($this->_joinObject); $j++) {
										$joinObjectItem = $this->_joinObject[$j];
										if ($joinObjectItem['object'] == $object) {
											if ($joinObjectItem['field_src'] != 'id') {
												$insertArray[$joinObjectItem['field']]= $argArray[$joinObjectItem['field_src']];
											}
											else {
												$insertArray[$joinObjectItem['field']]= $id;
											}
										}
									}
									if (isset($argArray[$fieldItem['field']])) {
										$objectList = $argArray[$fieldItem['field']];
										if (is_array($objectList)) {
											for ($j=0; $j < count($objectList); $j++) {
												if (!empty($fieldItem['fieldname'])) {
													$insertArray[$fieldItem['fieldname']]= $objectList[$j];
												}
												else {
													foreach($objectList[$j] as $key=>$objectValue) {
														$insertArray[$key]= $objectValue;
													}
												}
												$objectReturnId = $objectRef->insert($insertArray, $dbName)->returnGet();
												if ($objectReturnId == 0) {
													$id = 0;
												}
											}
										}
									}
								}
							}
						}
					
					}
				}

				foreach($objectLink as $object=>$objectArgArray) {
					$temp = $this->findObject($object);
					if ($temp) {
						$temp = $temp - 1;
						$objectItem = $this->_object[$temp];
						$objectname = $objectItem['objectname'];
						$objectRef = new $objectname();
						for ($j=0; $j < count($this->_joinObject); $j++) {
							$joinObjectItem = $this->_joinObject[$j];
							if ($joinObjectItem['object'] == $object) {
								if ($joinObjectItem['field_src'] != 'id') {
									$objectRef->filterSet($joinObjectItem['field'], $argArray[$joinObjectItem['field_src']]);
								}
								else {
									$objectRef->filterSet($joinObjectItem['field'], $argArray['id']);
								}
								$objectRef->filterSet($joinObjectItem['field'], $argArray[$joinObjectItem['field_src']]);
								$objectArgArray[$joinObjectItem['field']]= $argArray[$joinObjectItem['field_src']];
							}
						}
						$objectList = $objectRef->displayList();
						$objectArray = $objectList->returnGet();
						foreach ($this->_value as $field=>$value) {
							$index = $this->findField($field);
							if ($index > 0) {
								$fieldItem = $this->_field[$index - 1];
								$objectRef->valueSet($fieldItem['fieldname'], $value);
							}
						}
						if (isset($objectArray[0])) {
							$objectArgArray['id'] = $objectArray[0]['id'];
							$objectLinkReturnId = $objectRef->update($objectArgArray, $dbName)->returnGet();
							if ($objectLinkReturnId == 0) {
								$id = 0;
							}
						}
						else {
							$flagInsert = false;
							foreach($objectLink[$object] as $field=>$value) {
								if (!empty($value)) {
									$flagInsert = true;
								}
							}
							if ($flagInsert) {
								$objectLinkReturnId = $objectRef->insert($objectArgArray, $dbName)->returnGet();
								if ($objectLinkReturnId == 0) {
									$id = 0;
								}
								else {
									$objectInsertArray = array();
									for ($j=0; $j < count($this->_joinObject); $j++) {
										$joinObjectItem = $this->_joinObject[$j];
										if ($joinObjectItem['object'] == $object) {
											if ($joinObjectItem['field'] == 'id') {
												$objectInsertArray[$joinObjectItem['field_src']] = $objectLinkReturnId;
											}
										}
									}
									if (count($objectInsertArray) > 0) {
										$tbObject = new Smart_record($tableItem['tablename'], $this->_dbname);
										$tbObject->idSet($id);
										foreach ($objectInsertArray as $field=>$value) {
											$tbObject->fieldSet($field,$value);
										}
										$tbObject->update();
									}
								}
							}
						}
					}
				}
			}
		}
		catch (exception $e) {
			$id = 0;
		}

		if ($id != 0) {
			$db->commit();
			$fct_return->returnSet($id);
			$ws->logSys('debug', 'function OK for ' . $this->_name, __CLASS__, $fct_return->returnGet(),'results');
			$this->Msg('update','OK', $argArray);
		}
		else {
			$db->rollBack();
			$fct_return->errorSet($id);
			if (isset($e)) {
				$ws->logSys('error', 'function KO for ' . $this->_name . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			}
			else {
				$ws->logSys('error', 'function KO for ' . $this->_name, __CLASS__);
			}
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
    public function delete($id, $dbName = '')
    {
		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('info', $this->_dbname . ' - Object Delete for ' . $this->_name,  __CLASS__, func_get_args(), 'arguments');

		$db = PDO_extend::ws_open($this->_dbname);
		if ($this->_id == '') {
			$this->_id = 'id';
		}
		
		try {
			/**
			* function processing by using smartorm
			*/
			$error = false;
			$db->beginTransaction();
			$tableItem = $this->_table[0];
			$tbObject = new Smart_record($tableItem['tablename'], $this->_dbname);
			$argArray = $tbObject->findId($this->_id, $id);
			if ($argArray) {
				$objectLink = array();
				for ($i=0; $i < count($this->_field); $i++) {
					$fieldItem = $this->_field[$i];
					
					if ($fieldItem['type'] == 'first') {
						$object = $fieldItem['table'];
						$createFlag = true;
						for ($j=0; $j < count($objectLink); $j++) {
							if ($objectLink[$j] == $object) {
								$createFlag = false;
							}
						}
						if ($createFlag) {
							$objectLink[] = $object;
						}
					}
				
					if ($fieldItem['type'] == 'data') {
						$object = $fieldItem['table'];
						$temp = $this->findObject($object);
						if ($temp) {
							$temp = $temp - 1;
							$objectItem = $this->_object[$temp];
							$objectname = $objectItem['objectname'];
							$objectRef = new $objectname();
							for ($j=0; $j < count($this->_joinObject); $j++) {
								$joinObjectItem = $this->_joinObject[$j];
								if ($joinObjectItem['object'] == $object) {
									if ($joinObjectItem['field_src'] != 'id') {
										$objectRef->filterSet($joinObjectItem['field'], $tbObject->fieldGet($joinObjectItem['field_src']));
									}
									else {
										$objectRef->filterSet($joinObjectItem['field'], $id);
									}
								}
							}
							$objectList = $objectRef->displayList();
							$object_array = $objectList->returnGet();
							if (is_array($object_array)) {
								for ($j=0; $j < count($object_array); $j++) {
									$objectReturnId = $objectRef->delete($object_array[$j]['id'], $dbName)->returnGet();
									if ($objectReturnId == 0) {
										$id = 0;
									}
								}
							}
						}
					}
					
				}
				foreach($objectLink as $key=>$object) {
					$temp = $this->findObject($object);
					if ($temp) {
						$flagDelete = true;
						$temp = $temp - 1;
						$objectItem = $this->_object[$temp];
						$objectname = $objectItem['objectname'];
						$objectRef = new $objectname();
						for ($j=0; $j < count($this->_joinObject); $j++) {
							$joinObjectItem = $this->_joinObject[$j];
							if ($joinObjectItem['object'] == $object) {
								if ($joinObjectItem['field_src'] != 'id') {
									$objectRef->filterSet($joinObjectItem['field'], $tbObject->fieldGet($joinObjectItem['field_src']));
								}
								else {
									$objectRef->filterSet($joinObjectItem['field'], $id);
								}
								if ($joinObjectItem['field'] == 'id') {
									$flagDelete = false;
								}
							}
						}
						if ($flagDelete) {
							$objectList = $objectRef->displayList();
							$object_array = $objectList->returnGet();
							if (is_array($object_array)) {
								for ($j=0; $j < count($object_array); $j++) {
									if (isset($object_array[$j]['id'])) {
										$objectLinkReturnId = $objectRef->delete($object_array[$j]['id'], $dbName)->returnGet();
										if ($objectLinkReturnId == 0) {
											$id = 0;
										}
									}
								}
							}
						}
					}
				}
				$tbObject->delete();
			}
			else {
				$error = true;
			}
		}
		catch (exception $e) {
			$id = 0;
		}

		if ($id != 0) {
			$db->commit();
			$fct_return->returnSet($id);
			$ws->logSys('debug', 'function OK for ' . $this->_name, __CLASS__, $fct_return->returnGet(),'results');
			$this->Msg('delete','OK', $argArray);
		}
		else {
			$db->rollBack();
			$fct_return->errorSet($id);
			if (isset($e)) {
				$ws->logSys('error', 'function KO for ' . $this->_name . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			}
			else {
				$ws->logSys('error', 'function KO for ' . $this->_name, __CLASS__);
			}
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
	public function edit($findArray, $argArray)
    {

		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('info', $this->_dbname . ' - Object Edit for ' . $this->_name,  __CLASS__, func_get_args(), 'arguments');

		$db = PDO_extend::ws_open($this->_dbname);
		if ($this->_id == '') {
			$this->_id = 'id';
		}
		
		try {
			/**
			* function processing by using smartorm
			*/
			for ($temp=0; $temp < count($this->_table); $temp++) {
				$tableItem = $this->_table[$temp];
				if ($temp == 0) {
					$tbObject[$temp] = new Smart_select($tableItem['tablename'], $this->_dbname);
				}
				else {
					for ($i=0; $i < count($this->_join); $i++) {
						$joinItem = $this->_join[$i];
						if ($joinItem['table'] == $tableItem['table']) {
							$temp_src = 0;
							for ($j=0; $j < count($this->_table); $j++) {
								$table_src_item = $this->_table[$j];
								if ($joinItem['table_src'] == $table_src_item['table']) {
									$temp_src = $j;
								}
							}
							$tbObject[$temp] =$tbObject[$temp_src]->joinSet($joinItem['field_src'], $tableItem['tablename'], $joinItem['field']);
						}
					}
				}
				for ($i=0; $i < count($this->_field); $i++) {
					$fieldItem = $this->_field[$i];
					if (($fieldItem['table'] == $tableItem['table']) and ($fieldItem['type'] == 'table')) {
						$tbObject[$temp]->fieldSet($fieldItem['fieldname'],$fieldItem['field']);
					}
				}
				if ($temp == 0) {
					$findId = false;
					for ($i=0; $i < count($this->_field); $i++) {
						$fieldItem = $this->_field[$i];
						if (($fieldItem['table'] == $tableItem['table']) and ($fieldItem['field'] == 'id')) {
							$findId = true;
						}
					}
					if (!$findId) {
						$tbObject[$temp]->fieldSet($this->_id,'id');
					}
				}
				foreach ($findArray  as $key => $value) {
					for ($j=0; $j < count($this->_field); $j++) {
						$fieldItem = $this->_field[$j];
						if (($key == $fieldItem['field']) and ($fieldItem['table'] == $tableItem['table'])) {
							$tbObject[$temp]->whereSet($key, '%'.$value.'%');
						}
					}
				}
				for ($i=0; $i < count($this->_filter); $i++) {
					$filterItem = $this->_filter[$i];
					$operator = '=';
					if (isset($filterItem['operator'])) {
						$operator = $filterItem['operator'];
					}
					for ($j=0; $j < count($this->_field); $j++) {
						$fieldItem = $this->_field[$j];
						if (($filterItem['field'] == $fieldItem['field']) and ($fieldItem['table'] == $tableItem['table'])) {
							$tbObject[$temp]->whereSet($fieldItem['fieldname'], $filterItem['value'], 'and', $operator);
						}
					}
				}
			}
			$returnList = $tbObject[0]->findAll();
			$db->beginTransaction();
			if (count($returnList)) {
				for ($temp=0; $temp < count($returnList); $temp++) {
					$line = $returnList[$temp];
					$argArray[$this->_id] = $line[$this->_id];
					$this->update($argArray);
				}
			}
			else {
				$this->insert($argArray);			
			}
			$db->commit();
			
			$ws->logSys('debug', 'function OK for ' . $this->_name, __CLASS__, $fct_return->returnGet(),'results');
			$this->Msg('edit','OK', $argArray);
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$db->rollBack();
			$id = 0;
			$fct_return->errorSet($id);
			$ws->logSys('error', 'function KO for ' . $this->_name . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			$this->Msg('edit','KO', $argArray);
		}
		return $fct_return;

	}

}

