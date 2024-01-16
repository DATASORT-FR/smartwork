<?php
/**
* textlist field plugin
*
* @package    formfield_textlist
* @version    1.1
* @date       12 january 2019
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_TEXTLIST_NAME', 'textlist');

// Plugin Path
$ws->paramSet('PLG_TEXTLIST_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_TEXTLIST_NAME') . '/templates/src/');

/**
* Classes for textlist plugin.
*/
class plg_Textlist extends plg_formfield
{
	/**
	* constructor plg_Listmultiple
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_TEXTLIST_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}
	
	/**
	* Display html for text list field
	*
	* @param string - field value
	*
	* @return string html
	*
    * @access public
	*/
	public function display($field_value = array()) {
		$ws = workspace::ws_open();
		
		$atemp = explode(';',$field_value['value']);
		$field_value['values'] = $atemp;
		return parent::display($field_value);
	}
}
?>
