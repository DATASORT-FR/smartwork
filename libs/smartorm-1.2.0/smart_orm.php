<?php
/**
* This file contains classes and function for the PHP developpement help
* This "work space" use smarty and extend smarty classes
*
* @package smartorm
* @version   2.3
* @date      10 Mars 2013
* @author    Alain VANDEPUTTE
* @license   http://opensource.org/licenses/gpl-license.php  GNU Public License
*/

/**
* Class PDO extension
*/
class PDO_extend extends PDO
{
 
	private static $_instance = array();
	private static $_transaction = array();
	private $_dbname;

	/********************/
	/* Public functions */
	/********************/

	/* Singleton Control*/
	public static function ws_open($dbName = '') {
	
		$ws = workspace::ws_open();
		if ($dbName == '') $dbName = 'db';
		$dbName = mb_strtoupper($dbName);
		if (!isset(self::$_instance[$dbName])) {
			try {
				self::$_instance[$dbName] = new PDO_extend($dbName, $ws->paramGet($dbName.'_DSN'), $ws->paramGet($dbName.'_USERNAME'), $ws->paramGet($dbName.'_PASSWORD'));					
			}
			catch (PDOException $e) {
				self::return_exception($e);
			}

		}
		return self::$_instance[$dbName];
	}

	public static function return_exception($e, $sql = '', $param = array()) {
		$text = "File -> [". $e->getFile() . "],\r\n Line -> [" . $e->getLine() . "],\r\n Message -> [". $e->getMessage() . "]";
		$error = "ERROR SQL : " . $e->getMessage() . ",\r\n SQL : " . $sql . ",\r\n PARAM : " . var_export($param, true);
		if (class_exists('Logger')) {
			$pdo_log = Logger::getLogger(get_class());
			$pdo_log->error($error);
		}
		throw new Exception($text);
	}

	public static function initSessionSchema($dbName, $tableName)
	{
		if ($dbName == '') $dbName = 'db';
	
		if (!isset($_SESSION['schema'])) {
			$_SESSION['schema'] = array();
		}
		if (!isset($_SESSION['schema'][$dbName][$tableName])) {
			$fieldArray = array();
			try {
				$db = self::ws_open($dbName);
				$sql = 'select column_name, data_type, character_maximum_length, numeric_scale from INFORMATION_SCHEMA.COLUMNS where table_name = :table';
				$request = $db->prepare($sql);
				
				$param=array();
				$param[':table'] = $tableName;
				
				$request->execute($param);
				if (!isset($GLOBALS['Qy_nbReq'])) {
					$GLOBALS['Qy_nbReq'] = 0;
				}
				$GLOBALS['Qy_nbReq']++;
				$fieldList = $request->fetchAll();
				foreach($fieldList as $fieldStruct) {
					$fieldItem = array();
					if (isset($fieldStruct['COLUMN_NAME'])) {
						$fieldItem['name'] = $fieldStruct['COLUMN_NAME'];
						$fieldItem['type'] = $fieldStruct['DATA_TYPE'];
						$fieldItem['size'] = $fieldStruct['CHARACTER_MAXIMUM_LENGTH'];
						$fieldItem['precision'] = $fieldStruct['NUMERIC_SCALE'];
					}
					else  {
						$fieldItem['name'] = $fieldStruct['column_name'];
						$fieldItem['type'] = $fieldStruct['data_type'];
						$fieldItem['size'] = $fieldStruct['character_maximum_length'];
						$fieldItem['precision'] = $fieldStruct['numeric_scale'];
					}
					$fieldArray[] = $fieldItem;
				}	
			}
			catch (Exception $e) {
				PDO_extend::return_exception($e);
			}
			$_SESSION['schema'][$dbName][$tableName] = $fieldArray;
		}
		return $_SESSION['schema'][$dbName][$tableName];
	}

	/********************/
	/* Public functions */
	/********************/
	public function __construct($dbName, $dsn, $user=NULL, $password=NULL)
    {
		$this->_dbname = $dbName;
		try {
			mb_internal_encoding("UTF-8");
			parent::__construct($dsn, $user, $password);
			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->exec("SET NAMES 'UTF8'");
		}
		catch (PDOException $e) {
			self::return_exception($e);
		}
	}
	
    public function prepare(string $sql, array $options = []): PDOStatement|false
    {
        $statement = parent::prepare($sql);
        if(strpos(strtoupper($sql), 'SELECT') === 0) //requête "SELECT"
        {
            $statement->setFetchMode(PDO::FETCH_ASSOC);
        }

        return $statement;
    }

