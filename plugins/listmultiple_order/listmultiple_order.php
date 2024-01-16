<?php
/**
* listmultipleOrder field plugin
*
* @package    formfield_listmultipleOrder
* @version    1.1
* @date       22 Août 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_LISTMULTIPLE_ORDER_NAME', 'listmultiple_order');

// Plugin Path
$ws->paramSet('PLG_LISTMULTIPLE_ORDER_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_LISTMULTIPLE_ORDER_NAME') . '/templates/src/');

/**
* Classes for listmultipleOrder plugin.
*/
class plg_Listmultiple_Order extends plg_formfield
{
	/**
	* constructor plg_ListmultipleOrder
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_LISTMULTIPLE_ORDER_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}
	
}
?>
