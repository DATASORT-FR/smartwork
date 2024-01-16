<?php
/**
* This file contains classes and function for the forum posts management.
*
* @package    forum_post
* @version    1.0
* @date       29 December 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the forum posts management.
*/

class object_forum_post extends BUS_object
{

	/**
	* constructor frm_post
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
		$this->tableSet('frm_post');
		$this->joinTableSet('frm_status', 'id','frm_post','status_id');
		$this->joinTableSet('frm_topic', 'id','frm_post','topic_id');
		$this->joinTableSet('frm_subject', 'id','frm_topic','subject_id');
		$this->joinTableSet('frm_category', 'id','frm_subject','category_id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('date_creation');
		$this->fieldAttrSet('date_creation', 'date', array(
			'auto' => true));
		$this->fieldTableSet('date_update');
		$this->fieldAttrSet('date_update', 'date', array(
			'auto' => true));
		$this->fieldTableSet('reference');
		$this->fieldAttrSet('reference', 'string', array(
			'size' => 20));
		$this->fieldTableSet('author');
		$this->fieldAttrSet('author', 'string', array(
			'size' => 30));
		$this->fieldTableSet('ref_moderator');
		$this->fieldAttrSet('ref_moderator', 'string', array(
			'size' => 20));
		$this->fieldTableSet('moderator');
		$this->fieldAttrSet('moderator', 'string', array(
			'size' => 30));
		$this->fieldTableSet('status_id');
		$this->fieldAttrSet('status_id', 'boolean');
		$this->fieldTableSet('status','frm_status','label');
		$this->fieldTableSet('topic_id');
		$this->fieldAttrSet('topic_id', 'integer');
		$this->fieldTableSet('topic_label','frm_topic','label');
		$this->fieldAttrSet('subject_id','frm_topic','subject_id');
		$this->fieldTableSet('subject_name','frm_subject','name');
		$this->fieldTableSet('subject_sequence','frm_subject','sequence');
		$this->fieldAttrSet('category_id','frm_subject','category_id');
		$this->fieldTableSet('category_name','frm_category','name');
		$this->fieldTableSet('category_sequence','frm_category','sequence');

		$this->fieldFctSet('label', 'labelSize', 'content');
		$this->fieldTableSet('content');
		$this->fieldAttrSet('content', 'text');

		$this->whereTableSet('content');

		$this->orderTableSet(0,'topic_id');
		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'topic_id');
		$this->orderTableSet(1,'date_creation');
		$this->orderTableSet(1,'id');
		$this->orderTableSet(2,'topic_id');
		$this->orderTableSet(2,'date_creation');
		$this->orderTableSet(2,'id');
		$this->orderTableSet(3,'id');
	}

    public function insert($argArray, $dbName='')
    {
		if (isset($argArray['topic_id'])) {
			$topicId = $argArray['topic_id'];
		}
		else {
			$topicId = $this->valueGet('topic_id');
		}
		if (isset($argArray['reference'])) {
			$reference = $argArray['reference'];
		}
		else {
			$reference = $this->valueGet('reference');
		}
		if (isset($argArray['author'])) {
			$author = $argArray['author'];
		}
		else {
			$author = $this->valueGet('author');
		}
		if (!empty($topicId)) {
			$tbTopic = new Smart_select('frm_topic', 'forum');
			$tbTopic->fieldSet('label');
			$tbTopic->fieldSet('subject_id');
			$tbTopic->fieldSet('nb_post');
			$tbTopic->whereSet('id',$topicId);
			$return = $tbTopic->find();
			$nbPost = $return['nb_post'];
			
			$tbTopic = new Smart_record('frm_topic', 'forum');
			$tbTopic->idSet($topicId);
			$tbTopic->fieldSet('nb_post', $nbPost + 1);
			$tbTopic->fieldSet('date_last_post', date('Y-m-d H:i:s'));
			$tbTopic->fieldSet('reference_last_post', $reference);
			$tbTopic->fieldSet('author_last_post', $author);
			$tbTopic->update();

			if (isset($return['subject_id'])) {
				$subjectId = $return['subject_id'];
				$tbSubject = new Smart_select('frm_subject', 'forum');
				$tbSubject->fieldSet('name');
				$tbSubject->fieldSet('label');
				$tbSubject->fieldSet('nb_topic');
				$tbSubject->fieldSet('nb_post');
				$tbSubject->whereSet('id',$subjectId);
				$return = $tbSubject->find();
				$nbPost = $return['nb_post'];
			
				$tbSubject = new Smart_record('frm_subject', 'forum');
				$tbSubject->idSet($subjectId);
				$tbSubject->fieldSet('nb_post', $nbPost + 1);
				$tbSubject->fieldSet('date_last_post', date('Y-m-d H:i:s'));
				$tbSubject->fieldSet('reference_last_post', $reference);
				$tbSubject->fieldSet('author_last_post', $author);
				$tbSubject->update();
			}
		}
		$fct_return = parent::insert($argArray, $dbName);
		return $fct_return;
	}
	
    public function delete($id, $dbName='')
	{
		$tbPost = new Smart_select('frm_post', 'forum');
		$tbPost->fieldSet('topic_id');
		$tbPost->whereSet('id',$id);
		$return = $tbPost->find();

		if (isset($return['topic_id'])) {
			$topicId = $return['topic_id'];
			$tbTopic = new Smart_select('frm_topic', 'forum');
			$tbTopic->fieldSet('label');
			$tbTopic->fieldSet('subject_id');
			$tbTopic->fieldSet('nb_post');
			$tbTopic->whereSet('id',$topicId);
			$return = $tbTopic->find();
			$nbPost = $return['nb_post'];
			
			$tbTopic = new Smart_record('frm_topic', 'forum');
			$tbTopic->idSet($topicId);
			$tbTopic->fieldSet('nb_post', $nbPost - 1);
			$tbTopic->update();

			if (isset($return['subject_id'])) {
				$subjectId = $return['subject_id'];
				$tbSubject = new Smart_select('frm_subject', 'forum');
				$tbSubject->fieldSet('nb_post');
				$tbSubject->whereSet('id',$subjectId);
				$return = $tbSubject->find();
				$nbPost = $return['nb_post'];
			
				$tbSubject = new Smart_record('frm_subject', 'forum');
				$tbSubject->idSet($subjectId);
				$tbSubject->fieldSet('nb_post', $nbPost - 1);
				$tbSubject->update();
			}
		}
		
		$fct_return = parent::delete($id, $dbName);
		return $fct_return;
	}
	
    public function findList($topicId=0, $author='',$order='asc', $status=1)
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
			$tbPost = new Smart_select('frm_post', 'forum');
			$tbPost->fieldSet('id');
			$tbPost->fieldSet('date_creation');
			$tbPost->fieldSet('date_update');
			$tbPost->fieldSet('author');
			$tbPost->fieldSet('moderator');
			$tbPost->fieldSet('status_id');
			$tbPost->fieldSet('topic_id');
			$tbPost->fieldSet('content');

			switch ($order) {
				case 'desc':
					$tbPost->orderSet('date_creation', 'DESC');
				default:
					$tbPost->orderSet('date_creation', 'ASC');
			}
			
			if ($topicId!=0) {
				$tbPost->whereSet('topic_id', $topicId, 'and');
			}
			$tbPost->whereSet('status_id', $status, 'and', '>=');
			if (!empty($author)) {
				$tbPost->whereSet('author', $author, 'and');
			}
			
			$returnList = $tbPost->findAll();
			$fct_return->returnSet($returnList);
			$ws->logSys('debug', 'Display List Post ok', __CLASS__, $fct_return->returnGet(),'results');
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