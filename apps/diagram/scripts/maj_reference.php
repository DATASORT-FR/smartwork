<?php
/**
* This file contains App processing.
*
* Variables declaration 
*      $ws object workspace 
*
* @package    global
* @subpackage controller
* @version   1.0
* @date      04 April 2020
* @author    Alain VANDEPUTTE
* @copyright datasort.fr
*/

$ws = Workspace::ws_open();

if (!$ws->script()) {
	die();	
}

// Main
displayMsg('Begin process', '', 1);

$tbDiagram = new Smart_select('dmg_diagram', 'dgm');
//$tbDiagram->fieldSet('id');
$tbDiagram->fieldAll();
$diagrams = $tbDiagram->findAll();
foreach($diagrams as $key=>$diagram) {
	$traitFlag = true;

	$diagamId = $diagram['id'];
	displayMsg('Traitement diagram  ' . $diagamId, '', 2);
	
	$tbNode = new Smart_select('dmg_node', 'dgm');
	$tbNode->fieldAll();
	$tbNode->whereSet('diagram_id', $diagamId);
	$tbNode->orderSet('reference');
	$tbNode->orderSet('id');
	$nodes = $tbNode->findAll();
	$reference = 1;
	foreach($nodes as $key=>$node) {
		$nodeId = $node['id'];
		displayMsg('Traitement node  ' . $nodeId, '', 3);
		$tbNode = new Smart_record('dmg_node', 'dgm');
		$tbNode->fieldSet('reference', $reference);
		$tbNode->idSet($nodeId);
		$tbNode->update();
		$reference++;
	}
}

?>