	/* begin Transaction Control*/
	public function beginTransaction():bool {
		$dbName = $this->_dbname;
		$sequence = 0;
	
		if (isset(self::$_transaction[$dbName])) {
			$sequence = self::$_transaction[$dbName];
		}
		$sequence = $sequence + 1;
		self::$_transaction[$dbName] = $sequence;
		if ($sequence == 1) {
			parent::beginTransaction();
		}
		return $sequence;
	}

	/* commit Transaction Control*/
	public function commit():bool {
		$dbName = $this->_dbname;

		if (isset(self::$_transaction[$dbName])) {
			$sequence = self::$_transaction[$dbName];
			if ($sequence == 1) {
				parent::commit();
				$sequence = 0;
			}
			else {
				$sequence = $sequence - 1;
			}
		}
		else {
			$sequence = 0;
		}
		self::$_transaction[$dbName] = $sequence;
		return $sequence;
	}

	/* rollBack Transaction Control*/
	public function rollBack():bool {
		$dbName = $this->_dbname;

		if (isset(self::$_transaction[$dbName])) {
			$sequence = self::$_transaction[$dbName];
			if ($sequence == 1) {
				parent::rollBack();
				$sequence = 0;
			}
			else {
				$sequence = $sequence - 1;
			}
		}
		else {
			$sequence = 0;
		}
		self::$_transaction[$dbName] = $sequence;
		return $sequence;
	}
	
}

/**
* Class SQL request management using PDO
*/
class Smart_select
{

    private static $_instance;
	private static $_orderCounter;
	private static $_whereCounter;
	
    private $_dbname;
    private $_dbtable;
    private $_dbfield_join;
    private $_dbfield = array();
    private $_dbfieldAll = false;
    private $_dbfield_nb;
    private $_dbgroup;
    private $_dbjoin;
    private $_dbjoin_nb;
    private $_dbwhere;
    private $_dbwhere_nb;
    private $_dborder;
    private $_dborder_nb;
	private $_scroll;
    private $_request;

    public function __construct($value, $dbname = '')
    {
		$this->_dbtable = $value;
		$this->_dbname = $dbname;
		$this->_dbfieldAll = false;
		$this->_dbfield_nb = 0;
		$this->_dbwhere_nb = 0;
		$this->_dborder_nb = 0;
		$this->_dbjoin_nb = 0;
		$this->_scroll = false;
		$this->_dbgroup = false;
		if (!isset($GLOBALS['Qy_nbReq'])) {
			$GLOBALS['Qy_nbReq'] = 0;
		}
	}
	
	public function scrollGet() 
	{
		if (isset($this->_scroll)) {
			return $this->_scroll;
		} 
		else {
			return false;
		}
	}

	public function scrollSet($value) 
	{
		$this->_scroll = $value;
		if ($this->scrollGet() == $value) {
			return true;
		} else {
			return false;
		}
	}
	
	public function tableGet() 
	{
		if (isset($this->_dbtable)) {
			return $this->_dbtable;
		} 
		else {
			return '';
		}
	}

	public function tableSet($value) 
	{
		$this->_dbtable = $value;
		if ($this->tableGet() == $value) {
			return true;
		} else {
			return false;
		}
	}
	
	public function dbnameGet() 
	{
		if (isset($this->_dbname)) {
			return $this->_dbname;
		} 
		else {
			return '';
		}
	}

	public function dbnameSet($value) 
	{
		$this->_dbname = $value;
		if ($this->dbnameGet() == $value) {
			return true;
		} else {
			return false;
		}
	}

	public function field_joinGet() 
	{
		if (isset($this->_dbfield_join)) {
			return $this->_dbfield_join;
		} 
		else {
			return '';
		}
	}

	public function field_joinSet($value) 
	{
		$this->_dbfield_join = $value;
		if ($this->field_joinGet() == $value) {
			return true;
		} else {
			return false;
		}
	}

	public function field_nbGet() 
	{
		return $this->_dbfield_nb;
	}

	public function fieldGet() 
	{
		return $this->_dbfield;
	}

	public function fieldSet($field, $field_map = '') 
	{

		$field_item['field'] = $field;
		if ($field_map == ''){
			$field_item['field_map'] = $field;
		}
		else {
			$field_item['field_map'] = $field_map;
		}
		$field_item['group'] = 0;
		if ($this->_dbgroup == true) {
			$field_item['group'] = 1;
		}
		$this->_dbfield[] = $field_item;
		$this->_dbfield_nb = $this->_dbfield_nb + 1;
	}

	public function fieldAll() 
	{
		$this->_dbfieldAll = true;
//		$arrayField = PDO_extend::initSessionSchema($this->_dbname, $this->_dbtable);
//		foreach($arrayField as $fieldItem) {
//			$this->fieldSet($fieldItem['name']);
//		}
	}
	
	public function groupGet() 
	{
		return $this->_dbgroup;
	}

