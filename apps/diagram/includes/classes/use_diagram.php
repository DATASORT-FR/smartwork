<?php
/**
* This file contains classes and function for the diagrams management.
*
* @package    use_diagram
* @subpackage business_process
* @version    1.0
* @date       02 Octobre 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the diagrams management.
*/
class object_diagram extends BUS_object
{

	/**
	* constructor adm_feature
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->dbnameSet('dgm');
		$this->idSet('id');
		$this->selectLabelFieldSet('code');

		/* Table structure for the object */
		$this->tableSet('dmg_diagram');
		$this->joinTableSet('dmg_domain', 'id','dmg_diagram','domain_id');
		$this->joinTableSet('dmg_diagram_type', 'id','dmg_diagram','type_id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('domain_id');
		$this->fieldTableSet('domain_name','dmg_domain','name');
		$this->fieldTableSet('name');
		$this->fieldAttrSet('name', 'string', array(
			'required' => true,
			'size' => 20,
			'case' => 'upper'));
		$this->fieldTableSet('type_id');
		$this->fieldTableSet('type','dmg_diagram_type','code');
		$this->fieldTableSet('label');
		$this->fieldAttrSet('label', 'string', array(
			'size' => 100));
		$this->fieldTableSet('description');
		$this->fieldAttrSet('description', 'text');

		$this->fieldCompoSet('code', 'append', 'domain_name');
		$this->fieldCompoSet('code', 'append', ' - ');
		$this->fieldCompoSet('code', 'append', 'name');

		$this->whereTableSet('name');
		$this->whereTableSet('label');
		
		$this->orderTableSet(0,'id');		
		$this->orderTableSet(1,'domain_id');
		$this->orderTableSet(1,'name');
		$this->orderTableSet(1,'id');		

//		$this->joinObjectSet('object_node','diagram_id', 'id');		
//		$this->fieldObjectSet('node_title', 'object_node', 'title');
//		$this->fieldObjectSet('node_root', 'object_node', 'root');
	}

     public static function _copy($diagramId, $newDomainId, $newName = '') {
		$newDiagramId = 0;

		$tbDiagram = new Smart_select('dmg_diagram', 'dgm');
		$tbDiagram->fieldSet('domain_id');
		$tbDiagram->fieldSet('name');
		$tbDiagram->fieldSet('label');
		$tbDiagram->fieldSet('type_id');
		$tbDiagram->fieldSet('description');
		$tbDiagram->whereSet('id',$diagramId);
		$diagram = $tbDiagram->find();

		$domainId = $diagram['domain_id'];
		$name = $diagram['name'];
		$label = $diagram['label'];
		$typeId = $diagram['type_id'];
		$description = $diagram['description'];
		if (empty($newName)) {
			$newName = $name;
		}

		$tbDiagram = new Smart_select('dmg_diagram', 'dgm');
		$tbDiagram->fieldSet('id');
		$tbDiagram->whereSet('domain_id',$newDomainId);
		$tbDiagram->whereSet('name',$newName, 'and');
		$diagram = $tbDiagram->find();
		if (empty($diagram)) {
			$tbDiagram = new Smart_record('dmg_diagram', 'dgm');
			$tbDiagram->fieldSet('domain_id', $newDomainId);
			$tbDiagram->fieldSet('name', $newName);
			$tbDiagram->fieldSet('type_id', $typeId);
			$tbDiagram->fieldSet('description', $description);
			$tbDiagram->fieldSet('label', $label);
			$newDiagramId = $tbDiagram->insert();
	
			$tbNode = new Smart_select('dmg_node', 'dgm');
			$tbNode->fieldSet('id');
			$tbNode->whereSet('diagram_id', $diagramId);
			$tbNode->whereSet('root', 1, 'and');
			$node = $tbNode->find();
			if (!empty($node)) {
				$nodeId = $node['id'];
				object_node::_copyChildren($nodeId, $domainId, $diagramId, '', $newDomainId, $newDiagramId, '');
			}
		}
		return $newDiagramId;
	}

