<?php
/**
* Crud class
*
* @package    crud_crud
* @version    1.1
* @date       14 Août 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();
$ws = workspace::ws_open();

// Crud Parameter
$ws->paramSet('C_CRUD_NAME', 'crud');

// Crud Path
$ws->paramSet('C_CRUD_TEMPLATES_SRC_DIR', $ws->paramGet('MODULES_DIR') . $ws->paramGet('C_CRUD_NAME') . '/templates/src/');
$ws->paramSet('C_CRUD_TEMPLATES_CSS_DIR', $ws->paramGet('RELA_MODULES_DIR') . $ws->paramGet('C_CRUD_NAME') . '/templates/css/');
$ws->paramSet('C_CRUD_TEMPLATES_JS_DIR', $ws->paramGet('RELA_MODULES_DIR') . $ws->paramGet('C_CRUD_NAME') . '/templates/js/');

// Template css & js
$ws->paramSet('C_CRUD_TEMPLATE_STYLE', $ws->paramGet('C_CRUD_NAME') . '.css');
$ws->paramSet('C_CRUD_TEMPLATE_JS', $ws->paramGet('C_CRUD_NAME') . '.js');

$ws->addjs($ws->paramGet('C_CRUD_TEMPLATES_JS_DIR') . $ws->paramGet('C_CRUD_TEMPLATE_JS'));
$ws->addcss($ws->paramGet('C_CRUD_TEMPLATES_CSS_DIR') . $ws->paramGet('C_CRUD_TEMPLATE_STYLE'));

/**
* Classes for crud module.
*/
class wcrud
{

	const C_CRUD_COLUMN_MAX = 4;
	const MAX_TEXT_SIZE = 200;  
	const LABEL_SIZE = 2;  
	const HTML_DEFAULT_SIZE = 800;
	const COL_WIDTH = 450;
	
	/**
    * field types for forms
    *
    * @var array
    * @static
    * @access private
    */
	private static $_fieldDatagridType = array(
		'date',
		'datetime',
		'editor',
		'integer',
		'number',
		'text',
		'list');

	private static $_fieldType = array(
		'accordion',
		'accordioncontent',
		'accordioncontentend',
		'accordionend',
		'button',
		'buttonconfirm',
		'checkbox',
		'choice',
		'color',
		'comment',
		'crud',
		'currency',
		'datagrid',
		'date',
		'datetime',
		'display',
		'editor',
		'email',
		'file',
		'group',
		'groupend',
		'hidden',
		'image',
		'integer',
		'number',
		'page',
		'pagecontent',
		'pagecontentend',
		'pageend',
		'paraph',
		'password',
		'radio',
		'tab',
		'tabcontent',
		'tabcontentend',
		'tabend',
		'tel',
		'text',
		'textlist',
		'textarea',
		'list',
		'listmultiple',
		'listmultiple_order');

	private static $_fieldParameter = array(
		'accordion' => array(
			'labelflag' => false,
			'collabelflag' => false,
			'container' => false,
			'display' => true,
			'group' => true),
		'accordionend' => array(
			'labelflag' => false,
			'collabelflag' => false,
			'container' => false,
			'display' => false,
			'groupend' => true),
		'accordioncontent' => array(
			'labelflag' => false,
			'collabelflag' => false,
			'rowflag' => false,
			'colflag' => false,
			'container' => false,
			'display' => true,
			'group' => true),
		'accordioncontentend' => array(
			'labelflag' => false,
			'collabelflag' => false,
			'container' => false,
			'display' => false,
			'groupend' => true),
		'button' => array(
			'labelflag' => false,
			'collabelflag' => false,
			'container' => false,
			'option1' => 'page',
			'value_option2' => 'id',
			),
		'buttonconfirm' => array(
			'labelflag' => false,
			'collabelflag' => false,
			'container' => false,
			'option1' => 'page',
			'value_option2' => 'id',
			'value_option3' => 'code',
			),
		'choice' => array(
			'collabelflag' => false,
			'container' => false,
			),
		'comment' => array(
			'labelflag' => true,
			'container' => false,
			),
		'crud' => array(
			'collabelflag' => false,
			'container' => false,
			'option1' => 'page',
			'value_option2' => 'id',
			),
		'datagrid' => array(
			'labelflag' => false,
			'collabelflag' => false,
			'container' => false,
			),
		'display' => array(
			'labelflag' => false,
			'collabelflag' => false,
			'container' => true
			),
		'editor' => array(
			'labelflag' => false,
			'container' => false,
			),
		'group' => array(
			'labelflag' => false,
			'collabelflag' => false,
			'container' => false,
			'display' => true,
			'group' => true
			),
		'groupend' => array(
			'labelflag' => false,
			'collabelflag' => false,
			'display' => false,
			'groupend' => true,
			'container' => false,
			),
		'hidden' => array(
			'labelflag' => false,
			'collabelflag' => false,
			'rowflag' => false,
			'colflag' => false,
			'container' => false,
			),
		'image' => array(
			'collabelflag' => false,
			'container' => false,
			'option1' => 'path',
			),
		'list' => array(
			'collabelflag' => false,
			'option1' => 'list',
			'option2' => 'display',
			),
		'listmultiple' => array(
			'collabelflag' => false,
			'container' => false,
			'option2' => 'list',
			),
		'listmultiple_order' => array(
			'collabelflag' => false,
			'container' => false,
			'option2' => 'list'
			),
		'page' => array(
			'labelflag' => false,
			'collabelflag' => false,
			'container' => false,
			'display' => true,
			'group' => true,
			),
		'pageend' => array(
			'labelflag' => false,
			'collabelflag' => false,
			'container' => false,
			'display' => false,
			'groupend' => true,
			),
		'pagecontent' => array(
			'labelflag' => false,
			'collabelflag' => false,
			'rowflag' => false,
			'colflag' => false,
			'container' => false,
			'display' => true,
			'group' => true,
			),
		'pagecontentend' => array(
			'labelflag' => false,
			'collabelflag' => false,
			'container' => false,
			'display' => false,
			'groupend' => true,
			),
		'paraph' => array(
			'labelflag' => false,
			'collabelflag' => false,
			'container' => true,
			'option1' => 'text'
			),
		'password' => array(
			'labelflag' => false,
			'collabelflag' => false,
			'container' => false,
			),
		'tab' => array(
			'labelflag' => false,
			'collabelflag' => false,
			'container' => false,
			'display' => true,
			'group' => true,
			),
		'tabend' => array(
			'labelflag' => false,
			'collabelflag' => false,
			'container' => false,
			'display' => false,
			'groupend' => true,
			),
		'tabcontent' => array(
			'labelflag' => false,
			'collabelflag' => false,
			'rowflag' => false,
			'colflag' => false,
			'container' => false,
			'display' => true,
			'group' => true,
			),
		'tabcontentend' => array(
			'labelflag' => false,
			'collabelflag' => false,
			'container' => false,
			'display' => false,
			'groupend' => true,
			),
		'textlist' => array(
			'collabelflag' => false,
			'container' => false,
			'option1' => 'list',
			),
		'video' => array(
			'collabelflag' => false,
			'container' => false,
			'option1' => 'path',
			),
	);
		
	private static $_fieldObjectType = array(
		'boolean' => 'choice',
		'curreny' => 'currency',
		'date' => 'date',
		'datetime' => 'datetime',
		'encrypted' => 'password',
		'integer' => 'integer',
		'image' => 'image',
		'number' => 'number',
		'string' => 'text',
		'text' => 'textarea');


	private $_btokFlag;
	private $_btresetFlag;
	private $_btreturnFlag;
	private $_saveAutoFlag;
	private $_saveAutoRef;
	private $_columnNb;
	private $_command = array();
	private $_defaultValue_array = array();
	private $_display = '';
	private $_displayOnly_array = array();
	private $_editcolumnname;
	private $_datagridField = '';
	private $_datagrid_array = array();
	private $_field_array = array();
	private $_field_attr = array();
	private $_fieldLink_array = array();
	private $_filter_array = array();
	private $_initValue_array = array();
	private $_groupCurrent = 0;
	private $_html_size = 0;
	private $_groupLevel = array();
	private $_htmlId;
	private $_labelSizeDefault;
	private $_lineNb = array();
	private $_lineColNb = array();
	private $_list;
	private $_maxColNb = 0;
	private $_object;
	private $_objectFileFlag;
	private $_objectId;
	private $_objectCode;
	private $_objectName;
	private $_objectRef;
	private $_pageFlag;
	private $_phpName;
	private $_titleFlag;
	private $_writeFlag;
	private $_idFlag;
	private $_titleCode;
	private $_returnFlag;
	private $_createReturn;
	private $_actionReturn;
	private $_updateReturn;
	private $_deleteReturn;
	
	private $_value_array = array();

/* Private functions - fields management */

	/**
	* find field in the fields structure by name
	*
	* @param string - field name
	*
	* @return integer - field number (0 if the table is not found)
	*
    * @access private
	*/
    private function findField($field)
    {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$index = 0;
		$field = trim($field);
		for ($i=0; $i < count($this->_field_array); $i++) {
			$field_item = $this->_field_array[$i];
			if ($field_item['name'] == $field) {
				$index = $i + 1;
			}
		}
		return $index;
	}