	public function groupSet() 
	{
		$this->_dbgroup = true;
	}
	
	public function where_nbGet() 
	{
		return $this->_dbwhere_nb;
	}

	public function whereGet() 
	{
		return $this->_dbwhere;
	}

	public function whereSet($field, $value, $type = 'or', $operation = 'like') 
	{
		self::$_whereCounter = self::$_whereCounter + 1;
		$where_item['field'] = $field;
		$where_item['value'] = $value;
		$where_item['type'] = $type;
		$where_item['operation'] = $operation;
		$where_item['order'] = self::$_whereCounter;
		$this->_dbwhere[] = $where_item;
		$this->_dbwhere_nb = $this->_dbwhere_nb + 1;
	}
	
	public function order_nbGet() 
	{
		return $this->_dborder_nb;
	}

	public function orderGet() 
	{
		return $this->_dborder;
	}

	public function orderSet($field, $direction="ASC") 
	{
		if ($direction != "DESC") {
			$direction = "ASC";
		}
		self::$_orderCounter = self::$_orderCounter + 1;
		$order_item['field'] = $field;
		$order_item['order'] = self::$_orderCounter;
		$order_item['direction'] = $direction;
		$this->_dborder[] = $order_item;
		$this->_dborder_nb = $this->_dborder_nb + 1;
	}
	
	public function join_nbGet() 
	{
		return $this->_dbjoin_nb;
	}

	public function joinGet() 
	{
		return $this->_dbjoin;
	}

	public function joinSet($field, $table_join, $field_join) 
	{
		$join_item['field'] = $field;
		$dbtable = new Smart_select($table_join);
		$dbtable->field_joinSet($field_join);
		$join_item['table_join'] = $dbtable;
		$this->_dbjoin[] = $join_item;
		$this->_dbjoin_nb = $this->_dbjoin_nb + 1;
		if ($this->_dbgroup == true) {
			$dbtable->groupSet();
		}
		return $dbtable;
	}
		
	/** Fields in select */
    public function select_field()
    {
        $sql = "";
		if ($this->_dbfieldAll) {
			$sql = "*";
		}
		else {
			for ($temp=0; $temp < $this->_dbfield_nb; $temp++) {
				if ($sql <> "") {
					$sql = $sql . ", ";
				}
				$sql = $sql . "T0." . $this->_dbfield[$temp]['field'] . " as " . $this->_dbfield[$temp]['field_map'];
			}
			$num_table = 0;
			for ($temp_join=0; $temp_join < $this->_dbjoin_nb; $temp_join++) {
				$num_table = $num_table + 1;
				$table_join = $this->_dbjoin[$temp_join]['table_join'];
				$join_field = $table_join->fieldGet();

				for ($temp=0; $temp < $table_join->field_nbGet(); $temp++) {
					if ($sql <> "") {
						$sql = $sql . ", ";
					}
					$sql = $sql . "T" . $num_table . "." . $join_field[$temp]['field'] . " as " . $join_field[$temp]['field_map'];
				}
				$old_num_table = $num_table;
				for ($temp_join1=0; $temp_join1 < $table_join->_dbjoin_nb; $temp_join1++) {
					$num_table = $num_table + 1;
					$table_join1 = $table_join->_dbjoin[$temp_join1]['table_join'];
					$join_field = $table_join1->fieldGet();

					for ($temp1=0; $temp1 < $table_join1->field_nbGet(); $temp1++) {
						if ($sql <> "") {
							$sql = $sql . ", ";
						}
						$sql = $sql . "T" . $num_table . "." . $join_field[$temp1]['field'] . " as " . $join_field[$temp1]['field_map'];
					}
				}
			}
		}
		return $sql;
	}

	/** Fields in groupby */
    public function select_groupby()
    {
        $sql = "";
		for ($temp=0; $temp < $this->_dbfield_nb; $temp++) {
			if ($this->_dbfield[$temp]['group'] = 1) {
				if ($sql <> "") {
					$sql = $sql . ", ";
				}
				$sql = $sql . $this->_dbfield[$temp]['field_map'];
			}
		}
		for ($temp_join=0; $temp_join < $this->_dbjoin_nb; $temp_join++) {
			$table_join = $this->_dbjoin[$temp_join]['table_join'];
			$join_field = $table_join->fieldGet();

			for ($temp=0; $temp < $table_join->field_nbGet(); $temp++) {
				if ($join_field[$temp]['group'] = 1) {
					if ($sql <> "") {
						$sql = $sql . ", ";
					}
					$sql = $sql . $join_field[$temp]['field_map'];
				}
			}
			for ($temp_join1=0; $temp_join1 < $table_join->_dbjoin_nb; $temp_join1++) {
				$table_join1 = $table_join->_dbjoin[$temp_join1]['table_join'];
				$join_field = $table_join1->fieldGet();

				for ($temp1=0; $temp1 < $table_join1->field_nbGet(); $temp1++) {
					if ($join_field[$temp]['group'] = 1) {
						if ($sql <> "") {
							$sql = $sql . ", ";
						}
						$sql = $sql . $join_field[$temp1]['field_map'];
					}
				}
			}
		}
		return $sql;
	}

