<?php
/**
* accordion field plugin
*
* @package    formfield_  accordion
* @version    1.0
* @date       20 March 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_ACCORDION_NAME', 'accordion');
$ws->paramSet('PLG_ACCORDIONCONTENT_NAME', 'accordioncontent');

// Plugin Path
$ws->paramSet('PLG_ACCORDION_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_ACCORDION_NAME') . '/templates/src/');
$ws->paramSet('PLG_ACCORDIONCONTENT_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_ACCORDION_NAME') . '/templates/src/');

/**
* Classes for accordion plugin.
*/
class plg_Accordion extends plg_formfield
{
	/**
	* constructor plg_Tab
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_ACCORDION_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}
}

/**
* Classes for accordioncontent plugin.
*/
class plg_AccordionContent extends plg_formfield
{
	/**
	* constructor plg_Tab
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_ACCORDIONCONTENT_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}
}
?>
