<?php
/**
* text field plugin
*
* @package    formfield_text
* @version    1.1
* @date       14 Août 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_TEXT_NAME', 'text');

// Plugin Path
$ws->paramSet('PLG_TEXT_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_TEXT_NAME') . '/templates/src/');

/**
* Classes for text plugin.
*/
class plg_Text extends plg_formfield
{
	/**
	* constructor plg_Text
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_TEXT_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}
}
?>
