<?php
/**
* This file contains classes and functions for the connection management.
*
* @package    administration_connect
* @version    1.2
* @date       25 November 2013
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the users management.
*/
class object_connect extends BUS_object
{

	/**
	* constructor adm_connect
    *
    * @access public
	*/
    public function __construct()
    {
	}
	
	/**
	* controling process
	*
	* @param string - user login for connection
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
	*         return : array - user informations
	*  			- id : integer
	*  			- login : string
	*  			- status_id : integer
	*
    * @access public
	*/
    public function control($login)
    {
		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		try {
			/**
			* find user with login value by using smartorm
			*/
			$tb_adm_user = new Smart_select('adm_user');
			$tb_adm_user->fieldSet('id');
			$tb_adm_user->fieldSet('login');
			$tb_adm_user->fieldSet('status_id');
			$tb_adm_user->whereSet('login', $login);			
			$array_login = $tb_adm_user->find();
			if ($array_login) {
				$fct_return->returnSet($array_login);
			}
			else {
				$fct_return->returnSet(
					array(
						'id' => 0,
						'login' => '',
						'status_id' => 0
					)
				);
			}
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'Error on function ' . __FUNCTION__ . ' ' . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			$ws->logfunc('error', 'KO_001');
		}
		
		return $fct_return;

	}
	
	/**
	* search user by mail process
	*
	* @param string - user mail
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
	*         return : array - user informations
	*  			- id : integer
	*  			- login : string
	*  			- status_id : integer
	*
    * @access public
	*/
    public function searchMail($email)
    {
		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		try {
			/**
			* find user with login value by using smartorm
			*/
			$tb_adm_user = new Smart_select('adm_user');
			$tb_adm_user->fieldSet('id');
			$tb_adm_user->fieldSet('login');
			$tb_adm_user->fieldSet('email');
			$tb_adm_user->fieldSet('status_id');
			$tb_adm_user->whereSet('email', $email);			
			$array_login = $tb_adm_user->find();
			if ($array_login) {
				$fct_return->returnSet($array_login);
			}
			else {
				$fct_return->returnSet(
					array(
						'id' => 0,
						'login' => '',
						'status_id' => 0
					)
				);
			}
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'Error on function ' . __FUNCTION__ . ' ' . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			$ws->logfunc('error', 'KO_001');
		}
		
		return $fct_return;

	}
	
	/**
	* inscription process
	*
	* @param string - user login for connection
	* @param string - user email for connection
	* @param string - user surname for connection
	* @param string - user password for connection
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
	*         return : array - user informations
	*  			- id : integer
	*
    * @access public
	*/
    public function inscription($login, $email, $surName, $password)
    {
		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		try {
			$tb_adm_user = new Smart_record('adm_user');
			$tb_adm_user->fieldSet('date_creation', date('Y-m-d H:i:s'));
			$tb_adm_user->fieldSet('date_update', date('Y-m-d H:i:s'));				
			$tb_adm_user->fieldSet('login', $login);
			$tb_adm_user->fieldSet('source_id', $ws->paramGet('APP_ID'));
			$tb_adm_user->fieldSet('status_id', 0);
			$tb_adm_user->fieldSet('date_status', date('Y-m-d H:i:s'));				
			$tb_adm_user->fieldSet('email', $email);
			$tb_adm_user->fieldSet('surname', $surName);
			$tb_adm_user->fieldSet('lastname', $login);
			$tb_adm_user->fieldSet('firstname', '');
			$tb_adm_user->fieldSet('password', md5($password));
			$id = $tb_adm_user->insert();
			if ($id != 0) {
				if ($ws->paramGet('PARTNER_ID') != 0) {
					$tb_adm_user_partner = new Smart_record('adm_user_partner');
					$tb_adm_user_partner->fieldSet('user_id', $id);
					$tb_adm_user_partner->fieldSet('partner_id', $ws->paramGet('PARTNER_ID'));
					$tb_adm_user_partner->insert();
				}
				$ws->sessionSet('inscription_id', $id);
				$ws->sessionSet('inscription_name', $login);
				$fct_return->returnSet($id);
			}
			else {
				$fct_return->errorSet();
				$ws->logSys('debug', 'inscription error, login :' . $login, __CLASS__);
				$ws->logfunc('error', 'KO_001');
			}
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'Error on function ' . __FUNCTION__ . ' ' . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			$ws->logfunc('error', 'KO_001');
		}
		
		return $fct_return;
	}
	
	/**
	* validation process
	*
	* @param string - user login for connection
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
	*         return : null
	*
    * @access public
	*/
    public function validation($login)
    {
		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		try {
			/**
			* find user with login value by using smartorm
			*/
			$tb_adm_user = new Smart_select('adm_user');
			$tb_adm_user->fieldSet('id');
			$tb_adm_user->fieldSet('login');
			$tb_adm_user->fieldSet('status_id');
			$tb_adm_user->whereSet('login', $login);			
			$array_login = $tb_adm_user->find();
			if ($array_login) {
				$tb_adm_user = new Smart_record('adm_user');
				$tb_adm_user->idSet($array_login['id']);
				$tb_adm_user->fieldSet('date_update', date('Y-m-d H:i:s'));				
				$tb_adm_user->fieldSet('status_id', 1);
				$tb_adm_user->fieldSet('date_status', date('Y-m-d H:i:s'));				
				$tb_adm_user->update();
				$fct_return->returnSet($array_login['id']);
			}
			else {
				$fct_return->errorSet();
				$ws->logSys('debug', 'login not exist, login :' . $login, __CLASS__);
				$ws->logfunc('error', 'KO_001');
			}
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'Error on function ' . __FUNCTION__ . ' ' . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			$ws->logfunc('error', 'KO_001');
		}
		
		return $fct_return;

	}
	
	/**
	* connecting process
	*
	* @param string - user login for connection
	* @param string - user password for connection
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
	*         return : array - user informations
	*  			- id : integer
	*  			- name : string
	*
    * @access public
	*/
    public function connect($login, $password)
    {
		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		try {
			/**
			* find user with login value by using smartorm
			*/
			$tb_adm_user = new Smart_select('adm_user');
			$tb_adm_user->fieldSet('id');
			$tb_adm_user->fieldSet('status_id');
			$tb_adm_user->fieldSet('lastname');
			$tb_adm_user->fieldSet('firstname');
			$tb_adm_user->fieldSet('surname');
			$tb_adm_user->fieldSet('email');
			$tb_adm_user->fieldSet('company');
			$tb_adm_user->fieldSet('login');
			$tb_adm_user->fieldSet('password');
			$tb_adm_user->whereSet('login', $login);			
			$array_login = $tb_adm_user->find();
			if ($array_login) {
				/**
				* user found control
				*/
				if ($array_login['password'] == md5($password)) {
					/**
					* user found, password ok
					*/
					if ($array_login['status_id'] == 1) {
						$ws->sessionSet('connect_id', $array_login['id']);
						$ws->sessionSet('connect_name', $array_login['lastname'] . ' ' . $array_login['firstname']);
						$ws->sessionSet('connect_surname', $array_login['surname']);
						$ws->sessionSet('inscription_id', $array_login['id']);
						$ws->sessionSet('inscription_name', $array_login['lastname'] . ' ' . $array_login['firstname']);
						$ws->sessionSet('connect_cache', true);
						if ($ws->paramGet('USER_SUPERADMIN') == $ws->sessionGet('connect_id')) {
							$ws->sessionSet('connect_cache', false);
						}
						$connected_id = $array_login['id'];
						$app_count = 0;
						$app_default = '';
						$apps = $this->displayApps($connected_id);
						if ($apps->statusGet()) {
							$app_count = count($apps->returnGet());
							if ($app_count == 1) {
								$app_default = $apps->returnGet()[0]['app'];
							}
						}
						$ws->sessionSet('connect_app_count', $app_count);
						$ws->sessionSet('connect_app_default', $app_default);
						$fct_return->returnSet($connected_id);
					}
					else {
						$fct_return->returnSet(0);
						$ws->logSys('debug', 'Inactif user, login :' . $login, __CLASS__);
						$ws->logfunc('error', 'KO_100');
					}
				}
				else {
					/**
					* user found, password ko
					*/
					$fct_return->errorSet();
					$ws->logSys('debug', 'Password error, login :' . $login, __CLASS__);
					$ws->logfunc('error', 'KO_100');
				}
			}
			else {
				/**
				* user not found
				*/
				$fct_return->errorSet();
				$ws->logSys('debug', 'login error, login :' . $login, __CLASS__);
				$ws->logfunc('error', 'KO_100');
			}

		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'Error on function ' . __FUNCTION__ . ' ' . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			$ws->logfunc('error', 'KO_001');
		}
		
		return $fct_return;

	}
	
