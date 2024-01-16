<?php
/**
* Listcomp module
*
* @package    crud_listcomp
* @version    1.1
* @date       30 Août 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();
$ws = workspace::ws_open();
	
// List Parameter
$ws->paramSet('LC_LIST_ORDER_MAX', 10);
$ws->paramSet('LC_LIST_COLUMN_MAX', 10);
$ws->paramSet('LC_LIST_BUFFER_SIZE', 1000);
$ws->paramSet('LC_LIST_PAGE_SIZE_MIN', 5);
$ws->paramSet('LC_LIST_PAGE_SIZE_MEDIUM', 10);
$ws->paramSet('LC_LIST_PAGE_SIZE_LARGE', 23);
$ws->paramSet('LC_LIST_PAGE_SIZE_MAX', 25);

$ws->paramSet('LC_LIST_NAME', 'listcomp');

// List Path
$ws->paramSet('LC_LIST_TEMPLATES_SRC_DIR', $ws->paramGet('MODULES_DIR') . $ws->paramGet('LC_LIST_NAME') . '/templates/src/');
$ws->paramSet('LC_LIST_TEMPLATES_CSS_DIR', $ws->paramGet('RELA_MODULES_DIR') . $ws->paramGet('LC_LIST_NAME') . '/templates/css/');
$ws->paramSet('LC_LIST_TEMPLATES_JS_DIR', $ws->paramGet('RELA_MODULES_DIR') . $ws->paramGet('LC_LIST_NAME') . '/templates/js/');

// Template css & js
$ws->paramSet('LC_LIST_TEMPLATE_STYLE', $ws->paramGet('LC_LIST_NAME') . '.css');
$ws->paramSet('LC_LIST_TEMPLATE_JS', $ws->paramGet('LC_LIST_NAME') . '.js');

$ws->addjs($ws->paramGet('LC_LIST_TEMPLATES_JS_DIR') . $ws->paramGet('LC_LIST_TEMPLATE_JS'));
$ws->addcss($ws->paramGet('LC_LIST_TEMPLATES_CSS_DIR') . $ws->paramGet('LC_LIST_TEMPLATE_STYLE'));

/**
* Classes for listcomp module.
*/
class wlistcomp
{

	private $_object;
	private $_objectRef;
	private $_htmlId;
	private $_app;
	private $_phpName;
	private $_pageSize;
	private $_pageSizeArray = array();
	private $_pageButtonTopFlag;
	private $_pageOrderMax;
	private $_pageSearchFlag;
	private $_captionFlag;
	private $_columnIdFlag;
	private $_filterViewFlag;
	private $_sortFlag;
	private $_viewFlag;
	private $_pageSizeSelectorFlag = false;
	private $_columnIdPct;
	private $_columnActionPct;
	private $_displaySize;
	private $_columnNb;
	private $_columnnameArray = array();
	private $_columnFct = array();
	private $_columnFormat = array();
	private $_deletecolumnname;
	private $_filterArray = array();
	private $_filterViewArray = array();
	private $_pageFlag;
	private $_titleFlag;
	private $_titleCode;
	private $_event = array();
	private $_eventTab = array();

    private function _initEvent($event, $command, $icon, $list=false) {
		$this->_event[] = $event;

		$eventItem['flag'] = false;
		$eventItem['box'] = false;
		$eventItem['command'] = $command;
		$eventItem['file'] = '';
		$eventItem['icon'] = $icon;
		$eventItem['list'] = $list;
		$eventItem['text'] = '';
		$eventItem['ref'] = '';
		$this->_eventTab[$event] = $eventItem;
	}
	
    private function initSmarty(&$smarty) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$smarty->template_dir = $ws->paramGet('LC_LIST_TEMPLATES_SRC_DIR') ;