	/** Where in delete */
    public function delete_where()
    {
		$wherenb = $this->_dbwhere_nb;
		for ($temp=0; $temp < $this->_dbwhere_nb; $temp++) {
			$where_item['order'] = $this->_dbwhere[$temp]['order'];
			$where_item['table'] = $this->_dbtable;
			$where_item['field'] = $this->_dbwhere[$temp]['field'];
			$where_item['type'] = $this->_dbwhere[$temp]['type'];
			$where_item['operation'] = $this->_dbwhere[$temp]['operation'];

			$where_item['alias'] = 0;

			$where_array[]=$where_item;
		}
        $sql = "";
		if ($wherenb >0) {
			foreach ($where_array as $key => $where_item) {
				$order[$key] = $where_item['order'];
				$field[$key] = $where_item['field'];
				$type[$key] = $where_item['type'];
			}
			array_multisort($order, SORT_ASC, $field, SORT_ASC, $type, SORT_ASC, $where_array);
			$temp = 0;
			foreach ($where_array as $key => $where_item) {
				if ($temp >= 2) {
					$sql = "(" . $sql;
					$sql = $sql . ")";
				}
				$temp = $temp + 1;
				if ($sql <> "") {
					if ($where_item['type'] == 'or') {
						$sql = "" . $sql;
						$sql = $sql . " or ";
					}
					else {
						$sql = "" . $sql;
						$sql = $sql . " and ";
					}
				}
				$sql = $sql . "(" . $where_item['field'] . " " . $where_item['operation'] . " :T0" . "_" . $where_item['field'] . ")";
			}
		}
		return $sql;
	}

	/** Where in select */
    public function select_where()
    {
		$wherenb = $this->_dbwhere_nb;
		for ($temp=0; $temp < $this->_dbwhere_nb; $temp++) {
			$where_item['order'] = $this->_dbwhere[$temp]['order'];
			$where_item['table'] = $this->_dbtable;
			$where_item['field'] = $this->_dbwhere[$temp]['field'];
			$where_item['type'] = $this->_dbwhere[$temp]['type'];
			$where_item['operation'] = $this->_dbwhere[$temp]['operation'];

			$where_item['alias'] = 0;

			$where_array[]=$where_item;
		}
		$count_join = 0;
		for ($temp_join=0; $temp_join < $this->_dbjoin_nb; $temp_join++) {
			$count_join = $count_join + 1;
			$table_join = $this->_dbjoin[$temp_join]['table_join'];
			$join_where = $table_join->whereGet();
			$wherenb = $wherenb + $table_join->where_nbGet();
			for ($temp=0; $temp < $table_join->where_nbGet(); $temp++) {
				$where_item['order'] = $join_where[$temp]['order'];
				$where_item['table'] = $table_join->tableGet();
				$where_item['field'] = $join_where[$temp]['field'];
				$where_item['type'] = $join_where[$temp]['type'];
				$where_item['operation'] = $join_where[$temp]['operation'];
				$where_item['alias'] = $count_join;
				$where_array[]=$where_item;
			}
			for ($temp1_join=0; $temp1_join < $table_join->_dbjoin_nb; $temp1_join++) {
				$count_join = $count_join + 1;
				$table1_join = $table_join->_dbjoin[$temp1_join]['table_join'];
				$join1_where = $table1_join->whereGet();
				$wherenb = $wherenb + $table1_join->where_nbGet();
				for ($temp=0; $temp < $table1_join->where_nbGet(); $temp++) {
					$where_item['order'] = $join1_where[$temp]['order'];
					$where_item['table'] = $table1_join->tableGet();
					$where_item['field'] = $join1_where[$temp]['field'];
					$where_item['type'] = $join1_where[$temp]['type'];
					$where_item['operation'] = $join1_where[$temp]['operation'];
					$where_item['alias'] = $count_join;
					$where_array[]=$where_item;
				}
			}
		}
        $sql = "";
		if ($wherenb >0) {
			foreach ($where_array as $key => $where_item) {
				$order[$key] = $where_item['order'];
				$table[$key] = $where_item['table'];
				$field[$key] = $where_item['field'];
				$type[$key] = $where_item['type'];

				$alias[$key] = $where_item['alias'];

			}
			array_multisort($order, SORT_ASC, $table, SORT_ASC, $field, SORT_ASC, $type, SORT_ASC, $alias, SORT_ASC, $where_array);
			$temp = 0;
			foreach ($where_array as $key => $where_item) {
				if ($temp >= 2) {
					$sql = "(" . $sql;
					$sql = $sql . ")";
				}
				$temp = $temp + 1;
				if ($sql <> "") {
					if ($where_item['type'] == 'or') {
						$sql = "" . $sql;
						$sql = $sql . " or ";
					}
					else {
						$sql = "" . $sql;
						$sql = $sql . " and ";
					}
				}
				$sql = $sql . "(T" . $where_item['alias'] . "." . $where_item['field'] . " " . $where_item['operation'] . " :T" . $where_item['alias'] . "_" . $where_item['field'] . ")";
			}
		}
		return $sql;
	}

