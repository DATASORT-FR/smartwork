<?php
/**
* comment editor field plugin
*
* @package    formfield_comment
* @version    1.0
* @date       30 December 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_COMMENT_NAME', 'comment');

// Plugin Path
$ws->paramSet('PLG_COMMENT_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_COMMENT_NAME') . '/templates/src/');

/**
* Classes for comment editor plugin.
*/
class plg_Comment extends plg_formfield
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
		parent::__construct($ws->paramGet('PLG_COMMENT_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}
}
?>
