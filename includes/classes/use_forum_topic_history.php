<?php
/**
* This file contains classes and function for the forum topics management.
*
* @package    forum_administration
* @version    1.0
* @date       29 December 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

class object_forum_topic_history extends BUS_object
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
		
		/* Table structure for the object */
		$this->tableSet('frm_topic_history');
		$this->joinTableSet('frm_topic', 'id','frm_topic_history','topic_id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('date_read');
		$this->fieldAttrSet('date_read', 'date', array(
			'auto' => true));
		$this->fieldAttrSet('reference', 'string', array(
			'size' => 20));
		$this->fieldTableSet('topic_id');
		$this->fieldAttrSet('topic_id', 'integer');
		$this->fieldTableSet('label','frm_topic','label');
			
		$this->whereTableSet('label');

		$this->orderTableSet(0,'date_read');
		$this->orderTableSet(0,'reference');
		$this->orderTableSet(0,'topic_id');
		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'reference');
		$this->orderTableSet(1,'topic_id');
		$this->orderTableSet(1,'date_read');
		$this->orderTableSet(1,'id');
		$this->orderTableSet(2,'id');
	}
	
    public function add($reference='', $topicId=0)
    {
		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function', __CLASS__, func_get_args(), 'arguments');
		try {
			$id = 0;
			if ((!empty($reference)) and ($topicId != 0)) {
				$tbTopicHistory = new Smart_select('frm_topic_history', 'forum');
				$tbTopicHistory->fieldSet('id');
				$tbTopicHistory->fieldSet('date_read');
				$tbTopicHistory->whereSet('reference',$reference);
				$tbTopicHistory->whereSet('topic_id',$topicId, 'and');
				$return = $tbTopicHistory->find();
				if (isset($return['id'])) {
					$id = $return['id'];
					$tbTopicHistory = new Smart_record('frm_topic_history', 'forum');
					$tbTopicHistory->idSet($id);
					$tbTopicHistory->fieldSet('date_read', date('Y-m-d H:i:s'));
					$tbTopicHistory->update();
				}
				else {
					$tbTopicHistory = new Smart_record('frm_topic_history', 'forum');
					$tbTopicHistory->fieldSet('date_read', date('Y-m-d H:i:s'));
					$tbTopicHistory->fieldSet('reference', $reference);
					$tbTopicHistory->fieldSet('topic_id', $topicId);
					$id = $tbTopicHistory->insert();
				}
			}
			$fct_return->returnSet($id);
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
	
    public function findDate($reference='', $topicId=0)
    {
		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function', __CLASS__, func_get_args(), 'arguments');

		$dateRead = date('Y-m-d H:i:s', strtotime("2001-01-01 00:00:0"));
		try {
			$tbTopicHistory = new Smart_select('frm_topic_history', 'forum');
			$tbTopicHistory->fieldSet('id');
			$tbTopicHistory->fieldSet('date_read');
			$tbTopicHistory->whereSet('reference',$reference);
			$tbTopicHistory->whereSet('topic_id',$topicId, 'and');
			$return = $tbTopicHistory->find();
			if (isset($return['id'])) {
				$dateRead = $return['date_read'];
			}
			$fct_return->returnSet($dateRead);
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