	/** Order in select */
    public function select_order()
    {
		$ordernb = $this->_dborder_nb;
		for ($temp=0; $temp < $this->_dborder_nb; $temp++) {
			$order_item = $this->_dborder[$temp];
			$order_item['table'] = $this->_dbtable;
			$order_item['alias'] = 0;

			$order_array[]=$order_item;
		}
		for ($temp_join=0; $temp_join < $this->_dbjoin_nb; $temp_join++) {
			$table_join = $this->_dbjoin[$temp_join]['table_join'];
			$join_order = $table_join->orderGet();
			$ordernb = $ordernb + $table_join->order_nbGet();

			for ($temp=0; $temp < $table_join->order_nbGet(); $temp++) {
				$order_item = $join_order[$temp];
				$order_item['table'] = $table_join->tableGet();
				$order_item['alias'] = $temp_join + 1;

				$order_array[]=$order_item;
			}
		}
        $sql = "";
		if ($ordernb >0) {
			foreach ($order_array as $key => $order_item) {
				$order[$key]  = $order_item['order'];
				$table[$key] = $order_item['table'];
				$field[$key] = $order_item['field'];
				$alias[$key] = $order_item['alias'];
			}
			array_multisort($order, SORT_ASC, $table, SORT_ASC, $field, SORT_ASC, $alias, SORT_ASC, $order_array);
		
			foreach ($order_array as $key => $order_item) {
				if ($sql <> "") {
					$sql = $sql . ", ";
				}
				$sql = $sql . "T" . $order_item['alias'] . "." . $order_item['field'] . " " . $order_item['direction'];
			}
		}
		return $sql;
	}

	/** Join in select */
    public function select_join()
    {
        $sql = "";
		$num_table = 0;
		for ($temp=0; $temp < $this->_dbjoin_nb; $temp++) {
			$num_table = $num_table + 1;
			$table_join = $this->_dbjoin[$temp]['table_join'];
			$sql = $sql . " LEFT JOIN " . $table_join->tableGet() . " T" . $num_table;
			$sql = $sql . " ON (" . "T" . $num_table . "." . $table_join->field_joinGet() . " = " . "T0" . "." . $this->_dbjoin[$temp]['field'] . ")";

			$old_num_table = $num_table;
			for ($temp1=0; $temp1 < $table_join->_dbjoin_nb; $temp1++) {
				$num_table = $num_table + 1;
				$table_join1 = $table_join->_dbjoin[$temp1]['table_join'];
				$sql = $sql . " LEFT JOIN " . $table_join1->tableGet() . " T" . $num_table;
				$sql = $sql . " ON (" . "T" . $num_table . "." . $table_join1->field_joinGet() . " = " . "T" . $old_num_table . "." . $table_join->_dbjoin[$temp1]['field'] . ")";
			}

		}
		return $sql;
	}

	/** SQL Delete request */
    public function delete_sqlrequest()
    {
		$sql = "DELETE";
		$sql = $sql . " FROM " . $this->_dbtable . " ";
		$where = $this->delete_where();
		if ($where <> '') {
			$sql = $sql . " WHERE " . $where;
		}
		return $sql;
	}

	/** SQL Select request */
    public function select_sqlrequest()
    {
		$sql = "SELECT";
		$sql = $sql . " " . $this->select_field();
		$sql = $sql . " FROM " . $this->_dbtable . " T0";
		$sql = $sql . $this->select_join();
		$where = $this->select_where();		
		if ($where <> '') {
			$sql = $sql . " WHERE " . $where;
		}
		$groupby = $this->select_groupby();		
		if ($groupby <> '') {
			$sql = $sql . " GROUP BY " . $groupby;
		}
		$order = $this->select_order();
		if ($order <> '') {
			$sql = $sql . " ORDER BY " . $order;
		}
		return $sql;
	}

