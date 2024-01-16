<?php
/**
* tab field plugin
*
* @package    formfield_tab
* @version    1.1
* @date       24 Août 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_TAB_NAME', 'tab');
$ws->paramSet('PLG_TABCONTENT_NAME', 'tabcontent');

// Plugin Path
$ws->paramSet('PLG_TAB_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_TAB_NAME') . '/templates/src/');
$ws->paramSet('PLG_TABCONTENT_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_TAB_NAME') . '/templates/src/');

/**
* Classes for tab plugin.
*/
class plg_Tab extends plg_formfield
{
	/**
	* constructor plg_Tab
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_TAB_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}
}

/**
* Classes for tabcontent plugin.
*/
class plg_TabContent extends plg_formfield
{
	/**
	* constructor plg_Tab
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_TABCONTENT_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}
}
?>
