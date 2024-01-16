<?php
/**
* form_field plugin
*
* @package    crud_formfield
* @version    1.1
* @date       14 Août 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_FORM_FIELD_NAME', 'formfield');

// Plugin Path
$ws->paramSet('PLG_FORM_FIELD_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_FORM_FIELD_NAME') . '/templates/src/');
$ws->paramSet('PLG_FORM_FIELD_TEMPLATES_CSS_DIR', $ws->paramGet('RELA_PLUGINS_DIR') . $ws->paramGet('PLG_FORM_FIELD_NAME') . '/templates/css/');
$ws->paramSet('PLG_FORM_FIELD_TEMPLATES_JS_DIR', $ws->paramGet('RELA_PLUGINS_DIR') . $ws->paramGet('PLG_FORM_FIELD_NAME') . '/templates/js/');

// Template css
$ws->paramSet('PLG_FORM_FIELD_TEMPLATE_STYLE', 'template.css');
$ws->paramSet('PLG_FORM_FIELD_TEMPLATE_JS', 'form_field.js');

// Add css & js
$ws->addcss($ws->paramGet('PLG_FORM_FIELD_TEMPLATES_CSS_DIR') . $ws->paramGet('PLG_FORM_FIELD_TEMPLATE_STYLE'));
//$ws->addjs($ws->paramGet('PLG_FORM_FIELD_TEMPLATES_JS_DIR') . $ws->paramGet('PLG_FORM_FIELD_TEMPLATE_JS'));

/**
* Classes for global formfield plugin.
*/
class plg_formfield
{

	private $_type;
	private $_name;
	private $_id;
	private $_mode;
	private $_attr = array();

/* Private functions */
	
	/**
	* Load attribute
	*
	* @param array - attribute array
	*
	* @param string - attribute name
	*
	* @return string - attribute value
	*
    * @access private
	*/
    private function init_attr($field_attr, $attr) {
		
		$value = '';
		if (isset($field_attr[$attr])) {
			$value = $field_attr[$attr];
		}
		return $value;
	}
	
/* Public functions */
	
	/**
	* constructor plg_Tab
    *
    * @access public
	*/
    public function __construct($field_type, $field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$this->_type = $field_type;
		$this->_name = $field_name;
		$this->_id = $field_id;
		$this->_mode = $field_mode;
		$this->_attr = $field_attr;
	}
	
	/**
	* get $_attr
    *
    * @access public
	*/
     public function attrGet() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		return $this->_attr;
	}

	/**
	* Display html for text field
	*
	* @param string - field value
	*
	* @return string html
	*
    * @access public
	*/
   public function display($field_value = array()) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$field_type = $this->_type;
		$field_name = $this->_name;
		$field_id = $this->_id;
		$field_mode = $this->_mode;
		$field_attr = $this->_attr;

		// smarty parameters
		$smarty = new workpage('formfield_text');

		if (!isset($field_value['page'])) {
			$field_value['page'] = '';
		}
		if (!isset($field_value['id'])) {
			$field_value['id'] = '';
		}
		if (!isset($field_value['label'])) {
			$field_value['label'] = '';
		}
		if (!isset($field_value['text'])) {
			$field_value['text'] = '';
		}
		
		if (isset($field_value['value'])) {
			$field_value['value'] = $this->format($field_value['value']);
		}

		$readonly =	$this->init_attr($field_attr, 'readonly');
		$required =	$this->init_attr($field_attr, 'required');
		$pattern =	$this->init_attr($field_attr, 'pattern');
		$case =	$this->init_attr($field_attr, 'case');
		$block_ws =	$this->init_attr($field_attr, 'block-ws');
		$size =	$this->init_attr($field_attr, 'size');
		$cols =	$this->init_attr($field_attr, 'cols');
		$rows =	$this->init_attr($field_attr, 'rows');
		$max =	$this->init_attr($field_attr, 'max');
		$align = $this->init_attr($field_attr, 'align');

		$param = array();
		foreach($field_attr as $key=>$value) {
			$param[$key] = $this->init_attr($field_attr, $key);
		}
		
		/* classes, attributes and style */
		$attr = '';
		$style = '';
		$class = '';
		if ($readonly) {
			$attr = $attr.'readonly ';
		}
		if ($required) {
			$attr = $attr.'required="required" ';
		}
		if ($pattern != '') {
			$attr = $attr.'pattern="'.$pattern.'" ';
		}
		if ($case != '') {
			if ($case == 'upper') {
				$class = $class.'text-uppercase ';
			}
			if ($case == 'lower') {
				$class = $class.'text-lowercase ';
			}
		}
		if ($block_ws) {
			$class = $class.'block-ws ';
		}
		if ($size != 0) {
			$attr = $attr.'size="'.$size.'" ';
		}
		if ($rows != 0) {
			$attr = $attr.'rows="'.$rows.'" ';
		}
		if ($cols != 0) {
			$attr = $attr.'cols="'.$cols.'" ';
		}
		if ($max != 0) {
			$attr = $attr.'maxlength="'.$max.'" ';
		}
					
		if ($align != '') {
			$class = $class.$align.' ';
		}
					
		if ($style != '') {
			$style = 'style="'.$style.'"';
		}
		
		$smarty->assign('app', $ws->paramGet('APP_CODE'));
		$smarty->assign('display', $field_mode);
		$smarty->assign('readonly', $readonly);
		$smarty->assign('field_id', $field_id);
		$smarty->assign('field_name', $field_name);
		$smarty->assign('field_value', $field_value);
		$smarty->assign('field_type', $field_type);
		$smarty->assign('field_attr', $attr);
		$smarty->assign('field_style', $style);
		$smarty->assign('field_class', $class);
		$smarty->assign('field_param', $param);

		$smarty->template_dir = $ws->paramGet('PLG_' . strtoupper($field_type) . '_TEMPLATES_SRC_DIR');
		$field_html = $smarty->fetch($field_type . '.tpl');

		$smarty->assign('field_html', $field_html);
		$smarty->template_dir = $ws->paramGet('PLG_FORM_FIELD_TEMPLATES_SRC_DIR');
		$display_html = $smarty->fetch('index.tpl');

		return $display_html;
	}

	/**
	* format value to display
	*
	* @param mix - value
	*
	* @return mix
	*
    * @access public
	*/
   public function format($value) {

		return $value;
	}	
	
}

?>