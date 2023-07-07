<?php
/**
* This file contains classes and function for the nodes management.
*
* @package    use_node
* @subpackage business_process
* @version    1.0
* @date       02 Septembre 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

if (!function_exists('questionInit')) {
	function questionInit() {
		$question =  '';
		if (!empty($argArray['question_description'])) {
			$question = mb_substr($argArray['question_description'], 0, 60);
			if ((strlen($question) > 58)and (preg_match("# #iusU", $question))) {
				$question = mb_substr($question, 0, mb_strrpos($question, ' '));
			}
		}
		return $question;
	}
}

/**
* Classes for the applications management.
*/
class object_node extends BUS_object
{

	/**
	* constructor nodes
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->dbnameSet('dgm');
		$this->idSet('id');
		$this->selectLabelFieldSet('title_code');

		/* Table structure for the object */
		$this->tableSet('dmg_node');
		$this->joinTableSet('dmg_diagram', 'id','dmg_node','diagram_id');
		$this->joinTableSet('dmg_domain', 'id','dmg_diagram','domain_id');
		$this->joinTableSet('dmg_slide', 'id','dmg_node','slide_id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('diagram_id');
		$this->fieldTableSet('diagram_name','dmg_diagram','name');
		$this->fieldTableSet('diagram_type','dmg_diagram','type_id');
		$this->fieldTableSet('domain_id','dmg_diagram','domain_id');
		$this->fieldTableSet('domain_name','dmg_domain','name');
		$this->fieldTableSet('reference');
		$this->fieldTableSet('root');
		$this->fieldAttrSet('root', 'boolean');
		$this->fieldTableSet('information');
		$this->fieldAttrSet('information', 'boolean');
		$this->fieldTableSet('slide_id');
		$this->fieldTableSet('title','dmg_slide','title');
		$this->fieldAttrSet('title', 'string', array(
			'required' => true,
			'size' => 100));
		$this->fieldTableSet('image','dmg_slide','image');
		$this->fieldTableSet('description','dmg_slide','description');
		$this->fieldTableSet('notice_id','dmg_slide','notice_id');
		$this->fieldTableSet('variable_contentid','dmg_slide','variable_contentid');
		$this->fieldTableSet('result_contentid','dmg_slide','result_contentid');
		$this->fieldTableSet('question_id');
		$this->fieldFctSet('label','labelSize','slide_description');

		$this->fieldCompoSet('code', 'append', 'title');
		$this->fieldCompoSet('title_code', 'append', 'title');
		$this->fieldCompoSet('title_code', 'append', ' (');
		$this->fieldCompoSet('title_code', 'append', 'reference');
		$this->fieldCompoSet('title_code', 'append', ')');

		$this->whereTableSet('title');
		$this->whereTableSet('description');

		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'title');
		$this->orderTableSet(1,'id');
		
		$this->joinObjectSet('object_linkTo','nodeTo_id', 'id', 'object_link');		
		$this->fieldObjectSet('nodeFrom_id', 'object_linkTo');
		$this->fieldObjectSet('nodeTo_id', 'object_linkTo');
		$this->fieldObjectSet('nodeFrom', 'object_linkTo');
		$this->fieldObjectSet('nodeTo', 'object_linkTo');
		$this->fieldObjectSet('linkDiagram_id', 'object_linkTo', 'diagram_id');
		$this->fieldObjectSet('linkDescription', 'object_linkTo', 'description');

		$this->joinObjectSet('object_slide', 'id', 'slide_id');		
		$this->fieldObjectSet('slide_domain', 'object_slide', 'domain_id');
		$this->fieldObjectSet('slide_label', 'object_slide', 'label');
		$this->fieldObjectSet('slide_title', 'object_slide', 'title');
		$this->fieldObjectSet('slide_image_display', 'object_slide', 'image_display');
		$this->fieldObjectSet('slide_image', 'object_slide', 'image');
		$this->fieldObjectSet('slide_description', 'object_slide', 'description');
		
		$this->joinObjectSet('object_slide_variable','slide_id', 'slide_id');		
		$this->dataObjectSet('variable_list','object_slide_variable', 'field_id');