		// init buttons
		if (!$ws->paramGet('RIGHT_CREATE')) {
			$this->_eventTab['btnew']['flag'] = false;
		}
		if (!$ws->paramGet('RIGHT_UPDATE')) {
			$this->_eventTab['btedit']['flag'] = false;
		}
		if (!$ws->paramGet('RIGHT_DELETE')) {
			$this->_eventTab['btdelete']['flag'] = false;
		}
		if (!$ws->paramGet('RIGHT_EVENT')) {
			$this->_eventTab['btevent']['flag'] = false;
			$this->_eventTab['bttool']['flag'] = false;
		}
		
		$btHeaderNb = 0;
		if ($this->_eventTab['btnew']['flag']) {
			$btHeaderNb++;
		}
		if ($this->_eventTab['btlink']['flag']) {
			$btHeaderNb++;
		}

		$btNb = 0;
		if ($this->_eventTab['btedit']['flag']) {
			$btNb++;
		}
		if ($this->_eventTab['btdelete']['flag']) {
			$btNb++;
		}
		if ($this->_eventTab['btevent']['flag']) {
			$btNb++;
		}
		if ($this->_eventTab['bttool']['flag']) {
			$btNb++;
		}
		
		// init columns, flters and page selector
		$pageSizeSelectorFlag = false;
		if (count($this->_pageSizeArray) > 1) {
			$pageSizeSelectorFlag = true;
		}
		foreach($this->_columnnameArray as $key=>$columnItem) {
			 $columnItem['label'] = $smarty->getConfigVars("header_list_" . $columnItem['num']);
			 $this->_columnnameArray[$key] = $columnItem;
		}

		foreach($this->_filterViewArray as $key=>$filterView) {
			$filterView['label'] = $smarty->getConfigVars("filter_list_"  . $filterView['field']);
			$filterView['display'] = $filterView['value'];
			$filterView['display'] = preg_replace('#^%#Usi', '' , $filterView['display']);
			$filterView['display'] = preg_replace('#%$#Usi', '' , $filterView['display']);
			$this->_filterViewArray[$key] = $filterView;
		}