	/**
	* Add group level
	*
	* @param string - group name
	*
	* @return integer - group current number (0 for the initial group)
	*
    * @access private
	*/
    private function addGroup($groupName) {		
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$this->_groupCurrent = $this->_groupCurrent  + 1;
		$this->_groupLevel[$this->_groupCurrent] = $groupName;
		return $this->_groupCurrent;
	}

	/**
	* Close group 
	*
	* @param none
	*
	* @return string - group current name
	*
    * @access private
	*/
    private function closeGroup() {	
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		if ($this->_groupCurrent > 0) {
			$this->_groupCurrent = $this->_groupCurrent  - 1;
		}
		return $this->_groupLevel[$this->_groupCurrent];
	}

	/**
	* New line 
	*
	* @param string - group Name 
	*
	* @return integer - Line number
	*
    * @access private
	*/
    private function lineNew($group = "main") {	
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		if (isset($this->_lineNb[$group])) {
			$line = $this->_lineNb[$group] + 1;
		}
		else {
			$line = 1;
		}
		$this->_lineNb[$group] = $line;
		
		return $line;
	}

	/**
	* Current line 
	*
	* @param string - group Name 
	*
	* @return integer - Line number
	*
    * @access private
	*/
    private function lineCur($group = "main", $line=1) {	
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		if (isset($this->_lineNb[$group])) {
			$line = $this->_lineNb[$group];
		}
		else {
			$line = 1;
			$this->_lineNb[$group] = $line;
		}
		return $line;
	}

	/**
	* New Column 
	*
	* @param string - group Name 
	*		 integer Line number
	*
	* @return integer - Column number
	*
    * @access private
	*/
    private function colNew($group = "main", $line=1) {	
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		if (isset($this->_lineColNb[$group][$line])) {
			$col = $this->_lineColNb[$group][$line] + 1;
			$columnNbMax = self::C_CRUD_COLUMN_MAX;
			if ($col > $columnNbMax) {
				$col = $columnNbMax;
			}
			if ($col < 1) {
				$col = 1;
			}
			$this->_lineColNb[$group][$line] = $col;
		}
		else {
			$col=1;
			$this->_lineColNb[$group][$line] = $col;
		}
		if ($col > $this->_maxColNb) {
			$this->_maxColNb = $col;
		}		
		return $col;
	}

	/**
	* Current Column 
	*
	* @param string - group Name 
	*		 integer Line number
	*
	* @return integer - Column number
	*
    * @access private
	*/
    private function colCur($group = "main", $line=1) {	
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		if (isset($this->_lineColNb[$group][$line])) {
			$col = $this->_lineColNb[$group][$line];
		}
		else {
			$col=1;
			$this->_lineColNb[$group][$line] = $col;			
		}
		if ($col > $this->_maxColNb) {
			$this->_maxColNb = $col;
		}
		return $col;
	}

	private function fieldAttrReset($field) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		if (isset($this->_field_attr[$field])) {
			$field_attr = $this->_field_attr[$field];
		}
		$type_src = '';
		$required =	false;
		$readonly =	false;
		$pattern =	'';
		$decimal =	2;
		$format =	'';
		$case =	'';
		$block_ws =	false;
		$size =	0;
		$cols = 0;
		$rows = 0;
		$max =	0;
		$objectRef = $this->_objectRef;
		if ($objectRef->fieldAttrGet($field) != null) {
			$fieldType = $objectRef->fieldAttrGet($field);
			$type_src = $fieldType['fieldtype'];
			$readonly =	$fieldType['readonly'];
			$required =	$fieldType['required'];
			$pattern =	$fieldType['pattern'];
			$decimal =	$fieldType['decimal'];
			$format =	$fieldType['format'];
			$case =	$fieldType['case'];
			$size =	$fieldType['size'];
			$cols =	$fieldType['cols'];
			$rows =	$fieldType['rows'];
			$max =	$fieldType['size'];
		}
		if (($type_src == 'date') and (empty($format))) {
			$format =	'Y-m-d';
		}
		$field_attr['required'] = $required;
		$field_attr['readonly'] = $readonly;
		$field_attr['pattern'] = $pattern;
		$field_attr['decimal'] = $decimal;
		$field_attr['format'] = $format;
		$field_attr['case'] = $case;
		if ($size > self::MAX_TEXT_SIZE) {
			$size = self::MAX_TEXT_SIZE;
		}
		$field_attr['block-ws'] = $block_ws;
		$field_attr['size'] = $size;
		$field_attr['cols'] = $cols;
		$field_attr['rows'] = $rows;
		$field_attr['max'] = $max;
		$field_attr['align'] = "";
		$this->_field_attr[$field] = $field_attr;
	}

    private function _fieldAdd($field, $line=1, $col=1, $type="", $option1="", $option2="", $option3="", $labelflag=true) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$objectRef = $this->_objectRef;
		$field = trim($field);
		switch ($field) {
			case 'clear' :
				$type = 'text';
				break;
			default :
		}

		$typeSrc = '';
		if ($type == '') {
			if ($objectRef->fieldAttrGet($field) != null) {
				$fieldType = $objectRef->fieldAttrGet($field);
				$typeSrc = $fieldType['fieldtype'];
				if (isset(self::$_fieldObjectType[$typeSrc])) {
					$type = self::$_fieldObjectType[$typeSrc];
				}
				else {
					$type = 'text';					
				}
			}
		}
		if (!in_array($type, self::$_fieldType)) {
			$type = "text";
		}

		if (isset(self::$_fieldParameter[$type]['groupend'])) {
			if (self::$_fieldParameter[$type]['groupend']) {
				$this->closeGroup();				
			}
		}
		$field_display = true;
		if (isset(self::$_fieldParameter[$type]['display'])) {
			$field_display = self::$_fieldParameter[$type]['display'];
		}
		
		if ($field_display == true) {
			$field_item['name'] = $field;
			$field_item['line'] = $line;
			$field_item['col'] = $col;
			$field_item['type'] = $type;
			$field_item['option1'] = $option1;
			$field_item['option2'] = $option2;
			$field_item['option3'] = $option3;
			$field_item['mode'] = 'all';
			$field_item['right'] = 'all';
			$field_item['parent'] = $this->_groupLevel[$this->_groupCurrent];
			$field_item['label'] = '';
			$field_item['text'] = '';
			$field_item['collabel'] = '';
			$field_item['class'] = '';

			$field_item['labelflag'] = $labelflag;
			if (isset(self::$_fieldParameter[$type]['labelflag'])) {
				$field_item['labelflag'] = self::$_fieldParameter[$type]['labelflag'];
			}
			$field_item['collabelflag'] = true;
			if (isset(self::$_fieldParameter[$type]['collabelflag'])) {
				$field_item['collabelflag'] = self::$_fieldParameter[$type]['collabelflag'];
			}
			$field_item['rowflag'] = true;
			if (isset(self::$_fieldParameter[$type]['rowflag'])) {
				$field_item['rowflag'] = self::$_fieldParameter[$type]['rowflag'];
			}
			$field_item['colflag'] = true;
			if (isset(self::$_fieldParameter[$type]['colflag'])) {
				$field_item['colflag'] = self::$_fieldParameter[$type]['colflag'];
			}
			$field_item['group'] = false;
			if (isset(self::$_fieldParameter[$type]['group'])) {
				$field_item['group'] = self::$_fieldParameter[$type]['group'];
			}
			$field_item['container'] = true;
			if (isset(self::$_fieldParameter[$type]['container'])) {
				$field_item['container'] = self::$_fieldParameter[$type]['container'];
			}
			$field_item['colsize'] = 0;
			$field_item['labelsize'] = 0;
			
			
			$this->_field_array[] = $field_item;
			$this->fieldAttrReset($field);
			if ($type == 'datagrid') {
				$this->_datagridField = $field;
				$this->_datagrid_array[$field] = array();
			}
		}
		if (isset(self::$_fieldParameter[$type]['group'])) {
			if (self::$_fieldParameter[$type]['group']) {
				$this->addGroup($field);
			}
		}
	}