    private function execute($type='select')
    {
		$sql = '';
		$param=array();
		try {
			$db = PDO_extend::ws_open($this->_dbname);
			switch ($type) {
				case 'delete' :
					$sql = $this->delete_sqlrequest();
					break;
				default :
					$sql = $this->select_sqlrequest();
			}
			$options = array();
			if ($this->_scroll) {
				$options[PDO::ATTR_CURSOR] = PDO::CURSOR_SCROLL;
			}
			if ($options) {
				$this->_request = $db->prepare($sql, $options);
			}
			else {
				$this->_request = $db->prepare($sql);
			}
			for ($temp=0; $temp < $this->_dbwhere_nb; $temp++) {
				$param[":T0_" . $this->_dbwhere[$temp]['field']] = $this->_dbwhere[$temp]['value'];
			}
			$count_join = 0;
			for ($temp_join=0; $temp_join < $this->_dbjoin_nb; $temp_join++) {
				$count_join = $count_join + 1;
				$table_join = $this->_dbjoin[$temp_join]['table_join'];
				$join_where = $table_join->whereGet();
				for ($temp=0; $temp < $table_join->where_nbGet(); $temp++) {
					$param[":T" . $count_join . "_" . $join_where[$temp]['field']] = $join_where[$temp]['value'];
				}
				for ($temp1_join=0; $temp1_join < $table_join->_dbjoin_nb; $temp1_join++) {
					$count_join = $count_join + 1;
					$table1_join = $table_join->_dbjoin[$temp1_join]['table_join'];
					$join1_where = $table1_join->whereGet();
					for ($temp=0; $temp < $table1_join->where_nbGet(); $temp++) {
						$param[":T" . $count_join . "_" . $join1_where[$temp]['field']] = $join1_where[$temp]['value'];
					}
				}
			}
			if (class_exists('Logger')) {
				$smartorm_log = Logger::getLogger(get_class($this));
				$smartorm_log->debug('SMARTORM SQL : ' . $sql);
				$smartorm_log->debug('SMARTORM PARAM : ' . var_export($param, true));
			}
			$this->_request->execute($param);
			if (!isset($GLOBALS['Qy_nbReq'])) {
				$GLOBALS['Qy_nbReq'] = 0;
			}
			$GLOBALS['Qy_nbReq']++;
		}
		catch (Exception $e) {
			PDO_extend::return_exception($e, $sql, $param);
		}
	}

	/** PDO delete execute */
    public function delete()
    {
		try {
			$this->execute('delete');		
			return true;
		}
		catch (Exception $e) {
			PDO_extend::return_exception($e);
			return false;
		}
	}

	/** PDO request execute to array : find all items */
    public function findAll()
    {
		try {
			$return = array();
			$this->execute();		
			$this->_request->setFetchMode(PDO::FETCH_ASSOC);
			$fetch = $this->_request->fetchAll();
			if (!empty($fetch)) {
				$return = $fetch;
			}
			return $return;
		}
		catch (Exception $e) {
			PDO_extend::return_exception($e);
		}
	}

	/** PDO request execute to array : find the first item */
    public function find()
    {
		try {
			$return = array();
			$this->scrollSet(true);	
			$this->execute();		
			$this->_request->setFetchMode(PDO::FETCH_ASSOC);
			$fetch = $this->_request->fetch();
			if (!empty($fetch)) {
				$return = $fetch;
			}
			return $return;
		}
		catch (Exception $e) {
			PDO_extend::return_exception($e);
		}
	}

	/** PDO request execute to array : find the next item */
    public function findNext()
    {
		try {
			$this->_request->setFetchMode(PDO::FETCH_ASSOC);
			return $this->_request->fetch();
		}
		catch (Exception $e) {
			PDO_extend::return_exception($e);
		}
	}

	/** PDO request execute to array : find the last item */
    public function findLast()
    {
		try {
			$this->scrollSet(true);	
			$this->execute();
			$this->_request->setFetchMode(PDO::FETCH_ASSOC);
			return $this->_request->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_LAST);
		}
		catch (Exception $e) {
			PDO_extend::return_exception($e);
		}
	}

	/** PDO request execute to object : find the first item */
    public function findRecord()
    {
		try {
			$this->execute();		
			$this->_request->setFetchMode(PDO::FETCH_ASSOC);
			$record_item = $this->_request->fetch();
			if ($record_item) {
				$tb_record = new Smart_record($this->_dbtable);
				for ($temp=0; $temp < $this->_dbfield_nb; $temp++) {
					if ($this->_dbfield[$temp]['field'] == 'id') {
						$tb_record->idSet($record_item[$this->_dbfield[$temp]['field_map']]);
					}
					$tb_record->fieldSet($this->_dbfield[$temp]['field'], $record_item[$this->_dbfield[$temp]['field_map']]);
				}
				return $tb_record;
			}
		}
		catch (Exception $e) {
			PDO_extend::return_exception($e);
		}
	}

	/** PDO request execute to object : find the next item */
    public function findRecordNext()
    {
		try {
			$this->_request->setFetchMode(PDO::FETCH_ASSOC);
			$record_item = $this->_request->fetch();
			if ($record_item) {
				$tb_record = new Smart_record($this->_dbtable);
				for ($temp=0; $temp < $this->_dbfield_nb; $temp++) {
					if ($this->_dbfield[$temp]['field'] == 'id') {
						$tb_record->idSet($record_item[$this->_dbfield[$temp]['field_map']]);
					}
					$tb_record->fieldSet($this->_dbfield[$temp]['field'], $record_item[$this->_dbfield[$temp]['field_map']]);
				}
		
				return $tb_record;
			}
		}
		catch (Exception $e) {
			PDO_extend::return_exception($e);
		}
	}
}