		// display parameters
		$smarty->assign('html_id', $this->_htmlId);
		$smarty->assign('titleflag', $this->_titleFlag);
		$smarty->assign('titlecode', $this->_titleCode);
		$smarty->assign('pageflag', $this->_pageFlag);
		$smarty->assign('btsearch', $this->_eventTab['btsearch']);
		$smarty->assign('btorder', $this->_eventTab['btorder']);
		$smarty->assign('btclose', $this->_eventTab['btclose']);
		$smarty->assign('btnew', $this->_eventTab['btnew']);
		$smarty->assign('btlink', $this->_eventTab['btlink']);
		$smarty->assign('btedit', $this->_eventTab['btedit']);
		$smarty->assign('btdelete', $this->_eventTab['btdelete']);
		$smarty->assign('btevent', $this->_eventTab['btevent']);
		$smarty->assign('bttool', $this->_eventTab['bttool']);
		$smarty->assign('btnb', $btNb);
		$smarty->assign('btheadernb', $btHeaderNb);
		$smarty->assign('btpage', $this->_eventTab['btpage']);
		$smarty->assign('buttontopflag', $this->_pageButtonTopFlag);
		$smarty->assign('searchflag', $this->_pageSearchFlag);
		$smarty->assign('ordercount', $this->_pageOrderMax);
		$smarty->assign('object', $this->_object);
		$smarty->assign('object_id', $this->_object.'_id');
		$smarty->assign('app', $ws->paramGet('APP_CODE'));
		$smarty->assign('php_name', $this->_phpName);
		$smarty->assign('displaysize', $this->_displaySize);
		$smarty->assign('captionflag', $this->_captionFlag);
		$smarty->assign('filterflag', $this->_filterViewFlag);
		$smarty->assign('filterview', $this->_filterViewArray);
		$smarty->assign('columnidflag', $this->_columnIdFlag);
		$smarty->assign('sortflag', $this->_sortFlag);
		$smarty->assign('viewflag', $this->_viewFlag);
		$smarty->assign('pagesizeflag', $pageSizeSelectorFlag);
		$smarty->assign('pagesizearray', $this->_pageSizeArray);
		$smarty->assign('columnidpct', $this->_columnIdPct);
		$smarty->assign('columnactionpct', $this->_columnActionPct);
		$smarty->assign('columnnb', $this->_columnNb);
		$smarty->assign('columnname', $this->_columnnameArray);
		return true;
	}
	
    public function __construct($object, $htmlId="", $phpName="", $objectParam=null) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		if ($objectParam == null) {
			$objectRef = new $object();
		}
		else {
			$objectRef = $objectParam;
		}
		// html_id initialization
		if (trim($htmlId) == "") {
			$htmlId = $object;
		}

		// php_name initialization
		if (trim($phpName) == "") {
			$phpName = $object;
		}
		$this->_object = $object;
		$this->_objectRef = $objectRef;
		$this->_htmlId = $htmlId;
		$this->_app = $ws->paramGet('APP_CODE');
		$this->_phpName = $phpName;
		$this->_pageSize = $ws->paramGet('LC_LIST_PAGE_SIZE_LARGE');
		$this->_pageOrderMax = 0;
		$this->_displaySize = 0;
		$this->_pageButtonTopFlag = true;
		$this->_pageSearchFlag = false;
		$this->_titleFlag = true;
		$this->_titleCode = '';
		$this->_pageFlag = true;
		$this->_captionFlag = true;
		$this->_filterViewFlag = false;
		$this->_columnIdFlag = false;
		$this->_sortFlag = false;
		$this->_viewFlag = false;
		$this->_pageSizeSelectorFlag = false;
		$this->_columnIdPct = 0;
		$this->_columnActionPct = 0;
		$this->_columnNb = 0;

		$this->_initEvent('btsearch', 'list', 'search', false);
		$this->_initEvent('btorder', 'list', '', false);
		$this->_initEvent('btpage', 'list', '', false);
		$this->_initEvent('btnew', 'new', 'user', false);
		$this->_initEvent('btlink', '', '', false);
		$this->_initEvent('btclose', '', 'close', false);

		$this->_initEvent('btevent', 'event', 'wrench', true);
		$this->_initEvent('bttool', 'tool', 'wrench', true);
		$this->_initEvent('btedit', 'edit', 'edit', true);
		$this->_initEvent('btdelete', 'delete', 'trash', true);
		
