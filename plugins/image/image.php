<?php
/**
* image field plugin
*
* @package    formfield_image
* @version    1.1
* @date       22 Août 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_IMAGE_NAME', 'image');

// Plugin Path
$ws->paramSet('PLG_IMAGE_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_IMAGE_NAME') . '/templates/src/');
$ws->paramSet('PLG_IMAGE_TEMPLATES_CSS_DIR', $ws->paramGet('RELA_PLUGINS_DIR') . $ws->paramGet('PLG_IMAGE_NAME') . '/templates/css/');
$ws->paramSet('PLG_IMAGE_TEMPLATES_JS_DIR', $ws->paramGet('RELA_PLUGINS_DIR') . $ws->paramGet('PLG_IMAGE_NAME') . '/templates/js/');

// Template css
$ws->paramSet('PLG_IMAGE_TEMPLATE_STYLE', 'image.css');
$ws->paramSet('PLG_IMAGE_TEMPLATE_JS', 'image.js');

// Add css & js
$ws->addcss($ws->paramGet('PLG_IMAGE_TEMPLATES_CSS_DIR') . $ws->paramGet('PLG_IMAGE_TEMPLATE_STYLE'), true, false);
$ws->addjs($ws->paramGet('PLG_IMAGE_TEMPLATES_JS_DIR') . $ws->paramGet('PLG_IMAGE_TEMPLATE_JS'));

/**
* Classes for image plugin.
*/
class plg_Image extends plg_formfield
{

	/**
	* constructor plg_Image
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_IMAGE_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}

	/**
	* Display html for Image field
	*
	* @param string - field value
	*
	* @return string html
	*
    * @access public
	*/
	public function display($field_value = array()) {
		$ws = workspace::ws_open();
		
		$connect = new object_connect();
		$field_value['ref'] = $connect->constructHref($ws->paramGet('APP_CODE'), "mediamanager", "module:mediamanager");
		$atemp = explode(';',$field_value['value']);
		$image = '';
		$alt = '';
		$title = '';
		if (isset($atemp[0])) {
			$image = $atemp[0];
		}
		if (isset($atemp[1])) {
			$alt = $atemp[1];
		}
		if (isset($atemp[2])) {
			$title = $atemp[2];
		}
		$field_value['image'] = $image;
		$field_value['alt'] = $alt;
		$field_value['title'] = $title;
		return parent::display($field_value);
	}
}
?>
