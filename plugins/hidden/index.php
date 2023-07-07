<?php
/**
* hidden form field plugin : template
*
* @package    form_field plugin
* @subpackage hidden plugin
* @version    1.0
* @date       26 September 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_HIDDEN_NAME', 'hidden');

// Plugin Path
$ws->paramSet('PLG_HIDDEN_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_HIDDEN_NAME') . '/templates/src/');

/**
* Classes for hidden plugin.
*/
class plg_hidden extends plg_formfield
{
	/**
	* constructor plg_Hidden
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_HIDDEN_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}
}
?>
