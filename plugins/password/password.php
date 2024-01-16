<?php
/**
* password field plugin
*
* @package    formfield_password
* @version    1.1
* @date       14 Août 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_PASSWORD_NAME', 'password');

// Plugin Path
$ws->paramSet('PLG_PASSWORD_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_PASSWORD_NAME') . '/templates/src/');

/**
* Classes for password plugin.
*/
class plg_Password extends plg_formfield
{
	/**
	* constructor plg_Password
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_PASSWORD_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}
}
?>