	/**
	* change Password process
	*
	* @param string - user login for connection
	* @param string - new user password
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
	*         return : array - user informations
	*  			- id : integer
	*  			- name : string
	*
    * @access public
	*/
    public function changePassword($login, $password)
    {
		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		try {
			/**
			* find user with login value by using smartorm
			*/
			$tb_adm_user = new Smart_select('adm_user');
			$tb_adm_user->fieldSet('id');
			$tb_adm_user->fieldSet('status_id');
			$tb_adm_user->fieldSet('lastname');
			$tb_adm_user->fieldSet('firstname');
			$tb_adm_user->fieldSet('email');
			$tb_adm_user->fieldSet('company');
			$tb_adm_user->fieldSet('login');
			$tb_adm_user->fieldSet('password');
			$tb_adm_user->whereSet('login', $login);			
			$array_login = $tb_adm_user->find();
			if ($array_login) {
				$password = md5($password);
				$tb_adm_user = new Smart_record('adm_user');
				$tb_adm_user->idSet($array_login['id']);
				$tb_adm_user->fieldSet('date_update', date('Y-m-d H:i:s'));				
				$tb_adm_user->fieldSet('password', $password);
				$tb_adm_user->update();
				$fct_return->returnSet($array_login['id']);
			}
			else {
				$fct_return->errorSet();
				$ws->logSys('debug', 'login error, login :' . $login, __CLASS__);
				$ws->logfunc('error', 'KO_100');
			}
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'Error on function ' . __FUNCTION__ . ' ' . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			$ws->logfunc('error', 'KO_001');
		}
		
		return $fct_return;
	}
	
	/**
	* change Email process
	*
	* @param string - user login for connection
	* @param string - new user email
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
	*         return : array - user informations
	*  			- id : integer
	*  			- name : string
	*
    * @access public
	*/
    public function changeMail($login, $email)
    {
		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		try {
			/**
			* find user with login value by using smartorm
			*/
			$tb_adm_user = new Smart_select('adm_user');
			$tb_adm_user->fieldSet('id');
			$tb_adm_user->fieldSet('status_id');
			$tb_adm_user->fieldSet('lastname');
			$tb_adm_user->fieldSet('firstname');
			$tb_adm_user->fieldSet('email');
			$tb_adm_user->fieldSet('company');
			$tb_adm_user->fieldSet('login');
			$tb_adm_user->fieldSet('password');
			$tb_adm_user->whereSet('login', $login);			
			$array_login = $tb_adm_user->find();
			if ($array_login) {
				/**
				* user found control
				*/

			}
			else {
				/**
				* user not found
				*/
				$fct_return->errorSet();
				$ws->logSys('debug', 'login error, login :' . $login, __CLASS__);
				$ws->logfunc('error', 'KO_100');
			}

		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'Error on function ' . __FUNCTION__ . ' ' . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			$ws->logfunc('error', 'KO_001');
		}
		
		return $fct_return;
	}
	
	/**
	* modify info user process
	*
	* @param string - user login for connection
	* @param string - surname
	* @param string - civility
	* @param string - firstname
	* @param string - lastname
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
	*         return : array - user informations
	*  			- id : integer
	*  			- name : string
	*
    * @access public
	*/
    public function modify($login, $surname, $civility, $firstname, $lastname)
    {
		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		try {
			/**
			* find user with login value by using smartorm
			*/
			$tb_adm_user = new Smart_select('adm_user');
			$tb_adm_user->fieldSet('id');
			$tb_adm_user->fieldSet('status_id');
			$tb_adm_user->fieldSet('lastname');
			$tb_adm_user->fieldSet('firstname');
			$tb_adm_user->fieldSet('email');
			$tb_adm_user->fieldSet('company');
			$tb_adm_user->fieldSet('login');
			$tb_adm_user->fieldSet('password');
			$tb_adm_user->whereSet('login', $login);			
			$array_login = $tb_adm_user->find();
			if ($array_login) {
				/**
				* user found control
				*/

			}
			else {
				/**
				* user not found
				*/
				$fct_return->errorSet();
				$ws->logSys('debug', 'login error, login :' . $login, __CLASS__);
				$ws->logfunc('error', 'KO_100');
			}

		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'Error on function ' . __FUNCTION__ . ' ' . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			$ws->logfunc('error', 'KO_001');
		}
		
		return $fct_return;

	}
	
	/**
	* Guest connecting process
	*
	* @param integer - Guest user id
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
	*         return : array - user informations
	*  			- id : integer
	*  			- name : string
	*
    * @access public
	*/
    public function connectGuest($user_id)
    {
		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		try {
			/**
			* find user with login value by using smartorm
			*/
			$ws->sessionSet('connect_id', $user_id);
			$ws->sessionSet('connect_name', '');
			$ws->sessionSet('connect_surname', '');
			$ws->sessionSet('inscription_id', 0);
			$ws->sessionSet('inscription_name', '');
			$ws->sessionSet('connect_cache', true);
			$app_count = 0;
			$app_default = '';
			$apps = $this->displayApps($user_id);
			if ($apps->statusGet()) {
				$app_count = count($apps->returnGet());
				if ($app_count == 1) {
						$app_default = $apps->returnGet()[0]['app'];
					}
				}
				$ws->sessionSet('connect_app_count', $app_count);
				$ws->sessionSet('connect_app_default', $app_default);
			}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'Error on function ' . __FUNCTION__ . ' ' . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			$ws->logfunc('error', 'KO_001');
		}
		
