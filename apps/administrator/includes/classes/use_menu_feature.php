<?php
/**
* This file contains classes and functions for the menu management.
*
* @package   administration_menu
* @version   1.2
* @date      25 November 2013
* @author    Alain VANDEPUTTE
* @copyright datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the users management.
*/
class object_menu_feature extends BUS_object
{

	/**
	* constructor adm_application
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->idSet('id');

		/* Table structure for the object */
		$this->tableSet('adm_menu_feature');
		$this->tableSet('adm_menu_feature2', 'adm_menu_feature');
		$this->joinTableSet('adm_menu', 'id','adm_menu_feature','menu_id');
		$this->joinTableSet('adm_feature', 'id','adm_menu_feature','feature_id');
		$this->joinTableSet('adm_menu_feature2', 'id','adm_menu_feature','parent_id');
		
		$this->fieldTableSet('id');
		$this->fieldTableSet('name');
		$this->fieldAttrSet('name', 'string', array(
			'required' => true,
			'size' => 50));
		$this->fieldTableSet('level');
		$this->fieldTableSet('ref');
		$this->fieldAttrSet('ref', 'string', array(
			'size' => 100));
		$this->fieldTableSet('content_id');
		$this->fieldAttrSet('content_id', 'string', array(
			'size' => 100));
//		$this->fieldTableSet('display_field');
//		$this->fieldAttrSet('display_field', 'string', array(
//			'size' => 20));
//		$this->fieldTableSet('display_ope');
//		$this->fieldTableSet('display_value');
//		$this->fieldAttrSet('display_value', 'string', array(
//			'size' => 20));
		$this->fieldTableSet('class');
		$this->fieldAttrSet('class', 'string', array(
			'size' => 50));
		$this->fieldTableSet('icon');
		$this->fieldAttrSet('icon', 'string', array(
			'size' => 50));
		$this->fieldTableSet('icon_only');
		$this->fieldAttrSet('icon_only', 'boolean');
		$this->fieldTableSet('page');
		$this->fieldAttrSet('page', 'boolean');
		$this->fieldTableSet('parent_id');
		$this->fieldTableSet('parent','adm_menu_feature2','name');
		$this->fieldTableSet('level_parent','adm_menu_feature2','level');
		$this->fieldTableSet('menu_id');
		$this->fieldTableSet('menu','adm_menu','code');
		$this->fieldTableSet('feature_id');
		$this->fieldTableSet('feature','adm_feature','code');
		
		$this->fieldCompoSet('code','append','name');
		$this->fieldCompoSet('label','append','name');

		$this->whereTableSet('name');
		$this->whereTableSet('ref');
		$this->whereTableSet('content_id');