    public function copy($diagramId)
    {
		$newDiagramId = 0;
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('info', $this->dbnameGet() . ' - Object Insert for ' . $this->nameGet(),  __CLASS__, func_get_args(), 'arguments');

		$argArray = array();
		$db = PDO_extend::ws_open('dgm');
		try {
			$db->beginTransaction();
			$tbDiagram = new Smart_record('dmg_diagram', 'dgm');
			$argArray = $tbDiagram->findId('id', $diagramId);
			if ($argArray) {
				$name = $argArray['name'];
				$newName = $name . '-1';
				$newDomainId = $argArray['domain_id'];
				$newDiagramId = self::_copy($diagramId, $newDomainId, $newName);
			}
		}
		catch (exception $e) {
			$newDiagramId = 0;
		}
		if ($newDiagramId != 0) {
			$db->commit();
			$fct_return->returnSet($newDiagramId);
			$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
			$this->Msg('copy','OK', $argArray);
		}
		else {
			$db->rollBack();
			$fct_return->errorSet(0);
			if (isset($e)) {
				$ws->logSys('error', 'function KO for ' . $this->nameGet() . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			}
			else {
				$ws->logSys('error', 'function KO for ' . $this->nameGet() . " ", __CLASS__);
			}
			$this->Msg('copy','KO', $argArray);
		}
		return $fct_return;
	}

    public static function _delete($diagramId) {
		
		// links delete
		$tbLink = new Smart_select('dmg_link', 'dgm');
		$tbLink->fieldSet('id');
		$tbLink->whereSet('diagram_id',$diagramId);
		$linkList = $tbLink->findAll();
		for ($i=0; $i < count($linkList); $i++) {
			$item = $linkList[$i];
			$linkId = $item['id'];
			$tbLink = new Smart_record('dmg_link', 'dgm');
			$tbLink->idSet($linkId);
			$tbLink->delete();
		}

		// nodes delete
		$tbNode = new Smart_select('dmg_node', 'dgm');
		$tbNode->fieldSet('id');
		$tbNode->whereSet('diagram_id',$diagramId);
		$nodeList = $tbNode->findAll();
		for ($i=0; $i < count($nodeList); $i++) {
			$item = $nodeList[$i];
			$nodeId = $item['id'];
			object_node::_delete($nodeId);
		}

		// diagram delete
		$tbDiagram = new Smart_record('dmg_diagram', 'dgm');
		$tbDiagram->idSet($diagramId);
		$tbDiagram->delete();
	}
	
    public function delete($diagramId, $dbName = '')
	{
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('info', $this->dbnameGet() . ' - Object Insert for ' . $this->nameGet(),  __CLASS__, func_get_args(), 'arguments');

		$argArray = array();
		$db = PDO_extend::ws_open('dgm');
		try {
			$db->beginTransaction();
			$tbDiagram = new Smart_record('dmg_diagram', 'dgm');
			$argArray = $tbDiagram->findId('id', $diagramId);
			if ($argArray) {
				self::_delete($diagramId);
			}
			else {
				$diagramId = 0;
			}
		}
		catch (exception $e) {
			$diagramId = 0;
		}
		if ($diagramId != 0) {
			$db->commit();
			$fct_return->returnSet($diagramId);
			$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
			$this->Msg('delete','OK', $argArray);
		}
		else {
			$db->rollBack();
			$fct_return->errorSet(0);
			if (isset($e)) {
				$ws->logSys('error', 'function KO for ' . $this->nameGet() . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			}
			else {
				$ws->logSys('error', 'function KO for ' . $this->nameGet() . " ", __CLASS__);
			}
			$this->Msg('delete','KO', $argArray);
		}
		return $fct_return;
	}

    public function insert($argArray, $dbName = '')
    {
		$fct_return = parent::insert($argArray, $dbName);
		if ($fct_return->statusGet()) {
			$diagramId = $fct_return->returnGet();

			$tbNode = new Smart_record('dmg_node', 'dgm');
			$tbNode->fieldSet('diagram_id', $diagramId);
			$tbNode->fieldSet('reference', 1);
			$tbNode->fieldSet('root', 1);
			$nodeId = $tbNode->insert();
		}
		return $fct_return;
	}

}