<?php
/**
* paraph field plugin
*
* @package    formfield_paraph
* @version    1.0
* @date       14 April 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_PARAPH_NAME', 'paraph');

// Plugin Path
$ws->paramSet('PLG_PARAPH_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_PARAPH_NAME') . '/templates/src/');

/**
* Classes for paraph plugin.
*/
class plg_Paraph extends plg_formfield
{
	/**
	* constructor plg_Text
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_PARAPH_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}
}
?>
