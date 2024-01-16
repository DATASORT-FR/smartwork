<?php
/**
* list field plugin
*
* @package    formfield_list
* @version    1.1
* @date       22 Août 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_LIST_NAME', 'list');

// Plugin Path
$ws->paramSet('PLG_LIST_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_LIST_NAME') . '/templates/src/');

/**
* Classes for list plugin.
*/
class plg_List extends plg_formfield
{
	/**
	* constructor plg_List
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_LIST_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}
}
?>
