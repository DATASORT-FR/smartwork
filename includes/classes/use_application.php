<?php
/**
* This file contains classes and function for the applications management.
*
* @package    use_application
* @subpackage business_process
* @version    1.2
* @date       15 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

if (!function_exists('labelFlag')) {
	function labelFlag($id) {
		$ws = workspace::ws_open();
	
		$label = '';
		switch($id) {
			case 1 :
				$label = $ws->getConfigVars("Lbl_flag_1");
				break;
			default :
				$label = $ws->getConfigVars("Lbl_flag_0");
		}
		return $label;
	}
}

/**
* Classes for the applications management.
*/

class object_application extends BUS_object
{

	/**
	* constructor adm_application
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
//		$this->idSet('id');
//		$this->selectLabelFieldSet('title');
		$this->selectLabelFieldSet('label');

		/* Table structure for the object */
		$this->tableSet('adm_application');
		$this->joinTableSet('adm_apptype', 'id','adm_application','apptype_id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('code');
		$this->fieldAttrSet('code', 'string', array(
			'required' => true,
			'size' => 10,
			'case' => 'upper'));
		$this->fieldTableSet('status_id');
		$this->fieldAttrSet('status_id', 'boolean');
		$this->fieldFctSet('status','labelStatus','status_id');
		$this->fieldTableSet('name');
		$this->fieldAttrSet('name', 'string', array(
			'required' => true,
			'size' => 50,
			'case' => 'lower'));
		$this->fieldTableSet('copy_code');
		$this->fieldAttrSet('copy_code', 'string', array(
			'size' => 10,
			'case' => 'upper'));
		$this->fieldTableSet('copy_name');
		$this->fieldAttrSet('copy_name', 'string', array(
			'size' => 50,
			'case' => 'lower'));
		$this->fieldTableSet('flag_archive');
		$this->fieldAttrSet('flag_archive', 'boolean');
		$this->fieldTableSet('date_archive');
		$this->fieldTableSet('label');
		$this->fieldAttrSet('label', 'string', array(
			'size' => 50));
		$this->fieldTableSet('description');
		$this->fieldAttrSet('description', 'text');
		$this->fieldTableSet('apptype_id');
		$this->fieldTableSet('apptype', 'adm_apptype', 'code');
		$this->fieldTableSet('keywords');
		$this->fieldAttrSet('keywords', 'text');
		$this->fieldTableSet('canonical');
		$this->fieldAttrSet('canonical', 'string', array(
			'size' => 100));
		$this->fieldTableSet('url_root');
		$this->fieldAttrSet('url_root', 'string', array(
			'size' => 160));
		$this->fieldTableSet('content_page');
		$this->fieldAttrSet('content_page', 'string', array(
			'size' => 50));
		$this->fieldTableSet('forum_subject_page');
		$this->fieldAttrSet('forum_subject_page', 'string', array(
			'size' => 50));
		$this->fieldTableSet('forum_topic_page');
		$this->fieldAttrSet('forum_topic_page', 'string', array(
			'size' => 50));
		$this->fieldTableSet('public');
		$this->fieldAttrSet('public', 'boolean');
		$this->fieldFctSet('public_label', 'labelFlag', 'public');
		$this->fieldTableSet('image');
		$this->fieldAttrSet('image', 'string', array(
			'size' => 50));
		$this->fieldCompoSet('title', 'append', 'code');
		$this->fieldCompoSet('title', 'append', ' - ');
		$this->fieldCompoSet('title', 'append', 'label');
			
		$this->whereTableSet('code');
		$this->whereTableSet('label');
		$this->whereTableSet('description');

		$this->orderTableSet(0,'code');
		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'label');
		$this->orderTableSet(1,'id');
		$this->orderTableSet(2,'id');

	}

	/**
	* update status to archive
	*
	* @param integer - object identifier to update
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
    *         return : array of informations 
	*
    * @access public
	*/
    public function procArchive($id)
    {
		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'Object Display for ' . $this->nameGet(), __CLASS__, func_get_args(), 'arguments');

		try {
			/**
			* function processing by using smartorm
			*/
			$argArray = array();
			$argArray['id'] = $id;
			$argArray['flag_archive'] = 1;
			$this->update($argArray);
			$line = array();
			$line['id'] = $id;
			$fct_return->returnSet($line);
			$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
			$this->Msg('archivePending','OK', $argArray);
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'function KO for ' . $this->nameGet() . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			$this->Msg('archivePending','KO', $argArray);
		}		
		return $fct_return;
	}

	/**
	* update status to delete
	*
	* @param integer - object identifier to update
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
    *         return : array of informations 
	*
    * @access public
	*/
    public function procDelete($id)
    {
		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'Object Display for ' . $this->nameGet(), __CLASS__, func_get_args(), 'arguments');

		try {
			/**
			* function processing by using smartorm
			*/
			$argArray = array();
			$argArray['id'] = $id;
			$argArray['status_id'] = -1;
			$this->update($argArray);
			$line = array();
			$line['id'] = $id;
			$fct_return->returnSet($line);
			$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
			$this->Msg('deletePending','OK', $argArray);
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'function KO for ' . $this->nameGet() . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			$this->Msg('deletePending','KO', $argArray);
		}		
		return $fct_return;
	}

}