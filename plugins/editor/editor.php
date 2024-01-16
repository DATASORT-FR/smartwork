<?php
/**
* editor field plugin
*
* @package    formfield_editor
* @version    1.1
* @date       14 Août 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_EDITOR_NAME', 'editor');

// Plugin Path
$ws->paramSet('PLG_EDITOR_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_EDITOR_NAME') . '/templates/src/');

/**
* Classes for text editor plugin.
*/
class plg_Editor extends plg_formfield
{
	/**
	* constructor plg_Editor
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		if (!isset($field_attr['rows'])) {
			$field_attr['rows'] = 20;
		}
		parent::__construct($ws->paramGet('PLG_EDITOR_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}
}
?>