		$this->orderTableSet(0,'level_parent');
		$this->orderTableSet(0,'level');
		$this->orderTableSet(0,'id');
	}

    public function displayList($order=0, $search_text="", $sort="", $sortOrder=0)
    {
		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new return_function;
		$ws->logSys('info', 'Object DisplayList for ' . $this->nameGet(), 'Main', func_get_args(), 'arguments');
		$ws->logSys('debug', 'call function for ' . $this->nameGet(), __CLASS__, func_get_args(), 'arguments');
		$error = '';
				
		try {
			/**
			* function processing by using smartorm
			*/
			$tb_adm_menu_feature = new Smart_select('adm_menu_feature');
			$tb_adm_menu_feature->fieldSet('id');
			$tb_adm_menu_feature->fieldSet('name');
			$tb_adm_menu_feature->fieldSet('name', 'code');
			$tb_adm_menu_feature->fieldSet('name', 'label');
			$tb_adm_menu_feature->fieldSet('level');
			$tb_adm_menu_feature->fieldSet('ref');
			$tb_adm_menu_feature->fieldSet('content_id');
			$tb_adm_menu_feature->fieldSet('page');
			$tb_adm_menu_feature->fieldSet('menu_id');
			$tb_adm_menu_feature->fieldSet('feature_id');
			$tb_adm_menu_feature->fieldSet('parent_id');
			$tb_adm_menu_feature->whereSet('name', '%'.$search_text.'%');
			if ($this->findFilter('parent_id')) {
				$tb_adm_menu_feature->whereSet('parent_id', $this->filterGetValue('parent_id'),'and','=');
			}
			if ($this->findFilter('menu_id')) {
				$tb_adm_menu_feature->whereSet('menu_id', $this->filterGetValue('menu_id'),'and','=');
			}
			if ($this->findFilter('page')) {
				$tb_adm_menu_feature->whereSet('page', $this->filterGetValue('page'),'and','=');
			}
			
			$tb_adm_menu=$tb_adm_menu_feature->joinSet('menu_id', 'adm_menu', 'id');
			$tb_adm_menu->fieldSet('code', 'menu');

			$tb_adm_feature=$tb_adm_menu_feature->joinSet('feature_id', 'adm_feature', 'id');
			$tb_adm_feature->fieldSet('code', 'feature');

			$tb_adm_menu_feature2=$tb_adm_menu_feature->joinSet('parent_id', 'adm_menu_feature', 'id');
			$tb_adm_menu_feature2->fieldSet('name', 'parent');
			$tb_adm_menu_feature2->fieldSet('level', 'level_parent');
			
			/** calculate order list */
			$tb_adm_menu_feature2->orderSet('level');
			$tb_adm_menu_feature->orderSet('level');
			$tb_adm_menu_feature->orderSet('id');

			$sort = array();
			$returnList = $tb_adm_menu_feature->findAll();
			foreach ($returnList as $key => $line) {
				if ($line['parent_id']) {
					$line['order'] = ($line['level_parent'] * 100) + $line['level'];
					$line['name'] = '<span class="space-hierarchy">---</span>' . $line['name'];
				}
				else {
					$line['order'] = $line['level'] * 100;
				}
				$returnList[$key] = $line;
				$sort[$key] = $line['order'];
			}
			array_multisort($sort, SORT_ASC, $returnList);			
			
			$fct_return->returnSet($returnList);

			$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'function KO for ' . $this->nameGet() . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			$ws->logfunc('error', 'KO_001');
		}
		return $fct_return;
	}

    public function insert($argArray, $dbName = '')
    {
		$menu_id = $this->valueGet('menu_id');
		$parent_id = $argArray['parent_id'];
		$level = $this->menuitem_maxLevel($menu_id, $parent_id);
		$this->valueSet('level',$level + 1);
		$fct_return = parent::insert($argArray, $dbName);
		return $fct_return;
	}

    public function update($argArray, $dbName = '')
    {
		$tb_adm_menu_feature = new Smart_select('adm_menu_feature');
		$tb_adm_menu_feature->fieldSet('menu_id');
		$tb_adm_menu_feature->fieldSet('parent_id');
		$tb_adm_menu_feature->fieldSet('level');
		$tb_adm_menu_feature->whereSet('id',$argArray['id']);
		$returnList = $tb_adm_menu_feature->find();

		$menu_id = $this->valueGet('menu_id');
		$parent_id = $argArray['parent_id'];
		if ($returnList['parent_id'] != $parent_id) {
			$level = $this->menuitem_maxLevel($menu_id, $parent_id) + 1;
			$this->valueSet('level',$level);
		}
		$fct_return = parent::update($argArray, $dbName);
		if ($returnList['parent_id'] != $parent_id) {
			$this->menuitem_organizeLevel($menu_id, $parent_id);
			$this->menuitem_organizeLevel($menu_id, $returnList['parent_id']);
		}
		return $fct_return;
	}

    public function delete($id, $dbName = '')
    {
		$tb_adm_menu_feature = new Smart_select('adm_menu_feature');
		$tb_adm_menu_feature->fieldSet('menu_id');
		$tb_adm_menu_feature->fieldSet('parent_id');
		$tb_adm_menu_feature->whereSet('id',$id);
		$returnList = $tb_adm_menu_feature->find();

		$fct_return = parent::delete($id, $dbName);
		$menu_id = $returnList['menu_id'];
		$parent_id = $returnList['parent_id'];
		$this->menuitem_organizeLevel($menu_id, $parent_id);
		return $fct_return;
	}

    public function menuitem_maxLevel($menu_id, $menuitem_id)
    {
		$tb_adm_menu_feature = new Smart_select('adm_menu_feature');
		$tb_adm_menu_feature->fieldSet('id');
		$tb_adm_menu_feature->fieldSet('level');
		$tb_adm_menu_feature->whereSet('menu_id',$menu_id,'and');
		$tb_adm_menu_feature->whereSet('parent_id',$menuitem_id,'and');
		$tb_adm_menu_feature->orderSet('level','DESC');
		$returnList = $tb_adm_menu_feature->find();
		$level = 0;
		if (!empty($returnList['level'])) {
			$level = $returnList['level'];
		}
		return $level;
	}

    public function menuitem_organizeLevel($menu_id, $menuitem_id, $level_begin=0, $level_min=1)
    {
		$tb_adm_menu_feature = new Smart_select('adm_menu_feature');
		$tb_adm_menu_feature->fieldSet('id');
		$tb_adm_menu_feature->fieldSet('level');
		$tb_adm_menu_feature->whereSet('menu_id',$menu_id,'and');
		$tb_adm_menu_feature->whereSet('parent_id',$menuitem_id,'and');
		$tb_adm_menu_feature->whereSet('level',$level_begin,'and','>=');
		$tb_adm_menu_feature->orderSet('level');

		$tb_adm_menu_item = new Smart_record('adm_menu_feature');
		$level = $level_min;
		$returnList = $tb_adm_menu_feature->find();
		while ($returnList) {
			$tb_adm_menu_item->idSet($returnList['id']);
			$tb_adm_menu_item->fieldSet('level', $level);
			$tb_adm_menu_item->update();
			
			$level = $level + 1;
			$returnList = $tb_adm_menu_feature->findNext();
		}
	}

    public function levelUp($id)
    {
		$fct_return = new Return_function;
		$tb_adm_menu_feature = new Smart_select('adm_menu_feature');
		$tb_adm_menu_feature->fieldSet('menu_id');
		$tb_adm_menu_feature->fieldSet('parent_id');
		$tb_adm_menu_feature->fieldSet('level');
		$tb_adm_menu_feature->whereSet('id',$id);
		$tb_adm_menu_feature2=$tb_adm_menu_feature->joinSet('parent_id', 'adm_menu_feature', 'id');
		$tb_adm_menu_feature2->fieldSet('level', 'level_parent');
		$returnList = $tb_adm_menu_feature->find();
		
		$menu_id = $returnList['menu_id'];
		$parent_id = $returnList['parent_id'];
		$level = $returnList['level'];
		$level_parent = $returnList['level_parent'];
		if ($level > 1) {
			$level = $level - 1.5;
			$tb_adm_menu_item = new Smart_record('adm_menu_feature');
			$tb_adm_menu_item->idSet($id);
			$tb_adm_menu_item->fieldSet('level', $level);
			$tb_adm_menu_item->update();
			$this->menuitem_organizeLevel($menu_id, $parent_id);
		}
		else {
			if ($level_parent > 1) {
				$tb_adm_menu_feature = new Smart_select('adm_menu_feature');
				$tb_adm_menu_feature->fieldSet('id');
				$tb_adm_menu_feature->whereSet('menu_id', $menu_id, 'and');
				$tb_adm_menu_feature->whereSet('parent_id', 0, 'and','=');
				$tb_adm_menu_feature->whereSet('level', $level_parent - 1, 'and', '=');
				$returnList = $tb_adm_menu_feature->find();

				$parent_id_old = $parent_id;
				$parent_id = $returnList['id'];
				$level = $this->menuitem_maxLevel($menu_id, $parent_id);
				$tb_adm_menu_item = new Smart_record('adm_menu_feature');
				$tb_adm_menu_item->idSet($id);
				$tb_adm_menu_item->fieldSet('parent_id', $parent_id);
				$tb_adm_menu_item->fieldSet('level', $level + 1);
				$tb_adm_menu_item->update();
				$this->menuitem_organizeLevel($menu_id, $parent_id_old);
			}
		}
		return $fct_return;
	}

}