		return $fct_return;

	}
	
	/**
	* disconnecting process
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
	*
    * @access public
	*/
    public function disconnect()
    {
		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$ws->sessionSet('connect_id', '');
		$ws->sessionSet('connect_name', '');
		$ws->sessionSet('connect_surname', '');
		$ws->sessionSet('inscription_id', 0);
		$ws->sessionSet('inscription_name', '');
		$ws->sessionSet('connect_cache', true);
		$ws->sessionSet('connect_app_count', 0);
		$ws->sessionSet('connect_app_default', '');
		session_write_close();

		$fct_return->returnSet('');		
		return $fct_return;
	}
		
	/**
	* Display of user
	*
	* @param integer - user id
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
	*         return : array (applications to display)
	*  			- id : integer
	*
    * @access public
	*/
    public function display($user_id)
    {
		/**
		* function initialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		try {		
			$tb_adm_user = new Smart_select('adm_user');
			$tb_adm_user->fieldSet('id');
			$tb_adm_user->fieldSet('login');
			$tb_adm_user->fieldSet('lastname');
			$tb_adm_user->fieldSet('firstname');
			$tb_adm_user->fieldSet('surname');
			$tb_adm_user->fieldSet('company');
			$tb_adm_user->fieldSet('email');
			$tb_adm_user->fieldSet('status_id');
			$tb_adm_user->whereSet('id', $user_id);
			$array_login = $tb_adm_user->find();
			if ($array_login) {
				$fct_return->returnSet($array_login);
			}
			else {
				$fct_return->errorSet();
				$fct_return->returnSet(
					array(
						'id' => 0,
						'login' => '',
						'status_id' => 0
					)
				);
			}
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'Error on function ' . __FUNCTION__ . ' ' . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			$ws->logfunc('error', 'KO_001');
		}
		
		return $fct_return;

	}
		
	/**
	* Display list of applications usuable by user
	*
	* @param integer - user id
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
	*         return : array (applications to display)
	*  			- id : integer
	*  			- application : string
	*  			- description : string
	*
    * @access public
	*/
    public function displayApps($user_id)
    {
		/**
		* function initialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		try {
			/**
			* find apps by using smartorm
			*/
			if ($ws->cacheCtrl('apps', 'param')) {
				$apps = $ws->cacheGet('apps', 'param');
			}
			else {
				$apps = array();
				
				$tb_adm_user_group = new Smart_select('adm_user_group');
				$tb_adm_user_group->groupSet();
				$tb_adm_user_group->whereSet('user_id', $user_id);
				$tb_adm_group=$tb_adm_user_group->joinSet('group_id', 'adm_group', 'id');
				$tb_application=$tb_adm_group->joinSet('application_id', 'adm_application', 'id');
				$tb_application->fieldSet('id', 'application_id');
				$tb_application->fieldSet('code', 'app');
				$tb_application->fieldSet('version');
				$tb_application->fieldSet('status_id');
				$tb_application->fieldSet('name', 'application');
				$tb_application->fieldSet('label');
				$tb_application->fieldSet('description');
				$tb_application->fieldSet('keywords');
				$tb_application->fieldSet('canonical');
				$tb_application->fieldSet('url_root');
				$tb_application->fieldSet('public');
				$tb_application->fieldSet('image');
				$apps_auth = $tb_adm_user_group->findAll();
				for ($i=0; $i<count($apps_auth); $i++) {
					$app_item =  $apps_auth[$i];
					$addApp = false;
					if (isset($app_item['status_id'])) {
						if ($app_item['status_id'] > 0) {
							$addApp = true;
						}
					}
					if ($addApp) {
						$apps[] = $app_item;
					}
				}
				
				if ($ws->paramGet('USER_GUEST') <> "") {
					$tb_adm_user_group = new Smart_select('adm_user_group');
					$tb_adm_user_group->groupSet();
					$tb_adm_user_group->whereSet('user_id', $ws->paramGet('USER_GUEST'));
					$tb_adm_group=$tb_adm_user_group->joinSet('group_id', 'adm_group', 'id');
					$tb_application=$tb_adm_group->joinSet('application_id', 'adm_application', 'id');
					$tb_application->fieldSet('id', 'application_id');
					$tb_application->fieldSet('code', 'app');
					$tb_application->fieldSet('version');
					$tb_application->fieldSet('status_id');
					$tb_application->fieldSet('name', 'application');
					$tb_application->fieldSet('label');
					$tb_application->fieldSet('description');
					$tb_application->fieldSet('keywords');
					$tb_application->fieldSet('canonical');
					$tb_application->fieldSet('url_root');
					$tb_application->fieldSet('public');
					$tb_application->fieldSet('image');
					$apps_auth = $tb_adm_user_group->findAll();
					for ($i=0; $i<count($apps_auth); $i++) {
						$app_item =  $apps_auth[$i];
						$addApp = false;
						if (isset($app_item['status_id'])) {
							if ($app_item['status_id'] > 0) {
								$addApp = true;
								for ($j=0; $j<count($apps); $j++) {
									if ($apps[$j]['app'] == $app_item['app']) {
										$j = count($apps);
										$addApp = false;
									}
								}
							}
						}
						if ($addApp) {
							$apps[] = $app_item;
						}
					}
				}
				
				$tb_application = new Smart_select('adm_application');
				$tb_application->fieldSet('id', 'application_id');
				$tb_application->fieldSet('code', 'app');
				$tb_application->fieldSet('version');
				$tb_application->fieldSet('status_id');
				$tb_application->fieldSet('name', 'application');
				$tb_application->fieldSet('label');
				$tb_application->fieldSet('description');
				$tb_application->fieldSet('keywords');
				$tb_application->fieldSet('canonical');
				$tb_application->fieldSet('url_root');
				$tb_application->fieldSet('public');
				$tb_application->fieldSet('image');
				$tb_application->whereSet('public',1);
				$apps_public = $tb_application->findAll();
				for ($i=0; $i<count($apps_public); $i++) {
					$app_item =  $apps_public[$i];
					$addApp = false;
					if (isset($app_item['status_id'])) {
						if ($app_item['status_id'] > 0) {
							$addApp = true;
							for ($j=0; $j<count($apps); $j++) {
								if ($apps[$j]['app'] == $app_item['app']) {
									$j = count($apps);
									$addApp = false;
								}
							}
						}
					}
					if ($addApp) {
						$apps[] = $app_item;
					}
				}
				$ws->cacheSet('apps', $apps, 'param');
			}
			$fct_return->returnSet($apps);
			$ws->logSys('debug', 'Display apps ok', __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'Error on function ' . __FUNCTION__ . ' ' . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
		}
		return $fct_return;
	}

	/**
	* appFind object information
	*
	* @param string - application code to display
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
    *         return : array of informations 
	*  			- id : integer
	*  			- code : string 
	*  			- name : string 
	*  			- label : label 
	*  			- description : string 
	*  			- image : string 
	*			- url_root : string
	*			- content_page
	*			- forum_subject_page
	*			- forum_topic_page
	*			- public
	*			- parameters
	*
    * @access public
	*/
    public function appFind($code, $cache=true)
    {

		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		try {
			/**
			* function processing by using smartorm
			*/
			if (($ws->cacheCtrl($code, 'app')) and $cache) {
				$array_app = $ws->cacheGet($code, 'app');
			}
			else {
				$tb_application = new Smart_select('adm_application');
				$tb_application->fieldSet('id');
				$tb_application->fieldSet('code');
				$tb_application->fieldSet('name');
				$tb_application->fieldSet('label');
				$tb_application->fieldSet('description');
				$tb_application->fieldSet('keywords');
				$tb_application->fieldSet('canonical');
				$tb_application->fieldSet('url_root');
				$tb_application->fieldSet('content_page');
				$tb_application->fieldSet('forum_subject_page');
				$tb_application->fieldSet('forum_topic_page');
				$tb_application->fieldSet('public');
				$tb_application->fieldSet('image');
				$tb_application->fieldSet('parameters');
				$tb_application->whereSet('code',$code);
				$array_app = $tb_application->find();
				$ws->cacheSet($code, $array_app, 'app');
			}
			if (isset($array_app['parameters'])) {
				$arrayParameters = json_decode($array_app['parameters'], true);
			}
			else {
				$arrayParameters = array();
			}
			foreach ($arrayParameters as $key=>$value) {
				$ws->paramSet('APP_PARAM_'. strtoupper($key), $value);
			}
			$fct_return->returnSet($array_app);
			$ws->logSys('debug', 'Display '.get_class().' ok', __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'Error on function ' . __FUNCTION__ . ' ' . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			$ws->logfunc('error', 'KO_130', array());
		}		
		return $fct_return;
		
	}
	/**
	* appParamSet object information
	*
	* @param string - application code to display
	*        string - param key
	*        string - param value ('' by default)
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
    *         return : array of informations 
	*  			- id : integer
	*  			- code : string 
	*  			- name : string 
	*  			- label : label 
	*  			- description : string 
	*  			- image : string 
	*
    * @access public
	*/
    public function appParamSet($code,$key, $value='')
    {

		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		try {
			/**
			* function processing by using smartorm
			*/
			$tb_application = new Smart_select('adm_application');
			$tb_application->fieldSet('id');
			$tb_application->fieldSet('parameters');
			$tb_application->whereSet('code',$code);
			$array_app = $tb_application->find();
			if (isset($array_app['parameters'])) {
				$arrayParameters = json_decode($array_app['parameters'], true);
			}
			else {
				$arrayParameters = array();
			}
			$arrayParameters[$key] = $value;

			$tb_application = new Smart_record('adm_application');
			$tb_application->idSet($array_app['id']);
			$tb_application->fieldSet('parameters', json_encode($arrayParameters, true));
			$tb_application->update();
			$fct_return->returnSet($array_app['id']);
			
			$ws->logSys('debug', 'Display '.get_class().' ok', __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'Error on function ' . __FUNCTION__ . ' ' . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			$ws->logfunc('error', 'KO_127', array());
		}		
		return $fct_return;
		
	}

	/**
	* appFindByUrl object information
	*
	* @param string - application url root
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
    *         return : array of informations 
	*  			- id : integer
	*  			- code : string 
	*  			- name : string 
	*  			- label : label 
	*  			- description : string 
	*  			- image : string 
	*			- url_root : string
	*			- content_page
	*			- forum_subject_page
	*			- forum_topic_page
	*			- public
	*
    * @access public
	*/
    public function appFindByUrl($urlRoot)
    {

		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		try {
			/**
			* function processing by using smartorm
			*/
			if ($ws->cacheCtrl($urlRoot, 'root')) {
				$array_app = $ws->cacheGet($urlRoot, 'root');
			}
			else {
				$tb_application = new Smart_select('adm_application');
				$tb_application->fieldSet('id');
				$tb_application->fieldSet('code');
				$tb_application->fieldSet('name');
				$tb_application->fieldSet('label');
				$tb_application->fieldSet('description');
				$tb_application->fieldSet('keywords');
				$tb_application->fieldSet('canonical');
				$tb_application->fieldSet('url_root');
				$tb_application->fieldSet('content_page');
				$tb_application->fieldSet('public');
				$tb_application->fieldSet('image');
				$tb_application->whereSet('url_root','%' . $urlRoot . ';%');
				$array_app = $tb_application->find();
				$ws->cacheSet($urlRoot, $array_app, 'root');
			}
			$fct_return->returnSet($array_app, 'root');
			$ws->logSys('debug', 'Display '.get_class().' ok', __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'Error on function ' . __FUNCTION__ . ' ' . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
			$ws->logfunc('error', 'KO_120', array());
		}		
		return $fct_return;
		
	}

	/**
	* Search feature  usuable by user
	*
	* @param integer - application id
	* 		 string  - reference
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
	*         return : feature id : integer
	*
    * @access public
	*/
    public function searchFeature($application_id, $reference)
    {
		/**
		* function initialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		try {
			/**
			* find feature by using smartorm
			*/
			if ($ws->cacheCtrl($reference, 'feature')) {
				$feature_id = $ws->cacheGet($reference, 'feature');
			}
			else {
				$adm_application_ref = array();
				$tb_application_ref = new Smart_select('adm_application_ref');
				$tb_application_ref->fieldSet('application_id');
				$tb_application_ref->fieldSet('ref');
				$tb_application_ref->fieldSet('feature_id');
				$tb_application_ref->whereSet('application_id', $application_id);
				$tb_application_ref->whereSet('ref', $reference,'and');
				$adm_application_ref = $tb_application_ref->findAll();
				if (count($adm_application_ref) > 0) {
					$feature_id = $adm_application_ref[0]['feature_id'];
				}
				else {
					$feature_id = 0;				
				}
				$ws->cacheSet($reference, $feature_id, 'feature');
			}
			
			$fct_return->returnSet($feature_id);

			$ws->logSys('debug', 'Search feature ok', __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'Error on function ' . __FUNCTION__ . ' ' . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
		}
		return $fct_return;
	}
	
	/**
	* Search feature Right usuable by user
	*
	* @param integer - user id
	* 		 integer - 1 or 0 public access or not 
	* 		 string  - application code
	* 		 integer - feature id
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
	*         return : Rights - array
	*			- read : boolean
	*			- update : boolean
	*			- create : boolean
	*			- delete : boolean
	*			- event : boolean
	*
    * @access public
	*/
    public function searchFeatureRight($user_id, $app_public, $appCode, $feature_id)
    {
		/**
		* function initialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		try {
			/**
			* find right feature by using smartorm
			*/
			if ($ws->cacheCtrl($feature_id, 'right')) {
				$right = $ws->cacheGet($feature_id, 'right');
			}
			else {
				$right = array();
				$adm_user_group = array();
				$tb_adm_user_group = new Smart_select('adm_user_group');
				$tb_adm_user_group->groupSet();
				$tb_adm_user_group->whereSet('user_id', $user_id);
				
				$tb_adm_group=$tb_adm_user_group->joinSet('group_id', 'adm_group', 'id');
				$tb_application=$tb_adm_group->joinSet('application_id', 'adm_application', 'id');
				$tb_application->whereSet('code', $appCode, 'and');

				$tb_adm_group_right=$tb_adm_user_group->joinSet('group_id', 'adm_group_right', 'group_id');
				$tb_adm_group_right->whereSet('feature_id', $feature_id, 'and');
				$tb_adm_group_right->whereSet('module_id', 0, 'and');
				$tb_adm_group_right->fieldSet('group_id');
				$tb_adm_group_right->fieldSet('feature_id');
				$tb_adm_group_right->fieldSet('right_read');
				$tb_adm_group_right->fieldSet('right_create');
				$tb_adm_group_right->fieldSet('right_update');
				$tb_adm_group_right->fieldSet('right_delete');
				$tb_adm_group_right->fieldSet('right_event');
				$adm_user_group = $tb_adm_user_group->findAll();
				if ($app_public == 1) {
					$right['read'] = true;
					$right['create'] = false;
					$right['update'] = false;
					$right['delete'] = false;
					$right['event'] = false;
				}
				else {
					$right['read'] = false;
					$right['create'] = false;
					$right['update'] = false;
					$right['delete'] = false;
					$right['event'] = false;
				}
				for($i=0; $i < count($adm_user_group); $i++) {
					if ($app_public == 1) {
						if ($right['read']) {
							$right['read'] = boolval($adm_user_group[$i]['right_read']);
						}
						if (!$right['create']) {
							$right['create'] = boolval($adm_user_group[$i]['right_create']);
						}
						if (!$right['update']) {
							$right['update'] = boolval($adm_user_group[$i]['right_update']);
						}
						if (!$right['delete']) {
							$right['delete'] = boolval($adm_user_group[$i]['right_delete']);
						}
						if (!$right['event']) {
							$right['event'] = boolval($adm_user_group[$i]['right_event']);
						}
					}
					else {
						if (!$right['read']) {
							$right['read'] = boolval($adm_user_group[$i]['right_read']);
						}
						if (!$right['create']) {
							$right['create'] = boolval($adm_user_group[$i]['right_create']);
						}
						if (!$right['update']) {
							$right['update'] = boolval($adm_user_group[$i]['right_update']);
						}
						if (!$right['delete']) {
							$right['delete'] = boolval($adm_user_group[$i]['right_delete']);
						}
						if (!$right['event']) {
							$right['event'] = boolval($adm_user_group[$i]['right_event']);
						}
					}
				}
				
				$ws->cacheSet($feature_id, $right, 'right');
			}
			$fct_return->returnSet($right);

			$ws->logSys('debug', 'Search feature Right ok', __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'Error on function ' . __FUNCTION__ . ' ' . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
		}
		return $fct_return;
	}
	
	/**
	* Search modules Right usuable by user
	*
	* @param integer - user id
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
	*         return : modulesRights - array
	*			 string : module name	
	*				- read : boolean
	*				- update : boolean
	*				- create : boolean
	*				- delete : boolean
	*				- event : boolean
	*
    * @access public
	*/
    public function searchModulesRight($user_id, $appCode)
    {
		/**
		* function initialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		try {
			/**
			* find right feature by using smartorm
			*/
			if ($ws->cacheCtrl($appCode, 'module_right')) {
				$modulesRight = $ws->cacheGet($appCode, 'module_right');
			}
			else {
				$modulesRight = array();
				$adm_user_group = array();
				$tb_adm_user_group = new Smart_select('adm_user_group');
				$tb_adm_user_group->groupSet();
				$tb_adm_user_group->whereSet('user_id', $user_id);
				
				$tb_adm_group=$tb_adm_user_group->joinSet('group_id', 'adm_group', 'id');
				$tb_application=$tb_adm_group->joinSet('application_id', 'adm_application', 'id');
				$tb_application->whereSet('code', $appCode, 'and');

				$tb_adm_group_right=$tb_adm_user_group->joinSet('group_id', 'adm_group_right', 'group_id');
				$tb_adm_group_right->whereSet('feature_id', 0, 'and');
				$tb_adm_group_right->fieldSet('group_id');
				$tb_adm_group_right->fieldSet('feature_id');
				$tb_adm_group_right->fieldSet('module_id');
				$tb_adm_group_right->fieldSet('right_read');
				$tb_adm_group_right->fieldSet('right_create');
				$tb_adm_group_right->fieldSet('right_update');
				$tb_adm_group_right->fieldSet('right_delete');
				$tb_adm_group_right->fieldSet('right_event');
				$tb_adm_module=$tb_adm_group_right->joinSet('module_id', 'adm_module', 'id');
				$tb_adm_module->fieldSet('code', 'module');
				$adm_user_group = $tb_adm_user_group->findAll();
				for($i=0; $i < count($adm_user_group); $i++) {
					$right = array();
					$moduleName = $adm_user_group[$i]['module'];
					$right['create'] = boolval($adm_user_group[$i]['right_create']);
					$right['read'] = boolval($adm_user_group[$i]['right_read']);
					$right['update'] = boolval($adm_user_group[$i]['right_update']);
					$right['delete'] = boolval($adm_user_group[$i]['right_delete']);
					$right['event'] = boolval($adm_user_group[$i]['right_event']);
					$modulesRight[$moduleName] = $right;
				}
				$ws->cacheSet($appCode, $modulesRight, 'module_right');
			}

			$fct_return->returnSet($modulesRight);

			$ws->logSys('debug', 'Search Modules Right ok', __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'Error on function ' . __FUNCTION__ . ' ' . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
		}
		return $fct_return;
	}
	
	/**
	* Control access to the application 
	*
	* @param integer - user id
	* 		 string - Application code
	*
	* @return boolean
	*           - true : access is ok for user
	*           - false : access is ko for user
	*
    * @access public
	*/
    public function searchApp($user_id, $app_code)
    {
		/**
		* function initialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$access = false;
		$app_array = $this->displayApps($user_id)->returnGet();
		for ($i=0; $i < count($app_array); $i++) {
			if ($app_array[$i]['app'] == $app_code) {
				$access = true;
			}
		}
		return $access;
	}
	
	/**
	* Search right  usuable by user
	*
	* @param integer - user id
	* 		 string - Application code
	* 		 string - page name
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
	*         return : array
	*			- read : boolean
	*			- update : boolean
	*			- create : boolean
	*			- delete : boolean
	*			- event : boolean
	*
    * @access public
	*/
    public function searchRight($user_id, $app_code, $reference)
    {
		/**
		* function initialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		try {
			/**
			* find feature by using smartorm
			*/
			$right= array();
			$application_id = 0;
			$application_public = false;
			$app = $this->appFind($app_code)->returnGet();
			if (isset($app['code'])) {
				$application_id = $app['id'];
				$application_public = $app['public'];
				$feature_id = $this->searchFeature($application_id, $reference)->returnGet();
				if ((!empty($ws->paramGet('USER_DEFAULT'))) and ($user_id != $ws->paramGet('USER_SUPERADMIN')) and ($user_id != $ws->paramGet('USER_GUEST')) and (!empty($ws->paramGet('USER_GUEST')))) {
					$right = $this->searchFeatureRight($ws->paramGet('USER_DEFAULT'), $application_public, $app_code, $feature_id)->returnGet();
				}
				$right = $this->searchFeatureRight($user_id, $application_public, $app_code, $feature_id)->returnGet();
			}
			$fct_return->returnSet($right);

			$ws->logSys('debug', 'Search right ok', __CLASS__, $fct_return->returnGet(),'results');
		}
		catch (exception $e) {
			/**
			* function error processing
			*/
			$fct_return->errorSet();
			$ws->logSys('error', 'Error on function ' . __FUNCTION__ . ' ' . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
		}
		return $fct_return;
	}

 	/**
	* Construct url
	*
	* @param  array of parameters
	*			app : Application code
	*			page : page name
	
	*			module : module to use
	*			type : type to use in the module
	*			mode : mode (Api or Ws or Xml)
	*			id : Item id
	*			command : command to use
	*			param1 : parameter number 1
	*			other parameters as you want to use
	*
	* @return string - real page to use
	*
    * @access public
	*/
   public function constructHref()
      {
		$ws = workspace::ws_open();

		$app = '';
		$page = '';
		$module = '';
		$mode = '';
		$type = '';
		$id = '';
		$code = '';
		$fullPath = false;
		$noident = 1;
		$options = array();
		$argFunc = func_get_args();
		for($temp=0; $temp < count($argFunc); $temp++) {
			$atemp = explode(':', $argFunc[$temp]);
			if (count($atemp) > 1) {
				switch (strtoupper(trim($atemp[0]))) {
					case "APP" :
						$app = trim($atemp[1]);
						break;
					case "PAGE" :
						$page = trim($atemp[1]);
						break;
					case "MODULE" :
						$module = trim($atemp[1]);					
						break;
					case "TYPE" :
						$type = strtolower(trim($atemp[1]));					
						break;
					case "MODE" :
						$mode = trim($atemp[1]);					
						break;
					case "ID" :
						$id = trim($atemp[1]);
						break;
					case "CODE" :
						$code = trim($atemp[1]);
						break;
					case "FULLPATH" :
						if (strtoupper(trim($atemp[1])) == 'TRUE') {
							$fullPath = true;
						}
						else {
							$fullPath = false;
						}
						break;
					default :
						$options[trim($atemp[0])] = trim($atemp[1]);
				}
			}
			else {
				switch ($noident) {
					case 1 :
						$app = trim($argFunc[$temp]);
						break;
					case 2 :
						$page = trim($argFunc[$temp]);
						break;
				}
				$noident++;
			}
		} 

		$arg = array();
		if ($app <> '') {
			$arg['app'] = $app;
		}
		if ($module <> '') {
			$arg['module'] = $module;
		}
		if ($mode <> '') {
			$arg['mode'] = $mode;
		}
		if ($type <> '') {
			$arg['type'] = $type;
		}
		if ($page <> '') {
			$arg['page'] = $page;
		}
		else {
			if (($id != '') and ($id != '0')) {
				$arg['page'] = $ws->paramGet('CONTENT_PAGE');
			}
			else {
				if (!empty($code)) {
					$arg['page'] = $ws->paramGet('CONTENT_PAGE');
				}
			}
		}
		if ($id <> '') {
			$arg['id'] = $id;
		}
		foreach($options as $key=>$value) {
			$arg[$key] = $options[$key];
		}
		if (count($options) == 0) {
			$cacheKey = $app . '_' . $module . '_' . $type . '_' . $mode . '_' . $page . '_' . $id;
		}
		else {
			$cacheKey = '';
		}
		if ((!empty($cacheKey)) and ($ws->cacheCtrl($cacheKey, 'href'))) {
			$ref = $ws->cacheGet($cacheKey, 'href');
		}
		else {
		
			if ($ws->urlRewritingGet()) {
				$applicationId = $ws->paramGet('APP_ID');
				$app_only = $ws->paramGet('APP_ONLY');

				if ($app <> '') {
					unset($arg['app']);
				}
				if ($mode <> '') {
					unset($arg['mode']);
				}
				if ($type <> '') {
					unset($arg['type']);
				}
				if ($page <> '') {
					if (!$fullPath) {
						$ref = "./";
					}
					else {
						$ref = $ws->baseUrlGet();
						if (($app <> '') and ($app != $ws->paramGet('APP_CODE'))) {
							$admApp = new Smart_select('adm_application');
							$admApp->fieldSet('code');
							$admApp->fieldSet('id');
							$admApp->fieldSet('canonical');
							$admApp->whereSet('code', $app);
							$record = $admApp->find();
							if ($record) {
								$ref = $record['canonical'] . '/';
							}
						}
					}
					if (($app <> '') and ($app_only == '')) {
						$ref .= strtolower($app) . '/';
					}
					if ($mode <> '') {
						if ($mode == 'xml') {
							$ref .= strtolower($page) . '.xml';
						}
						else {
							$ref .= strtolower($mode) . '/';				
							$ref .= strtolower($page);
							if ((strtolower($mode) == 'api') and ($id != '') and ($id != '0')) {
								$ref .= '/' . $id;
								unset($arg['id']);
							}
						}
					}
					else {
						if (($id != '') and ($id != '0')) {
							$ref .= strtolower($page . '-id-' . $id . '.html');
							unset($arg['id']);
						}
						else {
							$ref .= strtolower($page . '.html');
						}
					}
					unset($arg['page']);
				}
				else {
					if ((!empty($code)) and (empty($id))) {
						$content = new Smart_select('cms_content', 'content');
						$content->fieldSet('id');
						$content->fieldSet('title');
						$content->fieldSet('content_page');
						$content->whereSet('application_id', $applicationId);
						$content->whereSet('code', $code, 'and');
						$records = $content->findAll();
						if (count($records) > 0) {
							$id = $records[0]['id'];
						}
					}

					if (($id != '') and ($id != '0')) {
						if (($app <> '') and ($app != $ws->paramGet('APP_CODE'))) {
							$admApp = new Smart_select('adm_application');
							$admApp->fieldSet('code');
							$admApp->fieldSet('id');
							$admApp->fieldSet('canonical');
							$admApp->whereSet('code', $app);
							$record = $admApp->find();
							if ($record) {
								$applicationId = $record['id'];	
							}
						}
					
						if (!$fullPath) {
							$ref = "./";
						}
						else {
							$ref = $ws->baseUrlGet();
							if (($app <> '') and ($app != $ws->paramGet('APP_CODE'))) {
								$admApp = new Smart_select('adm_application');
								$admApp->fieldSet('code');
								$admApp->fieldSet('id');
								$admApp->fieldSet('canonical');
								$admApp->whereSet('code', $app);
								$record = $admApp->find();
								if ($record) {
									$ref = $record['canonical'] . '/';
								}
							}
						}
						if (($app <> '') and ($app_only == '')) {
							$ref .= strtolower($app) . '/';
						}
						if (($app == '') and ($app_only == '')) {
							$ref .= strtolower($ws->paramGet('APP_CODE')) . '/';
						}
						if ($mode <> '') {
							$ref .= strtolower($mode) . '/';				
						}
						$alias = '';
						$path = '';
						
						switch ($type) {
							case 'subject':
								$path = $type . '/';
								$records = array();
								$content = new Smart_select('frm_subject', 'forum');
								$content->fieldSet('id');
								$content->fieldSet('alias');
								$content->whereSet('id', $id, 'and');				
								$record = $content->find();
								if ($record) {
									$alias = $record['alias'];
									$id = $record['id'];
								}
								if ($alias == '') {
									$alias = $ws->paramGet('FORUM_SUBJECT_PAGE');
								}
								break;
							case 'topic' :
								$path = $type . '/';
								$records = array();
								$content = new Smart_select('frm_topic', 'forum');
								$content->fieldSet('id');
								$content->fieldSet('alias');
								$content->whereSet('id', $id, 'and');				
								$record = $content->find();
								if ($record) {
									$alias = $record['alias'];
									$id = $record['id'];
								}
								if ($alias == '') {
									$alias = $ws->paramGet('FORUM_TOPIC_PAGE');
								}
								break;
							default :
								$records = array();
								$menu_feature = new Smart_select('adm_menu_feature');
								$menu_feature->fieldSet('id');
								$menu_feature->fieldSet('name');
								$menu_feature->fieldSet('alias');
								$menu_feature->whereSet('content_id', $id);
								$records = $menu_feature->findAll();
								if (count($records) > 0) {
									$alias = $records[0]['alias'];
								}
								if ($alias == '') {
									$records = array();
									$content = new Smart_select('cms_content', 'content');
									$content->fieldSet('id');
									$content->fieldSet('title');
									$content->fieldSet('alias');
									$content->fieldSet('path');
									if ((int)$id > 0) {
										$content->whereSet('id', $id, 'and');				
									}
									else {
										$content->whereSet('code', $id, 'and');
										$content->whereSet('application_id', $applicationId, 'and');
									}
									$record = $content->find();
									if ($record) {
										$alias = $record['alias'];
										$path = $record['path'];
										$id = $record['id'];
									}
								}
								if ($alias == '') {
									$alias = $ws->paramGet('CONTENT_PAGE');
								}

						}

						if ($path == '') {
							$ref .= strtolower($alias . '-id-' . $id . '.html');
						}
						else {
							$ref .= strtolower($path) . strtolower($alias . '-id-' . $id . '.html');
						}
						unset($arg['page']);
						unset($arg['id']);
					}
					else {
						if (!$fullPath) {
							$ref = "./";
						}
						else {
							$ref = $ws->baseUrlGet();
							if (($app <> '') and ($app != $ws->paramGet('APP_CODE'))) {
								$admApp = new Smart_select('adm_application');
								$admApp->fieldSet('code');
								$admApp->fieldSet('id');
								$admApp->fieldSet('canonical');
								$admApp->whereSet('code', $app);
								$record = $admApp->find();
								if ($record) {
									$ref = $record['canonical'] . '/';
								}
							}
						}
						if (($app <> '') and ($app_only == '')) {
							$ref .= strtolower($app) . '/';
						}
						if ($mode <> '') {
							$ref .= strtolower($mode) . '/';				
						}
					}
				}
			}
			else {
				$ref = 'index.php';
			}
			$paramFlag = false;
			foreach($arg as $key=>$value) {
				if (!$paramFlag) {
					$paramFlag = true;
					$ref .= '?';
				}
				else {
					$ref .= '&';				
				}
				$ref .= $key . '=' . $value;
			}
			if (!empty($cacheKey)) {
				$ws->cacheSet($cacheKey, $ref, 'href');
			}
		}
		return $ref;
	}
		
	public function contentPageGet($app, $id) 
	{
		$contentPage = '';
		if ($app != '') {
			$application = $this->appFind($app)->returnGet();
			if (isset($application['content_page'])) {
				$contentPage = $application['content_page'];
			}
		}
		return $contentPage;
	}

	/**
	* Find Page
	*
	* @param  string - page in the url
	* 		  string - content id
	*
	* @return string - real page to use
	*
    * @access private
	*/
    private function findPage($app, $page, $part = 'content', $id = '')
    {
		$ws = workspace::ws_open();

		$page_return = '';
		$id_return = $id;
		$records = array();

		$cacheKey = $app . '_' . $page . '_' . $part . '_' . $id;
		if ($ws->cacheCtrl($cacheKey, 'page')) {
			$page_return = $ws->cacheGet($cacheKey, 'page');
		}
		else {
			$application = $this->appFind($app)->returnGet();
			if (isset($application['code'])) {
				$contentPage = $application['content_page'];
				$forumSubjectPage = $application['forum_subject_page'];
				$forumTopicPage = $application['forum_topic_page'];
			}
			else {
				$application['forum_subject_page'] = '';
				$application['forum_topic_page'] = '';
			}
			switch ($part) {
				case 'subject' :
					$page_return = $application['forum_subject_page'];
					if ((int)$id > 0) {
						$record = array();
						$tbSubject = new Smart_select('frm_subject', 'forum');
						$tbSubject->fieldSet('id');
						$tbSubject->whereSet('id',$id);
						$record = $tbSubject->find();
						if (!isset($record['id'])) {
							$page_return = '';
							$page = '';
						}
					}
					break;
				case 'topic' :
					$page_return = $application['forum_topic_page'];
					if ((int)$id > 0) {
						$record = array();
						$tbTopic = new Smart_select('frm_topic', 'forum');
						$tbTopic->fieldSet('id');
						$tbTopic->fieldSet('subject_id');
						$tbTopic->whereSet('id',$id);
						$record = $tbTopic->find();
						if (!isset($record['id'])) {
							$page_return = '';
							$page = '';
						}
					}
					break;
				default :
					$menu_feature = new Smart_select('adm_menu_feature');
					$menu_feature->fieldSet('id');
					$menu_feature->fieldSet('name');
					$menu_feature->fieldSet('ref');
					$menu_feature->fieldSet('title');
					$menu_feature->fieldSet('description');
					$menu_feature->fieldSet('keywords');
					$menu_feature->whereSet('alias', $page);
					$records = $menu_feature->findAll();
					if (count($records) > 0) {
						if ($records[0]['ref'] == '') {
							if ($id != '') {
								$contentPage = $this->contentPageGet($app, $id);
								if ($contentPage != '') {
									$page_return = $contentPage;
								}
							}
						}
						else {
							$page_return = $records[0]['ref'];
						}
						$ws->urlTitleSet($records[0]['title']);
						$ws->urlDescriptionSet($records[0]['description']);
						$ws->urlKeywordsSet($records[0]['keywords']);
					}
					else {
						$records = array();
						$content = new Smart_select('cms_content', 'content');
						$content->fieldSet('id');
						$content->fieldSet('title');
						$content->fieldSet('content_page');
						$content->whereSet('alias', $page);
						if ((int)$id > 0) {
							$content->whereSet('id', $id, 'and');				
						}
						else {
							$content->whereSet('code', $id, 'and');
						}
						$records = $content->findAll();
						if (count($records) > 0) {
							if (empty($records[0]['content_page'])) {
								$contentPage = $this->contentPageGet($app, $id);
								if (!empty($contentPage)) {
									$page_return = $contentPage;
								}
							}
							else {
								$page_return = $records[0]['content_page'];
							}
						}
					}
					if ((empty($page_return)) and (!empty($id))) {
						$matches = explode('-', $page);
						if (isset($matches[0])) {
							$page_return = $matches[0];
						}
					}
			}
			if (empty($page_return)) {
				$page_return = $page;
			}
			
			$ws->cacheSet($cacheKey, $page_return, 'page');
		}
		return $page_return;			
	}
	
	/**
	* Analyse Params usuable by user
	*
	* @param none
	*
	* @return none
	*
    * @access public
	*/
	public function analyseParam() 
	{
		$ws = workspace::ws_open();
		
		$app_only = $ws->paramGet('APP_ONLY');
		$app = $ws->paramGet('APP_CODE');
		$page = $ws->paramGet('PAGE_NAME');
		$pageSpec = $ws->paramGet('PAGE_SPEC');
		$module = $ws->paramGet('MODULE_NAME');
		$mode = $ws->paramGet('MODE_NAME');
		$id = $ws->paramGet('ID');
		$id2 = $ws->paramGet('ID2');
		
		// Analyse params
		$requestUri = REQUEST_URI;
		$requestUri = preg_replace('#^/#Usi', '', $requestUri);
		$requestUri = preg_replace('#^' . FRAMEWORK_ROOT . '#Usi', '', $requestUri);
		if (preg_match('#^(.*)\?#Usi', $requestUri, $matches)) {
			$requestUri = $matches[1];
		}
	
		$iMode = -1;
		$urlArray = explode('/', $requestUri);
		for($i=0; $i < count($urlArray); $i++) {
			$urlArray[$i] = trim($urlArray[$i]);
			if ($urlArray[$i] != '') {
 				$analysed = false;
				if ((!$analysed) and ($i <= 0)) {
					if ((empty($app_only)) and (empty($module))) {
						$analysed = true;
					}
				}
				if ((!$analysed) and ($i <= 1)) {
					if ($mode == '') {
						$stemp = strtoupper($urlArray[$i]);
						if (($stemp == 'API') or ($stemp == 'WS') or ($stemp == 'XML')) {
							$mode = $stemp;
							$analysed = true;
							$iMode = $i;
						}
					}
				}
				if ((!$analysed) and ($i == count($urlArray) - 1) and ($mode != 'API') and ($mode != 'XML') and ($mode != 'WS')) {
					if (preg_match('#\.xml$#',$urlArray[$i])) {
						$urlArray[$i] = preg_replace('#\.(asp|htm|html|php|xml)$#Usi', '', $urlArray[$i]);
						$mode = 'XML';
						$page = $urlArray[$i];
						$analysed = true;
						$iMode = $i;
					}
					else {
						$urlArray[$i] = preg_replace('#\.(asp|htm|html|php|xml)$#Usi', '', $urlArray[$i]);
						if (($page == '') and ($urlArray[$i] != 'index')) {
							$part = 'content';
							if (count($urlArray) > 1) {
								if (preg_match('[subject|topic]', $urlArray[count($urlArray) - 2])) {
									$part = $urlArray[count($urlArray) - 2];
								}
							}
							if (preg_match('#-id-(.*)$#Usi', $urlArray[$i], $matches)) {
								$id = $matches[1];
								$urlArray[$i] = preg_replace('#-id-' . $matches[1] . '$#Usi', '', $urlArray[$i]);
								$page = $this->findPage($app, $urlArray[$i], $part, $id);
							}
							else {
								$page = $this->findPage($app, $urlArray[$i], $part);
							}
							$analysed = true;
						}
					}
				}
				if ((!$analysed) and ($mode == 'API') and ($i == $iMode + 1)) {
					$page = $urlArray[$i];
					$analysed = true;
				}
				if ((!$analysed) and ($mode == 'API') and ($i == $iMode + 2)) {
					if (preg_match('#^[0-9]#',$urlArray[$i])) {
						$id = $urlArray[$i];
					}
					else {
						$pageSpec = $urlArray[$i];;
					}
					$analysed = true;
				}
				if ((!$analysed) and ($mode == 'API') and ($i == $iMode + 3)) {
					$page = $page . '-' . $urlArray[$i];
					$analysed = true;
				}
				if ((!$analysed) and ($mode == 'API') and ($i == $iMode + 4)) {
					$id2 = $urlArray[$i];
					$analysed = true;
				}
				if ((!$analysed) and ($mode == 'XML') and ($i == $iMode + 1)) {
					$urlArray[$i] = preg_replace('#\.(asp|htm|html|php|xml)$#Usi', '', $urlArray[$i]);
					$page = $urlArray[$i];
					$analysed = true;
				}
			}
		}
		
		$ws->paramSet('PAGE_NAME', $page);
		$ws->paramSet('PAGE_SPEC', $pageSpec);
		$ws->paramSet('MODULE_NAME', $module);
		$ws->paramSet('MODE_NAME', $mode);
		$ws->paramSet('ID', $id);
		$ws->paramSet('ID2', $id2);

	}
	
	/**
	* Analyse Application
	*
	* @param none
	*
	* @return none
	*
    * @access public
	*/
	public function analyseApp() 
	{
		$ws = workspace::ws_open();
		
		$app_only = $ws->paramGet('APP_ONLY');
		$app = $ws->paramGet('APP_CODE');
		$application_id = $ws->paramGet('APP_ID');	
		$application_name = $ws->paramGet('APP_NAME');
		$root = $ws->paramGet('ROOT_URL');
		$combineFlag = $ws->paramGet('COMBINE_FLAG');
		$cacheFlag = $ws->paramGet('CACHE_FLAG');
		
		$appRoot = false;
		$serverName = SERVER_NAME;
		$baseName = BASE_NAME;
		$requestUri = REQUEST_URI;
		$application = $this->appFindByUrl($serverName)->returnGet();
		if (isset($application['code'])) {
			$app_only = $application['code'];
			$app = $app_only;
			$application_id = $application['id'];
			$application_name = $application['name'];
			$ws->baseUrlSet($baseName);
			$combineFlag = true;
			$cacheFlag = true;
			$appRoot = true;
		}
		else {
			$combineFlag = false;
			$cacheFlag = false;
		}
	
		if ($app == '') {
			$requestUri = preg_replace('#^/#Usi', '', $requestUri);
			$requestUri = preg_replace('#^' . FRAMEWORK_ROOT . '#Usi', '', $requestUri);
			if (preg_match('#^(.*)\?#Usi', $requestUri, $matches)) {
				$requestUri = $matches[1];
			}
			$urlArray = explode('/', $requestUri);
			if (count($urlArray) >= 1) {
				$stemp = trim(strtoupper($urlArray[0]));
				if ($stemp != '') {
					$application = $this->appFind($stemp)->returnGet();
					if (isset($application['code'])) {
						$app = $stemp;
						$application_id = $application['id'];
						$application_name = $application['name'];
					}
				}
			}
		}
		
		if ($appRoot) {
			$root = '/';
		}
		else {
			$root = $ws->baseUrlGet() . strtolower($app). '/';
		}
		$ws->paramSet('APP_CODE', $app);
		$ws->paramSet('APP_ONLY', $app_only);
		$ws->paramSet('APP_ID', $application_id);
		$ws->paramSet('APP_NAME', $application_name);
		$ws->paramSet('ROOT_URL', $root);
		$ws->paramSet('COMBINE_FLAG', $combineFlag);
		$ws->paramSet('CACHE_FLAG', $cacheFlag);
	}
	
	public function controlAccess() 
	{
		/**
		* function initialization
		*/
		$ws = workspace::ws_open();
		
		$app = $ws->paramGet('APP_CODE');
		$page = $ws->paramGet('PAGE_NAME');
		$module = $ws->paramGet('MODULE_NAME');
		$mode = $ws->paramGet('MODE_NAME');

		$app_only = $ws->paramGet('APP_ONLY');
		$application_id = $ws->paramGet('APP_ID');	
		$application_name = $ws->paramGet('APP_NAME');
		$contentPage = $ws->paramGet('CONTENT_PAGE');
		$forumSubjectPage = $ws->paramGet('FORUM_SUBJECT_PAGE');
		$forumTopicPage = $ws->paramGet('FORUM_TOPIC_PAGE');
		$create = $ws->paramGet('RIGHT_CREATE');
		$read = $ws->paramGet('RIGHT_READ');
		$update = $ws->paramGet('RIGHT_UPDATE');
		$delete = $ws->paramGet('RIGHT_DELETE');
		$event = $ws->paramGet('RIGHT_EVENT');

		if ($ws->connected()) {
			$connectId = $ws->connected_id();
			if ($app <> '') {
				if (!$this->searchApp($connectId, $app)) {
					$app = '';
					if ($page <> 'connect') {
						$page = '';
						$module = '';
					}
				}
			}
			if (($app <> '') and ($mode == '')) {
				$application_id = 0;
				$application_name = '';
				$application = $this->appFind($app)->returnGet();
				if (isset($application['code'])) {
					$application_id = $application['id'];
					$application_name = $application['name'];
					$contentPage = $application['content_page'];
					$forumSubjectPage = $application['forum_subject_page'];
					$forumTopicPage = $application['forum_topic_page'];
				}
				if (($page <> 'connect')) {
					if ($page == '') {
						$fct_return = $this->searchRight($connectId, $app, "#");
					}
					else {
						$fct_return = $this->searchRight($connectId, $app, $page);
					}
					if ($fct_return->statusGet()) {
						$connected_right = $fct_return->returnGet();
						$create = $connected_right['create'];
						$read = $connected_right['read'];
						$update = $connected_right['update'];
						$delete = $connected_right['delete'];
						$event = $connected_right['event'];
					}
				}
			}
			if (($app <> '') and ($mode <> '')) {
				$application_id = 0;
				$application_name = '';
				$application = $this->appFind($app)->returnGet();
				if (isset($application['code'])) {
					$application_id = $application['id'];
					$application_name = $application['name'];
					$contentPage = $application['content_page'];
					$forumSubjectPage = $application['forum_subject_page'];
					$forumTopicPage = $application['forum_topic_page'];
				}
				if ($page <> '') {
					$read = 1;
				}
			}
			if ($app == '') {
				if ($ws->connected_appCount() == 1) {
//					$app = $ws->connected_appDefault();
				}
			}
			if (($app <> '') and ($page == '')) {
				$read = 1;
			}
			if (($module <> '') and ($page <> '')) {
				$read = 1;
			}
			if ($read == 0) {
				$page ='error';
			}
		}
		else {
			$app = '';
			if ($page <> 'connect') {
				$page = '';
				$module = '';
			}
		}
		
		if (!$read) {
			$page = '';
			$module = '';
		}
		
		if (($app == '') and ($app_only <> '')) {
			$app = $app_only;
			$page = 'error';
			$module = '';
		}

		$ws->paramSet('APP_CODE', $app);
		$ws->paramSet('APP_ONLY', $app_only);
		$ws->paramSet('APP_ID', $application_id);
		$ws->paramSet('APP_NAME', $application_name);
		$ws->paramSet('PAGE_NAME', $page);
		$ws->paramSet('CONTENT_PAGE', $contentPage);
		$ws->paramSet('FORUM_SUBJECT_PAGE', $forumSubjectPage);
		$ws->paramSet('FORUM_TOPIC_PAGE', $forumTopicPage);
		$ws->paramSet('MODULE_NAME', $module);
		$ws->paramSet('MODE_NAME', $mode);

		$ws->paramSet('RIGHT_CREATE', $create);
		$ws->paramSet('RIGHT_READ', $read);
		$ws->paramSet('RIGHT_UPDATE', $update);
		$ws->paramSet('RIGHT_DELETE', $delete);
		$ws->paramSet('RIGHT_EVENT', $event);

		if ($ws->connected()) {
			$connectId = $ws->connected_id();
			$fct_return = $this->searchModulesRight($connectId, $app);
			if ($fct_return->statusGet()) {
				$modulesRight = $fct_return->returnGet();
				foreach($modulesRight as $moduleName=>$right) {
					$ws->paramSet($moduleName . '_RIGHT_CREATE', $right['create']);
					$ws->paramSet($moduleName . '_RIGHT_READ', $right['read']);
					$ws->paramSet($moduleName . '_RIGHT_UPDATE', $right['update']);
					$ws->paramSet($moduleName . '_RIGHT_DELETE', $right['delete']);
					$ws->paramSet($moduleName . '_RIGHT_EVENT', $right['event']);
				}
			}
		}
	}

}