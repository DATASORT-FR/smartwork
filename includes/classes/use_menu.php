<?php
/**
* This file contains classes and functions for the menu management.
*
* @package   administration_menu
* @version   1.3
* @date      25 Juillet 2015
* @author    Alain VANDEPUTTE
* @copyright datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the users management.
*/
class object_menu extends BUS_object
{

	/**
	* constructor adm_menu
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet('Menu');
		$this->idSet('id');

		/* Table structure for the object */
		$this->tableSet('adm_menu');
		$this->joinTableSet('adm_application', 'id','adm_menu','application_id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('code');
		$this->fieldAttrSet('code', 'string', array(
			'required' => true,
			'size' => 10,
			'case' => 'upper'));
		$this->fieldTableSet('label');
		$this->fieldAttrSet('label', 'string', array(
			'size' => 50));
		$this->fieldTableSet('application_id');
		$this->fieldTableSet('application','adm_application','code');

		$this->whereTableSet('code');
		$this->whereTableSet('label');

		$this->fieldCompoSet('title','append','application');
		$this->fieldCompoSet('title','append',' - ');
		$this->fieldCompoSet('title','append','code');
		
		$this->orderTableSet(0,'code');
		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'application');
		$this->orderTableSet(1,'code');
		$this->orderTableSet(1,'id');
		$this->orderTableSet(2,'id');
	}
	
	/**
	* Display list of menu items
	*
	* @param string - application code
	* @param string - menu code
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
	*         return : array (menus to display)
	*  			- id : integer
	*  			- level : integer
	*  			- level_parent : integer
	*  			- name : string
	*  			- menu : string
	*  			- ref : string
	*  			- page : boolean
	*
    * @access public
	*/
    public function displayItems($application, $menu_code)
    {
		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function', __CLASS__, func_get_args(), 'arguments');

		try {
			/**
			* find menu items by using smartorm
			*/
			$connect_id = $ws->connected_id();
			
			if ($ws->cacheCtrl($menu_code, 'menu')) {
				$adm_menu = $ws->cacheGet($menu_code, 'menu');
			}
			else {
				$tb_adm_menu = new Smart_select('adm_menu');
				$tb_adm_menu->fieldSet('id');
				$tb_adm_menu->fieldSet('code');
				$tb_adm_menu->fieldSet('label');
				$tb_adm_menu->fieldSet('application_id');
				$tb_adm_menu->whereSet('code', $menu_code);

				$tb_adm_application=$tb_adm_menu->joinSet('application_id', 'adm_application', 'id');
				$tb_adm_application->fieldSet('code', 'application');
				$tb_adm_application->fieldSet('public');
				$tb_adm_application->whereSet('code', $application, 'and');

				$adm_menu = $tb_adm_menu->find();
				$adm_menu_list = array();
				if (isset($adm_menu['id'])) {
					$menu_id = $adm_menu['id'];
					$application_id = $adm_menu['application_id'];
					$application_public = $adm_menu['public'];

					$tb_adm_menu_feature = new Smart_select('adm_menu_feature');
					$tb_adm_menu_feature->fieldSet('id');
					$tb_adm_menu_feature->fieldSet('level');
					$tb_adm_menu_feature->fieldSet('parent_id');
					$tb_adm_menu_feature->fieldSet('name');
					$tb_adm_menu_feature->fieldSet('ref');
					$tb_adm_menu_feature->fieldSet('content_id');
					$tb_adm_menu_feature->fieldSet('class');
					$tb_adm_menu_feature->fieldSet('icon');
					$tb_adm_menu_feature->fieldSet('icon_only');
					$tb_adm_menu_feature->fieldSet('page');
					$tb_adm_menu_feature->fieldSet('feature_id');
					$tb_adm_menu_feature->whereSet('menu_id', $menu_id);

					$tb_adm_feature=$tb_adm_menu_feature->joinSet('feature_id', 'adm_feature', 'id');
					$tb_adm_feature->fieldSet('code', 'feature');

					$tb_adm_menu_feature1=$tb_adm_menu_feature->joinSet('parent_id', 'adm_menu_feature', 'id');
					$tb_adm_menu_feature1->fieldSet('level', 'level_parent');
					$tb_adm_menu_feature1->fieldSet('feature_id', 'feature_parent_id');
			
					$adm_menu_list = $tb_adm_menu_feature->findAll();
				}

				$connect = new object_connect;
				for ($i=0; $i < count($adm_menu_list); $i++) {
					$menu_item = $adm_menu_list[$i];
					if ($menu_item['feature_id'] == 0) {
						if (trim($menu_item['ref']) != '') {
							$menu_item['feature_id'] = $connect->searchFeature($application_id, $menu_item['ref'])->returnGet();
						}
						else {
							$menu_item['feature_id'] = $connect->searchFeature($application_id, 'content')->returnGet();
						}
					}
					if ($menu_item['feature_id'] <> 0) {
						$menu_item['connected'] = $connect->searchFeatureRight($connect_id, $application_public, $application, $menu_item['feature_id'])->returnGet()['read'];
					
						if (($menu_item['connected']) && ($menu_item['feature_parent_id'] <> 0) && ($menu_item['parent_id'] <> 0)) {
							$menu_item['connected'] = $connect->searchFeatureRight($connect_id, $application_public, $application, $menu_item['feature_parent_id'])->returnGet()['read'];
						}
					}
					else {
						$menu_item['connected'] = true;						
					}
					$adm_menu_list[$i] = $menu_item;
				}

				$adm_menu['list'] = $adm_menu_list;

				$ws->cacheSet($menu_code, $adm_menu, 'menu');
			}
			$fct_return->returnSet($adm_menu);

			$ws->logSys('debug', 'Display menu ok', __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', $e->getCode() . " : " . $e->getMessage(), __CLASS__);
		}
		return $fct_return;
	}
}