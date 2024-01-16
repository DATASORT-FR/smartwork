<?php
/**
* Login class
*
* @package    module_login
* @version    1.5
* @date       17 April 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('LOGIN_NAME', 'login');

// Connect Path
$ws->paramSet($ws->paramGet('LOGIN_NAME') . '_TEMPLATES_SRC_DIR', $ws->paramGet('MODULES_DIR') . $ws->paramGet('LOGIN_NAME') . '/' . TEMPLATES_SRC_PATH);
$ws->paramSet($ws->paramGet('LOGIN_NAME') . '_TEMPLATES_CSS_DIR', $ws->paramGet('RELA_MODULES_DIR') . $ws->paramGet('LOGIN_NAME') . '/' . TEMPLATES_CSS_PATH);
$ws->paramSet($ws->paramGet('LOGIN_NAME') . '_TEMPLATES_JS_DIR', $ws->paramGet('RELA_MODULES_DIR') . $ws->paramGet('LOGIN_NAME') . '/' . TEMPLATES_JS_PATH);

// Template css & js
$ws->paramSet($ws->paramGet('LOGIN_NAME') . '_TEMPLATE_STYLE', $ws->paramGet('LOGIN_NAME') . '.css');
$ws->paramSet($ws->paramGet('LOGIN_NAME') . '_TEMPLATE_JS', $ws->paramGet('LOGIN_NAME') . '.js');

$ws->addcss($ws->paramGet($ws->paramGet('LOGIN_NAME') . '_TEMPLATES_CSS_DIR') . $ws->paramGet($ws->paramGet('LOGIN_NAME') . '_TEMPLATE_STYLE'));
$ws->addjs($ws->paramGet($ws->paramGet('LOGIN_NAME') . '_TEMPLATES_JS_DIR') . $ws->paramGet($ws->paramGet('LOGIN_NAME') . '_TEMPLATE_JS'));

/**
* Classes for login module.
*/
class wlogin
{

