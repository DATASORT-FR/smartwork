<?php
/**
* This file contains classes and functions for the content management.
*
* @package   content_administration
* @version   1.0
* @date      17 May 2017
* @author    Alain VANDEPUTTE
* @copyright datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the users management.
*/
class object_content extends BUS_object
{

	/**
	* constructor object_content
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet('Page');
		$this->dbnameSet('content');
		$this->idSet('id');
		$this->creationDateSet('date_creation');
		$this->updateDateSet('date_update');
		$this->changeDateSet('date_status', 'status_id');
		$this->selectLabelFieldSet('name');

		/* Table structure for the object */
		$this->tableSet('tb_content','cms_content');
		$this->tableSet('tb_status','cms_status');
		$this->tableSet('tb_category','cms_category');
		$this->tableSet('tb_application','adm_application');
		
		$this->joinTableSet('tb_status', 'id','tb_content','status_id');
		$this->joinTableSet('tb_category', 'id','tb_content','category_id');
		$this->joinTableSet('tb_application', 'id','tb_content','application_id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('date_creation');
		$this->fieldAttrSet('date_creation', 'date', array(
			'auto' => true));
		$this->fieldTableSet('date_update');
		$this->fieldAttrSet('date_update', 'date', array(
			'auto' => true));
		$this->fieldTableSet('application_id');
		$this->fieldTableSet('application','tb_application','name');
		$this->fieldTableSet('code');
		$this->fieldAttrSet('code', 'string', array(
			'size' => 10,
			'case' => 'upper'));
		$this->fieldTableSet('status_id');
		$this->fieldAttrSet('status_id', 'boolean');
		$this->fieldTableSet('status', 'tb_status', 'label');
		$this->fieldTableSet('date_status');
		$this->fieldAttrSet('date_status', 'date');
		$this->fieldTableSet('category_id');
		$this->fieldAttrSet('category_id', 'integer');
		$this->fieldTableSet('category', 'tb_category', 'code');
		$this->fieldTableSet('author_id');
		$this->fieldAttrSet('author_id', 'integer');
		$this->fieldTableSet('date_publication');
		$this->fieldAttrSet('date_publication', 'date');
		$this->fieldTableSet('title');
		$this->fieldAttrSet('title', 'string', array(
			'size' => 150));
		$this->fieldTableSet('title_page');
		$this->fieldAttrSet('title_page', 'string', array(
			'size' => 150));
		$this->fieldTableSet('param1');
		$this->fieldAttrSet('param1', 'string', array(
			'size' => 100));
		$this->fieldTableSet('param2');
		$this->fieldAttrSet('param2', 'string', array(
			'size' => 100));
		$this->fieldTableSet('alt');
		$this->fieldAttrSet('alt', 'string', array(
			'size' => 100));
		$this->fieldTableSet('alias');
		$this->fieldAttrSet('alias', 'string', array(
			'size' => 100));
		$this->fieldTableSet('style');
		$this->fieldAttrSet('style', 'string', array(
			'size' => 20));
		$this->fieldTableSet('class');
		$this->fieldAttrSet('class', 'string', array(
			'size' => 20));
		$this->fieldTableSet('icon');
		$this->fieldAttrSet('icon', 'string', array(
			'size' => 20));
		$this->fieldTableSet('path');
		$this->fieldAttrSet('path', 'string', array(
			'size' => 60));
		$this->fieldTableSet('content_page');
		$this->fieldAttrSet('content_page', 'string', array(
			'size' => 100));
		$this->fieldTableSet('image');
		$this->fieldTableSet('description');
		$this->fieldTableSet('keywords');
		$this->fieldTableSet('intro');
		$this->fieldTableSet('content');

		$this->fieldTableSet('image1');
		$this->fieldTableSet('image2');
		$this->fieldTableSet('image3');
		$this->fieldTableSet('image4');
		$this->fieldTableSet('image5');
		$this->fieldTableSet('image6');

		$this->fieldTableSet('block1');
		$this->fieldTableSet('block2');
		$this->fieldTableSet('block3');
		$this->fieldTableSet('block4');
		$this->fieldTableSet('block5');
		$this->fieldTableSet('block6');
		
		$this->whereTableSet('title');
		$this->whereTableSet('intro');

		$this->orderTableSet(0,'application_id');
		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'application_id');
		$this->orderTableSet(1,'code');
		$this->orderTableSet(1,'id');
		$this->orderTableSet(2,'application_id');
		$this->orderTableSet(2,'title');
		$this->orderTableSet(2,'id');
		$this->orderTableSet(3,'id');

	}

    public function ctrl($application, $contentCode)
    {
		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function', __CLASS__, func_get_args(), 'arguments');

		try {
			$applicationId = 0;
			if (!empty($application)) {
				$tb_application = new Smart_select('adm_application');
				$tb_application->fieldSet('id');
				$tb_application->fieldSet('code');
				$tb_application->whereSet('code', $application);
				$return = $tb_application->find();
				if (!empty($return)) {
					$applicationId = $return['id'];
				}
			}
			
			/**
			* find page item by using smartorm
			*/
			$connect_id = $ws->connected_id();
			$tb_content = new Smart_select('cms_content', 'content');
			$tb_content->fieldSet('id');
			if ((int)$contentCode > 0) {
				$tb_content->whereSet('id', $contentCode);				
			}
			else {
				$tb_content->whereSet('code', $contentCode);
			}

			if (!empty($application)) {
				$tb_content->whereSet('application_id', $applicationId, 'and');
			}

			$tb_status=$tb_content->joinSet('status_id', 'cms_status', 'id');
			$tb_status->fieldSet('label', 'status');

			if($tb_content->find()) {
				$return = true;
			}
			else {
				$return = false;				
			}
			$fct_return->returnSet($return);
		}
		catch (exception $e) {
			$fct_return->errorSet();
			$ws->logSys('error', $e->getCode() . " : " . $e->getMessage(), __CLASS__);
		}
		return $fct_return;
	}
	
    public function find($application, $contentCode)
    {
		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function', __CLASS__, func_get_args(), 'arguments');

		try {
			$applicationId = 0;
			if (!empty($application)) {
				$tb_application = new Smart_select('adm_application');
				$tb_application->fieldSet('id');
				$tb_application->fieldSet('code');
				$tb_application->whereSet('code', $application);
				$return = $tb_application->find();
				if (!empty($return)) {
					$applicationId = $return['id'];
				}
			}

			/**
			* find page item by using smartorm
			*/
			$tb_content = new Smart_select('cms_content', 'content');
			$tb_content->fieldSet('id');
			$tb_content->fieldSet('date_creation');
			$tb_content->fieldSet('date_update');
			$tb_content->fieldSet('application_id');
			$tb_content->fieldSet('code');
			$tb_content->fieldSet('status_id');
			$tb_content->fieldSet('date_status');
			$tb_content->fieldSet('category_id');
			$tb_content->fieldSet('author_id');
			$tb_content->fieldSet('date_publication');
			$tb_content->fieldSet('title');
			$tb_content->fieldSet('title_page');
			$tb_content->fieldSet('param1');
			$tb_content->fieldSet('param2');
			$tb_content->fieldSet('alt');
			$tb_content->fieldSet('alias');
			$tb_content->fieldSet('style');
			$tb_content->fieldSet('class');
			$tb_content->fieldSet('icon');
			$tb_content->fieldSet('path');
			$tb_content->fieldSet('content_page');
			$tb_content->fieldSet('image');
			$tb_content->fieldSet('description');
			$tb_content->fieldSet('keywords');
			$tb_content->fieldSet('intro');
			$tb_content->fieldSet('content');

			$tb_content->fieldSet('image1');
			$tb_content->fieldSet('image2');
			$tb_content->fieldSet('image3');
			$tb_content->fieldSet('image4');
			$tb_content->fieldSet('image5');
			$tb_content->fieldSet('image6');

			$tb_content->fieldSet('block1');
			$tb_content->fieldSet('block2');
			$tb_content->fieldSet('block3');
			$tb_content->fieldSet('block4');
			$tb_content->fieldSet('block5');
			$tb_content->fieldSet('block6');
			
			if ((int)$contentCode > 0) {
				$tb_content->whereSet('id', $contentCode);				
			}
			else {
				$tb_content->whereSet('code', $contentCode);
			}
			
			if (!empty($application)) {
				$tb_content->whereSet('application_id', $applicationId, 'and');
			}

			$tb_status=$tb_content->joinSet('status_id', 'cms_status', 'id');
			$tb_status->fieldSet('label', 'status');

			$tb_category=$tb_content->joinSet('category_id', 'cms_category', 'id');
			$tb_category->fieldSet('code', 'category');
			
			$return = $tb_content->find();	
			if (!empty($return)) {
				$fct_return->returnSet($return);
				$ws->logSys('debug', 'Display content ok', __CLASS__, $fct_return->returnGet(),'results');
			}
			else {
				$fct_return->errorSet();
				$ws->logSys('error', 'Record not found for ' . $contentCode, __CLASS__);
			}
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
	
    public function findList($application, $contentCode, $categoryCode='',$order='date')
    {
		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function', __CLASS__, func_get_args(), 'arguments');
		try {
			$applicationId = 0;
			if (!empty($application)) {
				$tb_application = new Smart_select('adm_application');
				$tb_application->fieldSet('id');
				$tb_application->fieldSet('code');
				$tb_application->whereSet('code', $application);
				$return = $tb_application->find();
				if (!empty($return)) {
					$applicationId = $return['id'];
				}
			}
			/**
			* find page item by using smartorm
			*/
			$tb_content = new Smart_select('cms_content', 'content');
			$tb_content->fieldSet('id');
			$tb_content->fieldSet('date_creation');
			$tb_content->fieldSet('date_update');
			$tb_content->fieldSet('application_id');
			$tb_content->fieldSet('code');
			$tb_content->fieldSet('status_id');
			$tb_content->fieldSet('date_status');
			$tb_content->fieldSet('category_id');
			$tb_content->fieldSet('author_id');
			$tb_content->fieldSet('date_publication');
			$tb_content->fieldSet('title');
			$tb_content->fieldSet('title_page');
			$tb_content->fieldSet('alt');
			$tb_content->fieldSet('alias');
			$tb_content->fieldSet('style');
			$tb_content->fieldSet('class');
			$tb_content->fieldSet('icon');
			$tb_content->fieldSet('path');
			$tb_content->fieldSet('content_page');
			$tb_content->fieldSet('image');
			$tb_content->fieldSet('keywords');
			$tb_content->fieldSet('intro');
			$tb_content->fieldSet('content');
			
			$tb_content->fieldSet('image1');
			$tb_content->fieldSet('image2');
			$tb_content->fieldSet('image3');
			$tb_content->fieldSet('image4');
			$tb_content->fieldSet('image5');
			$tb_content->fieldSet('image6');

			$tb_content->fieldSet('block1');
			$tb_content->fieldSet('block2');
			$tb_content->fieldSet('block3');
			$tb_content->fieldSet('block4');
			$tb_content->fieldSet('block5');
			$tb_content->fieldSet('block6');

			switch ($order) {
				case 'alpha':
					$tb_content->orderSet('title', 'ASC');					
				case 'date':
				default:
					$tb_content->orderSet('date_publication', 'DESC');
			}
			
			if (!empty($contentCode)) {
				$tb_content->whereSet('code', $contentCode);
			}
			if (!empty($application)) {
				$tb_content->whereSet('application_id', $applicationId, 'and');
			}

			$tb_status=$tb_content->joinSet('status_id', 'cms_status', 'id');
			$tb_status->fieldSet('label', 'status');

			$tb_category=$tb_content->joinSet('category_id', 'cms_category', 'id');
			$tb_category->fieldSet('code', 'category');
			if (!empty($categoryCode)) {
				$tb_category->whereSet('code', $categoryCode, 'and');
			}

			$returnList = $tb_content->findAll();
			$fct_return->returnSet($returnList);
			$ws->logSys('debug', 'Display content ok', __CLASS__, $fct_return->returnGet(),'results');
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