/* Private functions - fields display management */
	// Line display
	//
    public function displayField($temp = 0) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$field_array = $this->_field_array;
		$value_array = $this->_value_array;
		$htmlId = $this->_htmlId;
		$display = $this->_display;
		$objectName = $this->_objectName;
		$objectId = $this->_objectId;

		// smarty parameters
		$smarty = new workpage();
		$smarty->template_dir = $ws->paramGet('C_CRUD_TEMPLATES_SRC_DIR') ;

		$field = $field_array[$temp];
		$field_id = $field['field_id'];
		$field_value = array_merge($field_array[$temp], $value_array[$temp]);
		
		$field_value['object'] = $objectName;
		$field_value['object_id'] = $objectId;
		if (isset($field['value'])) {
			$field_value['value'] = $field['value'];
		}
		$field_attr = $this->_field_attr[$field['name']];

		if ((!$this->_writeFlag) and (!$ws->paramGet('RIGHT_UPDATE'))) {
				$field_attr['readonly'] = true;
		}
		if (($field['type'] == 'group') or ($field['type'] == 'accordion') or ($field['type'] == 'accordioncontent') or ($field['type'] == 'page') or ($field['type'] == 'pagecontent') or ($field['type'] == 'tab') or ($field['type'] == 'tabcontent')) {
			$html = $this->displayGroup($field['name']);	
		}
		else {
			$html= "";
		}
		$field_value['readonly'] = $field_attr['readonly'];
		$field_value['html'] = $html;

		$plg_object = 'plg_' . $field['type'];
		$fieldForm = new $plg_object($field['name'], $field_id, $display, $field_attr);
		$display_html = $fieldForm->display($field_value);
		$smarty->assign('field', $field);
		$smarty->assign('display_html', $display_html);
		return $smarty->fetch('field.tpl');
	}

	// Column display
	//
    public function displayCol($group = "main", $line = 0, $col = 0, $col_id = "") {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$field_array = $this->_field_array;
		$lineColNb = $this->_lineColNb[$group][$line];
		$display = $this->_display;
		$colsize = 0;
		$labelsize = 0;
		
		// smarty parameters
		$smarty = new workpage();
		$smarty->template_dir = $ws->paramGet('C_CRUD_TEMPLATES_SRC_DIR') ;

		$mode = false;
		$first = true;
		$field = array();
		$display_html = '';
		$append_html = '';
		$required = false;
		for ($temp=0; $temp < count($field_array); $temp++) {
			$field_attr = $this->_field_attr[$field_array[$temp]['name']];
			if ($field_array[$temp]['parent'] == $group) {				
				if ($field_array[$temp]['line'] == $line) {
					if ($field_array[$temp]['col'] == $col) {
						if (($field_array[$temp]['mode'] == $display) or ($field_array[$temp]['mode'] == 'all')) {
							$fieldDisplay = true;
							if ($field_array[$temp]['right'] != 'all') {
								$readonly = $field_attr['readonly'];
								if ((!$this->_writeFlag) and (!$ws->paramGet('RIGHT_UPDATE')) and (!$readonly)) {
									$readonly = true;
								}
								if ($readonly and ($field_array[$temp]['right'] != 'read')) {
									$fieldDisplay = false;
								}
								if (!$readonly and ($field_array[$temp]['right'] == 'read')) {
									$fieldDisplay = false;
								}
							}
							if ($fieldDisplay) {
								if ($first) {
									$field = $field_array[$temp];
									$display_html = $this->displayField($temp);
									$field_attr = $this->_field_attr[$field['name']];
									if (isset($field_attr['required'])) {
										$required = $field_attr['required'];
									}
									$labelsize = $field['labelsize'];
									$first = false;
								}
								else {
									$append_html = $append_html . $this->displayField($temp);
								}
								$mode = true;
								if ($field_array[$temp]['colsize'] > $colsize) {
									$colsize = $field_array[$temp]['colsize'];
								}
							}
						}
					}
				}
			}
		}
		$smarty->assign('mode',$mode);
		$smarty->assign('required', $required);
		$smarty->assign('col', $col);
		$smarty->assign('col_id', $col_id);
		$smarty->assign('colNb', $lineColNb);
		$smarty->assign('field', $field);
		$smarty->assign('col_fieldSize', $colsize);
		$smarty->assign('label_size', $labelsize);
		$smarty->assign('display_html', $display_html);
		$smarty->assign('append_html', $append_html);
		$display_html = $smarty->fetch('col.tpl');
		return $display_html;
	}

	// Line display
	//
    public function displayLine($group = "main", $line = 0, $line_id = "") {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$field_array = $this->_field_array;
		// smarty parameters
		$smarty = new workpage();
		$smarty->template_dir = $ws->paramGet('C_CRUD_TEMPLATES_SRC_DIR') ;

		$col = 0;
		$first = true;
		$field = array();
		$display_html = '';
		for ($temp=0; $temp < count($field_array); $temp++) {
			if ($field_array[$temp]['parent'] == $group) {				
				if ($field_array[$temp]['line'] == $line) {
					if ($field_array[$temp]['col'] != $col) {
						if ($first) {
							$field = $field_array[$temp];
							$first = false;
						}
						$col = $field_array[$temp]['col'];
//						$col_id = "";
						if ($line_id != '') {
							$col_id = $line_id . '-' . $col;
						}
						else {
							$col_id = $group . '-' . $line . '-' . $col;
						}
						$display_html = $display_html . $this->displayCol($group, $line, $col, $col_id);
					}
				}
			}
		}
		$smarty->assign('line', $line);
		$smarty->assign('line_id', $line_id);
		$smarty->assign('field', $field);
		$smarty->assign('display_html', $display_html);
		return $smarty->fetch('line.tpl');
	}

	// Group display
	//
    public function displayGroup($group = "main", $group_id = "") {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$field_array = $this->_field_array;
		$display = $this->_display;
		// smarty parameters
		$smarty = new workpage();
		$smarty->template_dir = $ws->paramGet('C_CRUD_TEMPLATES_SRC_DIR') ;

		$display_html = '';
		$line = 0;
		for ($temp=0; $temp < count($field_array); $temp++) {
			if ($field_array[$temp]['parent'] == $group) {				
				if ($field_array[$temp]['line'] != $line) {
					$line = $field_array[$temp]['line'];
//					$line_id = "";
					if ($group_id != "") {
						$line_id = $group_id . '-' . $line;
					}
					else {
						$line_id = $group . '-' . $line;
					}
					$display_html = $display_html . $this->displayLine($group, $line, $line_id);
				}
			}
		}
		if ($line > 0) {
			$smarty->assign('group_id', $group_id);
			$smarty->assign('display_html', $display_html);
			$display_html = $smarty->fetch('group.tpl');
		}
		else {
			$display_html = '';
		}
		return $display_html;
	}	
	
    private function initSmarty(&$smarty) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$htmlSize = self::COL_WIDTH * $this->_maxColNb;
		$smarty->template_dir = $ws->paramGet('C_CRUD_TEMPLATES_SRC_DIR') ;
		$smarty->debugging = $ws->paramGet('SMARTY_DEBUG');

		// param1 criteria
		$connect = new object_connect();
		$param1 = $ws->argGet('param1');
		$btcloseRef = $connect->constructHref($ws->paramGet('APP_CODE'), $this->_phpName, 'command:list', 'param1:' . $param1, 'module:' . $ws->paramGet('MODULE_NAME'));
		if ($this->_display == 'edit') {
			$btresetRef = $connect->constructHref($ws->paramGet('APP_CODE'), $this->_phpName, 'command:edit', 'param1:' . $param1, 'module:' . $ws->paramGet('MODULE_NAME'),'id:'.$this->_objectId);
		}
		else {
			$btresetRef = $connect->constructHref($ws->paramGet('APP_CODE'), $this->_phpName, 'command:new', 'param1:' . $param1, 'module:' . $ws->paramGet('MODULE_NAME'));			
		}
		if ($this->_display == 'edit') {
			$btokRef = $connect->constructHref($ws->paramGet('APP_CODE'), $this->_phpName, 'command:update', 'param1:' . $param1, 'module:' . $ws->paramGet('MODULE_NAME'));
		}
		else {
			$btokRef = $connect->constructHref($ws->paramGet('APP_CODE'), $this->_phpName, 'command:create', 'param1:' . $param1, 'module:' . $ws->paramGet('MODULE_NAME'));
		}
		if (empty($this->_saveAutoRef)) {
			if ($this->_saveAutoFlag) {
				$saveAutoRef = $connect->constructHref($ws->paramGet('APP_CODE'), $this->_phpName, 'command:update', 'param1:' . $param1, 'module:' . $ws->paramGet('MODULE_NAME'));
			}
			else {
				$saveAutoRef = '';
			}
		}
		else {
			$saveAutoRef = $this->_saveAutoRef;
		}
		$smarty->assign('display',$this->_display);
		$smarty->assign('html_size', $htmlSize);
		$smarty->assign('object_id', $this->_objectId);
		$smarty->assign('object_code', $this->_objectCode);
		$smarty->assign('app', $ws->paramGet('APP_CODE'));
		$smarty->assign('object', $this->_object);
		$smarty->assign('html_id', $this->_htmlId);
		$smarty->assign('php_name', $this->_phpName);
		$smarty->assign('pageflag', $this->_pageFlag);
		$smarty->assign('titleflag', $this->_titleFlag);
		$smarty->assign('idflag', $this->_idFlag);
		$smarty->assign('titlecode', $this->_titleCode);
		if (($this->_writeFlag) or ($ws->paramGet('RIGHT_UPDATE'))) {
			$smarty->assign('btresetflag', $this->_btresetFlag);
			$smarty->assign('btokflag', $this->_btokFlag);
			$smarty->assign('saveautoflag', $this->_saveAutoFlag);
		}
		else {
			$smarty->assign('btresetflag', false);
			$smarty->assign('btokflag', false);
			$smarty->assign('saveautoflag', false);
		}
		$smarty->assign('btreturnflag', $this->_btreturnFlag);
		$smarty->assign('btcloseref', $btcloseRef);
		$smarty->assign('btresetref', $btresetRef);
		$smarty->assign('btokref', $btokRef);
		$smarty->assign('saveautoref', $saveAutoRef);
		
		return true;
	}
	
    private function valueFields($mode='all') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		$objectRef = $this->_objectRef;

		$field_array = $this->_field_array;
		$argArray = array();
		for ($temp=0; $temp < count($field_array); $temp++) {
			if (($field_array[$temp]['name'] != 'clear') && ($field_array[$temp]['type'] != 'button') && ($field_array[$temp]['type'] != 'buttonconfirm') && ($field_array[$temp]['type'] != 'crud')) {
				$field = $field_array[$temp]['name'];
				$field_mode = $field_array[$temp]['mode'];
				$field_type = $field_array[$temp]['type'];
				$trait = false;
				if (($field_mode == 'all') || ($field_mode == 'new') || ($field_mode == 'edit') || ($field_mode == 'no')) {
					$trait = true;
				}
				if ($trait && ($mode != 'all')) {
					if (($field_mode != 'all') && ($field_mode != 'no') && ($field_mode != $mode)) {
						$trait = false;
					}
				}
				if ($trait == true) {
					$field_attr = $this->_field_attr[$field];
					$case =	$field_attr['case'];
					$size =	$field_attr['size'];
					$max =	$field_attr['max'];
					$decimal = $field_attr['decimal'];
					$format = $field_attr['format'];
					$field_attr['type'] = $field_type;
					if ($ws->ctrlPost($field)) {
						$valueTmp = $ws->argPost($field);
					}
					else {
						if ($field_type == 'datagrid') {
							$valueTmp =  array();
						}
						else {
							$valueTmp =  '';
						}
					}
					if ($field_type == 'datagrid') {
						$datagridArray = $this->_datagrid_array[$field];
						$value = array();
						for ($i=0; $i < count($valueTmp) - 1; $i++) {
							$valueItem = array();
							$j = 0;
							$aTemp = explode('|', $valueTmp[$i]);
							foreach($datagridArray as $key=>$datagridItem) {
								if (isset($aTemp[$j])) {
									$valueField = $aTemp[$j];
								}
								else{
									$valueField = '';
								}
								$valueItem[$datagridItem['name']] = $valueField;
								$j++;
							}
							$value[] = $valueItem;
						}
					}
					else {
						$value = $valueTmp;
					}
					$argArray[$field] = $value;
					$this->_field_attr[$field] = $field_attr;
					if ($this->_objectFileFlag) {
						$objectRef->fieldAttrSet($field, $field_attr);
					}
				}
			}
		}

		return $argArray;
	}

    private function formatFields($argArray) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		foreach ($argArray as $field=>$value) {
			$field_attr = $this->_field_attr[$field];
			$case =	$field_attr['case'];
			$size =	$field_attr['size'];
			$max =	$field_attr['max'];
			$decimal = $field_attr['decimal'];
			$format = $field_attr['format'];
			$type = $field_attr['type'];
			if ($case != '') {
				if ($case == 'upper') {
					$value = strtoupper($value);
				}
				if ($case == 'lower') {
					$value = strtolower($value);
				}
			}
			switch ($type) {
				case 'date':
					if ((!empty($format)) and (!empty($value))){
						$dateValue = date_create_from_format($format,$value);
						$value = date_format($dateValue,'Y-m-d');
					}
					break;
				default :
			}
			$argArray[$field] = $value;
		}
		return $argArray;
	}

    private function initFilter() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$objectRef = $this->_objectRef;
		for ($temp=0; $temp < count($this->_filter_array); $temp++) {
			$filter = $this->_filter_array[$temp];
			$objectRef->valueSet($filter['field'], $filter['value']);
		}
	}	

    private function initValue($argArray) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		for ($temp=0; $temp < count($this->_initValue_array); $temp++) {
			$initValue = $this->_initValue_array[$temp];
			$field = $initValue['field'];
			$value = $initValue['value'];
			$type = $initValue['type'];
			$source = $initValue['source'];
			$mode = $initValue['mode'];
			if (isset($argArray[$field])) {
				if (($mode == 'init') and (empty($argArray[$field]))) {
					switch ($type) {
						case 'function':
							$function = $value;
							if (function_exists($function)) {
								$value = $function();
							}
							break;
						case 'transform':
							$function = $value;
							if (function_exists($function)) {
								if (isset($argArray[$source])) {
									$value = $function($argArray[$source]);
								}
								else {
									$value = $function($argArray);
								}
							}
							break;
						case 'value':
							$fieldSrc = $value;
							if (isset($argArray[$fieldSrc])) {
								$value = $argArray[$fieldSrc];
							}
							break;
					}
					$argArray[$field] = $value;
				}
			}
		}

		for ($temp=0; $temp < count($this->_initValue_array); $temp++) {
			$initValue = $this->_initValue_array[$temp];
			$field = $initValue['field'];
			$value = $initValue['value'];
			$type = $initValue['type'];
			$source = $initValue['source'];
			$mode = $initValue['mode'];
			if (isset($argArray[$field])) {
				if (empty($mode)) {
					switch ($type) {
						case 'function':
							$function = $value;
							if (function_exists($function)) {
								$value = $function();
							}
							break;
						case 'transform':
							$function = $value;
							if (function_exists($function)) {
								if (isset($argArray[$source])) {
									$value = $function($argArray[$source]);
								}
								else {
									$value = $function($argArray);
								}
							}
							break;
						case 'value':
							$fieldSrc = $value;
							if (isset($argArray[$fieldSrc])) {
								$value = $argArray[$fieldSrc];
							}
							break;
					}
					$argArray[$field] = $value;
				}
			}
		}

		return $argArray;
	}
	
    private function initFields($smarty, $display) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$field_array = $this->_field_array;
		$fieldLink_array = $this->_fieldLink_array;
		$valueArray = array();
		$fieldParameter_array = self::$_fieldParameter;
		$objectId = $this->_objectId;
		$objectRef = $this->_objectRef;
		$htmlId = $this->_htmlId;
		$pageflag = $this->_pageFlag;
		$labelSizeDefault = $this->_labelSizeDefault;
		
		$this->initFilter();
		$objectDisplay = array();
		if ($display == 'edit') {
			$fct_return = $objectRef->display($objectId);
			if ($fct_return->statusGet()) {
				$objectDisplay = $fct_return->returnGet();
				if (!isset($this->_editcolumnname)) {
					if (isset($objectDisplay['code'])) {
						$objectCode = $objectDisplay['code'];
					}
					else {
						$objectCode = $objectDisplay['id'];
					}
				}
				else {
					if (isset($objectDisplay[$this->_editcolumnname])) {
						$objectCode = $objectDisplay[$this->_editcolumnname];
					}
					else {
						$objectCode = $objectDisplay['id'];
					}
				}
				$this->_objectCode = $objectCode;
			}
		}
		for ($temp=0; $temp < count($field_array); $temp++) {
			$field = $field_array[$temp];
			$field_attr = $this->_field_attr[$field['name']];

			$field['field_id'] = $htmlId . '_' . $objectId . '_' . $field['name'];			
			if (empty($field['text'])) {
				$field['text'] = $smarty->getConfigVars("Txt_".$htmlId."_".$field['name']);
			}
			if (empty($field['label'])) {
				$field['label'] = $smarty->getConfigVars("Lbl_".$htmlId."_".$field['name']);
			}
			if (empty($field['label1'])) {
				$field['label1'] = $smarty->getConfigVars("Lbl_".$htmlId."_".$field['name']."_1");
			}
			if (empty($field['label2'])) {
				$field['label2'] = $smarty->getConfigVars("Lbl_".$htmlId."_".$field['name']."_2");
			}
			if ($field['labelsize'] == 0) {
				$field['labelsize'] = $labelSizeDefault;
			}
			$value_item = array();
			$value_item['value'] = '';
			if (isset($objectDisplay[$field['name']])) {
				$value_item['value'] = $objectDisplay[$field['name']];
			}
			if (empty($value_item['value'])) {
				if (isset($this->_defaultValue_array[$field['name']])) {
					$value_item['value'] = $this->_defaultValue_array[$field['name']];
				}
			}
			$value_item['object_id'] = $objectId;
			if (isset($this->_displayOnly_array[$field['name']])) {
				$displayOnly = $this->_displayOnly_array[$field['name']];
				for ($temp1=0; $temp1 < count($displayOnly); $temp1++) {
					$displayOnly_item = $displayOnly[$temp1];
					$displayOnly_item['field_id'] = $htmlId . '_' . $objectId . '_' . $displayOnly_item['field'];
					$displayOnly[$temp1] = $displayOnly_item;
				}
			}
			else {
				$displayOnly = array();						
			}
			$value_item['displayonly'] = $displayOnly;
			$value_item['pageflag'] = $pageflag;
			$value_item['label'] = $field['label'];
			$value_item['text'] = $field['text'];
			$value_item['label1'] = $field['label1'];
//			$value_item['label1'] = $smarty->getConfigVars("Lbl_".$htmlId."_".$field['name']."_1");
			$value_item['label2'] = $field['label2'];
//			$value_item['label2'] = $smarty->getConfigVars("Lbl_".$htmlId."_".$field['name']."_2");
			$value_item['title'] = $smarty->getConfigVars("Title_".$htmlId."_".$field['name']);
			$value_item['message'] = $smarty->getConfigVars("Msg_".$htmlId."_".$field['name']);
			$value_item['option1'] = $field['option1'];
			if (isset($fieldParameter_array[$field['type']]['option1'])) {
				$value_item[$fieldParameter_array[$field['type']]['option1']] = $field['option1'];
			}
			if (isset($fieldParameter_array[$field['type']]['value_option1'])) {
				$value = '';
				if (isset($field['option1'])) {
					if (isset($objectDisplay[$field['option1']])) {
						$value = $objectDisplay[$field['option1']];
					}
				}
				$value_item[$fieldParameter_array[$field['type']]['value_option1']] = $value;
			}
			$value_item['option2'] = $field['option2'];
			if (isset($fieldParameter_array[$field['type']]['option2'])) {
				$value_item[$fieldParameter_array[$field['type']]['option2']] = $field['option2'];
			}
			if (isset($fieldParameter_array[$field['type']]['value_option2'])) {
				$value = '';
				if (isset($field['option2'])) {
					if (isset($objectDisplay[$field['option2']])) {
						$value = $objectDisplay[$field['option2']];
					}
				}
				$value_item[$fieldParameter_array[$field['type']]['value_option2']] = $value;
			}			
			$value_item['option3'] = $field['option3'];
			if (isset($fieldParameter_array[$field['type']]['option3'])) {
				$value_item[$fieldParameter_array[$field['type']]['option3']] = $field['option3'];
			}
			if (isset($fieldParameter_array[$field['type']]['value_option3'])) {
				$value = '';
				if (isset($field['option3'])) {
					if (isset($objectDisplay[$field['option3']])) {
						$value = $objectDisplay[$field['option3']];
					}
				}
				$value_item[$fieldParameter_array[$field['type']]['value_option3']] = $value;
			}
			switch ($field['type']) {
				case 'crud':
					$ws->configLoad($ws->paramGet($ws->paramGet('APP_NAME') . '_LANGUAGE_DIR').$ws->sessionGet('lang').'/lang.txt', $field['name']);
					break;
				case 'datagrid':
					$value_item['header'] = array();
					$sumPct = 0;
					foreach($this->_datagrid_array[$field['name']] as $key=>$datagridArray) {
						$item = array();
						$item['field'] = $key;
						$item['field_id'] = $htmlId . '_' . $objectId . '_' . $key;
						$item['type'] = $datagridArray['type'];
						$item['list'] = array();
						if ($datagridArray['type'] == 'list') {
							$item['list'] = $datagridArray['option1'];
						}
						$item['label'] = $smarty->getConfigVars("Datagrid_".$htmlId."_".$key);
						if (empty($item['label'])) {
							$item['label'] = $key;
						}
						$item['pct'] = 5;
						$item['readonly'] = true;
						$value_item['header'][] = $item;
						$sumPct += $item['pct'];
					}
					foreach($value_item['header'] as $key=>$item) {
						$item['pct'] = (int)(($item['pct']/$sumPct) * 95);
						$value_item['header'][$key] = $item;
					}

					if (!empty($value_item['value'])) {
						$listValue = $value_item['value'];
					}
					else {
						$listValue = array();
					}
					$value_item['value'] = array();
					foreach($listValue as $listItem) {
						$item = array();
						foreach($value_item['header'] as $key=>$header) {
							if (isset($listItem[$header['field']])) {
								$item[$header['field']] = $listItem[$header['field']];
							}
							else {
								$item[$header['field']] = '';
							}
						}
						$value_item['value'][] = $item;
					}
					break;
				case 'listmultiple':
				case 'listmultiple_order':
					if (!empty($value_item['value'])) {
						$listValue = $value_item['value'];
					}
					else {
						$listValue = array();
					}
					for ($i=0; $i < count($listValue); $i++) {
						if (isset($listValue[$i][$field['option1']])) {
							$listValue[$i]['listid'] = $listValue[$i][$field['option1']];
						}
					}
					$value_item['value'] = $listValue;
					break;
				case 'page':
					$pageArray = array();
					for ($temp1=0; $temp1 < count($field_array); $temp1++) {
						if ($field_array[$temp1]['type'] == 'pagecontent') {
							if ($field_array[$temp1]['option1'] == $field['name']) {
								if (($field_array[$temp1]['mode'] == $display) or ($field_array[$temp1]['mode'] == 'all')) {
									$pageContent = array();
									$pageContent['name'] = $field_array[$temp1]['name'];
									$pageContent['href'] = $htmlId . '_' . $objectId . '_' . $field_array[$temp1]['name'];
									if (empty($field_array[$temp1]['label'])) {
										$pageContent['label'] = $smarty->getConfigVars("Lbl_".$htmlId."_".$field_array[$temp1]['name']);
									}
									else {
										$pageContent['label'] = $field_array[$temp1]['label'];
									}
									$pageArray[] = $pageContent;
								}
							}
						}
					}
					$value_item['content'] = $pageArray;
					break;
				case 'tab':
					$tabArray = array();
					for ($temp1=0; $temp1 < count($field_array); $temp1++) {
						if ($field_array[$temp1]['type'] == 'tabcontent') {
							if ($field_array[$temp1]['option1'] == $field['name']) {
								if (($field_array[$temp1]['mode'] == $display) or ($field_array[$temp1]['mode'] == 'all')) {
									$tabContent = array();
									$tabContent['name'] = $field_array[$temp1]['name'];
									$tabContent['href'] = $htmlId . '_' . $objectId . '_' . $field_array[$temp1]['name'];
									if (empty($field_array[$temp1]['label'])) {
										$tabContent['label'] = $smarty->getConfigVars("Lbl_".$htmlId."_".$field_array[$temp1]['name']);
									}
									else {
										$tabContent['label'] = $field_array[$temp1]['label'];
									}
									$tabArray[] = $tabContent;
								}
							}
						}
					}
					$value_item['content'] = $tabArray;
					break;
				case 'tabcontent':
					$value_item['content'] = $tabArray;
					break;
				default :
			}
			if (isset($fieldLink_array[$field['name']])) {
				$field['link'] = $fieldLink_array[$field['name']];
			}
			else {
				$field['link'] = array();
			}
			$field_array[$temp] = $field;
			$valueArray[$temp] = $value_item;
		}
		
		$this->_field_array = $field_array;
		$this->_value_array = $valueArray;
	}

    private function crudList() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$display = 'list';
		$wlist = $this->_list;
		for ($temp=0; $temp < count($this->_filter_array); $temp++) {
			$filter = $this->_filter_array[$temp];
			$wlist->filterSet($filter['field'], $filter['value']);
		}
		$display_html = $wlist->fetchList();
		return $display_html;
	}

    private function crudNew() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$display = 'new';
		$objectId = "";
		$objectCode = "";

		$this->_display = $display;
		$this->_objectId = $objectId;
		$this->_objectCode = $objectCode;

		$labelSizeDefault = $this->_labelSizeDefault;
		$maxColNb = $this->_maxColNb;
		$smarty = new workpage($this->_htmlId);
		$this->initFields($smarty, $display);
		$this->initSmarty($smarty);
		$smarty->assign('display_html', $this->displayGroup());
		$smarty->assign('label_size', $labelSizeDefault);
		$display_html = $smarty->fetch('index.tpl');
		return $display_html;
	}

    private function crudEdit($objectId = "") {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$display = 'edit';
		$objectCode = "";

		$this->_display = $display;
		$this->_objectId = $objectId;
		$this->_objectCode = $objectCode;

		$labelSizeDefault = $this->_labelSizeDefault;
		$maxColNb = $this->_maxColNb;
		$smarty = new workpage($this->_htmlId);
		$this->initFields($smarty, $display);
		$this->initSmarty($smarty);
		$smarty->assign('display_html', $this->displayGroup());
		$smarty->assign('label_size', $labelSizeDefault);
		$display_html = $smarty->fetch('index.tpl');
		return $display_html;
	}