/**
* Class table management using PDO
*/
class Smart_record
{

    private static $_instance;
	
    private $_dbtable;
    private $_dbname;
    private $_dbid;
    private $_dbfield = array();
    private $_dbfield_nb;
    private $_dbfieldFind;
    private $_dbfieldFind_nb;
    private $_request;

    public function __construct($value, $dbname = '')
    {
		$this->_dbtable = $value;
		$this->_dbname = $dbname;
		$this->_dbid = 0;
		$this->_dbfield_nb = 0;
		$this->_dbfieldFind_nb = 0;
		if (!isset($GLOBALS['Qy_nbReq'])) {
			$GLOBALS['Qy_nbReq'] = 0;
		}
	}

	public function tableGet() 
	{
		if (isset($this->_dbtable)) {
			return $this->_dbtable;
		} 
		else {
			return '';
		}
	}

	public function tableSet($value) 
	{
		$this->_dbtable = $value;
		if ($this->tableGet() == $value) {
			return true;
		} else {
			return false;
		}
	}
	
	public function dbnameGet() 
	{
		if (isset($this->_dbname)) {
			return $this->_dbname;
		} 
		else {
			return '';
		}
	}

	public function dbnameSet($value) 
	{
		$this->_dbname = $value;
		if ($this->dbnameGet() == $value) {
			return true;
		} else {
			return false;
		}
	}

	public function idGet() 
	{
		return $this->_dbid;
	}

	public function idSet($value) 
	{
		$this->_dbid = $value;
		if ($this->idGet() == $value) {
			return true;
		} else {
			return false;
		}
	}

	public function fieldGet($field) 
	{
		if (isset($this->_dbfield[$field])) {
			return $this->_dbfield[$field];
		}
		else {
			return '';
		}
	}

	public function fieldSet($field, $value) 
	{
		$this->_dbfield[$field] = $value;
		$this->_dbfield_nb = $this->_dbfield_nb + 1;
		if ($this->fieldGet($field) == $value) {
			return true;
		}
		else {
			return false;
		}
	}

	public function fieldAll($arrayValue)
	{
		$arrayField = PDO_extend::initSessionSchema($this->_dbname, $this->_dbtable);
		foreach($arrayField as $fieldItem) {
			$field = $fieldItem['name'];
			if (($field != 'id') and (isset($arrayValue[$field]))) {
				$this->fieldSet($field, $arrayValue[$field]);
			}
		}
	}

	public function fieldFindSet($field) 
	{
		$this->_dbfieldFind[] = $field;
		$this->_dbfieldFind_nb = $this->_dbfieldFind_nb + 1;
		return true;
	}

	/** Find record by Id */
	public function findId($field, $value) 
	{
        $sql = "SELECT *";
		$temp = 0;
		for ($temp=0; $temp <  $this->_dbfieldFind_nb; $temp++) {
			$field_name = $this->_dbfieldFind[$temp];
			if ($field_name <> 'id') {
				$sql = $sql . ", " . $field_name;
			}
		}
		$sql = $sql . " FROM " . $this->_dbtable;
		$sql = $sql . " WHERE ".$field." =:id";
		$db = PDO_extend::ws_open($this->_dbname);
		$param=array();
		try {
			$this->_request = $db->prepare($sql);
			$this->_request->setFetchMode(PDO::FETCH_ASSOC);
			$param[":id"] = $value;
			if (class_exists('Logger')) {
				$smartorm_log = Logger::getLogger(get_class($this));
				$smartorm_log->debug('SMARTORM SQL : ' . $sql);
				$smartorm_log->debug('SMARTORM PARAM : ' . var_export($param, true));
			}
			$this->_request->execute($param);
			if (!isset($GLOBALS['Qy_nbReq'])) {
				$GLOBALS['Qy_nbReq'] = 0;
			}
			$GLOBALS['Qy_nbReq']++;
			$record_item = $this->_request->fetch();

			if ($record_item) {
				$this->_dbid = $record_item['id'];
				return $record_item;
			} 
			else {
				return false;
			}				
		}
		catch (Exception $e) {
			PDO_extend::return_exception($e, $sql, $param);
			return false;
		}
	}

