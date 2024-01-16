<?php
/**
* Contact module
*
* @package    module_contact
* @version    1.5
* @date       15 December 2023
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('CONTACT_NAME', 'contact');

// Connect Path
$ws->paramSet($ws->paramGet('CONTACT_NAME') . '_TEMPLATES_SRC_DIR', $ws->paramGet('MODULES_DIR') . $ws->paramGet('CONTACT_NAME') . '/' . TEMPLATES_SRC_PATH);
$ws->paramSet($ws->paramGet('CONTACT_NAME') . '_TEMPLATES_CSS_DIR', $ws->paramGet('RELA_MODULES_DIR') . $ws->paramGet('CONTACT_NAME') . '/' . TEMPLATES_CSS_PATH);
$ws->paramSet($ws->paramGet('CONTACT_NAME') . '_TEMPLATES_JS_DIR', $ws->paramGet('RELA_MODULES_DIR') . $ws->paramGet('CONTACT_NAME') . '/' . TEMPLATES_JS_PATH);

// Template css & js
$ws->paramSet($ws->paramGet('CONTACT_NAME') . '_TEMPLATE_STYLE', $ws->paramGet('CONTACT_NAME') . '.css');
$ws->paramSet($ws->paramGet('CONTACT_NAME') . '_TEMPLATE_JS', $ws->paramGet('CONTACT_NAME') . '.js');

//$ws->addcss($ws->paramGet($ws->paramGet('CONTACT_NAME') . '_TEMPLATES_CSS_DIR') . $ws->paramGet($ws->paramGet('CONTACT_NAME') . '_TEMPLATE_STYLE'));
//$ws->addjs($ws->paramGet($ws->paramGet('CONTACT_NAME') . '_TEMPLATES_JS_DIR') . $ws->paramGet($ws->paramGet('CONTACT_NAME') . '_TEMPLATE_JS'));

/**
* Classes for contact module.
*/
class Wcontact
{

    public function __construct() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

    }

    function display() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$smarty = new workpage();
		$smarty->setTemplateDir(array());
		$smarty->addTemplateDir($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . '/' . $ws->paramGet('CONTACT_NAME') . '/' . TEMPLATES_SRC_PATH);
		$smarty->addTemplateDir($ws->paramGet($ws->paramGet('CONTACT_NAME') . '_TEMPLATES_SRC_DIR'));

		$connect = new object_connect();
		$contactAction = $connect->constructHref($ws->paramGet('APP_CODE'), "sendmail_contact", "module:" . $ws->paramGet('CONTACT_NAME'));
		
		$smarty->assign('ContactAction', $contactAction);
		$display_html = $smarty->fetch('contact.tpl');

		return $display_html;
	}
}

?>