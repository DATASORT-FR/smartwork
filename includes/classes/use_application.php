<?php
/**
* This file contains classes and function for the applications management.
*
* @package    administration_application
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
		$this->selectLabelFieldSet('label');

		/* Table structure for the object */
		$this->tableSet('adm_application');
		$this->joinTableSet('adm_apptype', 'code','adm_application','apptype');

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
		$this->fieldTableSet('dir');
		$this->fieldTableSet('copy_code');
		$this->fieldAttrSet('copy_code', 'string', array(
			'size' => 10,
			'case' => 'upper'));
		$this->fieldTableSet('copy_name');
		$this->fieldAttrSet('copy_name', 'string', array(
			'size' => 50,
			'case' => 'lower'));
		$this->fieldTableSet('copy_content');
		$this->fieldAttrSet('copy_content', 'boolean');
		$this->fieldTableSet('flag_admin');
		$this->fieldAttrSet('flag_admin', 'boolean');
		$this->fieldTableSet('date_export');
		$this->fieldTableSet('date_import');
		$this->fieldTableSet('label');
		$this->fieldAttrSet('label', 'string', array(
			'size' => 50));
		$this->fieldTableSet('description');
		$this->fieldAttrSet('description', 'text');
		$this->fieldTableSet('apptype');
		$this->fieldTableSet('version');
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
		$this->fieldTableSet('parameters');
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
	* update flag to export
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
    public function procExport($appId)
    {
		$traitFlag = true;
		$argArray = array();
		$appArray = array();

		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'Object Display for ' . $this->nameGet(), __CLASS__, func_get_args(), 'arguments');

		$tbAppCible = new Smart_select('adm_application');
		$tbAppCible->fieldAll();
		$tbAppCible->whereSet('id', $appId);
		$appArray = $tbAppCible->find();
		if (empty($appArray)) {
			$traitFlag = false;
		}

		try {
			$argArray['id'] = $appId;
			$argArray['flag_admin'] = 5;
			if ($traitFlag) {
				$this->update($argArray);
				$line = array();
				$line['id'] = $appId;
				$fct_return->returnSet($line);
				$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
				$this->Msg('exportPending','OK', $appArray);
			}
			else {
				$fct_return->errorSet();
				$ws->logSys('error', 'function KO for ' . $this->nameGet(), __CLASS__);
				$this->Msg('not-exist','KO', $argArray);
			}
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'function KO for ' . $this->nameGet() . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			$this->Msg('exportPending','KO', $appArray);
		}		
		return $fct_return;
	}

	/**
	* insert App to import
	*
	* @param string - archive name
	*        string - app target name
	*        string - app target code
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
    *         return : array of informations 
	*
    * @access public
	*/
    public function procImport($appSource, $appName, $appCode, $copyContent)
    {
		$traitFlag = false;
		$argArray = array();
		$appArray = array();
		$importArray = array();
	
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'Object Display for ' . $this->nameGet(), __CLASS__, func_get_args(), 'arguments');
		
		$importFile = SITE_ROOT_DIR . ARCHIVE_PATH . $appSource . '/application.json';
		if (file_exists($importFile)) {
			$importArray = jsonRead($importFile);
			if (isset($importArray['application'])) {
				$appArray = $importArray['application'];
				$traitFlag = true;
			}
		}
		if ($traitFlag) {
			if (!empty($appName)) {
				$appArray['name'] = $appName;
			}
			if (!empty($appCode)) {
				$appArray['code'] = $appCode;
			}
			$appArray['dir'] = $appArray['name'];
			if (file_exists(SITE_ROOT_DIR . APPS_PATH . $appArray['dir'])) {
				$traitFlag = false;
			}
		}

		if ($traitFlag) {
			$tbAppCible = new Smart_select('adm_application');
			$tbAppCible->fieldAll();
			$tbAppCible->whereSet('code', $appArray['code']);
			$tbAppCible->whereSet('name', $appArray['name']);
			$appCible = $tbAppCible->find();
			if (!empty($appCible)) {
				$traitFlag = false;
			}
		}
		
		try {
			if ($traitFlag) {
				$argArray['code'] = $appArray['code'];
				$argArray['name'] = $appArray['name'];
				$argArray['dir'] = $appArray['dir'];
				$argArray['copy_code'] = '';
				$argArray['copy_name'] = $appSource;
				$argArray['copy_content'] = $copyContent;
				$argArray['flag_admin'] = 7;
				$argArray['status_id'] = -1;
				$argArray['version'] = $appArray['version'];
				$argArray['label'] = $appArray['label'];
				$argArray['description'] = $appArray['description'];
				$argArray['apptype'] = $appArray['apptype'];
				$argArray['image'] = $appArray['image'];
				$argArray['public'] = $appArray['public'];
				$argArray['url_root'] = $appArray['url_root'];
				$argArray['canonical'] = $appArray['canonical'];
				$argArray['keywords'] = $appArray['keywords'];
				$argArray['parameters'] = $appArray['parameters'];
				$argArray['content_page'] = $appArray['content_page'];
				$argArray['forum_subject_page'] = $appArray['forum_subject_page'];
				$argArray['forum_topic_page'] = $appArray['forum_topic_page'];

				$tbAppCible = new Smart_record('adm_application');
				$tbAppCible->fieldAll($argArray);
				$appCibleId = $tbAppCible->insert();
				$line = array();
				$line['id'] = $appCibleId;
				$fct_return->returnSet($line);
				$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
				$this->Msg('importPending','OK', $appArray);
			}
			else {
				$fct_return->errorSet();
				$ws->logSys('error', 'function KO for ' . $this->nameGet(), __CLASS__);
				$this->Msg('exist','KO', $appArray);
			}
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'function KO for ' . $this->nameGet() . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			$this->Msg('importPending','KO', $appArray);
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
    public function procDelete($appId)
    {
		$traitFlag = true;
		$argArray = array();
		$appArray = array();
		
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'Object Display for ' . $this->nameGet(), __CLASS__, func_get_args(), 'arguments');

		$tbAppCible = new Smart_select('adm_application');
		$tbAppCible->fieldAll();
		$tbAppCible->whereSet('id', $appId);
		$appArray = $tbAppCible->find();
		if (empty($appArray)) {
			$traitFlag = false;
		}

		try {
			$argArray['id'] = $appId;
			$argArray['flag_admin'] = 6;
			$argArray['status_id'] = -1;
			if ($traitFlag) {
				$this->update($argArray);
				$line = array();
				$line['id'] = $appId;
				$fct_return->returnSet($line);
				$ws->logSys('debug', 'function OK for ' . $this->nameGet(), __CLASS__, $fct_return->returnGet(),'results');
				$this->Msg('deletePending','OK', $appArray);
			}
			else {
				$fct_return->errorSet();
				$ws->logSys('error', 'function KO for ' . $this->nameGet(), __CLASS__);
				$this->Msg('not-exist','KO', $argArray);
			}
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'function KO for ' . $this->nameGet() . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			$this->Msg('deletePending','KO', $appArray);
		}		
		return $fct_return;
	}

}