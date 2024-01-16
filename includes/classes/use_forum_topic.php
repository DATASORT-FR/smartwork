<?php
/**
* This file contains classes and function for the forum topics management.
*
* @package    forum_topic
* @version    1.0
* @date       29 December 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the forum topics management.
*/

if (!function_exists('aliasInit')) {
	function aliasInit($title) {
		$title = mb_substr($title, 0, 60);
		if ((strlen($title) > 58)and (preg_match("# #iusU", $title))) {
			$title = mb_substr($title, 0, mb_strrpos($title, ' '));
		}
		$title = preg_replace("#[\#]+#iusU", '',$title);
		$title = preg_replace("#[-.,\?\:\\\/\s']+#iusU", '-',$title);
		$title = preg_replace("#-+#ius", '-',$title);
		$title = LIB_content::cleanSpecial($title);
	
		return $title;
	}
}

class object_forum_topic extends BUS_object
{

	/**
	* constructor frm_topic
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
		$this->tableSet('frm_topic');
		$this->joinTableSet('frm_status', 'id','frm_topic','status_id');
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
		$this->fieldTableSet('subject_id');
		$this->fieldAttrSet('subject_id', 'integer');
		$this->fieldTableSet('subject_name','frm_subject','name');
		$this->fieldTableSet('subject_sequence','frm_subject','sequence');
		$this->fieldAttrSet('category_id','frm_subject','category_id');
		$this->fieldTableSet('category_name','frm_category','name');
		$this->fieldTableSet('category_sequence','frm_category','sequence');

		$this->fieldTableSet('label');
		$this->fieldAttrSet('label', 'string', array(
			'size' => 100));
		$this->fieldTableSet('alt');
		$this->fieldAttrSet('alt', 'string', array(
			'size' => 100));
		$this->fieldTableSet('alias');
		$this->fieldAttrSet('alias', 'string', array(
			'size' => 100));
		$this->fieldTableSet('content');
		$this->fieldAttrSet('content', 'text');
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
			
		$this->whereTableSet('label');
		$this->whereTableSet('content');

		$this->orderTableSet(0,'category_sequence');
		$this->orderTableSet(0,'subject_sequence');
		$this->orderTableSet(0,'date_creation');
		$this->orderTableSet(0,'label');
		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'category_sequence');
		$this->orderTableSet(1,'subject_sequence');
		$this->orderTableSet(1,'label');
		$this->orderTableSet(1,'id');
		$this->orderTableSet(2,'id');
	}

    public function insert($argArray, $dbName = '')
    {
		if (isset($argArray['subject_id'])) {
			$subjectId = $argArray['subject_id'];
		}
		else {
			$subjectId = $this->valueGet('subject_id');
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
		$alias = aliasInit($argArray['label']);
		if (!empty($subjectId)) {
			$tbSubject = new Smart_select('frm_subject', 'forum');
			$tbSubject->fieldSet('name');
			$tbSubject->fieldSet('label');
			$tbSubject->fieldSet('nb_topic');
			$tbSubject->fieldSet('nb_post');
			$tbSubject->whereSet('id',$subjectId);
			$return = $tbSubject->find();
			$nbTopic = $return['nb_topic'];
			$nbPost = $return['nb_post'];
			
			$tbSubject = new Smart_record('frm_subject', 'forum');
			$tbSubject->idSet($subjectId);
			$tbSubject->fieldSet('nb_topic', $nbTopic + 1);
			$tbSubject->fieldSet('date_last_topic', date('Y-m-d H:i:s'));
			$tbSubject->fieldSet('reference_last_topic', $reference);
			$tbSubject->fieldSet('author_last_topic', $author);
			$tbSubject->fieldSet('nb_post', $nbPost + 1);
			$tbSubject->fieldSet('date_last_post', date('Y-m-d H:i:s'));
			$tbSubject->fieldSet('reference_last_post', $reference);
			$tbSubject->fieldSet('author_last_post', $author);
			
			$tbSubject->update();
		}
		$argArray['nb_post'] = 1;
		$argArray['date_last_post'] = date('Y-m-d H:i:s');
		$argArray['reference_last_post'] = $reference;
		$argArray['author_last_post'] = $author;
		$argArray['alias'] = $alias;
		$fct_return = parent::insert($argArray, $dbName);
		return $fct_return;
	}
	
    public function delete($id, $dbName='')
	{

		$tbTopic = new Smart_select('frm_topic', 'forum');
		$tbTopic->fieldSet('subject_id');
		$tbTopic->fieldSet('nb_post');
		$tbTopic->whereSet('id',$id);
		$return = $tbTopic->find();

		$tbPost = new Smart_select('frm_post', 'forum');
		$tbPost->fieldSet('id');
		$tbPost->whereSet('topic_id',$id);
		$postDelete = $tbPost->findAll();
		foreach ($postDelete as $post) {
			$tbPost = new Smart_record('frm_post', 'forum');
			$tbPost->idSet($post['id']);
			$tbPost->delete();
		}

		if (isset($return['subject_id'])) {
			$subjectId = $return['subject_id'];
			$nbTopicPost = $return['nb_post'];
			
			$tbSubject = new Smart_select('frm_subject', 'forum');
			$tbSubject->fieldSet('nb_topic');
			$tbSubject->fieldSet('nb_post');
			$tbSubject->whereSet('id',$subjectId);
			$return = $tbSubject->find();
			$nbTopic = $return['nb_topic'];
			$nbPost = $return['nb_post'];
			
			$tbSubject = new Smart_record('frm_subject', 'forum');
			$tbSubject->idSet($subjectId);
			$tbSubject->fieldSet('nb_topic', $nbTopic - 1);
			$tbSubject->fieldSet('nb_post', $nbPost - $nbTopicPost);
			$tbSubject->update();
		}
		
		$fct_return = parent::delete($id, $dbName);
		return $fct_return;
	}
	
    public function findList($subjectId=0, $author='',$order='asc', $status=1)
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
			$tbTopic = new Smart_select('frm_topic', 'forum');
			$tbTopic->fieldSet('id');
			$tbTopic->fieldSet('date_creation');
			$tbTopic->fieldSet('date_update');
			$tbTopic->fieldSet('author');
			$tbTopic->fieldSet('moderator');
			$tbTopic->fieldSet('status_id');
			$tbTopic->fieldSet('subject_id');
			$tbTopic->fieldSet('label');
			$tbTopic->fieldSet('alt');
			$tbTopic->fieldSet('alias');
			$tbTopic->fieldSet('nb_post');
			$tbTopic->fieldSet('date_last_post');
			$tbTopic->fieldSet('reference_last_post');
			$tbTopic->fieldSet('author_last_post');

			switch ($order) {
				case 'asc':
					$tbTopic->orderSet('date_creation', 'ASC');					
				case 'desc':
					$tbTopic->orderSet('date_creation', 'DESC');					
				default:
					$tbTopic->orderSet('date_last_post', 'DESC');
			}
			
			if ($subjectId!=0) {
				$tbTopic->whereSet('subject_id', $subjectId, 'and');
			}
			$tbTopic->whereSet('status_id', $status, 'and', '>=');
			if (!empty($author)) {
				$tbTopic->whereSet('author', $author, 'and');
			}
			
			$returnList = $tbTopic->findAll();
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