		$this->joinObjectSet('object_slide_variable_1','slide_id', 'slide_id');		
		$this->dataObjectSet('variable_1_list','object_slide_variable_1', 'field_id');

		$this->joinObjectSet('object_slide_result','slide_id', 'slide_id');		
		$this->dataObjectSet('result_list','object_slide_result', 'field_id');

		$this->joinObjectSet('object_slide_result_1','slide_id', 'slide_id');		
		$this->dataObjectSet('result_1_list','object_slide_result_1', 'field_id');

		$this->joinObjectSet('object_notice', 'id', 'notice_id');		
		$this->fieldObjectSet('notice_domain', 'object_notice', 'domain_id');
		$this->fieldObjectSet('notice_type', 'object_notice', 'type_id');
		$this->fieldObjectSet('notice_label', 'object_notice', 'label');
		$this->fieldObjectSet('notice_title', 'object_notice', 'title');
		$this->fieldObjectSet('notice_image', 'object_notice', 'image');
		$this->fieldObjectSet('notice_description', 'object_notice', 'description');

		$this->joinObjectSet('object_content_variables', 'id', 'variable_contentid',);		
		$this->fieldObjectSet('variable_domain', 'object_content_variables', 'domain_id');
		$this->fieldObjectSet('variable_type', 'object_content_variables', 'type_id');
		$this->fieldObjectSet('variable_label', 'object_content_variables', 'label');
		$this->fieldObjectSet('variable_title', 'object_content_variables', 'title');
		$this->fieldObjectSet('variable_image', 'object_content_variables', 'image');
		$this->fieldObjectSet('variable_description', 'object_content_variables', 'description');

		$this->joinObjectSet('object_content_results', 'id', 'result_contentid');		
		$this->fieldObjectSet('result_domain', 'object_content_results', 'domain_id');
		$this->fieldObjectSet('result_type', 'object_content_results', 'type_id');
		$this->fieldObjectSet('result_label', 'object_content_results', 'label');
		$this->fieldObjectSet('result_title', 'object_content_results', 'title');
		$this->fieldObjectSet('result_image', 'object_content_results', 'image');
		$this->fieldObjectSet('result_description', 'object_content_results', 'description');