    public function __construct() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

    }

    function displayLogged($style = 'default') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$smarty = new workpage();
		$smarty->template_dir = $ws->paramGet($ws->paramGet('LOGIN_NAME') . '_TEMPLATES_SRC_DIR') ;

		$display_html = '';
		$connect = new object_connect();
		if ($ws->userConnected()) {
			$userId = $ws->connected_id();
			$logoutSuccess = $connect->constructHref($ws->paramGet('APP_CODE'));

			$login = '';
			$surname = '';
			$email = '';
			$fct_return = $connect->display($userId);
			if ($fct_return->statusGet()) {
				if($fct_return->returnGet()['id'] != 0) {
					$array_login = $fct_return->returnGet();
					$login = $array_login['login'];
					$surname = $array_login['surname'];
					$email = $array_login['email'];
				}
			}
			$smarty->assign('Style',$style);
			$smarty->assign('LogoutAction',$connect->constructHref($ws->paramGet('APP_CODE'), "disconnect", "module:" . $ws->paramGet('LOGIN_NAME')));
			$smarty->assign('LogoutSuccess',$logoutSuccess);
			$smarty->assign('FlagConnect',$ws->userConnected());
			$smarty->assign('ConnectName',$ws->connected_name());
			$smarty->assign('ConnectLogin',$login);
			$smarty->assign('ConnectSurName',$surname);
			$smarty->assign('ConnectEmail',$email);
			$display_html = $smarty->fetch('logged.tpl');
		}
		
		return $display_html;
	}

    function displayConnect($style = 'default', $labelFlagLogin = true, $labelFlagPassword = -1, $loginSuccess = '') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$smarty = new workpage();
		$smarty->template_dir = $ws->paramGet($ws->paramGet('LOGIN_NAME') . '_TEMPLATES_SRC_DIR') ;

		$connect = new object_connect();
		if ($ws->userConnected()) {
			$display_html = $this->displayLogged($style);
		}
		else {
			if (isset($_COOKIE['sw_login'])) {
				$login_value = $_COOKIE['sw_login'];
			}
			else {
				$login_value = '';
			}
			if ($labelFlagPassword == -1) {
				$labelFlagPassword = $labelFlagLogin;
			}
			$connect = new object_connect();
			if (empty($loginSuccess)) {
				$loginSuccess = $connect->constructHref($ws->paramGet('APP_CODE'));
			}
			$smarty->assign('Style',$style);
			$smarty->assign('LoginAction',$connect->constructHref($ws->paramGet('APP_CODE'), "connect", "module:" . $ws->paramGet('LOGIN_NAME')));
			$smarty->assign('LabelFlagLogin',$labelFlagLogin);
			$smarty->assign('LabelFlagPassword',$labelFlagPassword);
			$smarty->assign('LoginSuccess',$loginSuccess);
			$smarty->assign('LoginValue',$login_value);
			$display_html = $smarty->fetch('login.tpl');
		}
		
		return $display_html;
	}

    function displayAccount() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$userId = 0;
		$display_html = '';
		$smarty = new workpage();
		$connect = new object_connect();
		
		$smarty->template_dir = $ws->paramGet($ws->paramGet('LOGIN_NAME') . '_TEMPLATES_SRC_DIR') ;
		if ($ws->sessionGet('connect_id') <> $ws->paramGet('USER_GUEST')) {
			$userId = $ws->connected_id();
		}
		if ($userId != 0) {
			$fct_return = $connect->display($userId);
			if ($fct_return->statusGet()) {
				if($fct_return->returnGet()['id'] != 0) {
					$array_login = $fct_return->returnGet();
					$login = $array_login['login'];
					$name = $array_login['lastname'] . ' ' . $array_login['firstname'];
					$surname = $array_login['surname'];
					$email = $array_login['email'];
					$smarty->assign('LogoutAction',$connect->constructHref($ws->paramGet('APP_CODE'), "disconnect", "module:" . $ws->paramGet('LOGIN_NAME')));
					$smarty->assign('LogoutPage',$connect->constructHref($ws->paramGet('APP_CODE')));
					$smarty->assign('PasswordAction',$connect->constructHref($ws->paramGet('APP_CODE'), "sendmail_password", "module:" . $ws->paramGet('LOGIN_NAME')));
					$smarty->assign('ConnectLogin',$login);
					$smarty->assign('ConnectName',$name);
					$smarty->assign('ConnectSurName',$surname);
					$smarty->assign('ConnectEmail',$email);
					$display_html = $smarty->fetch('account.tpl');
				}
			}
		}
		return $display_html;
	}

    function displayApps($connect_id = 0) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$smarty = new workpage();
		$smarty->setTemplateDir(array());
		$smarty->addTemplateDir($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . '/' . $ws->paramGet('LOGIN_NAME') . '/' . TEMPLATES_SRC_PATH);
		$smarty->addTemplateDir($ws->paramGet($ws->paramGet('LOGIN_NAME') . '_TEMPLATES_SRC_DIR'));
		
		if ($connect_id == 0) {
			$connect_id = $ws->sessionGet('connect_id');
		}
		$app_array = array();
		$connect = new object_connect();
		$fct_return = $connect->displayApps($connect_id);
		if ($fct_return->statusGet()) {
			$app_array = $fct_return->returnGet();
		}
		for($temp=0; $temp < count($app_array); $temp++) {
			$app_item = $app_array[$temp];
			$app_item['href'] = $connect->constructHref($app_item['app']);

			$atemp = explode(';', $app_item['image']);
			$image = '';
			if (isset($atemp[0])) {
				$image = $atemp[0];
			}
			$app_item['image'] = $image;
			$app_array[$temp] = $app_item;
		}
		
		$smarty->assign('app_array',$app_array);
		return $smarty->fetch('apps.tpl');
	}

	// Login display function
	function displayLoginBox() {
		$ws = workspace::ws_open();

		$ws->sessionSet('inscription_id', 0);
		$ws->sessionSet('inscription_name', '');
	
		$smarty = new workpage();
		$smarty->setTemplateDir(array());
		$smarty->addTemplateDir($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . '/' . $ws->paramGet('LOGIN_NAME') . '/' . TEMPLATES_SRC_PATH);
		$smarty->addTemplateDir($ws->paramGet($ws->paramGet('LOGIN_NAME') . '_TEMPLATES_SRC_DIR'));

		$connect = new object_connect();
		$loginAction = $connect->constructHref($ws->paramGet('APP_CODE'), "connect", "module:" . $ws->paramGet('LOGIN_NAME'));
		$inscriptionAction = $connect->constructHref($ws->paramGet('APP_CODE'), "inscription", "module:" . $ws->paramGet('LOGIN_NAME'));
		$passwordAction = $connect->constructHref($ws->paramGet('APP_CODE'), "sendmail_password", "module:" . $ws->paramGet('LOGIN_NAME'));
		$validationAction = $connect->constructHref($ws->paramGet('APP_CODE'), "sendmail_validation", "module:" . $ws->paramGet('LOGIN_NAME'));

		$smarty->assign('LoginAction', $loginAction);
		$smarty->assign('InscriptionAction', $inscriptionAction);
		$smarty->assign('PasswordAction', $passwordAction);
		$smarty->assign('ValidationAction', $validationAction);
	
		return $smarty->fetch('loginblock.tpl');
	}

	// Send validation mail function
	function sendMailValidation($email) {
		$ws = workspace::ws_open();

		$smarty = new workpage();
		$smarty->setTemplateDir(array());
		$smarty->addTemplateDir($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . '/' . $ws->paramGet('LOGIN_NAME') . '/' . TEMPLATES_SRC_PATH);
		$smarty->addTemplateDir($ws->paramGet($ws->paramGet('LOGIN_NAME') . '_TEMPLATES_SRC_DIR'));

		$userId = 0;
		$connect = new object_connect();
		$fct_return = $connect->searchMail($email);
		if ($fct_return->statusGet()) {
			if($fct_return->returnGet()['id'] != 0) {
				$userId = $fct_return->returnGet()['id'];
			}
		}

		if ($userId != 0) {
			$tokenId = '';
			$token = new object_token();
			$fct_return = $token->create($ws->paramGet('APP_CODE'), 'VALIDATION', $userId);
			if ($fct_return->statusGet()) {
				if($fct_return->returnGet()['code'] != '') {
					$tokenId = $fct_return->returnGet()['code'];
				}
			}

			$connect = new object_connect();
			$validationAction = $connect->constructHref($ws->paramGet('APP_CODE'), "user_validation", "module:" . $ws->paramGet('LOGIN_NAME'), "key:" . $tokenId);
			$smarty->assign('validationAction', $validationAction);
		
			$from = $ws->getConfigVars("Mail_from") . ',' . $ws->getConfigVars("Mail_from_name");
			$to = $email;
			$subject = $ws->getConfigVars("Mail_validation_subject");
			$bodyTxt = $ws->getConfigVars("Mail_validation_txt");
			$bodyTxt = preg_replace("#\[link_validation\]#isU", $validationAction, $bodyTxt);
			$bodyHtml = $smarty->fetch('mail_validation.tpl');

			$return = mailSend($from, $to, $subject, $bodyHtml, $bodyTxt);
		}
		else {
			$return = false;
		}

		return $return;
	}
	
	// Validation function
	function validation($tokenId) {
		$ws = workspace::ws_open();

		$userId = 0;
		$login = '';
		$token = new object_token();
		$fct_return = $token->control($tokenId, $ws->paramGet('APP_CODE'), 'VALIDATION');
		if ($fct_return->statusGet()) {
			if($fct_return->returnGet()['user_id'] != '') {
				$userId = $fct_return->returnGet()['user_id'];
				$connect = new object_connect();
				$fct_return = $connect->display($userId);
				if ($fct_return->statusGet()) {
					$login = $fct_return->returnGet()['login'];
				}
			}
		}
		$return = false;
		if ($login != '') {
			$connect = new object_connect();
			$fct_return = $connect->validation($login);
			if ($fct_return->statusGet()) {
				$token->use($tokenId);
				$return = true;
			}
		}
		return $return;
	}

	// Password display function
	function displayPasswordBox($tokenId) {
		$ws = workspace::ws_open();
	
		$token = new object_token();
		$fct_return = $token->control($tokenId, $ws->paramGet('APP_CODE'), 'PASSWORD');
		if ($fct_return->statusGet()) {

			$smarty = new workpage();
			$smarty->setTemplateDir(array());
			$smarty->addTemplateDir($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . '/' . $ws->paramGet('LOGIN_NAME') . '/' . TEMPLATES_SRC_PATH);
			$smarty->addTemplateDir($ws->paramGet($ws->paramGet('LOGIN_NAME') . '_TEMPLATES_SRC_DIR'));

			$connect = new object_connect();
			$passwordAction = $connect->constructHref($ws->paramGet('APP_CODE'), "password", "module:" . $ws->paramGet('LOGIN_NAME'), "key:" . $tokenId);

			$smarty->assign('passwordAction', $passwordAction);
	
			$return = $smarty->fetch('passwordblock.tpl');
		}
		else {
			$return = '<p>'.$ws->getConfigVars("Msg_password_ko").'</p>';
		}
		return $return;
	}

	// Send password mail function
	function sendMailPassword($email) {
		$ws = workspace::ws_open();

		$smarty = new workpage();
		$smarty->setTemplateDir(array());
		$smarty->addTemplateDir($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . '/' . $ws->paramGet('LOGIN_NAME') . '/' . TEMPLATES_SRC_PATH);
		$smarty->addTemplateDir($ws->paramGet($ws->paramGet('LOGIN_NAME') . '_TEMPLATES_SRC_DIR'));

		$userId = 0;
		$connect = new object_connect();
		$fct_return = $connect->searchMail($email);
		if ($fct_return->statusGet()) {
			if ($fct_return->returnGet()['id'] != 0) {
				$userId = $fct_return->returnGet()['id'];
			}
		}

		if ($userId != 0) {
			$tokenId = '';
			$token = new object_token();
			$fct_return = $token->create($ws->paramGet('APP_CODE'), 'PASSWORD', $userId);
			if ($fct_return->statusGet()) {
				if($fct_return->returnGet()['code'] != '') {
					$tokenId = $fct_return->returnGet()['code'];
				}
			}

			$connect = new object_connect();
			$linkPassword = $connect->constructHref($ws->paramGet('APP_CODE'), "user_password", "module:" . $ws->paramGet('LOGIN_NAME'), "key:" . $tokenId);
			$smarty->assign('LinkPassword', $linkPassword);
	
			$from = $ws->getConfigVars("Mail_from") . ',' . $ws->getConfigVars("Mail_from_name");
			$to = $email;
			$subject = $ws->getConfigVars("Mail_password_subject");
			$bodyTxt = $ws->getConfigVars("Mail_password_txt");
			$bodyTxt = preg_replace("#\[link_password\]#isU", $linkPassword, $bodyTxt);
			$bodyHtml = $smarty->fetch('mail_password.tpl');
	
			$return = mailSend($from, $to, $subject, $bodyHtml, $bodyTxt);
		}
		else {
			$return = false;
		}

		return $return;
	}

}

?>