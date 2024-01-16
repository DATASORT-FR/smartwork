<?php
/**
* datagrid field plugin
*
* @package    formfield_datagrid
* @version    1.0
* @date       14 April 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_DATAGRID_NAME', 'datagrid');

// Plugin Path
$ws->paramSet('PLG_DATAGRID_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_DATAGRID_NAME') . '/templates/src/');

/**
* Classes for Datagrid plugin.
*/
class plg_Datagrid extends plg_formfield
{
	/**
	* constructor plg_Datagrid
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_DATAGRID_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}

	public function display($field_value = array()) {
		$ws = workspace::ws_open();
		
		return parent::display($field_value);
	}
	
}
?>
