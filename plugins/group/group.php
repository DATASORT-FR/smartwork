<?php
/**
* group field plugin
*
* @package    formfield_group
* @version    1.0
* @date       28 Août 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_GROUP_NAME', 'group');

// Plugin Path
$ws->paramSet('PLG_GROUP_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_GROUP_NAME') . '/templates/src/');

/**
*  Classes for group plugin.
*/
class plg_Group  extends plg_formfield
{
	/**
	* constructor plg_Group
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_GROUP_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}
}
?>
