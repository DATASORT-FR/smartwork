<?php
/**
* This file contains classes and function for the tokens management.
*
* @package    administration_token
* @version    1.0
* @date       20 august 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

if (!defined('TOKEN_DURATION')) {
	define('TOKEN_DURATION', 30);
}

/**
* Classes for the users management.
*/
class object_token extends BUS_object
{

	/**
	* constructor object_adm_user
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->idSet('id');

		/* Table structure for the object */
		$this->tableSet('adm_token');
		$this->creationDateSet('date_creation');
		$this->updateDateSet('date_update');
		
		$this->fieldTableSet('id');
		$this->fieldTableSet('date_creation');
		$this->fieldAttrSet('date_creation', 'date', array(
			'auto' => true));
		$this->fieldTableSet('date_update');
		$this->fieldAttrSet('date_update', 'date', array(
			'auto' => true));
		$this->fieldTableSet('code');
		$this->fieldAttrSet('code', 'string', array(
			'required' => true,
			'size' => 40));
		$this->fieldTableSet('app');
		$this->fieldAttrSet('app', 'string', array(
			'size' => 10));
		$this->fieldTableSet('user_id');
		$this->fieldAttrSet('user_id', 'integer');
		$this->fieldTableSet('func');
		$this->fieldAttrSet('func', 'string', array(
			'size' => 10));
		$this->fieldTableSet('param');
		$this->fieldAttrSet('param', 'string', array(
			'size' => 50));
		$this->fieldTableSet('date_use');
		$this->fieldAttrSet('date_use', 'date');

		$this->whereTableSet('code');
		$this->whereTableSet('func');

		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'code');
		$this->orderTableSet(1,'id');
		$this->orderTableSet(2,'func');
		$this->orderTableSet(2,'code');
		$this->orderTableSet(2,'id');
	}
	
	/**
	* create token process
	*
	* @param string - app code
	* @param string - function for concept
	* @param string - user id
	*
	* @return object return_function
	*         status : boolean
	*           + true : no error
	*           + false : error
	*         return : array - user informations
	*  			- tokenId : string
	*
    * @access public
	*/
	public function create($app, $function='', $userId=0, $param='')
	{
 		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		$tokenId = '';
		$today = date("Y-m-d H:i:s");
		
		try {
			$tb_adm_token = new Smart_record('adm_token');
			$tb_adm_token->fieldSet('date_creation', $today);
			$tb_adm_token->fieldSet('date_update', $today);
			$tb_adm_token->fieldSet('app', $app);
			$tb_adm_token->fieldSet('func', $function);
			$tb_adm_token->fieldSet('user_id', $userId);
			$tb_adm_token->fieldSet('param', $param);
			$id = $tb_adm_token->insert();
			if ($id != 0) {
				$tokenId = base64_encode($app . '_' . $today . $id);
				$tbField = new Smart_record('adm_token');
				$tbField->idSet($id);
				$tbField->fieldSet('code', $tokenId);
				$tbField->update();
				$fct_return->returnSet(array('code' => $tokenId));
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

	public function control($tokenId, $app, $function='', $userId=0)
	{
 		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		$token_duration = TOKEN_DURATION;
		$date = new DateTime();
		$dateCurrent = $date->getTimestamp();
		
		try {

			$return = false;
			$tb_adm_token = new Smart_select('adm_token');
			$tb_adm_token->fieldSet('id');
			$tb_adm_token->fieldSet('date_creation');
			$tb_adm_token->fieldSet('app');
			$tb_adm_token->fieldSet('func');
			$tb_adm_token->fieldSet('user_id');
			$tb_adm_token->fieldSet('param');
			$tb_adm_token->fieldSet('date_use');
			$tb_adm_token->whereSet('code', $tokenId);
			$token = $tb_adm_token->find();
			if (!empty($token)) {
				$date = new DateTime($token['date_creation']);
				$tokenDateCreation = $date->getTimestamp();
				$diffDate = $dateCurrent - $tokenDateCreation;
				$tokenApp = $token['app'];
				$tokenUserId = $token['user_id'];
				$tokenFunction = $token['func'];
				$return = true;
				if ($return and ($app != $tokenApp)) {
					$return = false;
				}
				if ($return and ($function != '') and ($function != $tokenFunction)) {
					$return = false;
				}
				if ($return and ($userId != 0) and ($userId != $tokenUserId)) {
					$return = false;
				}
				if ($return and ($diffDate > $token_duration*60)) {
					$return = false;
				}
				if ($return and ($token['date_use'] != null)) {
					$return = false;
				}
			}
			if ($return) {
				$fct_return->returnSet($token);
			}
			else {
				$fct_return->errorSet();
				$ws->logSys('debug', 'control token, tokenID :' . $tokenId, __CLASS__);
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

	public function use($tokenId)
	{
 		/**
		* function intialization
		*/
		$ws = workspace::ws_open();
		$fct_return = new Return_function;
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		try {
			$tb_adm_token = new Smart_select('adm_token');
			$tb_adm_token->fieldSet('id');
			$tb_adm_token->fieldSet('date_creation');
			$tb_adm_token->fieldSet('app');
			$tb_adm_token->fieldSet('func');
			$tb_adm_token->fieldSet('user_id');
			$tb_adm_token->fieldSet('param');
			$tb_adm_token->whereSet('code', $tokenId);
			$token = $tb_adm_token->find();
			if (!empty($token)) {
				$tb_adm_token = new Smart_record('adm_token');
				$tb_adm_token->idSet($token['id']);
				$tb_adm_token->fieldSet('date_use', date('Y-m-d H:i:s'));
				$tb_adm_token->update();
				$fct_return->returnSet($token);
			}
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
	
}