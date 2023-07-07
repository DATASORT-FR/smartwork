<?php
/**
* This file contains classes and functions for the node link management.
*
* @package   use_link
* @subpackage business_process
* @version   1.0
* @date      03 Septembre 2020
* @author    Alain VANDEPUTTE
* @copyright datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the links management.
*/
class object_link extends BUS_object
{

	/**
	* constructor adm_menu
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->dbnameSet('dgm');
		$this->idSet('id');

		/* Table structure for the object */
		$this->tableSet('dmg_link');
		$this->tableSet('dmg_nodeFrom', 'dmg_node');
		$this->tableSet('dmg_nodeTo', 'dmg_node');
		$this->joinTableSet('dmg_diagram', 'id','dmg_node','diagram_id');
		$this->joinTableSet('dmg_domain', 'id','dmg_diagram','domain_id');
		$this->joinTableSet('dmg_nodeFrom', 'id','dmg_link','nodeFrom_id');
		$this->joinTableSet('dmg_nodeTo', 'id','dmg_link','nodeTo_id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('diagram_id');
		$this->fieldTableSet('diagram_name','dmg_diagram','title');
		$this->fieldTableSet('diagram_type','dmg_diagram','type_id');
		$this->fieldTableSet('domain_id','dmg_diagram','domain_id');
		$this->fieldTableSet('domain_name','dmg_domain','name');
		$this->fieldTableSet('nodeFrom_id');
		$this->fieldTableSet('nodeFrom_reference','dmg_nodeFrom','reference');
		$this->fieldTableSet('nodeFrom','dmg_nodeFrom','title');
		$this->fieldTableSet('nodeTo_id');
		$this->fieldTableSet('nodeTo_reference','dmg_nodeTo','reference');
		$this->fieldTableSet('nodeTo','dmg_nodeTo','title');
		$this->fieldTableSet('sequence');

		$this->fieldTableSet('description');
		$this->fieldAttrSet('description', 'text');

		$this->fieldCompoSet('code', 'append', 'nodeFrom_reference');
		$this->fieldCompoSet('code', 'append', ' - ');
		$this->fieldCompoSet('code', 'append', 'nodeTo_reference');

		$this->whereTableSet('nodeFrom');
		$this->whereTableSet('nodeTo');

		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'nodeFrom_id');
		$this->orderTableSet(1,'sequence');
		$this->orderTableSet(1,'nodeTo_id');
		$this->orderTableSet(1,'id');
	}

    public static function _maxSequence($diagramId, $nodeId)
    {
		$sequence = 0;
		$tbLink = new Smart_select('dmg_link');
		$tbLink->dbnameSet('dgm');
		$tbLink->fieldSet('id');
		$tbLink->fieldSet('sequence');
		$tbLink->whereSet('diagram_id', $diagramId);
		$tbLink->whereSet('nodeFrom_id', $nodeId, 'and');
		$tbLink->orderSet('nodeFrom_id');
		$tbLink->orderSet('sequence');
		$tbLink->orderSet('nodeTo_id');
		$list = $tbLink->findAll();
		$returnList = $tbLink->findAll();
		if (!empty($returnList)) {
			$sequence = count($returnList);
		}
		return $sequence;
	}
	
    public static function _delete($linkId)
    {
		$tb_link = new Smart_record('dmg_link', 'dgm');

		$tb_link->idSet($linkId);
		$tb_link->delete();

	}
	
    public function insert($argArray, $dbName = '')
    {
		$list = array();
		if ((isset($argArray['diagram_id'])) and (isset($argArray['nodeFrom_id']))) {
			$sequence = self::_maxSequence($argArray['diagram_id'], $argArray['nodeFrom_id']);
			$argArray['sequence'] = $sequence;
		}
		$fct_return = parent::insert($argArray);
		return $fct_return;
	}
	
}