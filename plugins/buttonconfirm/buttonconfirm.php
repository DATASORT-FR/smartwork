<?php
/**
* button confirm field plugin
*
* @package    formfield_confirmButton
* @version    1.1
* @date       19 March 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_BUTTONCONFIRM_NAME', 'buttonconfirm');

// Plugin Path
$ws->paramSet('PLG_BUTTONCONFIRM_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_BUTTONCONFIRM_NAME') . '/templates/src/');

/**
* Classes for confirm button plugin.
*/
class plg_ButtonConfirm extends plg_formfield
{

	/**
	* constructor plg_Button
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_BUTTONCONFIRM_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}

	/**
	* Display html for Button field
	*
	* @param string - field value
	*
	* @return string html
	*
    * @access public
	*/
	public function display($field_value = array()) {
		$ws = workspace::ws_open();

		$connect = new object_connect();
		$field_value['ref'] = $connect->constructHref($ws->paramGet('APP_CODE'),$field_value['page'],"","")."?".$field_value['object']."_id=".$field_value['id'];
		return parent::display($field_value);
	}
	
}
?>
