<?php
/**
* This file contains classes and function for the variables management.
*
* @package    use_field
* @subpackage business_process
* @version    1.0
* @date       02 Septembre 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

class object_trace_diagram extends BUS_object
{

/**************************************
* Methods for the object
**************************************/

	/**
	* constructor trace
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->dbnameSet('trace');
		$this->idSet('id');
		$this->selectLabelFieldSet('code');

		/* Table structure for the object */
		$this->tableSet('dmg_trace_diagram');
		$this->creationDateSet('date_creation');
		$this->updateDateSet('date_update');

		$this->fieldTableSet('id');
		$this->fieldTableSet('date_creation');
		$this->fieldAttrSet('date_creation', 'date', array(
			'auto' => true));
		$this->fieldTableSet('date_update');
		$this->fieldAttrSet('date_update', 'date', array(
			'auto' => true));
		$this->fieldTableSet('session');
		$this->fieldTableSet('reference');
		$this->fieldTableSet('user');
		$this->fieldTableSet('diagram_id');
		$this->fieldTableSet('diagram_name');
		$this->fieldTableSet('diagram_selected');
		$this->fieldTableSet('diagram_nodes');

		$this->fieldCompoSet('code', 'append', 'diagram_name');
		$this->fieldCompoSet('code', 'append', ' - ');
		$this->fieldCompoSet('code', 'append', 'reference');
		$this->fieldCompoSet('code', 'append', ' - ');
		$this->fieldCompoSet('code', 'append', 'session');

		$this->orderTableSet(0,'diagram_id');
		$this->orderTableSet(0,'session');
		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'diagram_id');
		$this->orderTableSet(1,'reference');
		$this->orderTableSet(1,'id');
	}

    public function init()
    {
		$diagramId = 0;
		$reference = '';
		$sessionId = '';
		$userId = 0;

		$noident = 1;
		$argFunc = func_get_args();
		if (is_array($argFunc[0])) {
			foreach($argFunc[0] as $key=>$value) {
				switch (strtoupper($key)) {
					case "DIAGRAM_ID" :
						$diagramId = trim($value);
						break;
					case "REFERENCE" :
						$reference = trim($value);
						break;
					case "SESSION" :
						$sessionId = trim($value);
						break;
					case "USER" :
						$userId = trim($value);
						break;
				}
			}
		}
		else {
			for($temp=0; $temp < count($argFunc); $temp++) {
				$atemp = explode(':', $argFunc[$temp]);
				if (count($atemp) > 1) {
					switch (strtoupper(trim($atemp[0]))) {
						case "DIAGRAM_ID" :
								$diagramId = trim($atemp[1]);
						break;
						case "REFERENCE" :
							$reference = trim($atemp[1]);
							break;
						case "SESSION" :
							$sessionId = trim($atemp[1]);
							break;
						case "USER" :
							$userId = trim($atemp[1]);
							break;
					}
				}
				else {
					switch ($noident) {
						case 1 :
							$diagramId = $argFunc[$temp];
							break;
						case 2 :
							$reference = trim($argFunc[$temp]);
							break;
						case 3 :
							$sessionId = trim($argFunc[$temp]);
							break;
						case 4 :
							$userId = $argFunc[$temp];
							break;
					}
					$noident++;
				}
			}
		}
		
		$fct_return = new return_function;

		$tb_diagram = new Smart_select('dmg_diagram', 'dgm');
		$tb_diagram->fieldSet('id');
		$tb_diagram->fieldSet('name');
		$tb_diagram->fieldSet('domain_id');
		$tb_diagram->fieldSet('type_id');
		$tb_diagram->whereSet('id', $diagramId);
		$diagram = $tb_diagram->find();
		$diagramName = $diagram['name'];
		$diagramType = $diagram['type_id'];
		$domainId = $diagram['domain_id'];
		$nodeSelected = '';

		$tb_trace = new Smart_select('dmg_trace_diagram', 'trace');
		$tb_trace->fieldSet('id');
		$tb_trace->fieldSet('session');
		$tb_trace->fieldSet('reference');
		$tb_trace->fieldSet('user');
		$tb_trace->fieldSet('diagram_id');
		$tb_trace->fieldSet('diagram_name');
		$tb_trace->fieldSet('diagram_type');
		$tb_trace->fieldSet('diagram_selected');
		$tb_trace->fieldSet('diagram_nodes');
		if (empty($reference)) {
			$tb_trace->whereSet('diagram_id', $diagramId);
			$tb_trace->whereSet('session', $sessionId, 'and');
			$traceDiagram = $tb_trace->find();
		}
		else {
			$tb_trace->whereSet('diagram_id', $diagramId);
			$tb_trace->whereSet('reference', $reference, 'and');
			$traceDiagram = $tb_trace->find();
			if (empty($traceDiagram)) {
				$tb_trace->whereSet('diagram_id', $diagramId);
				$tb_trace->whereSet('session', $sessionId, 'and');
				$traceDiagram = $tb_trace->find();
				if (!empty($traceDiagram)) {
					$traceDiagram['session'] = '';
					$traceDiagram['reference'] = $reference;
					$fct_return = parent::update($traceDiagram);
				}
			}
		}
		if (empty($traceDiagram)) {
			$tb_trace = new Smart_record('dmg_trace_diagram', 'trace');
			$tb_trace->fieldSet('session', $sessionId);
			$tb_trace->fieldSet('reference', $reference);
			$tb_trace->fieldSet('user', $userId);
			$tb_trace->fieldSet('diagram_id', $diagramId);
			$tb_trace->fieldSet('diagram_name', $diagramName);
			$tb_trace->fieldSet('diagram_type', $diagramType);
			$tb_trace->fieldSet('diagram_selected', 0);
			$tb_trace->fieldSet('diagram_nodes', '');
			$id = $tb_trace->insert();

			$traceDiagram = array();
			$traceDiagram['id'] = $id;
			$traceDiagram['session'] = $sessionId;
			$traceDiagram['reference'] = $reference;
			$traceDiagram['user'] = $userId;
			$traceDiagram['diagram_id'] = $diagramId;
			$traceDiagram['diagram_name'] = $diagramName;
			$traceDiagram['diagram_type'] = $diagramType;
			$traceDiagram['diagram_selected'] = 0;
			$traceDiagram['diagram_nodes'] = '';
		}
		
//		$trace = new object_trace();
//		$traceItem = $trace->init($domainId, $reference, $sessionId, $userId)->returnGet();
//		$traceDiagram['trace_id'] = $traceItem['id'];

		$fct_return->returnSet($traceDiagram);
		return $fct_return;
	}

}