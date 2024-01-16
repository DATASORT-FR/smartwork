<?php
/**
* crud field plugin
*
* @package    formfield_crud
* @version    1.1
* @date       14 Août 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_CRUD_NAME', 'crud');

// Plugin Path
$ws->paramSet('PLG_CRUD_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_CRUD_NAME') . '/templates/src/');

/**
* Classes for crud plugin.
*/
class plg_Crud extends plg_formfield
{
	/**
	* constructor plg_Crud
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_CRUD_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}

	/**
	* Display html for Crud field
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
		$field_value['ref'] = $connect->constructHref($ws->paramGet('APP_CODE'),$field_value['page'],"command:list",'id:'.$field_value['object_id']);
		return parent::display($field_value);
	}
	
}
?>
