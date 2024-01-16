<?php
/**
* number field plugin
*
* @package    formfield_number
* @version    1.1
* @date       14 Août 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_NUMBER_NAME', 'number');

// Plugin Path
$ws->paramSet('PLG_NUMBER_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_NUMBER_NAME') . '/templates/src/');
$ws->paramSet('PLG_NUMBER_TEMPLATES_CSS_DIR', $ws->paramGet('RELA_PLUGINS_DIR') . $ws->paramGet('PLG_NUMBER_NAME') . '/templates/css/');

// Template css
//$ws->paramSet('PLG_NUMBER_TEMPLATE_STYLE', 'template.css');

// Add css & js
//$ws->addcss($ws->paramGet('PLG_NUMBER_TEMPLATES_CSS_DIR') . $ws->paramGet('PLG_NUMBER_TEMPLATE_STYLE'));

/**
* Classes for number plugin.
*/
class plg_Number extends plg_formfield
{
	/**
	* constructor plg_Number
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_NUMBER_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}
	
   public function format($value) {
		$ws = workspace::ws_open();

		$value = str_replace('.', $ws->sessionGet('decimal'), $value);
		return $value;
	}
	
}
?>