		$this->joinObjectSet('object_question', 'id', 'question_id');		
		$this->fieldObjectSet('question_domain', 'object_question', 'domain_id');
		$this->fieldObjectSet('question_type', 'object_question', 'type_id');
		$this->fieldObjectSet('question_label', 'object_question', 'label');
		$this->fieldObjectSet('question', 'object_question', 'title');
		$this->fieldObjectSet('question_description', 'object_question', 'description');

	}
	
    public static function _copy($nodeId, $domainId, $diagramId, $nodeParentId, $newDomainId, $newDiagramId, $newNodeParentId)
    {
		$item = array();

		$tbNode = new Smart_select('dmg_node', 'dgm');
		$tbNode->fieldSet('id');
		$tbNode->fieldSet('diagram_id');
		$tbNode->fieldSet('reference');
		$tbNode->fieldSet('root');
		$tbNode->fieldSet('slide_id');
		$tbNode->fieldSet('question_id');
		$tbNode->whereSet('id', $nodeId);
		$item = $tbNode->find();

		$nodeReference = $item['reference'];
		$nodeRoot = $item['root'];
		$nodeSlideId = $item['slide_id'];
		$nodeQuestionId = $item['question_id'];
		
		if ($domainId != $newDomainId) {
			// Slide
			$nodeSlideId = 0;
			$tbSlide = new Smart_select('dmg_slide', 'dgm');
			$tbSlide->fieldSet('id');
			$tbSlide->fieldSet('title');
			$tbSlide->whereSet('id', $item['slide_id']);
			$slide = $tbSlide->find();
			if (!empty($slide)) {
				$tbSlide = new Smart_select('dmg_slide', 'dgm');
				$tbSlide->fieldSet('id');
				$tbSlide->fieldSet('title');
				$tbSlide->whereSet('domain_id', $newDomainId, 'and');
				$tbSlide->whereSet('title', $slide['title'], 'and');
				$content = $tbSlide->find();
			}
			if (!empty($slide)) {
				$nodeSlideId = $slide['id'];
			}

			// Question
			$nodeQuestionId = 0;
			$tb_content = new Smart_select('dmg_content', 'dgm');
			$tb_content->fieldSet('id');
			$tb_content->fieldSet('title');
			$tb_content->whereSet('id', $item['question_id']);
			$content = $tb_content->find();
			if (!empty($content)) {
				$tb_content = new Smart_select('dmg_content', 'dgm');
				$tb_content->fieldSet('id');
				$tb_content->fieldSet('title');
				$tb_content->whereSet('domain_id', $newDomainId);
				$tb_content->whereSet('title', $content['title']);
				$tb_content->whereSet('type_id', 2, 'and');
				$content = $tb_content->find();
			}
			if (!empty($content)) {
				$nodeQuestionId = $content['id'];
			}
		}

		$tbNode = new Smart_record('dmg_node', 'dgm');
		$tbNode->fieldSet('diagram_id', $newDiagramId);
		$tbNode->fieldSet('reference', $nodeReference);
		$tbNode->fieldSet('root', $nodeRoot);
		$tbNode->fieldSet('slide_id', $nodeSlideId);
		$tbNode->fieldSet('question_id', $nodeQuestionId);
		$newNodeId = $tbNode->insert();

		// add Links with parent
		$linkSequence = 0;
		$linkDescription = '';
		if ($nodeParentId != '') {
			$tbLink = new Smart_select('dmg_link', 'dgm');
			$tbLink->fieldSet('id');
			$tbLink->fieldSet('diagram_id');
			$tbLink->fieldSet('nodeFrom_id');
			$tbLink->fieldSet('nodeTo_id');
			$tbLink->fieldSet('sequence');
			$tbLink->fieldSet('description');
			$tbLink->whereSet('diagram_id',$diagramId);
			$tbLink->whereSet('nodeFrom_id',$nodeParentId, 'and');
			$tbLink->whereSet('nodeTo_id',$nodeId, 'and');
			$item = $tbLink->find();

			$linkSequence = $item['sequence'];
			$linkDescription = $item['description'];
		}
		else {
			if ($newNodeParentId != '') {
				$linkSequence = object_link::_maxSequence($diagramId, $newNodeParentId);
			}
		}

		if ($newNodeParentId != '') {
			$tbLink = new Smart_record('dmg_link', 'dgm');
			$tbLink->fieldSet('diagram_id', $newDiagramId);
			$tbLink->fieldSet('nodeFrom_id', $newNodeParentId);
			$tbLink->fieldSet('nodeTo_id', $newNodeId);
			$tbLink->fieldSet('sequence', $linkSequence);
			$tbLink->fieldSet('description', $linkDescription);
			$newLinkId = $tbLink->insert();
		}
		return $newNodeId;
	}
	
    public static function _copyChildren($nodeId, $domainId, $diagramId, $nodeParentId, $newDomainId, $newDiagramId, $newNodeParentId)
    {

		$newNodeId = self::_copy($nodeId, $domainId, $diagramId, $nodeParentId, $newDomainId, $newDiagramId, $newNodeParentId);
		
		// add child nodes
		$tbLink = new Smart_select('dmg_link', 'dgm');
		$tbLink->fieldSet('id');
		$tbLink->fieldSet('nodeFrom_id');
		$tbLink->fieldSet('nodeTo_id');
		$tbLink->whereSet('diagram_id',$diagramId);
		$tbLink->whereSet('nodeFrom_id',$nodeId, 'and');
		$tbLink->orderSet('nodeFrom_id');
		$tbLink->orderSet('sequence');
		$tbLink->orderSet('nodeTo_id');
		$list = $tbLink->findAll();
		for ($i=0; $i < count($list); $i++) {
			$item = $list[$i];
			$nodeToId = $item['nodeTo_id'];
			self::_copyChildren($nodeToId, $domainId, $diagramId, $nodeId, $newDomainId, $newDiagramId, $newNodeId);
		}
		return $newNodeId;
	}
	
    public static function _delete($nodeId)
    {
		$tbNode = new Smart_record('dmg_node', 'dgm');
		$tbNode->idSet($nodeId);
		$tbNode->delete();
	}

    public static function _deleteChildren($nodeId)
    {
		$tb_linkSelect = new Smart_select('dmg_link', 'dgm');
		$tb_linkSelect->fieldSet('id');
		$tb_linkSelect->fieldSet('nodeFrom_id');
		$tb_linkSelect->fieldSet('nodeTo_id');
		$tb_linkSelect->whereSet('nodeFrom_id', $nodeId);
		$listLink = $tb_linkSelect->findAll();
		for ($i=0; $i < count($listLink); $i++) {
			self::_deleteChildren($listLink[$i]['nodeTo_id']);
		}

		$tb_linkSelect->fieldSet('id');
		$tb_linkSelect->fieldSet('nodeFrom_id');
		$tb_linkSelect->fieldSet('nodeTo_id');
		$tb_linkSelect->whereSet('nodeTo_id', $nodeId);
		$listLink = $tb_linkSelect->findAll();
		for ($i=0; $i < count($listLink); $i++) {
			$linkId = $listLink[$i]['id'];
			object_link::_delete($linkId);
		}
		self::_delete($nodeId);
	}

    public function copyChildren($nodeId, $domainId, $diagramId, $nodeParentId, $newDomainId, $newDiagramId, $newNodeParentId)
    {
		$newNodeId = 0;
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('info', $this->dbnameGet() . ' - Object Insert for ' . $this->nameGet(),  __CLASS__, func_get_args(), 'arguments');

		$argArray = array();
		$db = PDO_extend::ws_open('dgm');
		try {
			$db->beginTransaction();
			$tbNode = new Smart_record('dmg_node', 'dgm');
			$argArray = $tbNode->findId('id', $nodeId);
			if ($argArray) {
				$newNodeId = self::_copyChildren($nodeId, $domainId, $diagramId, $nodeParentId, $newDomainId, $newDiagramId, $newNodeParentId);
			}
		}
		catch (exception $e) {
			$newNodeId = 0;
		}
		if ($newNodeId != 0) {
			$db->commit();
			$fct_return->returnSet($newNodeId);
			$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
			$this->Msg('copyChildren','OK', $argArray);
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
			$this->Msg('copyChildren','KO', $argArray);
		}
		return $fct_return;
	}
	
    public function deleteChildren($nodeId)
    {
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('info', $this->dbnameGet() . ' - Object deleteChildren for ' . $this->nameGet(),  __CLASS__, func_get_args(), 'arguments');
		
		$argArray = array();
		$db = PDO_extend::ws_open('dgm');
		try {
			$db->beginTransaction();
			$tbNode = new Smart_record('dmg_node', 'dgm');
			$argArray = $tbNode->findId('id', $nodeId);
			if ($argArray) {
				self::_deleteChildren($nodeId);
			}
			else {
				$nodeId = 0;
			}
		}
		catch (exception $e) {
			$nodeId = 0;
		}
		if ($nodeId != 0) {
			$db->commit();
			$fct_return->returnSet($nodeId);
			$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
			$this->Msg('deleteChildren','OK', $argArray);
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
			$this->Msg('deleteChildren','KO', $argArray);
		}
		return $fct_return;
	}
	
    public function insert($argArray, $dbName = '')
    {
		$list = array();
		if (!isset($argArray['diagram_id'])) {
			$diagramId = $this->valueGet('diagram_id');
		}
		else {
			$diagramId = $argArray['diagram_id'];
		}
		$tb_node = new Smart_select('dmg_node', 'dgm');
		$tb_node->fieldSet('id');
		$tb_node->fieldSet('reference');
		$tb_node->whereSet('diagram_id', $diagramId);
		$tb_node->orderSet('reference');
		$tb_node->orderSet('id');
		$list = $tb_node->findAll();
		if (count($list) > 0) {
			$reference = count($list);
			if ($reference <= $list[count($list) - 1]['reference']) {
				$reference = $list[count($list) - 1]['reference'] + 1;
			}
		}
		else {
			$reference = 1;
		}
		$argArray['reference'] = $reference;
		$fct_return = parent::insert($argArray);
		return $fct_return;
	}

}