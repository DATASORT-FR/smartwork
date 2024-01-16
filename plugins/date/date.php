<?php
/**
* date field plugin
*
* @package    formfield_date
* @version    1.1
* @date       14 Août 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_DATE_NAME', 'date');

// Plugin Path
$ws->paramSet('PLG_DATE_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_DATE_NAME') . '/templates/src/');

/**
* Classes for date plugin.
*/
class plg_Date extends plg_formfield
{
	/**
	* constructor plg_Date
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_DATE_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}
	
	/**
	* Display html for Date field
	*
	* @param string - field value
	*
	* @return string html
	*
    * @access public
	*/
	public function display($field_value = array()) {
		$ws = workspace::ws_open();

		$field_attr = $this->attrGet();		
		if ($field_attr['format'] == 'd/m/Y') {
			$field_value['format'] = 'dd/mm/yyyy';
		}
		else {
			$field_value['format'] = 'yyyy-mm-dd';
			$field_attr['format'] = 'Y-m-d';
		}
		$format = $field_attr['format'];
		if ((!empty($field_value['value'])) and ($field_value['value'] != ' ')) {
			$dateValue = date_create($field_value['value']);
			$field_value['value'] = date_format($dateValue, $format);
		}
		else {
			if (empty($field_value['value'])) {
				$field_value['value'] = date($format);
			}
			else {
				$field_value['value'] = trim($field_value['value']);
			}
		}
		return parent::display($field_value);
	}
}
?>
