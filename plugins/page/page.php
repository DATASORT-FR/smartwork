<?php
/**
* page field plugin
*
* @package    formfield_page
* @version    1.0
* @date       08 July 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('PLG_PAGE_NAME', 'page');
$ws->paramSet('PLG_PAGECONTENT_NAME', 'pagecontent');

// Plugin Path
$ws->paramSet('PLG_PAGE_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_PAGE_NAME') . '/templates/src/');
$ws->paramSet('PLG_PAGE_TEMPLATES_CSS_DIR', $ws->paramGet('RELA_PLUGINS_DIR') . $ws->paramGet('PLG_PAGE_NAME') . '/templates/css/');
$ws->paramSet('PLG_PAGECONTENT_TEMPLATES_SRC_DIR', $ws->paramGet('PLUGINS_DIR') . $ws->paramGet('PLG_PAGE_NAME') . '/templates/src/');

// Template css
$ws->paramSet('PLG_PAGE_TEMPLATE_STYLE', 'page.css');

// Add css & js
$ws->addcss($ws->paramGet('PLG_PAGE_TEMPLATES_CSS_DIR') . $ws->paramGet('PLG_PAGE_TEMPLATE_STYLE'), true, false);

/**
* Classes for page plugin.
*/
class plg_Page extends plg_formfield
{
	/**
	* constructor plg_Page
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_PAGE_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}
}

/**
* Classes for pagecontent plugin.
*/
class plg_PageContent extends plg_formfield
{
	/**
	* constructor plg_Page
    *
    * @access public
	*/
    public function __construct($field_name, $field_id, $field_mode = 'edit', $field_attr= array()) {
		$ws = workspace::ws_open();
		parent::__construct($ws->paramGet('PLG_PAGECONTENT_NAME'), $field_name, $field_id, $field_mode, $field_attr);
	}
}
?>
