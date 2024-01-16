<?php
/**
* This file contains classes and function for the forum subjects management.
*
* @package    forum_subject
* @version    1.0
* @date       29 December 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the forum subjects management.
*/

class object_forum_subject extends BUS_object
{

	/**
	* constructor frm_subject
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->dbnameSet('forum');
		$this->idSet('id');
		$this->creationDateSet('date_creation');
		$this->updateDateSet('date_update');
		$this->selectLabelFieldSet('label');
		
		/* Table structure for the object */
		$this->tableSet('frm_subject');
		$this->joinTableSet('frm_category', 'id','frm_subject','category_id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('date_creation');
		$this->fieldAttrSet('date_creation', 'date', array(
			'auto' => true));
		$this->fieldTableSet('date_update');
		$this->fieldAttrSet('date_update', 'date', array(
			'auto' => true));
		$this->fieldTableSet('name');
		$this->fieldAttrSet('name', 'string', array(
			'size' => 30));
		$this->fieldTableSet('status_id');
		$this->fieldAttrSet('status_id', 'boolean');
		$this->fieldFctSet('status','labelStatus','status_id');
		$this->fieldTableSet('category_id');
		$this->fieldAttrSet('category_id', 'integer');
		$this->fieldTableSet('application','frm_category','application');
		$this->fieldTableSet('category_name','frm_category','name');
		$this->fieldTableSet('category_sequence','frm_category','sequence');
		$this->fieldTableSet('sequence');
		$this->fieldAttrSet('sequence', 'integer');
		$this->fieldTableSet('vignette');
		$this->fieldTableSet('label');
		$this->fieldAttrSet('label', 'string', array(
			'size' => 100));
		$this->fieldTableSet('alt');
		$this->fieldAttrSet('alt', 'string', array(
			'size' => 100));
		$this->fieldTableSet('alias');
		$this->fieldAttrSet('alias', 'string', array(
			'size' => 100));
		$this->fieldTableSet('class');
		$this->fieldAttrSet('class', 'string', array(
			'size' => 20));
		$this->fieldTableSet('icon');
		$this->fieldAttrSet('icon', 'string', array(
			'size' => 20));
		$this->fieldTableSet('image');
		$this->fieldAttrSet('image', 'text');
		$this->fieldTableSet('description');
		$this->fieldAttrSet('description', 'text');
		$this->fieldTableSet('keywords');
		$this->fieldAttrSet('keywords', 'text');
		$this->fieldTableSet('content');
		$this->fieldAttrSet('content', 'text');
		$this->fieldTableSet('nb_topic');
		$this->fieldAttrSet('nb_topic', 'integer');
		$this->fieldTableSet('date_last_topic');
		$this->fieldAttrSet('date_last_topic', 'date');
		$this->fieldTableSet('reference_last_topic');
		$this->fieldAttrSet('reference_last_topic', 'string', array(
			'size' => 20));
		$this->fieldTableSet('author_last_topic');
		$this->fieldAttrSet('author_last_topic', 'string', array(
			'size' => 30));
		$this->fieldTableSet('nb_post');
		$this->fieldAttrSet('nb_post', 'integer');
		$this->fieldTableSet('date_last_post');
		$this->fieldAttrSet('date_last_post', 'date');
		$this->fieldTableSet('reference_last_post');
		$this->fieldAttrSet('reference_last_post', 'string', array(
			'size' => 20));
		$this->fieldTableSet('author_last_post');
		$this->fieldAttrSet('author_last_post', 'string', array(
			'size' => 30));
			
		$this->whereTableSet('name');
		$this->whereTableSet('label');
		$this->whereTableSet('content');

		$this->orderTableSet(0,'category_sequence');
		$this->orderTableSet(0,'sequence');
		$this->orderTableSet(0,'name');
		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'category_name');
		$this->orderTableSet(1,'name');
		$this->orderTableSet(1,'id');
		$this->orderTableSet(2,'id');	
	}

    public function maxSequence($categoryId='')
    {
		$tbSubject = new Smart_select('frm_subject', 'forum');
		$tbSubject->fieldSet('id');
		$tbSubject->fieldSet('name');
		$tbSubject->fieldSet('label');
		$tbSubject->fieldSet('sequence');
		if (!empty($categoryId)) {
			$tbSubject->whereSet('category_id',$categoryId);
		}
		$tbSubject->orderSet('sequence', 'DESC');
		$returnList = $tbSubject->find();
		$sequence = $returnList['sequence'];
		return $sequence;
	}

    public function insert($argArray, $dbName='')
    {
		$categoryId = '';
		if(isset($argArray['category_id'])) {
			$categoryId = $argArray['category_id'];
		}
		$sequence = $this->maxSequence($categoryId);
		$this->valueSet('sequence',$sequence + 1);
		$fct_return = parent::insert($argArray, $dbName);
		return $fct_return;
	}
	
    public function organizeSequence($categoryId)
    {
		$tbSubject = new Smart_select('frm_subject', 'forum');
		$tbSubject->fieldSet('id');
		$tbSubject->fieldSet('sequence');
		$tbSubject->whereSet('category_id',$categoryId);
		$tbSubject->orderSet('sequence');
		$returnList = $tbSubject->findAll();

		$tbSubjectItem = new Smart_record('frm_subject', 'forum');
		$sequence = 1;
		for ($i=0; $i < count($returnList); $i++) {
			$tbSubjectItem->idSet($returnList[$i]['id']);
			$tbSubjectItem->fieldSet('sequence', $sequence);
			$tbSubjectItem->update();			
			$sequence = $sequence + 1;
		}
	}

    public function levelUp($id)
    {
		$tbSubject = new Smart_select('frm_subject', 'forum');
		$tbSubject->fieldSet('category_id');
		$tbSubject->fieldSet('name');
		$tbSubject->fieldSet('label');
		$tbSubject->fieldSet('sequence');
		$tbSubject->whereSet('id',$id);
		$return = $tbSubject->find();
		
		$categoryId = $return['category_id'];
		$sequence = $return['sequence'];
		$sequence = $sequence - 1.5;
		$tbSubject = new Smart_record('frm_subject', 'forum');
		$tbSubject->idSet($id);
		$tbSubject->fieldSet('sequence', $sequence);
		$tbSubject->update();
		$this->organizeSequence($categoryId);
	}
	
    public function delete($id, $dbName='')
	{
		$tbTopic = new Smart_select('frm_topic', 'forum');
		$tbTopic->fieldSet('id');
		$tbTopic->whereSet('subject_id',$id);
		$topicDelete = $tbTopic->findAll();
		foreach ($topicDelete as $topic) {
			$tbPost = new Smart_select('frm_post', 'forum');
			$tbPost->fieldSet('id');
			$tbPost->whereSet('topic_id',$topic['id']);
			$postDelete = $tbPost->findAll();
			foreach ($postDelete as $post) {
				$tbPost = new Smart_record('frm_post', 'forum');
				$tbPost->idSet($post['id']);
				$tbPost->delete();
			}
			$tbTopic = new Smart_record('frm_topic', 'forum');
			$tbTopic->idSet($topic['id']);
			$tbTopic->delete();
		}
		
		$fct_return = parent::delete($id, $dbName);
		return $fct_return;
	}
	
    public function findList($categoryId=0, $application='', $order='date', $status=1)
    {
		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function', __CLASS__, func_get_args(), 'arguments');
		try {
			/**
			* find page item by using smartorm
			*/
			$tbSubject = new Smart_select('frm_subject', 'forum');
			$tbCategory=$tbSubject->joinSet('category_id', 'frm_category', 'id');
			
			$tbSubject->fieldSet('id');
			$tbSubject->fieldSet('date_creation');
			$tbSubject->fieldSet('date_update');
			$tbSubject->fieldSet('status_id');
			$tbSubject->fieldSet('category_id');
			$tbCategory->fieldSet('application');
			$tbCategory->fieldSet('name', 'category_name');
			$tbCategory->fieldSet('sequence', 'category_sequence');
			$tbSubject->fieldSet('sequence');
			$tbSubject->fieldSet('vignette');
			$tbSubject->fieldSet('name');
			$tbSubject->fieldSet('label');
			$tbSubject->fieldSet('alt');
			$tbSubject->fieldSet('alias');
			$tbSubject->fieldSet('nb_topic');
			$tbSubject->fieldSet('date_last_topic');
			$tbSubject->fieldSet('reference_last_topic');
			$tbSubject->fieldSet('author_last_topic');
			$tbSubject->fieldSet('nb_post');
			$tbSubject->fieldSet('date_last_post');
			$tbSubject->fieldSet('reference_last_post');
			$tbSubject->fieldSet('author_last_post');

			$tbCategory->orderSet('sequence');
			$tbSubject->orderSet('sequence');
			
			if ($categoryId!=0) {
				$tbSubject->whereSet('category_id', $categoryId, 'and');
			}
			if (!empty($application)) {
				$tbCategory->whereSet('application', $application, 'and');
			}
			$tbSubject->whereSet('status_id', $status, 'and', '>=');
			
			$returnList = $tbSubject->findAll();
			$fct_return->returnSet($returnList);
			$ws->logSys('debug', 'Display  List Topic ok', __CLASS__, $fct_return->returnGet(),'results');
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