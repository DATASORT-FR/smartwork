<?php
/**
* integer field plugin
*
* @package    formfield_integer
* @version    1.0
* @date       01 May 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_INTEGER_NAME', 'integer');

// Plugin Path
$ws->paramSet('PLG_INTEGER_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_INTEGER_NAME') . '/templates/src/');
$ws->paramSet('PLG_INTEGER_TEMPLATES_CSS_DIR', $ws->paramGet('RELA_PLUGINS_DIR') . $ws->paramGet('PLG_INTEGER_NAME') . '/templates/css/');

// Template css
//$ws->paramSet('PLG_INTEGER_TEMPLATE_STYLE', 'template.css');

// Add css & js
//$ws->addcss($ws->paramGet('PLG_INTEGER_TEMPLATES_CSS_DIR') . $ws->paramGet('PLG_INTEGER_TEMPLATE_STYLE'));

/**
* Classes for integer plugin.
*/
class plg_Integer extends plg_formfield
{
	/**
	* constructor plg_Number
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_INTEGER_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}
}
?>
