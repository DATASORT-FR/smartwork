<?php
/**
* video field plugin
*
* @package    formfield_video
* @version    1.1
* @date       21 Sept. 2018
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_VIDEO_NAME', 'video');

// Plugin Path
$ws->paramSet('PLG_VIDEO_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_VIDEO_NAME') . '/templates/src/');
$ws->paramSet('PLG_VIDEO_TEMPLATES_CSS_DIR', $ws->paramGet('RELA_PLUGINS_DIR') . $ws->paramGet('PLG_VIDEO_NAME') . '/templates/css/');
$ws->paramSet('PLG_VIDEO_TEMPLATES_JS_DIR', $ws->paramGet('RELA_PLUGINS_DIR') . $ws->paramGet('PLG_VIDEO_NAME') . '/templates/js/');

// Template css
$ws->paramSet('PLG_VIDEO_TEMPLATE_STYLE', 'video.css');
$ws->paramSet('PLG_VIDEO_TEMPLATE_JS', 'video.js');

// Add css & js
$ws->addcss($ws->paramGet('PLG_VIDEO_TEMPLATES_CSS_DIR') . $ws->paramGet('PLG_VIDEO_TEMPLATE_STYLE'));
$ws->addjs($ws->paramGet('PLG_VIDEO_TEMPLATES_JS_DIR') . $ws->paramGet('PLG_VIDEO_TEMPLATE_JS'));

/**
* Classes for video plugin.
*/
class plg_Video extends plg_formfield
{

	/**
	* constructor plg_Image
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_VIDEO_NAME'), $field_name, $field_id, $field_mode, $field_attr);
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
		$video = '';
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
