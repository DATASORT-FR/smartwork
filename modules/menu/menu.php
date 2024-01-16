<?php
/**
* Menu class
*
* @package    module_menu
* @version    1.2
* @date       2 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('WMENU_NAME', 'menu');

// Menu Path
$ws->paramSet($ws->paramGet('WMENU_NAME') . '_TEMPLATES_SRC_DIR', $ws->paramGet('MODULES_DIR') . $ws->paramGet('WMENU_NAME') . '/' . TEMPLATES_SRC_PATH);
$ws->paramSet($ws->paramGet('WMENU_NAME') . '_TEMPLATES_JS_DIR', $ws->paramGet('RELA_MODULES_DIR') . $ws->paramGet('WMENU_NAME') . '/' . TEMPLATES_JS_PATH);

// Template css & js
$ws->paramSet($ws->paramGet('WMENU_NAME') . '_TEMPLATE_JS', 'menu.js');

$ws->addjs($ws->paramGet($ws->paramGet('WMENU_NAME') . '_TEMPLATES_JS_DIR') . $ws->paramGet($ws->paramGet('WMENU_NAME') . '_TEMPLATE_JS'));

/**
* Classes for menu module.
*/
class wmenu extends Wmodule
{


    public function __construct() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

 		parent::__construct($ws->paramGet('WMENU_NAME'));
   }
   
    function display($app, $menu_code, $style = 'default', $classAdd = '') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$smarty = new workpage();
		parent::initSmarty($smarty);
		
		$connect = new object_connect();
		$menu = array();
		$menu_text = array();
		$menu_title = array();
		$menu_ref = array();
		$menu_page = array();
		$menu_class = array();
		$menu_icon = array();
		$menu_iconOnly = array();
		$level_text = array();
		$level_title = array();
		$level_ref = array();
		$level_page = array();
		$level_class = array();
		$level_icon = array();
		$level_iconOnly = array();
		$adm_menu = new object_menu();
		$fct_return = $adm_menu->displayItems($app, $menu_code);
		if ($fct_return->statusGet()) {
			$menu = $fct_return->returnGet();
		}
		if (isset($menu['list'])) {
			$menu_array = $menu['list'];
			foreach($menu_array as $menu_item) {
				if (isset($menu_item['connected'])) {
					$show_item = $menu_item['connected'];
				}
				else {
					$show_item = false;
				}
				if ($show_item) {
					if (isset($menu_item['level_parent'])) {
						$menu_item['level_1'] = intval($menu_item['level_parent']);
						$menu_item['level_2'] = intval($menu_item['level']);
					}
					else {
						$menu_item['level_parent'] = 0;
						$menu_item['level_1'] = intval($menu_item['level']);
						$menu_item['level_2'] = 0;
					}
					$menuTextConfig = "Txt_menu_". strtolower($menu_code)."_".str_replace(" ","_",strtolower(trim($menu_item['name'])));
					$menuText = $smarty->getConfigVars($menuTextConfig);
					if (empty($menuText)) {
						$menuText = $menu_item['name'];
					}					
					$level_text[$menu_item['level_1'] - 1][$menu_item['level_2']] = $menuText;
					
					$menuTitleConfig = "Lbl_menu_". strtolower($menu_code)."_".str_replace(" ","_",strtolower(trim($menu_item['name'])));
					$menuTitle = $smarty->getConfigVars($menuTitleConfig);
					$level_title[$menu_item['level_1'] - 1][$menu_item['level_2']] = $menuTitle;
					
					$ref = trim($menu_item['ref']);
					$refId = trim($menu_item['content_id']);
					if ((($ref == '') or ($ref == '#')) and (($refId == '') or ($refId == '0'))) {
						$level_ref[$menu_item['level_1'] - 1][$menu_item['level_2']] = RELA_PATH;
					}
					else {
						if (($refId != '') and ($refId != '0')) {
							$level_ref[$menu_item['level_1'] - 1][$menu_item['level_2']] = $connect->constructHref($app, $ref, 'id:' . $refId);
						}
						else {
							$level_ref[$menu_item['level_1'] - 1][$menu_item['level_2']] = $connect->constructHref($app, $ref);							
						}
					}
					$level_page[$menu_item['level_1'] - 1][$menu_item['level_2']] = $menu_item['page'];
					$level_class[$menu_item['level_1'] - 1][$menu_item['level_2']] = $menu_item['class'];
					$level_icon[$menu_item['level_1'] - 1][$menu_item['level_2']] = $menu_item['icon'];
					$level_iconOnly[$menu_item['level_1'] - 1][$menu_item['level_2']] = $menu_item['icon_only'];
				}
			}
			$index1 = 0;
			$level1_max = 10;
			$level2_max = 20;
			for ($level1=0; $level1 < $level1_max; $level1++) {
				if (isset($level_text[$level1])) {
					$temp_text = array();
					$temp_title = array();
					$temp_ref = array();
					$temp_page = array();
					$temp_class = array();
					$temp_icon = array();
					$temp_iconOnly = array();
					$index2 = 0;
					for ($level2=0; $level2 < $level2_max; $level2++) {
						if (isset($level_text[$level1][$level2])) {
							$temp_text[$index2] = $level_text[$level1][$level2];
							$temp_title[$index2] = $level_title[$level1][$level2];
							$temp_ref[$index2] = $level_ref[$level1][$level2];
							$temp_page[$index2] = $level_page[$level1][$level2];
							$temp_class[$index2] = $level_class[$level1][$level2];
							$temp_icon[$index2] = $level_icon[$level1][$level2];
							$temp_iconOnly[$index2] = $level_iconOnly[$level1][$level2];
							$index2 = $index2 + 1;
						}
					}
					$menu_text[$index1] = $temp_text;
					$menu_title[$index1] = $temp_title;
					$menu_ref[$index1] = $temp_ref;
					$menu_page[$index1] = $temp_page;
					$menu_class[$index1] = $temp_class;
					$menu_icon[$index1] = $temp_icon;
					$menu_iconOnly[$index1] = $temp_iconOnly;
					$index1 = $index1 + 1;
				}
			}

		}
		$menu_back = true;
		If (!empty($ws->paramGet('APP_ONLY'))) {
			$menu_back = false;
		}

		$smarty->assign('Site_title', $ws->paramGet('SITE_TITLE'));
		$smarty->assign('Menu_homepage', $connect->constructHref(''));
		$smarty->assign('Menu_apppage', $connect->constructHref($app));
		$smarty->assign('Menu_style',$style);
		$smarty->assign('Menu_classAdd',$classAdd);
		$smarty->assign('Menu_back',$menu_back);
		$smarty->assign('Menu_text',$menu_text);
		$smarty->assign('Menu_title',$menu_title);
		$smarty->assign('Menu_ref',$menu_ref);
		$smarty->assign('Menu_page',$menu_page);
		$smarty->assign('Menu_class',$menu_class);
		$smarty->assign('Menu_icon',$menu_icon);
		$smarty->assign('Menu_iconOnly',$menu_iconOnly);
		$return = $smarty->fetch('menu.tpl');
		return $return;
	}

}

?>
