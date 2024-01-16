<?php
/**
* display field plugin
*
* @package    formfield_display
* @version    1.1
* @date       25 March 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_DISPLAY_NAME', 'display');

// Plugin Path
$ws->paramSet('PLG_DISPLAY_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_DISPLAY_NAME') . '/templates/src/');

/**
* Classes for display plugin.
*/
class plg_Display extends plg_formfield
{
	/**
	* constructor plg_Text
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_DISPLAY_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}
}
?>
