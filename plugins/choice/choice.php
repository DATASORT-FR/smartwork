<?php
/**
* choice field plugin
*
* @package    formfield_choice
* @version    1.1
* @date       14 Août 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_CHOICE_NAME', 'choice');

// Plugin Path
$ws->paramSet('PLG_CHOICE_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_CHOICE_NAME') . '/templates/src/');

/**
* Classes for choice plugin.
*/
class plg_Choice extends plg_formfield
{

	/**
	* constructor plg_Choice
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_CHOICE_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}

}
?>
