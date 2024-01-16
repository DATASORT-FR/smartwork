<?php
/**
* textarea field plugin
*
* @package    formfield_textarea
* @version    1.1
* @date       14 Août 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_TEXTAREA_NAME', 'textarea');

// Plugin Path
$ws->paramSet('PLG_TEXTAREA_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_TEXTAREA_NAME') . '/templates/src/');

/**
* Classes for textarea plugin.
*/
class plg_Textarea extends plg_formfield
{
	/**
	* constructor plg_Textarea
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_TEXTAREA_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}
}
?>
