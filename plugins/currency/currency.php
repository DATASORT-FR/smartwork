<?php
/**
* currency field plugin
*
* @package    formfield_currency
* @version    1.1
* @date       14 Août 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_CURRENCY_NAME', 'currency');

// Plugin Path
$ws->paramSet('PLG_CURRENCY_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_CURRENCY_NAME') . '/templates/src/');
$ws->paramSet('PLG_CURRENCY_TEMPLATES_CSS_DIR', $ws->paramGet('RELA_PLUGINS_DIR') . $ws->paramGet('PLG_CURRENCY_NAME') . '/templates/css/');

/**
* Classes for currency plugin.
*/
class plg_Currency extends plg_formfield
{
	/**
	* constructor plg_Number
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_CURRENCY_NAME'), $field_name, $field_id, $field_mode, $field_attr);
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

		$decimal = 2;
		if (isset($field_attr['decimal'])) {
			$decimal = $field_attr['decimal'];
		}
		switch ($field_attr['format']) {
			case 'usd':
				$currency = 'fa-dollar-sign';
				break;
			case 'euro':
				$currency = 'fa-eur';
				break;
			case 'gbp':
				$currency = 'fa-pound-sign';
				break;
			default:
				$currency = 'fa-money-bill';
		}
		$field_value['currency'] = $currency;
		$field_value['value'] = str_replace('.', $ws->sessionGet('decimal'), $field_value['value']);
		return parent::display($field_value);
	}
	
}

?>