/* Public functions */
	
	// $object = class name for the object managed in the CRUD
	// $htmlId = Id html of the section to display the CRUD
	// $php_name = file name without the extension of the php file source
    public function __construct($object, $php_name="", $htmlId="") {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$this->_btokFlag = true;
		$this->_btresetFlag = true;
		$this->_btreturnFlag = true;
		$this->_saveAutoFlag = false;
		$this->_saveAutoRef = '';
		$this->_columnNb = 0;

		if (class_exists($object)) {
			$this->_objectFileFlag = false;
			$objectRef = new $object();
		}
		else {
			$this->_objectFileFlag = true;
			$objectRef = new object_file($object);
		}

		// php_name initialization
		if (trim($php_name) == "") {
			$php_name = $object;
		}
		
		// html_id initialization
		if (trim($htmlId) == "") {
			$htmlId = $php_name;
		}
		
		$this->_object = $object;
		$this->_objectName = $object;
		$this->_objectRef = $objectRef;
		$this->_htmlId = $htmlId;
		$this->_phpName = $php_name;
		$this->_groupLevel[0] = 'main';
		$this->_groupCurrent = 0;
		$this->_list = new wlistcomp($object, $htmlId, $php_name, $objectRef);
		$this->_html_size = self::HTML_DEFAULT_SIZE;
		$this->_labelSizeDefault = self::LABEL_SIZE;
		$this->_pageFlag=true;	
		$this->_titleFlag=true;
		$this->_idFlag=true;
		$this->_writeFlag=false;
		$this->_returnFlag=true;
		$this->_createReturn='';
		$this->_actionReturn='';
		$this->_updateReturn='';
		$this->_deleteReturn='';
		$this->_titleCode='';
	}

    public function listSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$this->_list = $value;
	}

    public function listGet() {
		return $this->_list;
	}

    public function returnSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');		
		$this->_returnFlag = $value;
	}

    public function returnGet() {
		return $this->_returnFlag;
	}

    public function createReturnSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');		
		$this->_createReturn = $value;
	}

    public function createReturnGet() {
		return $this->_createReturn;
	}

    public function actionReturnSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');		
		$this->_actionReturn = $value;
	}

    public function actionReturnGet() {
		return $this->_actionReturn;
	}

    public function updateReturnSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');		
		$this->_updateReturn = $value;
	}

    public function updateReturnGet() {
		return $this->_updateReturn;
	}

    public function deleteReturnSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');		
		$this->_deleteReturn = $value;
	}

    public function deleteReturnGet() {
		return $this->_deleteReturn;
	}

    public function titleSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$wlist = $this->listGet();
		$wlist->titleSet($value);
		$this->_titleFlag=$value;
	}

    public function titleGet() {
		return $this->_titleFlag;
	}

    public function writeSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$this->_writeFlag=$value;
	}

    public function writeGet() {
		return $this->_writeFlag;
	}

    public function idSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$this->_idFlag=$value;
	}

    public function idGet() {
		return $this->_idFlag;
	}

    public function titleCodeSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$wlist = $this->listGet();
		$wlist->titleCodeSet($value);
		$this->_titleCode=$value;
	}

    public function titleCodeGet() {
		return $this->_titleCode;
	}

     public function pageSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$wlist = $this->listGet();
		$wlist->pageSet($value);
		$this->_pageFlag=$value;
	}

    public function pageGet() {
		return $this->_pageFlag;
	}

   public function btokSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$this->_btokFlag = $value;
	}

    public function btokGet() {
		return $this->_btokFlag;
	}

    public function btresetSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$this->_btresetFlag = $value;
	}

    public function btresetGet() {
		return $this->_btresetFlag;
	}

    public function btreturnSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$this->_btreturnFlag = $value;
	}

    public function btreturnGet() {
		return $this->_btreturnFlag;
	}

    public function saveAutoSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$this->_saveAutoFlag = $value;
	}

    public function saveAutoRefSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$this->_saveAutoRef = $value;
	}

    public function saveAutoGet() {
		return $this->_saveAutoFlag;
	}

    public function saveAutoRefGet() {
		return $this->_saveAutoRef;
	}

    public function commandSet($command, $value ='') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		if ($value == '') {
			$value = $command;
		}
		$this->_command[$command] = $value;
	}

    public function commandGet($command) {
		return $this->_command[$command];
	}

	public function editcolumnnameSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$this->_editcolumnname=$value;
	}

    public function editcolumnnameGet() {
		return $this->_editcolumnname;
	}

    public function datagridSet($field, $type="text", $option1="", $option2="", $option3="") {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$field = trim($field);
		if (!in_array($type, self::$_fieldDatagridType)) {
			$type = "text";
		}
		if (!empty($this->_datagridField)) {
			if (isset($this->_datagrid_array[$this->_datagridField])) {
				$datagridArray = $this->_datagrid_array[$this->_datagridField];
			}
			else {
				$datagridArray = array();
			}
			$field_item = array();
			$field_item['name'] = $field;
			$field_item['type'] = $type;
			$field_item['option1'] = $option1;
			$field_item['option2'] = $option2;
			$field_item['option3'] = $option3;
			$datagridArray[$field] = $field_item;
			$this->_datagrid_array[$this->_datagridField] = $datagridArray;
			return true;
		}
		else {
			return false;
		}
	}

    public function fieldLinkSet($field, $fieldSrc, $data="") {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$index = $this->findField($fieldSrc);
		if ($index > 0) {
			$fieldLink = array();
			if (isset($this->_fieldLink_array[$fieldSrc])) {
				$fieldLink = $this->_fieldLink_array[$fieldSrc];
			}
			$field_item = array();
			$field_item['field'] = $field;
			$field_item['data'] = $data;
			$fieldLink[] = $field_item;
			$this->_fieldLink_array[$fieldSrc] = $fieldLink;
			return true;
		}
		
		return false;
	}

    public function fieldSet($field, $type="", $option1="", $option2="", $option3="") {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		if (!$this->findField($field)) {
			$ws = workspace::ws_open();
			$line = $this->lineNew($this->_groupLevel[$this->_groupCurrent]);
			$col = $this->colNew($this->_groupLevel[$this->_groupCurrent], $line);
			$this->_fieldAdd($field, $line, $col, $type, $option1, $option2, $option3);
			return true;
		}
		else {
			return false;
		}
	}

    public function fieldAppendSet($field, $type="", $option1="", $option2="", $option3="") {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		if (!$this->findField($field)) {
			$ws = workspace::ws_open();
			$line = $this->lineCur($this->_groupLevel[$this->_groupCurrent]);
			$col = $this->colCur($this->_groupLevel[$this->_groupCurrent], $line);
			$labelflag = false;
			$this->_fieldAdd($field, $line, $col, $type, $option1, $option2, $option3, $labelflag);
			return true;
		}
		else {
			return false;
		}
	}

    public function fieldDisplaySet($field, $mode="all") {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$index = $this->findField($field);
		if ($index > 0) {
			$field_item = $this->_field_array[$index - 1];
			$field_item['mode'] = $mode;
			$this->_field_array[$index - 1] = $field_item;
			return true;
		}
		else {
			return false;			
		}
	}

    public function fieldRightSet($field, $right="all") {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$index = $this->findField($field);
		if ($index > 0) {
			$field_item = $this->_field_array[$index - 1];
			$field_item['right'] = $right;
			$this->_field_array[$index - 1] = $field_item;
			return true;
		}
		else {
			return false;			
		}
	}

    public function fieldColSizeSet($field, $size=0) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$index = $this->findField($field);
		if ($index > 0) {
			$field_item = $this->_field_array[$index - 1];
			$field_item['colsize'] = $size;
			$this->_field_array[$index - 1] = $field_item;
			return true;
		}
		else {
			return false;			
		}
	}

    public function classSet($field, $value='') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$index = $this->findField($field);
		if ($index > 0) {
			$field_item = $this->_field_array[$index - 1];
			$field_item['class'] = $value;
			$this->_field_array[$index - 1] = $field_item;
			return true;
		}
		else {
			return false;			
		}
	}

    public function labelSet($field, $value='') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$index = $this->findField($field);
		if ($index > 0) {
			$field_item = $this->_field_array[$index - 1];
			$field_item['label'] = $value;
			$this->_field_array[$index - 1] = $field_item;
			return true;
		}
		else {
			return false;			
		}
	}

    public function textSet($field, $value='') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$index = $this->findField($field);
		if ($index > 0) {
			$field_item = $this->_field_array[$index - 1];
			$field_item['text'] = $value;
			$this->_field_array[$index - 1] = $field_item;
			return true;
		}
		else {
			return false;			
		}
	}
	
    public function collabelSet($field, $value='') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$index = $this->findField($field);
		if ($index > 0) {
			$field_item = $this->_field_array[$index - 1];
			$field_item['collabel'] = $value;
			$this->_field_array[$index - 1] = $field_item;
			return true;
		}
		else {
			return false;			
		}
	}

    public function fieldLabelSet($field, $value=true) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$index = $this->findField($field);
		if ($index > 0) {
			$field_item = $this->_field_array[$index - 1];
			$field_item['labelflag'] = $value;
			$this->_field_array[$index - 1] = $field_item;
			return true;
		}
		else {
			return false;			
		}
	}

    public function fieldLabelSizeSet($field, $size=0) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$index = $this->findField($field);
		if ($index > 0) {
			$field_item = $this->_field_array[$index - 1];
			$field_item['labelsize'] = $size;
			$this->_field_array[$index - 1] = $field_item;
			return true;
		}
		else {
			return false;			
		}
	}

    public function fieldDisplayOnlySet($field, $fieldSrc, $value, $ope='=') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		if (isset($this->_displayOnly_array[$fieldSrc])) {
			$displayOnly = $this->_displayOnly_array[$fieldSrc];
		}
		else {
			$displayOnly = array();
		}
		$found = false;
		for ($temp=0; $temp < count($displayOnly); $temp++) {
			$displayOnly_item = $displayOnly[$temp];
			if ($displayOnly_item['field'] == $field) {
				$found = true;
				$displayOnly_value = $displayOnly_item['value'];
				$displayOnly_value[] = $value;
				$displayOnly_item['value'] = $displayOnly_value;
				$displayOnly[$temp] = $displayOnly_item;
			}
		}
		if (!$found) {
			$displayOnly_item = array();
			$displayOnly_item['field'] = $field;
			$displayOnly_item['ope'] = $ope;
			$displayOnly_value = array();
			$displayOnly_value[] = $value;
			$displayOnly_item['value'] = $displayOnly_value;
			$displayOnly[] = $displayOnly_item;
		}
		
		$this->_displayOnly_array[$fieldSrc] = $displayOnly;
		return true;
	}

    public function fieldLineSet($field, $type="", $option1="", $option2="", $option3="") {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		if (!$this->findField($field)) {
			$ws = workspace::ws_open();
			$line = $this->lineCur($this->_groupLevel[$this->_groupCurrent]);
			$col = $this->colNew($this->_groupLevel[$this->_groupCurrent], $line);
			$this->_fieldAdd($field, $line, $col, $type, $option1, $option2, $option3);
			return true;
		}
		else {
			return false;
		}
	}

    public function fieldUpdateSet($field, $type="", $option1="", $option2="", $option3="") {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		if (!$this->findField($field)) {
			$ws = workspace::ws_open();
			$line = $this->lineCur($this->_groupLevel[$this->_groupCurrent]);
			$col = $this->colCur($this->_groupLevel[$this->_groupCurrent], $line);
			$this->_fieldAdd($field, $line, $col, $type, $option1, $option2, $option3);
			return true;
		}
		else {
			return false;
		}
	}

    public function defaultValueGet() {
		$defaultValue = $this->_defaultValue_array;
		return $defaultValue;
	}

    public function defaultValueSet($field, $value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		if ($this->findField($field)) {
			$this->_defaultValue_array[$field] = $value;
			return true;
		}
		else {
			return false;
		}
	}

    public function filterGet() {
		$filter = $this->_filter_array;
		return $filter;
	}

    public function filterSet($field, $value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$filter = array();
		$filter['field']=$field;
		$filter['value']=$value;
		$this->_filter_array[] = $filter;
		return true;
	}

    public function initValueGet() {
		$initValue = array();
		$filter = array();

		for ($temp=0; $temp < count($this->_initValue_array); $temp++) {
			$initValue = $this->_initValue_array[$temp];
			$field = $initValue['field'];
			$value = $initValue['value'];
			$type = $initValue['type'];
			$source = $initValue['source'];
			$mode = $initValue['mode'];
			if ($mode == 'init') {
				$initValue['field']=$field;
				$initValue['value']=$value;
				$initValue['type'] = $type;
				$initValue['source'] = $source;
				$initValue['mode'] = $mode;
				$filter[] = $initValue;
			}
		}
		return $filter;
	}

    public function initValueSet($field, $value, $type = '', $source = '') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$initValue = array();
		$initValue['field']=$field;
		$initValue['value']=$value;
		$initValue['type'] = $type;
		$initValue['source'] = $source;
		$initValue['mode'] = 'init';
		$this->_initValue_array[] = $initValue;
		return true;
	}

    public function valueGet() {
		$initValue = array();
		$filter = array();

		for ($temp=0; $temp < count($this->_initValue_array); $temp++) {
			$initValue = $this->_initValue_array[$temp];
			$field = $initValue['field'];
			$value = $initValue['value'];
			$type = $initValue['type'];
			$source = $initValue['source'];
			$mode = $initValue['mode'];
			if (empty($mode)) {
				$initValue['field']=$field;
				$initValue['value']=$value;
				$initValue['type'] = $type;
				$initValue['source'] = $source;
				$initValue['mode'] = $mode;
				$filter[] = $initValue;
			}
		}
		return $filter;
	}

    public function valueSet($field, $value, $type = '', $source = '', $mode = '') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$initValue = array();
		$initValue['field']=$field;
		$initValue['value']=$value;
		$initValue['type'] = $type;
		$initValue['source'] = $source;
		$initValue['mode'] = $mode;
		$this->_initValue_array[] = $initValue;
		return true;
	}

    public function requiredSet($field) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		$objectRef = $this->_objectRef;
		
		if ($this->findField($field)) {
			$field_attr = $this->_field_attr[$field];
			$field_attr['required'] = true;
			$this->_field_attr[$field] = $field_attr;
			if ($this->_objectFileFlag) {
				$objectRef->fieldAttrSet($field, $field_attr);
			}
			return true;
		}
		else {
			return false;			
		}
	}

    public function patternSet($field, $value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		$objectRef = $this->_objectRef;
		
		if ($this->findField($field)) {
			$field_attr = $this->_field_attr[$field];
			$field_attr['pattern'] = $value;
			$this->_field_attr[$field] = $field_attr;
			if ($this->_objectFileFlag) {
				$objectRef->fieldAttrSet($field, $field_attr);
			}
			return true;
		}
		else {
			return false;			
		}
	}

    public function caseSet($field, $value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		$objectRef = $this->_objectRef;
		
		if ($this->findField($field)) {
			$field_attr = $this->_field_attr[$field];
			$field_attr['case'] = $value;
			$this->_field_attr[$field] = $field_attr;
			if ($this->_objectFileFlag) {
				$objectRef->fieldAttrSet($field, $field_attr);
			}
			return true;
		}
		else {
			return false;			
		}
	}

    public function decimalSet($field, $value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		$objectRef = $this->_objectRef;
		
		if ($this->findField($field)) {
			$field_attr = $this->_field_attr[$field];
			$field_attr['decimal'] = $value;
			$this->_field_attr[$field] = $field_attr;
			if ($this->_objectFileFlag) {
				$objectRef->fieldAttrSet($field, $field_attr);
			}
			return true;
		}
		else {
			return false;			
		}
	}

    public function formatSet($field, $value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		$objectRef = $this->_objectRef;
		
		if ($this->findField($field)) {
			$field_attr = $this->_field_attr[$field];
			$field_attr['format'] = $value;
			$this->_field_attr[$field] = $field_attr;
			if ($this->_objectFileFlag) {
				$objectRef->fieldAttrSet($field, $field_attr);
			}
			return true;
		}
		else {
			return false;			
		}
	}

    public function blowkWsSet($field) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		$objectRef = $this->_objectRef;
		
		if ($this->findField($field)) {
			$field_attr = $this->_field_attr[$field];
			$field_attr['block-ws'] = true;
			$this->_field_attr[$field] = $field_attr;
			if ($this->_objectFileFlag) {
				$objectRef->fieldAttrSet($field, $field_attr);
			}
			return true;
		}
		else {
			return false;			
		}
	}

	public function sizeSet($field, $value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		$objectRef = $this->_objectRef;
		
		if ($this->findField($field)) {
			$field_attr = $this->_field_attr[$field];
			if ($value > self::MAX_TEXT_SIZE) {
				$value = self::MAX_TEXT_SIZE;
			}
			$field_attr['size'] = $value;
			$this->_field_attr[$field] = $field_attr;
			if ($this->_objectFileFlag) {
				$objectRef->fieldAttrSet($field, $field_attr);
			}
			return true;
		}
		else {
			return false;			
		}
	}

	public function colsSet($field, $value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		$objectRef = $this->_objectRef;
		
		if ($this->findField($field)) {
			$field_attr = $this->_field_attr[$field];
			$field_attr['cols'] = $value;
			$this->_field_attr[$field] = $field_attr;
			if ($this->_objectFileFlag) {
				$objectRef->fieldAttrSet($field, $field_attr);
			}
			return true;
		}
		else {
			return false;			
		}
	}

	public function rowsSet($field, $value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		$objectRef = $this->_objectRef;
		
		if ($this->findField($field)) {
			$field_attr = $this->_field_attr[$field];
			$field_attr['rows'] = $value;
			$this->_field_attr[$field] = $field_attr;
			if ($this->_objectFileFlag) {
				$objectRef->fieldAttrSet($field, $field_attr);
			}
			return true;
		}
		else {
			return false;			
		}
	}

	public function maxSet($field, $value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		$objectRef = $this->_objectRef;
		
		if ($this->findField($field)) {
			$field_attr = $this->_field_attr[$field];
			$field_attr['max'] = $value;
			$this->_field_attr[$field] = $field_attr;
			if ($this->_objectFileFlag) {
				$objectRef->fieldAttrSet($field, $field_attr);
			}
			return true;
		}
		else {
			return false;			
		}
	}

    public function readonlySet($field) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		$objectRef = $this->_objectRef;
		
		if ($this->findField($field)) {
			$field_attr = $this->_field_attr[$field];
			$field_attr['readonly'] = true;
			$this->_field_attr[$field] = $field_attr;
			if ($this->_objectFileFlag) {
				$objectRef->fieldAttrSet($field, $field_attr);
			}
			return true;
		}
		else {
			return false;			
		}
	}

    public function alignSet($field, $align="") {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		$objectRef = $this->_objectRef;
		
		if ($this->findField($field)) {
			$field_attr = $this->_field_attr[$field];
			$field_attr['align'] = $align;
			$this->_field_attr[$field] = $field_attr;
			if ($this->_objectFileFlag) {
				$objectRef->fieldAttrSet($field, $field_attr);
			}
			return true;
		}
		else {
			return false;			
		}
	}

    public function fetchList() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		return $this->crudList();
	}
	
    public function fetchCrudNew() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$objectRef = $this->_objectRef;
		/* Command processing */
		$command = $ws->argGet('command');
		switch ($command) {
			case 'list':
				$display = 'refresh';
				break;
			case 'create':
				$this->initFilter();
				$argArray = $this->valueFields('new');
				$argArray = $this->initValue($argArray);
				$argArray = $this->formatFields($argArray);
				$fct_return = $objectRef->insert($argArray); /* module creattion processing */
				if ($this->_returnFlag) {
					$display = 'return';
				}
				else {
					$display = 'refresh';
				}
				break;
			case 'new':
			case 'event':
			case '':
				$display = 'new';
				break;
			default :
				$display = 'close';
		}
		$this->_display = $display;
		$display_html = '';
		if ($display == 'new') {
			$display_html = $this->crudNew();
		}
		if ($display == 'refresh') {
			$display_html = 'refresh';
		}
		if ($display == 'return') {
			$display_html = 'return';
		}
		return $display_html;
	}

    public function fetchCrudEdit($objectId = "") {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$objectRef = $this->_objectRef;
		/* Command processing */
		$command = $ws->argGet('command');
		switch ($command) {				
			case 'list':
				$display = 'refresh';
				break;
			case 'update':
				$this->initFilter();
				$id = $ws->argPost('id');
				$argArray = $this->valueFields('edit');
				$argArray = $this->initValue($argArray);
				$argArray = $this->formatFields($argArray);
				$argArray['id'] = $id;
				$fct_return = $objectRef->update($argArray); /* module update processing */
				if ($this->_returnFlag) {
					$display = 'return';
				}
				else {
					$display = 'refresh';
				}
				break;
			case 'edit':
			case 'event':
			case '':
				$display = 'edit'; /* module update screen display */
				break;
			default :
				$display = 'close';
		}
		$this->_display = $display;
		$display_html = '';
		if ($display == 'edit') {
			$display_html = $this->crudEdit($objectId);
		}
		if ($display == 'refresh') {
			$display_html = 'refresh';
		}
		if ($display == 'return') {
			$display_html = 'return';
		}
		return $display_html;
	}

    public function fetchCrud() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$object = $this->_object;
		$objectRef = $this->_objectRef;
		/* Command processing */
		$command = $ws->argGet('command');
		$display = '';
		switch ($command) {
			case 'list':
				$display = 'list'; /* module list screen display */
				break;

			case 'create':
				$this->initFilter();
				$argArray = $this->valueFields('new');
				$argArray = $this->initValue($argArray);
				$argArray = $this->formatFields($argArray);
				$fct_return = $objectRef->insert($argArray); /* module creattion processing */
				$display = 'list';	
				break;

			case 'action':
				$this->initFilter();
				$id = $ws->argPost('id');
				$argArray = $this->valueFields();
				$argArray = $this->formatFields($argArray);
				$argArray['id'] = $id;
				$fct_return = $objectRef->action($argArray); /* module action processing */
				$display = 'list';	
				break;		

			case 'update':
				$this->initFilter();
				$id = $ws->argPost('id');
				$argArray = $this->valueFields('edit');
				$argArray = $this->initValue($argArray);
				$argArray = $this->formatFields($argArray);
				$argArray['id'] = $id;
				$fct_return = $objectRef->update($argArray); /* module update processing */
				$display = 'list';
				break;

			case 'delete':
				$this->initFilter();
				$id = $ws->paramGet('ID');
				$fct_return = $objectRef->delete($id); /* module delete processing */
				$display = 'list';
				break;

			case 'edit':
				$display = 'edit'; /* module update screen display */
				break;

			case 'new':
				$display = 'new'; /* module create screen display */
				break;

			default :
				if (isset($this->_command[$command])) {
					$objectFunction = $this->_command[$command];
					$fct_return = $objectRef->$objectFunction($ws->paramGet('ID'));
				}
				$display = 'list';
		}
		$this->_display = $display;
		// display processing
		$display_html = '';
		switch ($display) {
			case 'edit' :
				$objectId = $ws->paramGet('ID');
				$display_html = $this->fetchCrudEdit($objectId);
				break;
			case 'new' :
				$display_html = $this->fetchCrudNew();
				break;
			default :
				$display_html = $this->fetchCrudList();
		}
		return $display_html;
	}

    public function displayCrudList() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$display = 'list';
		$wlist = $this->_list;
		for ($temp=0; $temp < count($this->_filter_array); $temp++) {
			$filter = $this->_filter_array[$temp];
			$wlist->filterSet($filter['field'], $filter['value']);
		}
		$wlist->displayList();
	}
	
    public function displayCrudNew() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$display_html = $this->fetchCrudNew();
		if (($display_html == 'refresh') or ($display_html == 'return')) {
			$ws->caching = false;
			$ws->build($display_html);
		}
		else {
			$ws->caching = false;
			$ws->assign('body', $display_html);			
			$ws->build('simple'); 
		}
	}

    public function displayCrudEdit($objectId = "") {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$display_html = $this->fetchCrudEdit($objectId);
		if (($display_html == 'refresh') or ($display_html == 'return')) {
			$ws->caching = false;
			$ws->build($display_html);
		}
		else {
			$ws->caching = false;
			$ws->assign('body', $display_html);
			$ws->build('simple'); 
		}
	}

    public function displayCrud() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$object = $this->_object;
		$objectRef = $this->_objectRef;
		/* Command processing */
		$command = $ws->argGet('command');
		$display = '';
		switch ($command) {
			case 'list':
				$display = 'list'; /* module list screen display */
				break;

			case 'create':
				$this->initFilter();
				$argArray = $this->valueFields('new');
				$argArray = $this->initValue($argArray);
				$argArray = $this->formatFields($argArray);
				$fct_return = $objectRef->insert($argArray); /* module creattion processing */
				if ($this->_returnFlag) {
					$display = 'return';
				}
				else {
					$display = 'refresh';
				}
				switch ($this->_createReturn) {
					case 'refresh' :
						$display = 'refresh';
						break;
					case 'reload' :
						$display = 'reload';
						break;
					case 'return' :
						$display = 'return';
						break;
					case 'list' :
						$display = 'list';
						break;
				}
				break;

			case 'action':
				$this->initFilter();
				$id = $ws->argPost('id');
				$argArray = $this->valueFields();
				$argArray = $this->formatFields($argArray);
				$argArray['id'] = $id;
				$fct_return = $objectRef->action($argArray); /* module action processing */
				if ($this->_returnFlag) {
					$display = 'return';
				}
				else {
					$display = 'refresh';
				}
				switch ($this->_actionReturn) {
					case 'refresh' :
						$display = 'refresh';
						break;
					case 'reload' :
						$display = 'reload';
						break;
					case 'return' :
						$display = 'return';
						break;
					case 'list' :
						$display = 'list';
						break;
				}
				break;		

			case 'update':
				$this->initFilter();
				$id = $ws->argPost('id');
				$argArray = $this->valueFields('edit');
				$argArray = $this->initValue($argArray);
				$argArray = $this->formatFields($argArray);
				$argArray['id'] = $id;
				$fct_return = $objectRef->update($argArray); /* module update processing */
				if ($this->_returnFlag) {
					$display = 'return';
				}
				else {
					$display = 'refresh';
				}
				switch ($this->_updateReturn) {
					case 'refresh' :
						$display = 'refresh';
						break;
					case 'reload' :
						$display = 'reload';
						break;
					case 'return' :
						$display = 'return';
						break;
					case 'list' :
						$display = 'list';
						break;
				}
				break;

			case 'delete':
				$this->initFilter();
				$id = $ws->paramGet('ID');
				$fct_return = $objectRef->delete($id); /* module delete processing */
				if ($this->_returnFlag) {
					$display = 'refresh';
				}
				else {
					$display = 'return';
				}
				switch ($this->_deleteReturn) {
					case 'refresh' :
						$display = 'refresh';
						break;
					case 'reload' :
						$display = 'reload';
						break;
					case 'return' :
						$display = 'return';
						break;
					case 'list' :
						$display = 'list';
						break;
				}
				break;
			case 'edit':
				$display = 'edit'; /* module update screen display */
				break;

			case 'new':
				$display = 'new'; /* module create screen display */
				break;

			default :
				if (isset($this->_command[$command])) {
					$objectFunction = $this->_command[$command];
					$fct_return = $objectRef->$objectFunction($ws->paramGet('ID'));
					$display = 'refresh';
				}
				else {
					$display = 'init'; /* module create screen display */
				}
		}
		$this->_display = $display;
		// display processing
		switch ($display) {
			case 'init' :
				if($ws->templateExists($this->_phpName.'.tpl')) {
					$ws->build($this->_phpName.'.tpl'); 
				}
				else {
					$pageRef = $ws->getTemplateVars('pageRef');
					if (empty($pageRef)) {
						$connect = new object_connect();
						$ws->assign('pageRef',$connect->constructHref($ws->paramGet('APP_CODE'), $this->_phpName, 'command:list'));
					}
					$ws->build('crud_init.tpl');
				}
				break;
			case 'edit' :
				$objectId = $ws->paramGet('ID');
				$display_html = $this->crudEdit($objectId);
				if (($display_html == 'refresh') or ($display_html == 'return')) {
					$ws->build($display_html);
				}
				else {
					$ws->caching = false;
					$ws->assign('body', $display_html);
					$ws->build('simple'); 
				}
				break;
			case 'new' :
				$display_html = $this->crudNew();
				if (($display_html == 'refresh') or ($display_html == 'return')) {
					$ws->build($display_html);
				}
				else {
					$ws->caching = false;
					$ws->assign('body', $display_html);
					$ws->build('simple'); 
				}
				break;
			case 'refresh' :
				$display_html = 'refresh';
				$ws->build($display_html);
				break;
			case 'reload' :
				$display_html = 'reload';
				$ws->build($display_html);
				break;
			case 'return' :
				$display_html = 'return';
				$ws->build($display_html);
				break;
			default :
				$this->displayCrudList();
		}
	}
	
}
?>