	/** SQL insert */
    public function select_sqlinsert()
    {
		$sql = "INSERT INTO";
		$sql = $sql . " " . $this->_dbtable . " (";
		$temp = 0;
		foreach ($this->_dbfield as $field => $value) {
			if ($temp > 0) {
				$sql = $sql . ",";
			}
			$sql = $sql . $field;
			$temp = $temp + 1;
		}
		$sql = $sql . ") VALUES (";
		$temp = 0;
		foreach ($this->_dbfield as $field => $value) {
			if ($temp > 0) {
				$sql = $sql . ",";
			}
			$sql = $sql . ":" . $field;
			$temp = $temp + 1;
		}
		$sql = $sql . ")";
		
		return $sql;
	}

	/** PDO insert execute */
    public function insert()
    {
		$sql = '';
		$param = array();
		try {
			$db = PDO_extend::ws_open($this->_dbname);
			$sql = $this->select_sqlinsert();
			$this->_request = $db->prepare($sql);
			foreach ($this->_dbfield as $field => $value) {
				$param[":" . $field] = $value;
			}
			if (class_exists('Logger')) {
				$smartorm_log = Logger::getLogger(get_class($this));
				$smartorm_log->debug('SMARTORM SQL : ' . $sql);
				$smartorm_log->debug('SMARTORM PARAM : ' . var_export($param, true));
			}
			$this->_request->execute($param);
			if (!isset($GLOBALS['Qy_nbReq'])) {
				$GLOBALS['Qy_nbReq'] = 0;
			}
			$GLOBALS['Qy_nbReq']++;
			$this->_dbid=$db->lastInsertId();
			return $this->_dbid;
		}
		catch (Exception $e) {
			PDO_extend::return_exception($e, $sql, $param);
			return false;
		}
	}	
	
	/** SQL update */
    public function select_sqlupdate()
    {
		$sql = "UPDATE ";
		$sql = $sql . " " . $this->_dbtable . " SET ";
		$temp = 0;
		foreach ($this->_dbfield as $field => $value) {
			if ($temp > 0) {
				$sql = $sql . ", ";
			}
			$sql = $sql . $field . " = :" .$field ;
			$temp = $temp + 1;
		}
		$sql = $sql . " WHERE id = " . $this->_dbid;
		return $sql;
	}

	/** PDO update execute */
    public function update()
    {
		$sql = '';
		$param = array();
		try {
			$db = PDO_extend::ws_open($this->_dbname);
			$sql = $this->select_sqlupdate();
			$this->_request = $db->prepare($sql);

			foreach ($this->_dbfield as $field => $value) {
				$param[":" . $field] = $value;
			}

			if (class_exists('Logger')) {
				$smartorm_log = Logger::getLogger(get_class($this));
				$smartorm_log->debug('SMARTORM SQL : ' . $sql);
				$smartorm_log->debug('SMARTORM PARAM : ' . var_export($param, true));
			}
			$this->_request->execute($param);
			if (!isset($GLOBALS['Qy_nbReq'])) {
				$GLOBALS['Qy_nbReq'] = 0;
			}
			$GLOBALS['Qy_nbReq']++;
			return true;
		}
		catch (Exception $e) {
			PDO_extend::return_exception($e, $sql, $param);
			return false;
		}
	}	
	
	/** SQL delete */
    public function select_sqldelete()
    {
		$sql = "DELETE FROM";
		$sql = $sql . " " . $this->_dbtable;
		$sql = $sql . " WHERE id = " . $this->_dbid;
		return $sql;
	}

	/** PDO update execute */
    public function delete()
    {
		$sql = '';
		$param = array();
		try {
			$db = PDO_extend::ws_open($this->_dbname);
			$sql = $this->select_sqldelete();
			$this->_request = $db->prepare($sql);

			$param=array();
			if (class_exists('Logger')) {
				$smartorm_log = Logger::getLogger(get_class($this));
				$smartorm_log->debug('SMARTORM SQL : ' . $sql);
				$smartorm_log->debug('SMARTORM PARAM : ' . var_export($param, true));
			}
			$this->_request->execute();
			if (!isset($GLOBALS['Qy_nbReq'])) {
				$GLOBALS['Qy_nbReq'] = 0;
			}
			$GLOBALS['Qy_nbReq']++;
			return true;
		}
		catch (Exception $e) {
			PDO_extend::return_exception($e, $sql, $param);
			return false;
		}
	}
		
}
