<?php
/**
* button field plugin
*
* @package    formfield_button
* @version    1.1
* @date       14 Août 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_BUTTON_NAME', 'button');

// Plugin Path
$ws->paramSet('PLG_BUTTON_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_BUTTON_NAME') . '/templates/src/');

/**
* Classes for button plugin.
*/
class plg_Button extends plg_formfield
{

	/**
	* constructor plg_Button
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_BUTTON_NAME'), $field_name, $field_id, $field_mode, $field_attr);
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