//		$this->_initEvent('link', 'edit','edit');
   }

    public function pagesizeSet($value0, $value1=0, $value2=0, $value3=0, $value4=0) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		$this->_pageSizeArray = array();
		$this->_pageSize = $value0;
		if ($value0 != 0) {
			$this->_pageSizeArray[0] = $value0;
			if ($value1 != 0) {
				$this->_pageSizeArray[] = $value1;
			}
			if ($value2 != 0) {
				$this->_pageSizeArray[] = $value2;
			}
			if ($value3 != 0) {
				$this->_pageSizeArray[] = $value3;
			}
			if ($value4 != 0) {
				$this->_pageSizeArray[] = $value4;
			}
			sort($this->_pageSizeArray, SORT_NATURAL);
		}
	}

    public function pagesizeGet() {
		return $this->_pageSize;
	}

    public function pagesizeselectorSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$this->_pageSizeSelectorFlag=$value;
	}

    public function pagesizeselectorGet() {
		return $this->_pageSizeSelectorFlag;
	}

    public function pageorderSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		if ($value > $ws->paramGet('LC_LIST_ORDER_MAX')) {
			$value = $ws->paramGet('LC_LIST_ORDER_MAX');
		}
		$this->_pageOrderMax=$value;
	}

    public function pageorderGet() {
		return $this->_pageOrderMax;
	}

     public function pagebuttontopSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$this->_pageButtonTopFlag=$value;
	}

    public function pagebuttontopGet() {
		return $this->_pageButtonTopFlag;
	}
	
     public function pagesearchSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$this->_pageSearchFlag=$value;
	}

    public function pagesearchGet() {
		return $this->_pageSearchFlag;
	}

    public function captionSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$this->_captionFlag=$value;
	}

    public function captionGet() {
		return $this->_captionFlag;
	}

    public function titleSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$this->_titleFlag=$value;
	}

    public function titleGet() {
		return $this->_titleFlag;
	}

    public function titleCodeSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$this->_titleCode=$value;
	}

    public function titleCodeGet() {
		return $this->_titleCode;
	}

    public function pageSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$this->_pageFlag=$value;
	}

    public function pageGet() {
		return $this->_pageFlag;
	}

    public function eventSet($event, $value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$eventItem = $this->_eventTab[$event];
		$eventItem['flag']=$value;
		$this->_eventTab[$event] = $eventItem;
	}

    public function eventGet($event) {
		$eventItem = $this->_eventTab[$event];
		return $eventItem['flag'];
	}

     public function eventcommandSet($event, $value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$eventItem = $this->_eventTab[$event];
		$eventItem['command']=$value;
		$this->_eventTab[$event] = $eventItem;
	}

    public function eventcommandGet($event) {
		$eventItem = $this->_eventTab[$event];
		return $eventItem['command'];
	}

	public function eventboxSet($event, $value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$eventItem = $this->_eventTab[$event];
		$eventItem['box']=$value;
		$this->_eventTab[$event] = $eventItem;
	}

    public function eventboxGet($event) {
		$eventItem = $this->_eventTab[$event];
		return $eventItem['box'];
	}

	public function eventiconSet($event, $value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$eventItem = $this->_eventTab[$event];
		$eventItem['icon']=$value;
		$this->_eventTab[$event] = $eventItem;
	}

    public function eventiconGet($event) {
		$eventItem = $this->_eventTab[$event];
		return $eventItem['icon'];
	}

	public function eventtextSet($event, $value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$eventItem = $this->_eventTab[$event];
		$eventItem['text']=$value;
		$this->_eventTab[$event] = $eventItem;
	}

    public function eventtextGet($event) {
		$eventItem = $this->_eventTab[$event];
		return $eventItem['text'];
	}

	public function eventfileSet($event, $value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$eventItem = $this->_eventTab[$event];
		$eventItem['file']=$value;
		$this->_eventTab[$event] = $eventItem;
	}

    public function eventfileGet($event) {
		$eventItem = $this->_eventTab[$event];
		return $eventItem['file'];
	}

	public function deletecolumnnameSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$this->_deletecolumnname=$value;
	}

    public function deletecolumnnameGet() {
		return $this->_deletecolumnname;
	}

    public function columnidSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$this->_columnIdFlag=$value;
	}

    public function columnidGet() {
		return $this->_columnIdFlag;
	}

    public function sortSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$this->_sortFlag=$value;
	}

    public function sortGet() {
		return $this->_sortFlag;
	}

    public function viewSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$this->_viewFlag=$value;
	}

    public function viewGet() {
		return $this->_viewFlag;
	}

    public function displaysizeSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$size = 0;
		
		switch (strtoupper($value)) {
			case 'LARGE':
				$size = 0;
				break;
			case 'MEDIUM':
				$size = 1;
				break;
			case 'SMALL':
				$size = 2;
				break;
			case 'MINI':
				$size = 3;
				break;
			default :
				$size = 0;
		}
		$this->_displaySize=$size;
	}

 
	/**
	* Initialize column of the list
	*
	* @param string - field name in the object
	*
	* @param integer - size of the column in the list
	*
	* @return No
	*
    * @access public
	*/
   public function columnAdd($field, $pct=0, $display=true) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$column = array();
		$column['name']=$field;
		$column['pct']=$pct;
		$column['display']= $display;
		if ($this->_columnNb < $ws->paramGet('LC_LIST_COLUMN_MAX')) {
			$this->_columnNb = $this->_columnNb + 1;
			$column['num']=$this->_columnNb;
			$this->_columnnameArray[] = $column;
		}
	}

	/**
	* Initialize object fields by function
	*
	* @param string - field name in the object
	*
	* @param string - function name
	*
	* @param string - field name first parameter of the function
	*
	* @param string - field name second parameter of the function
	*
	* @return No
	*
    * @access public
	*/
	public function columnFct($field, $function = '', $fieldname0 = '', $fieldname1 = '') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$control = true;
		if ($control) {
			if ($fieldname0 == ''){
				$control = false;
			}
			if ($function == '') {
				$control = false;
			}
		}
		if ($control) {
			$fieldFct = array();
			$fieldFct['function'] = $function;
			$fieldFct['fieldname0'] = $fieldname0;
			$fieldFct['fieldname1'] = $fieldname1;
			$this->_columnFct[$field] = $fieldFct;
		}
	}

	/**
	* object fields format
	*
	* @param string - field name in the object
	*
	* @param string - format name 'date'
	*
	* @return No
	*
    * @access public
	*/
	public function columnFormat($field, $name, $format='') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$control = true;
		if ($control) {
			if (empty($name)){
				$control = false;
			}
		}
		if ($control) {
			$fieldFormat = array();
			$fieldFormat['name'] = $name;
			$fieldFormat['format'] = $format;
			$this->_columnFormat[$field] = $fieldFormat;
		}
	}

    public function columnidpctSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$this->_columnIdPct=$value;
	}

    public function columnidpctGet() {
		return $this->_columnIdPct;
	}

    public function columnactionpctSet($value) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$this->_columnActionPct=$value;
	}

    public function columnactionpctGet() {
		return $this->_columnActionPct;
	}

    public function filterSet($name, $value, $operator='=') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$filter['field']=$name;
		$filter['value']=$value;
		$filter['operator']=$operator;
		$this->_filterArray[] = $filter;
	}

    public function filterGet() {
		return $this->_filterArray;
	}

    public function filterViewSet($name, $type='text', $option = '') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$filterView['field'] = $name;
		$filterView['type'] = $type;
		$filterView['label'] = '';
		if ($type == 'text') {
			$filterView['operator'] = 'like';
		}
		else {
			$filterView['operator'] = '=';
		}
		$filterView['option'] = $option;
		$filterView['size'] = 0;
		$this->_filterViewArray[] = $filterView;
		$this->_filterViewFlag = true;
	}

    public function filterViewGet() {
		return $this->_filterViewArray;
	}

	// $object = class name for the object managed in the list
	// $htmlId = Id html of the section to display the list 
	// $phpName = file name without the extension of the php file source
	//
    public function fetchList() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$object = $this->_object;
		$htmlId = $this->_htmlId;
		$app = $this->_app;
		$phpName = $this->_phpName;
		$name_id = 'id';
		if (!isset($this->_deletecolumnname)) {
			$deletecolumnname = 'id';
		}
		else {
			$deletecolumnname = $this->_deletecolumnname;
		}

		// param1 criteria
		$param1 = $ws->argGet('param1');

		// search criteria
		if ($ws->ctrlGet('search')) {
			$pageSearch = $ws->argGet('search');
		}
		else {
			$pageSearch=$ws->sessionGet($htmlId . '_search');
		}
		if(!$this->_pageSearchFlag) {
			$pageSearch='';
		}
		$ws->sessionSet($htmlId . '_search',$pageSearch);

		// sort
		if ($ws->ctrlGet('sort')) {
			$pageSortTmp = $ws->argGet('sort');
		}
		else {
			$pageSortTmp=$ws->sessionGet($htmlId . '_sort');
		}
		$pageSort = '';
		if ($pageSortTmp == $name_id) {
			$pageSort = $pageSortTmp;
		}
		else {
			foreach($this->_columnnameArray as $key=>$column) {
				if ($column['name'] == $pageSortTmp) {
					$pageSort = $pageSortTmp;
					break;
				}
			}
		}
		$ws->sessionSet($htmlId . '_sort',$pageSort);

		// sort order
		if ($ws->ctrlGet('sortorder')) {
			$pageSortorderTmp = $ws->argGet('sortorder');
		}
		else {
			$pageSortorderTmp=$ws->sessionGet($htmlId . '_sortorder');
		}
		$pageSortorder=intval($pageSortorderTmp);
		if(($pageSortorder > 1) or ($pageSortorder < 0)) {
			$pageSortorder=0;
		}
		$ws->sessionSet($htmlId . '_sortorder',$pageSortorder);
		
		// order
		if ($ws->ctrlGet('order')) {
			$pageOrderTmp = $ws->argGet('order');
		}
		else {
			$pageOrderTmp=$ws->sessionGet($htmlId . '_order');
		}
		$pageOrder=intval($pageOrderTmp);
		if(($pageOrder > $this->_pageOrderMax) or ($pageOrder < 0)) {
			$pageOrder=0;
		}
		$ws->sessionSet($htmlId . '_order',$pageOrder);
		
		// size
		if ($ws->ctrlGet('size')) {
			$pageSizeTmp = $ws->argGet('size');
		}
		else {
			$pageSizeTmp=$ws->sessionGet($htmlId . '_size');
		}
		$pageSize=intval($pageSizeTmp);
		if ($pageSize == 0) {
			$pageSize = $this->_pageSize;
		}
		$ws->sessionSet($htmlId . '_size',$pageSize);
		
		// filter
		if ($ws->ctrlGet('filter')) {
			$filterValueTmp = $ws->argGet('filter');
		}
		else {
			$filterValueTmp = $ws->sessionGet($htmlId . '_filter');
		}
		$filterValue = '';
		$atemp = explode(',', $filterValueTmp);
		foreach($this->_filterViewArray as $key=>$filterView) {
			if ($key > 0) {
				$filterValue .= ',';
			}
			if (isset($atemp[$key])) {
				$value = $atemp[$key];
			}
			else {
				$value = '';
			}
			switch ($filterView['type']) {
				case 'list' :
					$filterView['list'] = $filterView['option'];
					$filterView['value'] = $value;
					$filterView['description'] = '';
					$valueList = $filterView['option'];
					if (isset($valueList[$value])) {
						$filterView['description'] = $valueList[$value];
					}
					break;
				case 'int' :
					$filterView['value'] = int($value);
					$filterView['description'] = $value;
					break;
				default :
					$filterView['value'] = $value;
					$filterView['description'] = $value;
			}
			if ($filterView['operator'] == 'like') {
				$filterView['value'] = '%' . $value . '%';
			}
			$filterValue .= $value;
			$this->_filterViewArray[$key] = $filterView;
		}
		$ws->sessionSet($htmlId . '_filter',$filterValue);

		// view
		$columnViewArrayTmp = $ws->sessionGet($htmlId . '_column');
		if (empty($columnViewArrayTmp)) {
			$columnViewArray = array();
		}
		else {
			$columnViewArray = $columnViewArrayTmp;
		}
		foreach($this->_columnnameArray as $columnItem) {
			if (!isset($columnViewArray[$columnItem['name']])) {
				$columnViewArray[$columnItem['name']] = $columnItem['display'];
			}
		}
		$fieldView = '';
		if ($ws->ctrlGet('view')) {
			$fieldView = $ws->argGet('view');
		}
		if (isset($columnViewArray[$fieldView])) {
			if ($columnViewArray[$fieldView] == 1) {
				$columnViewArray[$fieldView] = 0;
			}
			else {
				$columnViewArray[$fieldView] = 1;
			}
		}
		$ws->sessionSet($htmlId . '_column',$columnViewArray);
		foreach($this->_columnnameArray as $key=>$columnItem) {
			 $columnItem['display'] = $columnViewArray[$columnItem['name']];
			 $this->_columnnameArray[$key] = $columnItem;
		}

		// init data object 		
		$objectRef = $this->_objectRef;
		$filterArray = $this->_filterArray;
		for ($temp=0; $temp < count($filterArray); $temp++) {
			$filter = $filterArray[$temp];
			$objectRef->filterSet($filter['field'], $filter['value'], $filter['operator']);
		}

		foreach($this->_filterViewArray as $key=>$filterView) {
			if (!empty($filterView['description'])) {
				$objectRef->filterSet($filterView['field'], $filterView['value'], $filterView['operator']);
			}
		}
		
		// loading list data 		
		$linesArray = array();
		$fctReturn = $objectRef->displayList($pageOrder, $pageSearch, $pageSort, $pageSortorder);
		if ($fctReturn->statusGet()) {
			$linesArray = $fctReturn->returnGet();
		}

		// page number and page count
		if ($ws->ctrlGet('p')) {
			$pageNumberTmp = $ws->argGet('p');
		}
		else {
			$pageNumberTmp = $ws->sessionGet($htmlId . '_page');
		}
		$linesCount=count($linesArray);
		$pageCount= floor($linesCount/$pageSize);
		if ($linesCount%$pageSize > 0) {
			$pageCount = $pageCount + 1;
		}
		$pageNumber=intval($pageNumberTmp);
		if (($pageNumber == 0) or ($pageNumber < -1)) {
			$pageNumber=1;
		}
		elseif ($pageNumber == -1) {
			$pageNumber=$pageCount;
		}
		elseif ($pageNumber > $pageCount) {
			$pageNumber=$pageCount;
		}
		$ws->sessionSet($htmlId . '_page',$pageNumber);

		// calculation of the list data to display
		$pageBegin=($pageNumber -1)*$pageSize;
		if (isset($linesArray)) {
			$pageArray = array_slice($linesArray, $pageBegin, $pageSize);
		}
		else {
			$pageArray = array();
		}
		
		// calculation of the list pagination to display
		switch ($pageCount) {
			case 0:
				$paginationArray = array(-2,-2,-2,-2,-2,-2,-2);
				break;
			case 1:
				$paginationArray = array(-2,-2,-2,-2,-2,-2,-2);
				break;
			case 2:
				$paginationArray = array(0,1,2,-1,-2,-2,-2);
				break;
			case 3:
				$paginationArray = array(0,1,2,3,-1,-2,-2);
				break;
			case 4:
				$paginationArray = array(0,1,2,3,4,-1,-2);
				break;
			default:
				$paginationArray[0] = 0; 
				if ($pageNumber < 4) {
					$paginationArray[1] = 1; 
					$paginationArray[2] = 2; 
					$paginationArray[3] = 3; 
					$paginationArray[4] = 4; 
					$paginationArray[5] = 5; 
				}
				else {
					if ($pageNumber+2 <= $pageCount) {
						$paginationArray[1] = $pageNumber-2; 
						$paginationArray[2] = $pageNumber-1; 
						$paginationArray[3] = $pageNumber; 
						$paginationArray[4] = $pageNumber+1; 
						$paginationArray[5] = $pageNumber+2; 
					}
					elseif ($pageNumber+1 <= $pageCount) {
						$paginationArray[1] = $pageNumber-3; 
						$paginationArray[2] = $pageNumber-2; 
						$paginationArray[3] = $pageNumber-1; 
						$paginationArray[4] = $pageNumber; 
						$paginationArray[5] = $pageNumber+1; 
					}
					else {
						$paginationArray[1] = $pageNumber-4; 
						$paginationArray[2] = $pageNumber-3; 
						$paginationArray[3] = $pageNumber-2; 
						$paginationArray[4] = $pageNumber-1; 
						$paginationArray[5] = $pageNumber; 
					}
				}
				$paginationArray[6] = -1; 
		}

		// init events Hrefs
		$connect = new object_connect();
		for ($temp=0 ; $temp < count($this->_event); $temp++) {
			$event = $this->_event[$temp];
			$eventItem = $this->_eventTab[$event];
			if ($eventItem['file'] == "") {
				$eventItem['file'] = $phpName;
			}
			if ($eventItem['list']) {
				$refArray = array();
				for ($temp1=0 ; $temp1 < count($pageArray); $temp1++) {
					$refArray[$temp1] = $connect->constructHref($app,$eventItem['file'],'command:' . $eventItem['command'], 'param1:' . $param1, 'id:' . $pageArray[$temp1]['id']);
				}
				$eventItem['ref'] = $refArray;
			}
			else {
				if ($eventItem['command'] != '') {
					$eventItem['ref'] = $connect->constructHref($app,$eventItem['file'],'command:' . $eventItem['command'], 'param1:' . $param1);
				}
				else {
					$eventItem['ref'] = $connect->constructHref($app,$eventItem['file'], 'param1:' . $param1);
				}
			}
			$this->_eventTab[$event] = $eventItem;
		}

		$formatArray =  $this->_columnFormat;
		$fctArray =  $this->_columnFct;
		foreach ($pageArray as $key=>$line) {

			foreach ($line as $field=>$value) {
				if (isset($formatArray[$field])) {
					$formatName = $formatArray[$field]['name'];
					switch ($formatName) {
						case 'date':
							$dateValue = date_create($value);
							$formatValue = date_format($dateValue,'d/m/Y');
							break;
						default:
							$formatValue = $value;
					}
					$line[$field] = $formatValue;
				}
			}

			foreach ($fctArray as $field=>$fieldFct) {
				$fieldResult = "";
			
				$function = $fieldFct['function'];
				$fieldname0 = $fieldFct['fieldname0'];
				$fieldname1 = $fieldFct['fieldname1'];
				if (!empty($function)) {
					if (empty($fieldname0)) {
						$fieldResult = $function();
					}
					else {
						if (empty($fieldname1)) {
							if (isset($line[$fieldname0])) {
								$fieldResult = $function($line[$fieldname0]);
							}
						}
						else {
							if ((isset($line[$fieldname0])) and (isset($line[$fieldname1]))) {
								$fieldResult = $function($line[$fieldname0], $line[$fieldname1]);
							}
						}
					}
				}
				$line[$field] = $fieldResult;
			}
			$pageArray[$key] = $line;
		}

		// smarty parameters
		$smarty = new workpage($this->_htmlId);
		$this->initSmarty($smarty);
		$smarty->assign('htmlid', $htmlId);
		$smarty->assign('search', $pageSearch);
		$smarty->assign('count', $linesCount);
		$smarty->assign('filter', $filterValue);
		$smarty->assign('list', $pageArray);
		$smarty->assign('page', $pageNumber);
		$smarty->assign('order', $pageOrder);
		$smarty->assign('sort', $pageSort);
		$smarty->assign('sort_order', $pageSortorder);
		$smarty->assign('pagesize', $pageSize);
		$smarty->assign('pagecount', $pageCount);
		$smarty->assign('pagination', $paginationArray);
		$smarty->assign('name_list_id', $name_id);
		$smarty->assign('name_delete', $deletecolumnname);
		$smarty->assign('param1', $param1);

		return $smarty->fetch('index.tpl');
	}
	
    public function displayList() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$display_html = $this->fetchList();
		$ws->assign('body', $display_html); 
		$ws->caching = false;
		$ws->build('simple'); 
	}

}
?>
