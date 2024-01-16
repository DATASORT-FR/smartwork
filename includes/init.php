<?php
/**
* This file contains initialization code
*
* @package    administration_initialization
* @version    1.3
* @date       25 November 2013
* @update	  03 March 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// global define
include('includes/config.php');

if (!defined('DISPLAY_PHP_ERROR')) {
	define('DISPLAY_PHP_ERROR', false);
}
if (!defined('SERVER_ROOT')) {
	define('SERVER_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
}
if (!defined('SERVER_NAME')) {
	if (isset($_SERVER['SERVER_NAME'])) {
		define('SERVER_NAME', $_SERVER['SERVER_NAME']);
	}
	else {
		define('SERVER_NAME', '');		
	}
}
if (!defined('REQUEST_URI')) {
	if (isset($_SERVER['REQUEST_URI'])) {
		define('REQUEST_URI', $_SERVER['REQUEST_URI']);
	}
	else {
		define('REQUEST_URI', '');		
	}
}
if (!defined('BASE_NAME')) {
	if (isset($_SERVER['SERVER_NAME'])) {
		$httpsFlag = false;
		if (((!empty($_SERVER['HTTPS'])) && ($_SERVER['HTTPS'] == 'on')) || ($_SERVER['SERVER_PORT'] == 443)) {
			$httpsFlag = true;
		}
		else {
			if ((!empty($_SERVER['HTTP_X_FORWARDED_PROTO'])) && ($_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) {
				$httpsFlag = true;
			}
			else  {
				if ((!empty($_SERVER['HTTP_X_FORWARDED_SSL'])) && ($_SERVER['HTTP_X_FORWARDED_SSL'] == 'on')) {
					$httpsFlag = true;
				}
			}
		}
		if ($httpsFlag) {
			define('BASE_NAME', 'https://' . $_SERVER['SERVER_NAME'] . '/');
		}
		else {
			define('BASE_NAME', 'http://' . $_SERVER['SERVER_NAME'] . '/');
		}
	}
	else {
		define('BASE_NAME', '/');		
	}
}
if (!defined('FRAMEWORK_ROOT')) {
	define('FRAMEWORK_ROOT', '');
}
if (!defined('SITE_TITLE')) {
	define('SITE_TITLE', 'SmartWork');
}
if (!defined('SITE_VERSION')) {
	define('SITE_VERSION', '1.2');
}
if (!defined('SMARTY_DEBUG')) {
	define('SMARTY_DEBUG', False);
}
if (!defined('SMARTY_CACHE')) {
	define('SMARTY_CACHE', False);
}
if (!defined('SMARTY_COMPILE_CHECK')) {
	define('SMARTY_COMPILE_CHECK', True);
}
if (!defined('SMARTY_FORCE_COMPILE')) {
	define('SMARTY_FORCE_COMPILE', True);
}
if (!defined('LOG4PHP_GROUP')) {
	define('LOG4PHP_GROUP', False);
}
if (!defined('CONNEXION_DURATION')) {
	define('CONNEXION_DURATION', 120);
}
if (!defined('CACHE_DURATION')) {
	define('CACHE_DURATION', 1);
}
if (!defined('URL_REWRITING')) {
	define('URL_REWRITING', false);
}
if (!defined('ERROR_PAGE')) {
	define('ERROR_PAGE', 'error.html');
}
if (!defined('CSS_COMBINE')) {
	define('CSS_COMBINE', false);
}
if (!defined('JS_COMBINE')) {
	define('JS_COMBINE', false);
}
if (!defined('LOCAL_PARAM')) {
	define('LOCAL_PARAM', 'en-GB.UTF-8');
}
if (!defined('LOCAL_LANGUAGE')) {
	define('LOCAL_LANGUAGE', 'en-GB');
}
if (!defined('LOCAL_ZONE')) {
	define('LOCAL_ZONE', 'Europe/London');
}
if (!defined('LOCAL_DATE_FORMAT')) {
	define('LOCAL_DATE_FORMAT', 'dd/MM/YYYY');
}
if (!defined('DEFAULT_LANGUAGE')) {
	define('DEFAULT_LANGUAGE', 'en');
}
if (!defined('SESSION_SERVER')) {
	define('SESSION_SERVER', false);
}
if (!defined('PARTNER_ID')) {
	define('PARTNER_ID', 0);
}

if (DISPLAY_PHP_ERROR) {
	define('ERRORSLOG_LEVEL', E_WARNING);
	ini_set('display_errors', 'on');
	ini_set('error_reporting', E_ALL);
}
else {
	ini_set('display_errors', 'off');
	ini_set('track_errors', 1);
	ini_set('error_reporting', E_ERROR | E_PARSE);
}

define('SITE_BASE', BASE_NAME . FRAMEWORK_ROOT);
// Framework Path
define('API_PATH', 'api/');
define('APPS_PATH', 'apps/');
define('APPS_ADMINISTRATOR_PATH', 'apps/administrator/');
define('ARCHIVE_PATH', 'archive/');
define('BACKUP_PATH', 'backup/');
define('CACHE_PATH', 'cache/');
define('CLASSES_PATH', 'includes/classes/');
define('COMPILE_PATH', 'compile/');
define('DEFAULT_PATH', 'default/');
define('DOCS_PATH', 'docs/');
define('FILES_PATH', 'files/');
define('IMAGES_PATH', 'images/');
define('IMAGES_ADMINISTRATOR_PATH', 'images/administrator/');
define('IMAGES_DEFAULT_PATH', 'images/default/');
define('INCLUDES_PATH', 'includes/');
define('INIT_PATH', 'init/');
define('LANGUAGE_PATH', 'language/');
define('LIBS_PATH', 'libs/');
define('LOGS_PATH', 'logs/');
define('MODELS_PATH', 'includes/models/');
define('MODULES_PATH', 'modules/');
define('PAGES_PATH', 'pages/');
define('PLUGINS_PATH', 'plugins/');
define('RELA_PATH', './');
define('SCRIPTS_PATH', 'scripts/');
define('TEMPLATES_PATH', 'templates/');
define('TEMPLATES_CSS_PATH', 'templates/css/');
define('TEMPLATES_JS_PATH', 'templates/js/');
define('TEMPLATES_SRC_PATH', 'templates/src/');
define('UPLOADS_PATH', 'uploads/');
define('WORKSPACE_PATH', 'workspace/');
define('WS_PATH', 'ws/');
define('XML_PATH', 'xml/');

// Library Root
define('BOOTSTRAP_ROOT', 'bootstrap-5.0.2/');
define('TYPEAHEAD_ROOT', 'typeahead/');
define('TAGSINPUT_ROOT', 'tagsinput/');
define('TREEVIEW_ROOT', 'treeview/');
define('CKEDITOR_ROOT', 'ckeditor-5/');
define('DATEPICKER_ROOT', 'datepicker-1.0.0/');
define('DOMPDF_ROOT', 'dompdf/');
define('FONTAWESOME_ROOT', 'font-awesome-4.7.0/');
define('JQUERY_ROOT', 'jquery-3.7.1/');
define('JQUERYUI_ROOT', 'jquery-ui-1.10.3/');
define('LOG4PHP_ROOT', 'log4php-2.3.0/');
define('LESSPHP_ROOT', 'lessphp/');
define('ONESHEET_ROOT', 'onesheet-1.2.2/');
define('PHPMAILER_ROOT', 'PHPMailer/');
define('SMARTORM_ROOT', 'smartorm-1.2.0/');
define('SMARTY_ROOT', 'smarty-4.3.4/');
define('TETHER_ROOT', 'tether-1.4.0/');
define('CHARTJS_ROOT', 'chartjs-2.7.2/');

// Script or Wen initialization
define('SCRIPT_TYPE', 'SCRIPT');
define('WEB_TYPE', 'WEB');
if (!isset($argv)) {
	define('SITE_ROOT_DIR', SERVER_ROOT . FRAMEWORK_ROOT);
	define('_WSEXEC', WEB_TYPE);
}
else {
	define('SITE_ROOT_DIR', SERVER_ROOT . $_SERVER['DOCUMENT_ROOT'] . FRAMEWORK_ROOT);
	define('_WSEXEC', SCRIPT_TYPE);
}

if (!defined('UPLOAD_ROOT')) {
	define('UPLOAD_ROOT', SITE_ROOT_DIR . UPLOADS_PATH);
}

// ====================================
// Global Intialization
// ====================================

	// require
	require_once(SITE_ROOT_DIR . LIBS_PATH . SMARTY_ROOT . 'libs/Smarty.class.php');
	require_once(SITE_ROOT_DIR . WORKSPACE_PATH . 'use_workspace.php');
	require_once(SITE_ROOT_DIR . LIBS_PATH . LOG4PHP_ROOT . 'Logger.php');
	require_once(SITE_ROOT_DIR . LIBS_PATH . SMARTORM_ROOT . 'smart_orm.php');
	require_once(SITE_ROOT_DIR . LIBS_PATH . LESSPHP_ROOT . 'lessc.inc.php');
	require_once(SITE_ROOT_DIR . LIBS_PATH . ONESHEET_ROOT . 'autoload.php');
	require_once(SITE_ROOT_DIR . LIBS_PATH . PHPMAILER_ROOT . 'src/Exception.php');
	require_once(SITE_ROOT_DIR . LIBS_PATH . PHPMAILER_ROOT . 'src/PHPMailer.php');
	require_once(SITE_ROOT_DIR . LIBS_PATH . PHPMAILER_ROOT . 'src/SMTP.php');
	require_once(SITE_ROOT_DIR . WORKSPACE_PATH . 'contentlib.php');
	require_once(SITE_ROOT_DIR . LIBS_PATH . DOMPDF_ROOT . 'autoload.inc.php');

	// Logger
	Logger::configure(SITE_ROOT_DIR . INCLUDES_PATH . 'log4php.xml');

	// Init workspace
	$sessionServer= '';
	if (SESSION_SERVER and isset($_SERVER['SERVER_NAME'])) {
		$host = explode('.', $_SERVER['SERVER_NAME']);
		if (count($host) == 2) {
			$sessionServer = $host[count($host) - 2] . '.' . $host[count($host) - 1];
		}
	}
	$ws = workspace::ws_open(SITE_BASE, CONNEXION_DURATION, CACHE_DURATION, $sessionServer);

	// Global
	$ws->paramSet('CALL_TYPE', _WSEXEC);
	$ws->paramSet('SITE_TITLE', SITE_TITLE);
	
	$ws->paramSet('CSS_COMBINE', CSS_COMBINE);
	$ws->paramSet('JS_COMBINE', JS_COMBINE);
	$ws->urlRewritingSet(URL_REWRITING);
	$ws->errorPageSet(ERROR_PAGE);

	// absolute Path
	$ws->paramSet('SITE_DIR', SITE_ROOT_DIR);
	$ws->paramSet('API_DIR', SITE_ROOT_DIR . DEFAULT_PATH . API_PATH);
	$ws->paramSet('APPS_DIR', SITE_ROOT_DIR . APPS_PATH);
	$ws->paramSet('ARCHIVE_DIR', SITE_ROOT_DIR . ARCHIVE_PATH);
	$ws->paramSet('CACHE_DIR', SITE_ROOT_DIR . CACHE_PATH);
	$ws->paramSet('CLASSES_DIR', SITE_ROOT_DIR . CLASSES_PATH);
	$ws->paramSet('COMPILE_DIR', SITE_ROOT_DIR . COMPILE_PATH);
	$ws->paramSet('FILES_DIR', SITE_ROOT_DIR . FILES_PATH);
	$ws->paramSet('IMAGES_DIR', SITE_ROOT_DIR . IMAGES_PATH);
	$ws->paramSet('INCLUDES_DIR', SITE_ROOT_DIR . INCLUDES_PATH);
	$ws->paramSet('LANGUAGE_DIR', SITE_ROOT_DIR . LANGUAGE_PATH);
	$ws->paramSet('LIBS_DIR', SITE_ROOT_DIR . LIBS_PATH);
	$ws->paramSet('LOGS_DIR', SITE_ROOT_DIR . LOGS_PATH);
	$ws->paramSet('MODELS_DIR', SITE_ROOT_DIR . MODELS_PATH);
	$ws->paramSet('MODULES_DIR', SITE_ROOT_DIR . MODULES_PATH);
	$ws->paramSet('PLUGINS_DIR', SITE_ROOT_DIR . PLUGINS_PATH);
	$ws->paramSet('SCRIPTS_DIR', SITE_ROOT_DIR . SCRIPTS_PATH);
	$ws->paramSet('TEMPLATES_CSS_DIR', SITE_ROOT_DIR . TEMPLATES_CSS_PATH);
	$ws->paramSet('TEMPLATES_JS_DIR', SITE_ROOT_DIR . TEMPLATES_JS_PATH);
	$ws->paramSet('TEMPLATES_SRC_DIR', SITE_ROOT_DIR . TEMPLATES_SRC_PATH);
	$ws->paramSet('PAGES_DIR', SITE_ROOT_DIR . PAGES_PATH);

	$ws->paramSet('UPLOADS_DIR', UPLOAD_ROOT);

	// relatif Path
	$ws->paramSet('RELA_APPS_DIR', RELA_PATH . APPS_PATH);
	$ws->paramSet('RELA_CACHE_DIR', RELA_PATH . CACHE_PATH);
	$ws->paramSet('RELA_CLASSES_DIR', RELA_PATH . CLASSES_PATH);
	$ws->paramSet('RELA_COMPILE_DIR', RELA_PATH . COMPILE_PATH);
	$ws->paramSet('RELA_IMAGES_DIR', RELA_PATH . IMAGES_PATH);
	$ws->paramSet('RELA_INCLUDES_DIR', RELA_PATH . INCLUDES_PATH);
	$ws->paramSet('RELA_LANGUAGE_DIR', RELA_PATH . LANGUAGE_PATH);
	$ws->paramSet('RELA_LIBS_DIR', RELA_PATH . LIBS_PATH);
	$ws->paramSet('RELA_LOGS_DIR', RELA_PATH . LOGS_PATH);
	$ws->paramSet('RELA_MODELS_DIR', RELA_PATH . MODELS_PATH);
	$ws->paramSet('RELA_MODULES_DIR', RELA_PATH . MODULES_PATH);
	$ws->paramSet('RELA_PLUGINS_DIR', RELA_PATH . PLUGINS_PATH);
	$ws->paramSet('RELA_TEMPLATES_CSS_DIR', RELA_PATH . TEMPLATES_CSS_PATH);
	$ws->paramSet('RELA_TEMPLATES_JS_DIR', RELA_PATH . TEMPLATES_JS_PATH);
	$ws->paramSet('RELA_TEMPLATES_SRC_DIR', RELA_PATH . TEMPLATES_SRC_PATH);
	$ws->paramSet('RELA_PAGES_DIR', RELA_PATH . PAGES_PATH);

	$ws->paramSet('RELA_BOOTSTRAP_DIR', $ws->paramGet('RELA_LIBS_DIR') . BOOTSTRAP_ROOT);
	$ws->paramSet('RELA_TYPEAHEAD_DIR', $ws->paramGet('RELA_LIBS_DIR') . TYPEAHEAD_ROOT);
	$ws->paramSet('RELA_TAGSINPUT_DIR', $ws->paramGet('RELA_LIBS_DIR') . TAGSINPUT_ROOT);
	$ws->paramSet('RELA_TREEVIEW_DIR', $ws->paramGet('RELA_LIBS_DIR') . TREEVIEW_ROOT);
	$ws->paramSet('RELA_CKEDITOR_DIR', $ws->paramGet('RELA_LIBS_DIR') . CKEDITOR_ROOT);
	$ws->paramSet('RELA_CHARTJS_DIR', $ws->paramGet('RELA_LIBS_DIR') . CHARTJS_ROOT);
	$ws->paramSet('RELA_DATEPICKER_DIR', $ws->paramGet('RELA_LIBS_DIR') . DATEPICKER_ROOT);
	$ws->paramSet('RELA_FONTAWESOME_DIR', $ws->paramGet('RELA_LIBS_DIR') . FONTAWESOME_ROOT);
	$ws->paramSet('RELA_JQUERY_DIR', $ws->paramGet('RELA_LIBS_DIR') . JQUERY_ROOT);
	$ws->paramSet('RELA_JQUERYUI_DIR', $ws->paramGet('RELA_LIBS_DIR') . JQUERYUI_ROOT);
	$ws->paramSet('RELA_TETHER_DIR', $ws->paramGet('RELA_LIBS_DIR') . TETHER_ROOT);
	$ws->paramSet('RELA_WORKSPACE_DIR', RELA_PATH . WORKSPACE_PATH);

// ====================================
// Librairies initialization
// ====================================

	// Bootstrap library
	$ws->paramSet('RELA_BOOTSTRAP_CSS_DIR', $ws->paramGet('RELA_BOOTSTRAP_DIR') .'css/');
	$ws->paramSet('RELA_BOOTSTRAP_JS_DIR', $ws->paramGet('RELA_BOOTSTRAP_DIR') .'js/');
	$ws->paramSet('BOOTSTRAP_CSS_FILE', 'bootstrap.min.css');
//	$ws->paramSet('BOOTSTRAP_JS_FILE', 'bootstrap.min.js');
	$ws->paramSet('BOOTSTRAP_JS_FILE', 'bootstrap.bundle.min.js');

	// Bootstrap TYPEAHEAD library
	$ws->paramSet('RELA_TYPEAHEAD_JS_DIR', $ws->paramGet('RELA_TYPEAHEAD_DIR') .'js/');
	$ws->paramSet('TYPEAHEAD_JS_FILE', 'typeahead.js');
	
	// Bootstrap tagsinput library
	$ws->paramSet('RELA_TAGSINPUT_CSS_DIR', $ws->paramGet('RELA_TAGSINPUT_DIR') .'css/');
	$ws->paramSet('RELA_TAGSINPUT_JS_DIR', $ws->paramGet('RELA_TAGSINPUT_DIR') .'js/');
	$ws->paramSet('TAGSINPUT_CSS_FILE', 'tagsinput.css');
	$ws->paramSet('TAGSINPUT_JS_FILE', 'tagsinput.js');
	
	// Bootstrap treeview library
	$ws->paramSet('RELA_TREEVIEW_CSS_DIR', $ws->paramGet('RELA_TREEVIEW_DIR') .'css/');
	$ws->paramSet('RELA_TREEVIEW_JS_DIR', $ws->paramGet('RELA_TREEVIEW_DIR') .'js/');
	$ws->paramSet('TREEVIEW_CSS_FILE', 'bootstrap-treeview.css');
	$ws->paramSet('TREEVIEW_JS_FILE', 'bootstrap-treeview.js');
	
	// Ckeditor library
	$ws->paramSet('RELA_CKEDITOR_JS_DIR', $ws->paramGet('RELA_CKEDITOR_DIR'));
	$ws->paramSet('CKEDITOR_JS_FILE', 'ckeditor.js');

	// Chartjs library
	$ws->paramSet('RELA_CHARTJS_JS_DIR', $ws->paramGet('RELA_CHARTJS_DIR') .'js/');
	$ws->paramSet('CHARTJS_JS_FILE', 'chart.bundle.min.js');

	// Datepicker library
	$ws->paramSet('RELA_DATEPICKER_CSS_DIR', $ws->paramGet('RELA_DATEPICKER_DIR') .'css/');
	$ws->paramSet('RELA_DATEPICKER_JS_DIR', $ws->paramGet('RELA_DATEPICKER_DIR') .'js/');
	$ws->paramSet('DATEPICKER_CSS_FILE', 'datepicker.css');
	$ws->paramSet('DATEPICKER_JS_FILE', 'bootstrap-datepicker.js');
	
	// Font Awesome library
	$ws->paramSet('RELA_FONTAWESOME_CSS_DIR', $ws->paramGet('RELA_FONTAWESOME_DIR') .'css/');
	$ws->paramSet('FONTAWESOME_CSS_FILE', 'font-awesome.css');
	
	// Jquery library
	$ws->paramSet('RELA_JQUERY_JS_DIR', $ws->paramGet('RELA_JQUERY_DIR') .'js/');
	$ws->paramSet('JQUERY_JS_FILE', 'jquery.min.js');

	// Jquery UI library
	$ws->paramSet('RELA_JQUERYUI_CSS_DIR', $ws->paramGet('RELA_JQUERYUI_DIR') .'css/');
	$ws->paramSet('RELA_JQUERYUI_JS_DIR', $ws->paramGet('RELA_JQUERYUI_DIR') .'js/');
	$ws->paramSet('JQUERYUI_CSS_FILE', 'jquery-ui.css');
	$ws->paramSet('JQUERYUI_JS_FILE', 'jquery-ui.min.js');	
	
	// Tether library
	$ws->paramSet('RELA_TETHER_JS_DIR', $ws->paramGet('RELA_TETHER_DIR') .'js/');
	$ws->paramSet('TETHER_JS_FILE', 'tether.min.js');

	// workspace library
	$ws->paramSet('RELA_WORKSPACE_CSS_DIR', $ws->paramGet('RELA_WORKSPACE_DIR') .'css/');
	$ws->paramSet('RELA_WORKSPACE_JS_DIR', $ws->paramGet('RELA_WORKSPACE_DIR') .'js/');
	$ws->paramSet('WORKSPACE_JS_FILE', 'workspace.js');
	$ws->paramSet('GRAPH_JS_FILE', 'graph.js');
	$ws->paramSet('WORKSPACE_CSS_FILE', 'workspace.css');

	// Css files
	$ws->addcss($ws->paramGet('RELA_JQUERYUI_CSS_DIR') . $ws->paramGet('JQUERYUI_CSS_FILE'));
	$ws->addcss($ws->paramGet('RELA_BOOTSTRAP_CSS_DIR') . $ws->paramGet('BOOTSTRAP_CSS_FILE'), false);
	$ws->addcss($ws->paramGet('RELA_TAGSINPUT_CSS_DIR') . $ws->paramGet('TAGSINPUT_CSS_FILE'));
	$ws->addcss($ws->paramGet('RELA_TREEVIEW_CSS_DIR') . $ws->paramGet('TREEVIEW_CSS_FILE'));
	$ws->addcss($ws->paramGet('RELA_DATEPICKER_CSS_DIR') . $ws->paramGet('DATEPICKER_CSS_FILE'));
	$ws->addcss($ws->paramGet('RELA_WORKSPACE_CSS_DIR') . $ws->paramGet('WORKSPACE_CSS_FILE'));
	$ws->addcss($ws->paramGet('RELA_FONTAWESOME_CSS_DIR') . $ws->paramGet('FONTAWESOME_CSS_FILE'), false);
	
	// Javascript files
	$ws->addjs($ws->paramGet('RELA_JQUERY_JS_DIR') . $ws->paramGet('JQUERY_JS_FILE'));
	$ws->addjs($ws->paramGet('RELA_TETHER_JS_DIR') . $ws->paramGet('TETHER_JS_FILE'));
	$ws->addjs($ws->paramGet('RELA_JQUERYUI_JS_DIR') . $ws->paramGet('JQUERYUI_JS_FILE'));
	$ws->addjs($ws->paramGet('RELA_BOOTSTRAP_JS_DIR') . $ws->paramGet('BOOTSTRAP_JS_FILE'), false);
	$ws->addjs($ws->paramGet('RELA_TYPEAHEAD_JS_DIR') . $ws->paramGet('TYPEAHEAD_JS_FILE'));
	$ws->addjs($ws->paramGet('RELA_TAGSINPUT_JS_DIR') . $ws->paramGet('TAGSINPUT_JS_FILE'));
	$ws->addjs($ws->paramGet('RELA_TREEVIEW_JS_DIR') . $ws->paramGet('TREEVIEW_JS_FILE'));
	$ws->addjs($ws->paramGet('RELA_CHARTJS_JS_DIR') . $ws->paramGet('CHARTJS_JS_FILE'));
	$ws->addjs($ws->paramGet('RELA_DATEPICKER_JS_DIR') . $ws->paramGet('DATEPICKER_JS_FILE'));
	$ws->addjs($ws->paramGet('RELA_WORKSPACE_JS_DIR') . $ws->paramGet('WORKSPACE_JS_FILE'));
	$ws->addjs($ws->paramGet('RELA_WORKSPACE_JS_DIR') . $ws->paramGet('GRAPH_JS_FILE'));
	$ws->addjs($ws->paramGet('RELA_LANGUAGE_DIR').$ws->sessionGet('lang').'/message_js.js');

// ====================================
// Classes initialization
// ====================================
	require_once($ws->paramGet('CLASSES_DIR') . 'use_object.php');
	require_once($ws->paramGet('CLASSES_DIR') . 'use_object_rest.php');
	require_once($ws->paramGet('CLASSES_DIR') . 'use_api.php');
	require_once($ws->paramGet('CLASSES_DIR') . 'classes.php');

	// Modules initialization
	require_once($ws->paramGet('MODULES_DIR') . 'modules.php');

	// Plugins initialization
	require_once($ws->paramGet('PLUGINS_DIR') . 'plugins.php');
// ====================================
// Params
// ====================================

	// Default params initialization
	$app = '';
	$app_only = '';
	$page = '';
	$pageSpec = '';
	$script = '';
	$module = '';
	$mode = '';
	$root = '';
	$id = 0;
	$id2 = 0;
	$httpVerb = 'GET';
	$combineFlag = true;
	$cacheFlag = true;
	$application_id = 0;
	$application_name = '';
	$contentPage = '';
	$forumSubjectPage = '';
	$forumTopicPage = '';
	// Default rights initialization
	$create = 0;
	$read = 0;
	$update = 0;
	$delete = 0;
	$event = 0;	

	// Read params
	if ($ws->script()) {
		$app = $ws->keyValue($argv,'app');
		$page = $ws->keyValue($argv,'page');
		$pageSpec = $ws->keyValue($argv,'spec');
		$script = $ws->keyValue($argv,'script');
		$module = $ws->keyValue($argv,'module');
		$mode = $ws->keyValue($argv,'mode');
		$id = $ws->keyValue($argv,'id');
		$id2 = $ws->keyValue($argv,'id2');
	}
	else {
		$app = $ws->argGet('app');
		$page = $ws->argGet('page');
		$pageSpec = $ws->argGet('spec');
		$module = $ws->argGet('module');
		$mode = $ws->argGet('mode');
		$id = $ws->argGet('id');
		$id2 = $ws->argGet('id2');
		$httpVerb = $_SERVER["REQUEST_METHOD"];
	}
	
	// Save params and rights
	$ws->paramSet('APP_ONLY', $app_only);
	$ws->paramSet('APP_CODE', $app);
	$ws->paramSet('PAGE_NAME', $page);
	$ws->paramSet('PAGE_SPEC', $pageSpec);
	$ws->paramSet('SCRIPT_NAME', $script);
	$ws->paramSet('MODULE_NAME', $module);
	$ws->paramSet('MODE_NAME', $mode);
	$ws->paramSet('ROOT_URL', $root);
	$ws->paramSet('ID', $id);
	$ws->paramSet('ID2', $id2);
	$ws->paramSet('HTTP_VERB', $httpVerb);
	$ws->paramSet('COMBINE_FLAG', $combineFlag);
	$ws->paramSet('CACHE_FLAG', $cacheFlag);
	$ws->paramSet('APP_ID', $application_id);	
	$ws->paramSet('APP_NAME', $application_name);
	$ws->paramSet('CONTENT_PAGE', $contentPage);
	$ws->paramSet('FORUM_SUBJECT_PAGE', $forumSubjectPage);
	$ws->paramSet('FORUM_TOPIC_PAGE', $forumTopicPage);
	$ws->paramSet('RIGHT_CREATE', $create);
	$ws->paramSet('RIGHT_READ', $read);
	$ws->paramSet('RIGHT_UPDATE', $update);
	$ws->paramSet('RIGHT_DELETE', $delete);
	$ws->paramSet('RIGHT_EVENT', $event);
	
	// Default users initialization
	if (defined('USER_GUEST')) {
		$ws->paramSet('USER_GUEST', USER_GUEST);
	}
	else {
		$ws->paramSet('USER_GUEST', "");		
	}
	if (defined('USER_SUPERADMIN')) {
		$ws->paramSet('USER_SUPERADMIN', USER_SUPERADMIN);
	}
	else {
		$ws->paramSet('USER_SUPERADMIN', "");		
	}
	if (defined('USER_DEFAULT')) {
		$ws->paramSet('USER_DEFAULT', USER_DEFAULT);
	}
	else {
		$ws->paramSet('USER_DEFAULT', "");		
	}

// ====================================
// Analyse application
// ====================================	
	$connect = new object_connect();
	if (_WSEXEC <> SCRIPT_TYPE ) {
		$connect->analyseApp();
	}
	$ws->paramSet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR', SITE_ROOT_DIR . APPS_PATH . $ws->paramGet('APP_NAME') . '/' . INCLUDES_PATH);

	// require App config
	if ($ws->paramGet('APP_NAME') != '') {
		$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'config.php';
		if (file_exists($filePath)) {
			require_once($filePath);
		}
	}
	
	// require clesses extension with application
	require_once($ws->paramGet('CLASSES_DIR') . 'classes_extend.php');
	
// ====================================
// Analyse Params and access control
// ====================================

	$connect = new object_connect();
	if (!$ws->connected() and ($ws->paramGet('USER_GUEST') <> "")) {
		$connect->connectGuest($ws->paramGet('USER_GUEST'));
	}

	if ($ws->userConnected()) {
		$ws->addjs($ws->paramGet('RELA_CKEDITOR_JS_DIR') . $ws->paramGet('CKEDITOR_JS_FILE'), false);
	}

	// Analyse Param
	if (_WSEXEC <> SCRIPT_TYPE ) {
		$connect->analyseParam();
	}
	
	// Access control
	$connect->controlAccess();

	$urlLink = '';
	if ($ws->paramGet('ID') == '') {
		$urlLink = $connect->constructHref($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'));
	}
	else {
		$urlLink = $connect->constructHref($ws->paramGet('APP_CODE'), 'id:' . $ws->paramGet('ID'));		
	}
	$application = $connect->appFind($ws->paramGet('APP_CODE'))->returnGet();

	$urlCanonical = '';
	$keyWords = '';
	if (isset($application['canonical'])) {
		$urlCanonical = $application['canonical'];
		$keyWords = $application['keywords'];
	}
	if ($urlCanonical == '') {
		$urlLink = preg_replace('#^\./#Usi', $ws->baseUrlGet() , $urlLink);
	}
	else {
		$urlLink = preg_replace('#^\./' . strtolower($ws->paramGet('APP_CODE')) . '/#Usi', $urlCanonical . '/' , $urlLink);
		$urlLink = preg_replace('#^\./#Usi', $urlCanonical . '/' , $urlLink);
	}
	$ws->urlLinkSet($urlLink);
	$ws->canonicalSet($urlCanonical);
	$ws->keywordsSet($keyWords);

// ====================================
// Application initialization
// ====================================	
	if (empty($ws->paramGet('MODE_NAME'))) {
		$ws->logSys('info', 'call - App : ' . $ws->paramGet('APP_CODE') . ' - Module : ' . $ws->paramGet('MODULE_NAME') . ' - Page : ' . $ws->paramGet('PAGE_NAME') . ' - Script : ' . $ws->paramGet('SCRIPT_NAME'), 'Main');
	}
	else {
		$ws->logSys('info', 'call - App : ' . $ws->paramGet('APP_CODE') . ' - Module : ' . $ws->paramGet('MODULE_NAME') . ' - Page : ' . strtolower($ws->paramGet('MODE_NAME')) . '/' . $ws->paramGet('PAGE_NAME') . ' - Script : ' . $ws->paramGet('SCRIPT_NAME'), 'Main');
	}
	
	$ws->paramSet($ws->paramGet('APP_NAME') . '_DIR', SITE_ROOT_DIR . APPS_PATH . $ws->paramGet('APP_NAME') . '/');		
	$ws->paramSet($ws->paramGet('APP_NAME') . '_CLASSES_DIR', SITE_ROOT_DIR . APPS_PATH . $ws->paramGet('APP_NAME') . '/' . CLASSES_PATH);
	$ws->paramSet($ws->paramGet('APP_NAME') . '_IMAGES_DIR', $ws->paramGet('IMAGES_DIR') . $ws->paramGet('APP_NAME') . '/');
	$ws->paramSet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR', SITE_ROOT_DIR . APPS_PATH . $ws->paramGet('APP_NAME') . '/' . INCLUDES_PATH);
	$ws->paramSet($ws->paramGet('APP_NAME') . '_LANGUAGE_DIR', SITE_ROOT_DIR . APPS_PATH . $ws->paramGet('APP_NAME') . '/' . LANGUAGE_PATH);
	$ws->paramSet($ws->paramGet('APP_NAME') . '_MODULES_DIR', SITE_ROOT_DIR . APPS_PATH . $ws->paramGet('APP_NAME') . '/' . MODULES_PATH);
	$ws->paramSet($ws->paramGet('APP_NAME') . '_PAGES_DIR', SITE_ROOT_DIR . APPS_PATH . $ws->paramGet('APP_NAME') . '/' . PAGES_PATH);
	$ws->paramSet($ws->paramGet('APP_NAME') . '_SCRIPTS_DIR', SITE_ROOT_DIR . APPS_PATH . $ws->paramGet('APP_NAME') . '/' . SCRIPTS_PATH);
	$ws->paramSet($ws->paramGet('APP_NAME') . '_TEMPLATES_CSS_DIR', SITE_ROOT_DIR . APPS_PATH . $ws->paramGet('APP_NAME'). '/' . TEMPLATES_CSS_PATH);
	$ws->paramSet($ws->paramGet('APP_NAME') . '_TEMPLATES_JS_DIR', SITE_ROOT_DIR . APPS_PATH . $ws->paramGet('APP_NAME'). '/' . TEMPLATES_JS_PATH);
	$ws->paramSet($ws->paramGet('APP_NAME') . '_TEMPLATES_SRC_DIR', SITE_ROOT_DIR . APPS_PATH . $ws->paramGet('APP_NAME') . '/' . TEMPLATES_SRC_PATH);

	$ws->paramSet($ws->paramGet('APP_NAME') . '_RELA_IMAGES_DIR', $ws->paramGet('RELA_IMAGES_DIR') . $ws->paramGet('APP_NAME') . '/');
	$ws->paramSet($ws->paramGet('APP_NAME') . '_RELA_TEMPLATES_CSS_DIR', RELA_PATH . APPS_PATH . $ws->paramGet('APP_NAME'). '/' . TEMPLATES_CSS_PATH);
	$ws->paramSet($ws->paramGet('APP_NAME') . '_RELA_TEMPLATES_JS_DIR', RELA_PATH . APPS_PATH . $ws->paramGet('APP_NAME'). '/' . TEMPLATES_JS_PATH);

	$ws->paramSet($ws->paramGet('APP_NAME') . '_API_DIR', SITE_ROOT_DIR . APPS_PATH . $ws->paramGet('APP_NAME') . '/' . API_PATH);
	$ws->paramSet($ws->paramGet('APP_NAME') . '_WS_DIR', SITE_ROOT_DIR . APPS_PATH . $ws->paramGet('APP_NAME') . '/' . WS_PATH);
	$ws->paramSet($ws->paramGet('APP_NAME') . '_XML_DIR', SITE_ROOT_DIR . APPS_PATH . $ws->paramGet('APP_NAME') . '/' . XML_PATH);

	
// ====================================
// Assigns
// ====================================

	// Template css
	$ws->paramSet('TEMPLATE_STYLE', 'template.css');

	// Template js
	$ws->paramSet('TEMPLATE_JS', 'template.js');

	// Css files
	$filePath = $ws->paramGet('TEMPLATES_CSS_DIR') . $ws->paramGet('TEMPLATE_STYLE');
	if (file_exists($filePath)) {
		$filePath = $ws->paramGet('RELA_TEMPLATES_CSS_DIR') . $ws->paramGet('TEMPLATE_STYLE');
		$ws->addcss($filePath);
	}

	// Javascript files
	$filePath = $ws->paramGet('TEMPLATES_JS_DIR') . $ws->paramGet('TEMPLATE_JS');
	if (file_exists($filePath)) {
		$filePath = $ws->paramGet('RELA_TEMPLATES_JS_DIR') . $ws->paramGet('TEMPLATE_JS');
		$ws->addjs($filePath);
	}

	// App Classes initialization
	if ($ws->paramGet('APP_NAME') != '') {
		$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_CLASSES_DIR') . 'classes.php';
		if (file_exists($filePath)) {	
			require_once($filePath);
		}
	}

// ====================================
// defines for apps
// ====================================
	// Coookies initialization
	if (!defined('COOKIE')) {
		define('COOKIE', '');
	}
	if (defined('APP_COOKIE')) {
		$ws->paramSet('COOKIE', APP_COOKIE);
	}
	else {
		$ws->paramSet('COOKIE', COOKIE);
	}
	
	if (!defined('COOKIE_PARAM')) {
		define('COOKIE_PARAM', true);
	}
	if (defined('APP_COOKIE_PARAM')) {
		$ws->paramSet('COOKIE_PARAM', APP_COOKIE_PARAM);
	}
	else {
		$ws->paramSet('COOKIE_PARAM', COOKIE_PARAM);
	}

	// Cache initialization
	if (!defined('BROWSER_CACHE')) {
		define('BROWSER_CACHE', true);
	}
	if (defined('APP_BROWSER_CACHE')) {
		$ws->paramSet('BROWSER_CACHE', APP_BROWSER_CACHE);
	}
	else {
		$ws->paramSet('BROWSER_CACHE', BROWSER_CACHE);
	}

	// Image path initialization
	if (!defined('APP_IMAGES_PATH')) {
		define('APP_IMAGES_PATH', RELA_PATH . IMAGES_PATH . $ws->paramGet('APP_NAME'). '/');
	}
	$ws->paramSet('APP_IMAGES_PATH', APP_IMAGES_PATH);
	$ws->paramSet('APP_IMAGES_DIR', preg_replace('#^\./#Usi', SITE_ROOT_DIR, APP_IMAGES_PATH));

	// Content initialization
	if (defined('APP_CODE_CONTENT')) {
		$ws->paramSet('APP_CODE_CONTENT',APP_CODE_CONTENT);
	}
	else {
		$ws->paramSet('APP_CODE_CONTENT', $ws->paramGet('APP_CODE'));
	}
	if (defined('APP_ID_CONTENT')) {
		$ws->paramSet('APP_ID_CONTENT', APP_ID_CONTENT);
	}
	else {
		$ws->paramSet('APP_ID_CONTENT', $ws->paramGet('APP_ID'));
	}

	// Favicon
	$filePath = $ws->paramGet('APP_IMAGES_DIR') . 'favicon.ico';
	if (file_exists($filePath)) {
		$ws->faviconSet($ws->paramGet('APP_IMAGES_PATH') . 'favicon.ico');
	}
	else {
		$filePath = SITE_ROOT_DIR . 'favicon.ico';
		if (file_exists($filePath)) {
			$ws->faviconSet('./favicon.ico');
		}
	}

// ====================================
// Smarty initialization
// ====================================
	$ws->setTemplateDir(array());
	if ($ws->paramGet('APP_NAME') != '') {
		$ws->addTemplateDir($ws->paramGet($ws->paramGet('APP_NAME') . '_TEMPLATES_SRC_DIR'));
	}
	$ws->addTemplateDir($ws->paramGet('TEMPLATES_SRC_DIR'));	
	if ($ws->paramGet('CACHE_FLAG')) {
		if (defined('APP_SMARTY_CACHE')) {
			$ws->caching = APP_SMARTY_CACHE;
		}
		else {
			$ws->caching = SMARTY_CACHE;
		}
	}
	else {
		$ws->caching = false;		
	}

	if (defined('APP_SMARTY_COMPILE_CHECK')) {
		$ws->compile_check = APP_SMARTY_COMPILE_CHECK;
	}
	else {
		$ws->compile_check = SMARTY_COMPILE_CHECK;
	}
	
	if (defined('APP_SMARTY_FORCE_COMPILE')) {
		$ws->force_compile = APP_SMARTY_FORCE_COMPILE;	
	}
	else {
		$ws->force_compile = SMARTY_FORCE_COMPILE;	
	}
	
	initWorkConfig($ws);

// ====================================
// Assigns
// ====================================
	$ws->assign('App_code',$ws->paramGet('APP_CODE'));
	$ws->assign('App_name',$ws->paramGet('APP_NAME'));
	$ws->assign('body','');

	if (defined('APP_LOCAL_PARAM')) {
		$ws->paramSet('LOCAL_PARAM', APP_LOCAL_PARAM);
	}
	else {
		$ws->paramSet('LOCAL_PARAM', LOCAL_PARAM);
	}
	if (defined('APP_LOCAL_LANGUAGE')) {
		$ws->paramSet('LOCAL_LANGUAGE', APP_LOCAL_LANGUAGE);
	}
	else {
		$ws->paramSet('LOCAL_LANGUAGE', LOCAL_LANGUAGE);
	}
	if (defined('APP_LOCAL_ZONE')) {
		$ws->paramSet('LOCAL_ZONE', APP_LOCAL_ZONE);
	}
	else {
		$ws->paramSet('LOCAL_ZONE', LOCAL_ZONE);
	}
	if (defined('APP_LOCAL_DATE_FORMAT')) {
		$ws->paramSet('LOCAL_DATE_FORMAT', APP_LOCAL_DATE_FORMAT);
	}
	else {
		$ws->paramSet('LOCAL_DATE_FORMAT', LOCAL_DATE_FORMAT);
	}

	if (defined('APP_PARTNER_ID')) {
		$ws->paramSet('PARTNER_ID', APP_PARTNER_ID);
	}
	else {
		$ws->paramSet('PARTNER_ID', PARTNER_ID);
	}

	if (defined('APP_TRACE_NAME')) {
		$ws->paramSet('TRACE_NAME', APP_TRACE_NAME);
	}
	else {
		if (defined('TRACE_NAME')) {
			$ws->paramSet('TRACE_NAME', TRACE_NAME);
		}
		else {
			$ws->paramSet('TRACE_NAME', $ws->paramGet('APP_CODE'));
		}
	}

	setlocale(LC_ALL, $ws->paramGet('LOCAL_PARAM'), $ws->paramGet('LOCAL_LANGUAGE'));;
	
?>