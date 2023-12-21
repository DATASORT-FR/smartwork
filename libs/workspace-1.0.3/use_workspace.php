<?php
/**
* This file contains classes and function for the PHP developpement help
* This "work space" use smarty and extend smarty classes
*
* @package workspace
* @version   1.1
* @date      28 january 2019
* @author    Alain VANDEPUTTE
* @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
*/

// use
use Dompdf\Dompdf;
use Dompdf\Options;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!defined('SCRIPT_TYPE')) {
	define('SCRIPT_TYPE', 'SCRIPT');
}
if (!defined('WEB_TYPE')) {
	define('WEB_TYPE', 'WEB');
}
if (!defined('_WSEXEC')) {
	if (isset($argv)) {
		define('_WSEXEC', SCRIPT_TYPE);
	}
	else {
		define('_WSEXEC', WEB_TYPE);
	}
}

// global define
if (!defined('PLUGIN_FORM_FIELD')) {
	define('PLUGIN_FORM_FIELD', 'form_field');
}
if (!defined('SESSION_CACHE')) {
	define('SESSION_CACHE', false);
}

if (!defined('RIGHT_READ')) {
	define('RIGHT_READ', 1);
}
if (!defined('RIGHT_UPDATE')) {
	define('RIGHT_UPDATE', 2);
}

if (!defined('GROUP_NAME')) {
	define('GROUP_NAME', 'www-data');
}

/**
* init value in a array
*
* @param array pointer - pointer to the array
* 		 string - key in the array
*        any - default value if the key is not in the attary
*
* @return boolean - true if the default value has been seted
*
* @access public
*/
function initCont(&$fieldArray, $key, $value) {
	$return = true;
		
	$traitFlag = false;
	if (!isset($fieldArray[$key])) {
		$traitFlag = true;
	}
	else {
		if (empty($fieldArray[$key])) {
			$traitFlag = true;
		}
	}
	if ($traitFlag) {
		$fieldArray[$key] = $value;
	}
	if ($fieldArray[$key] == 'empty') {
		$fieldArray[$key] = '';			
	}
	return $return;
}

/**
* read keys value in a array and set default value if not existe
*
* @param array - array
* 		 string - key in the array
*        any - default value if the key is not in the array
*
* @return any - return value of the key
*
* @access public
*/
function readCont($fieldArray, $key, $default = '') {
		
	if (!isset($fieldArray[$key])) {
		$return = $default;
	}
	else {
		$return = $fieldArray[$key];			
	}	
	return $return;
}

/**
* Encode image to base 64
*
* @param string - image Path
* 		 string - image type (default : png)
*
* @return string - coded image
*
* @access public
*/
function encode_img_base64($imgPath = false, $imgType = 'png' ) {
	$imgSrc = '';
    if( $imgPath ){
        $imgData = fopen($imgPath, 'rb' );
        $imgSize = filesize($imgPath);
        $binary_image = fread($imgData, $imgSize );
        fclose($imgData);

        $imgSrc = "data:image/".$imgType.";base64,".str_replace ("\n", "", base64_encode($binary_image));
    }
    return $imgSrc;
}

/**
* Create PDF File from  HTML
*
* @param string - File Name
* 		 string - Html data
* 		 string - paper format 'A4', 'Letter'
* 		 string - paper orientation 'portrait' or 'landscape'
*
* @return boolean - process return
*
* @access public
*/
function html2PdfFile($fileName, $html, $format = 'A4', $orientation = 'portrait') {
	$ws = workspace::ws_open();
	$return = false;

	try {
		$options = new Options();
		$options->set('isRemoteEnabled', true);
		$dompdf = new Dompdf($options);	
		$dompdf->loadHtml($html);
		$dompdf->setPaper($format, $orientation);
		$dompdf->render();
		file_put_contents($fileName, $dompdf->output());
		if (file_exists($fileName)) {
			$return = true;
			$ws->logSys('info', 'PDF file for ' . $fileName . ' with ' . $format . ', ' . $orientation,  __FUNCTION__);
		}
		else {
			$ws->logSys('error', 'PDF file ' . $fileName . ' with ' . $format . ', ' . $orientation . '. Error : File not exist',  __FUNCTION__);
		}
	}
	catch (exception $e) {
		$ws->logSys('error', 'PDF file ' . $fileName . ' with ' . $format . ', ' . $orientation . '. Error : ' . $e->getCode() . ' : ' . $e->getMessage(),  __FUNCTION__);
	}
	
	return $return;
}
/**
* create PDF Stream from  HTML
*
* @param string - Html data
* 		 string - paper format 'A4', 'Letter'
* 		 string - paper orientation 'portrait' or 'landscape'
*
* @return boolean - process return
*
* @access public
*/
function html2PdfStream($fileName, $html, $format = 'A4', $orientation = 'portrait') {
	$ws = workspace::ws_open();
	$return = false;

	try {
		$options = new Options();
		$options->set('isRemoteEnabled', true);
		$dompdf = new Dompdf($options);	
		$dompdf->loadHtml($html);
		$dompdf->setPaper($format, $orientation);
		$dompdf->render();
		$dompdf->stream($fileName, array("Attachment" => false));
		$return = true;
		$ws->logSys('info', 'PDF Stream for ' . $fileName . ' with ' . $format . ', ' . $orientation,  __FUNCTION__);
	}
	catch (exception $e) {
		$ws->logSys('error', 'PDF Stream for ' . $fileName . ' with ' . $format . ', ' . $orientation . '. Error : ' . $e->getCode() . ' : ' . $e->getMessage(),  __FUNCTION__);
	}
	return $return;
}

/**
* Send Mail
*
* @param string - Email sender
* 		 string - Email destination
* 		 string - subject of the mail
* 		 string - html body of the mail
* 		 string - text (or alternative text) mail's body
*
* @return boolean - process return
*
* @access public
*/
function mailSend($from, $to, $subject, $bodyHtml='', $bodyTxt='', $fileName='') {
	$ws = workspace::ws_open();
	$return = false;

	if (!defined('MAIL_HOST')) {
		define('MAIL_HOST', 'UNKNOW');
	}
	if (!defined('MAIL_PORT')) {
		define('MAIL_PORT', 0);
	}
	if (!defined('MAIL_AUTH')) {
		define('MAIL_AUTH', false);
	}
	if (!defined('MAIL_SECURE')) {
		define('MAIL_SECURE', 'none');
	}
	if (!defined('MAIL_USER')) {
		define('MAIL_USER', '');
	}
	if (!defined('MAIL_PASSWORD')) {
		define('MAIL_PASSWORD', '');
	}
	if (!defined('MAIL_NO_VERIFY')) {
		define('MAIL_NO_VERIFY', false);
	}
	if (!defined('MAIL_DEBUG')) {
		define('MAIL_DEBUG', false);
	}
	if (!defined('MAIL_DEBUG_LEVEL')) {
		define('MAIL_DEBUG_LEVEL', 0);
	}
	if (!defined('MAIL_DEBUG_TO')) {
		define('MAIL_DEBUG_TO', '');
	}
	if (MAIL_HOST != 'UNKNOW') {		
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug = MAIL_DEBUG_LEVEL;
		$mail->Host = MAIL_HOST;
		$mail->Port = MAIL_PORT;
		if (MAIL_AUTH) {
			$mail->SMTPAuth = 1;
			if (MAIL_SECURE != 'none') {
				$mail->SMTPSecure = MAIL_SECURE;
			}
			$mail->Username = MAIL_USER;
			$mail->Password = MAIL_PASSWORD;
			if (MAIL_NO_VERIFY) {
				$mail->SMTPOptions = array (
					'ssl' => array (
						'verify_peer' => false,
						'verify_peer_name' => false,
						'allow_self_signed' => false
					)
				);
			}
			else {
				$mail->SMTPOptions = array (
					'ssl' => array (
						'verify_peer' => true,
						'verify_peer_name' => true,
						'allow_self_signed' => true
					)
				);
			}
		}
		else {
			$mail->SMTPAuth = 0;
		}
		$mail->WordWrap   = 50;
		$mail->CharSet = 'UTF-8';	

		$mailFrom = explode(',', $from);
		$mail->From = $mailFrom[0];
		if (isset($mailFrom[1])) {
			$mail->FromName = $mailFrom[1];
		}

		$mail->Subject = $subject;
		$mail->AltBody = $bodyTxt;
		if ($bodyHtml != '') {
			$mail->IsHTML(true);
			$mail->MsgHTML($bodyHtml);
		}
		else {
			$mail->IsHTML(false);
			$mail->Body = $bodyTxt;
		}

		if (MAIL_DEBUG) {
			if (MAIL_DEBUG_TO != '') {
				$to = MAIL_DEBUG_TO;
			}
			else {
				$to = MAIL_MAIL_USER;
			}
		}

		$arrayTo = explode(';', $to);
		for ($i = 0; $i < count($arrayTo); $i++) {
			$mailTo = explode(',', $arrayTo[$i]);
			if (isset($mailTo[1])) {
				$mail->AddAddress($mailTo[0], $mailTo[1]);
			}
			else {
				$mail->AddAddress($mailTo[0]);
			}
		}	
		if (!empty($fileName)) {
			$mail->AddAttachment($fileName);
		}
		
		if ($mail->send()) {
			$ws->logSys('info', 'Mail sent:' . $to . "\r\n" . 'From : ' . $from . "\r\n" . 'Subject : ' . $subject,  __FUNCTION__);
			$return = true;
		}
		else {
			$ws->logSys('error', 'Mail:' . $to . 'Info:'. $mail->ErrorInfo,  __FUNCTION__);
		}
	}
	return $return;
}

//*******************************
// Soap API extend
//*******************************
class WorkSoapClient extends SoapClient {
	
    public function __doRequest(string $request, string $location, string $action, int $version, bool $one_way = false): ?string {
        $response = parent::__doRequest( $request, $location, $action, $version );
        if ($response) {
//			if (preg_match("#\xEF\xBB\xBF#isu", $response)) {
//				$response = preg_replace("#\xEF\xBB\xBF#isu", "", $response);
//			}
//			if (preg_match("#\</SOAP-ENV:Envelo.*#isu", $response)) {
//				$response = preg_replace("#\</SOAP-ENV:Envelo.*#isu", "\</SOAP-ENV:Envelo", $response);
//				$response = preg_replace("#\</SOAP-ENV:Envelo#isu", "\</SOAP-ENV:Envelope>", $response);
//			}
			if (isset($this->_cookies)) {
				$_SESSION['soap_cookies'] = $this->_cookies;
			}
			else {
				$_SESSION['soap_cookies'] = '';
			}
		}
        return $response;
    }

    public function __construct($serverpath, $options = array('soap_version'=>SOAP_1_2)) 
    {

		$context = array(
			'ssl' => array(
//				'ciphers' => 'RC4-SHA',
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
//				'ciphers' => 'DEFAULT@SECLEVEL=1'
			)
		);
		if (!isset($options['cache_wsdl'])) {
			$options['cache_wsdl'] = WSDL_CACHE_NONE;
		}
		if (!isset($options['trace'])) {
			$options['trace'] = true;
		}
		if (!isset($options['keep_alive'])) {
			$options['keep_alive'] = true;
		}
//		if (!isset($options['exception'])) {
//			$options['exception'] = 1;
//		}
//		if (!isset($options['user_agent'])) {
//			$options['user_agent'] = 'PHPSoapClient';
//		}
//		if (!isset($options['soap_version'])) {
//			$options['soap_version'] = SOAP_1_2;
//		}
		if (!isset($options['stream_context'])) {
			$options['stream_context'] = stream_context_create($context);
		}
		$client = parent::__construct($serverpath, $options);
//		$this->_client->soap_defencoding = 'UTF-8';
//		$this->_client->decode_utf8 = false;
		if (!empty($_SESSION['soap_cookies'])) {
			foreach($_SESSION['soap_cookies'] as $cookieKey => $cookieValues) {
				$this->__setCookie($cookieKey, $cookieValues[0]);
			}
		}
		else {
			try {
				$this->hello();
			}
			catch (SoapFault $e) {
			}
			if (isset($this->_cookies)) {
				$_SESSION['soap_cookies'] = $this->_cookies;
			}
		}
//		return $this;
		return $client;
	}
	
}
//*******************************
// Rest API use
//*******************************
class WorkRestClient {

	private $_url;

    public function __construct($urlpath) 
    {
		$this->_url = $urlpath;
	}

    public function get($id = '', $argArray = array()) 
	{
		$ws = workspace::ws_open();
		$fct_return = new return_function;
		$ws->logSys('debug', 'function GET for ' . $this->_url,  __CLASS__, func_get_args(), 'arguments');
		
		try {
			if (!empty($id)) {
				$url = $this->_url . $id;
			}
			else {
				$param = '';
				if (count($argArray) > 0) {
					$param = '?';
					$temp = 0;
					foreach($argArray as $key=>$value) {
						if ($temp > 0) {
							$param .= '&';
						}
						$param .= $key .'='.$value;
						$temp++;
					}
				}
				$url = $this->_url . $param;
			}
			$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'GET'
				)
			);
			$context  = stream_context_create($options);
			$result = @file_get_contents($url, false, $context);
			if ($result !== false) { 
				$return = json_decode($result, true);
				$fct_return->returnSet($return);
			}
			else {
				$fct_return->errorSet();
			}
		}
		catch (exception $e) {
			$fct_return->errorSet();
			$ws->logSys('error', 'function GET KO for ' . $this->_url . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
		}
		return $fct_return;	
		
	}

    public function post($argArray = array()) 
	{
		$ws = workspace::ws_open();
		$fct_return = new return_function;
		$ws->logSys('debug', 'function POST for ' . $this->_url,  __CLASS__, func_get_args(), 'arguments');
		
		try {
			$url = $this->_url;
			$data = http_build_query($argArray);
			$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => $data
				)
			);
			$context  = stream_context_create($options);
			$result = @file_get_contents($url, false, $context);
			if ($result !== false) { 
				$return = json_decode($result, true);
				$fct_return->returnSet($return);
			}
			else {
				$fct_return->errorSet();
			}
		}
		catch (exception $e) {
			$fct_return->errorSet();
			$ws->logSys('error', 'function POST KO for ' . $this->_url . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
		}
		return $fct_return;	
	}
 
    public function put($argArray = array()) 
	{
		$ws = workspace::ws_open();
		$fct_return = new return_function;
		$ws->logSys('debug', 'function PUT for ' . $this->_url,  __CLASS__, func_get_args(), 'arguments');
		
		try {
			if (isset($argArray['id'])) {
				$id = $argArray['id'];
				$url = $this->_url . $id;
				$data = json_encode($argArray);
				$options = array(
					'http' => array(
						'header'  => "Content-Type:application/x-www-form-urlencoded\r\n" . "Accept:*/*\r\n" . "Content-Length: " . strlen($data) . "\r\n",
						'method'  => 'PUT',
						'content' => $data
					)
				);
				$context  = stream_context_create($options);
				$result = file_get_contents($url, false, $context);
				if ($result !== false) { 
					$return = json_decode($result, true);
					$fct_return->returnSet($return);
				}
				else {
					$fct_return->errorSet();
				}
			}
			else {
				$fct_return->errorSet();
			}
		}
		catch (exception $e) {
			$fct_return->errorSet();
			$ws->logSys('error', 'function PUT KO for ' . $this->_url . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
		}
		return $fct_return;	
	}
	
    public function delete($id) 
	{
		$ws = workspace::ws_open();
		$fct_return = new return_function;
		$ws->logSys('debug', 'function DELETE for ' . $this->_url,  __CLASS__, func_get_args(), 'arguments');
		
		try {
			$url = $this->_url . $id;
			$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'DELETE'
				)
			);
			$context  = stream_context_create($options);
			$result = @file_get_contents($url, false, $context);
			if ($result !== false) { 
				$return = json_decode($result, true);
				$fct_return->returnSet($return);
			}
			else {
				$fct_return->errorSet();
			}
		}
		catch (exception $e) {
			$fct_return->errorSet();
			$ws->logSys('error', 'function DELETE KO for ' . $this->_url . " " . $e->getCode() . " : " . $e->getMessage(), __CLASS__);
		}
		return $fct_return;	
	}
	
}

function arrayToString($array) {

	$return = 'Array(' . count($array) . ') {';
	$i = 0;
	foreach($array as $key=>$value) {
		if ($i > 0) {
			$return .= ',';
		}
		if (is_array($value)) {
			$stemp = arrayToString($value);
		}
		else {
			$stemp = $value;
		}
		$return .= " '" . $key . "' => '" .$stemp . "'"; 
		$i++;
	}
	$return .= '}';
	return $return;
}

function _json_encode($val)
{
    if (is_string($val)) return '"'.addslashes($val).'"';
    if (is_numeric($val)) return $val;
    if ($val === null) return 'null';
    if ($val === true) return 'true';
    if ($val === false) return 'false';

    $assoc = false;
    $i = 0;
    foreach ($val as $k=>$v){
        if ($k !== $i++){
            $assoc = true;
            break;
        }
    }
    $res = array();
    foreach ($val as $k=>$v){
        $v = _json_encode($v);
        if ($assoc){
            $k = '"'.addslashes($k).'"';
            $v = $k.':'.$v;
        }
        $res[] = $v;
    }
    $res = implode(',', $res);
    return ($assoc)? '{'.$res.'}' : '['.$res.']';
}

/**
* Display message
*
* @param 	string	- message
* 		 	integer	- display level (1, 2 or 3)
*					default = 1
*
* @access public
*/
function displayMsg($value, $key = '', $level = 1, $truncate=true) {

	$return = true;
	$stemp = '';
	switch ($level) {
		case 2 :
			$stemp = '---> ';
			break;
		case 3 :
			$stemp = '------> ';
			break;
		case 4 :
			$stemp = '---------> ';
			break;
		case 5 :
			$stemp = '------------> ';
			break;
		case 6 :
			$stemp = '---------------> ';
			break;
	}
	if ($key != '') {
		$stemp = $stemp . $key . ' : ';		
	}
	if (is_array($value)) {
		$str = arrayToString($value);
		$truncate = false;
	}
	elseif (is_bool($value)) {
		$str = 'false';
		if ($value) {
			$str = 'true';
		}
	}
	else {
		$str = $value;
	}
	if ($truncate) {
		$msg = preg_replace("#[\r\n]+#U", " ", mb_substr((string)$str, 0, 150));
	}
	else {
		$msg = preg_replace("#[\r\n]+#U", " ", (string)$str);
	}
	
	if (_WSEXEC == WEB_TYPE) {
		$stemp = $stemp . $msg ."<br>";
	}
	else {
		$stemp = $stemp . $msg ."\r\n";
	}
	print $stemp;
	
	return $return;
}

function displayParams($level = 1, $truncate=true) {
	$ws = workspace::ws_open();

	displayMsg($ws->paramGet('APP_CODE'), 'APP_CODE', $level, $truncate);
	displayMsg($ws->paramGet('APP_ONLY'), 'APP_ONLY', $level, $truncate);
	displayMsg($ws->paramGet('APP_ID'), 'APP_ID', $level, $truncate);
	displayMsg($ws->paramGet('APP_NAME'), 'APP_NAME', $level, $truncate);
	displayMsg($ws->paramGet('PAGE_NAME'), 'PAGE_NAME', $level, $truncate);
	displayMsg($ws->paramGet('CONTENT_PAGE'), 'CONTENT_PAGE', $level, $truncate);
	displayMsg($ws->paramGet('FORUM_SUBJECT_PAGE'), 'FORUM_SUBJECT_PAGE', $level, $truncate);
	displayMsg($ws->paramGet('FORUM_TOPIC_PAGE'), 'FORUM_TOPIC_PAGE', $level, $truncate);
	displayMsg($ws->paramGet('MODULE_NAME'), 'MODULE_NAME', $level, $truncate);
	displayMsg($ws->paramGet('MODE_NAME'), 'MODE_NAME', $level, $truncate);
	displayMsg($ws->paramGet('ROOT_URL'), 'ROOT_URL', $level, $truncate);
	displayMsg($ws->paramGet('ID'), 'ID', $level, $truncate);
	displayMsg($ws->paramGet('ID2'), 'ID2', $level, $truncate);
	displayMsg($ws->paramGet('COMBINE_FLAG'), 'COMBINE_FLAG', $level, $truncate);
	displayMsg($ws->paramGet('CACHE_FLAG'), 'CACHE_FLAG', $level, $truncate);
	displayMsg('********************');
	displayMsg($ws->paramGet('RIGHT_CREATE'), 'RIGHT_CREATE', $level, $truncate);
	displayMsg($ws->paramGet('RIGHT_READ'), 'RIGHT_READ', $level, $truncate);
	displayMsg($ws->paramGet('RIGHT_UPDATE'), 'RIGHT_UPDATE', $level, $truncate);
	displayMsg($ws->paramGet('RIGHT_DELETE'), 'RIGHT_DELETE', $level, $truncate);
	displayMsg($ws->paramGet('RIGHT_EVENT'), 'RIGHT_EVENT', $level, $truncate);
}


function analyseImage($imageStr) {
	$atemp = explode(';',$imageStr);
	$image = '';
	$imageAlt = '';
	$imageTitle = '';

	if (isset($atemp[0])) {
		$image = $atemp[0];
	}
	if (isset($atemp[1])) {
		$imageAlt = $atemp[1];
	}
	if (isset($atemp[2])) {
		$imageTitle = $atemp[2];
	}
	if (!file_exists($image)) {
		$image = '';
	}
	$return['image'] = $image;
	$return['alt'] = $imageAlt;
	$return['title'] = $imageTitle;
	
	return $return;
}

// Functions

/**
* find label for a status id
*
* @param integer stastus id
*
* @return string
*/
function labelStatus($id) {
	$ws = workspace::ws_open();
	
	$label = '';
	switch($id) {
		case -2 :
			$label = $ws->getConfigVars("Lbl_status_m2");
			break;
		case -1 :
			$label = $ws->getConfigVars("Lbl_status_m1");
			break;
		case 1 :
			$label = $ws->getConfigVars("Lbl_status_1");
			break;
		default :
			$label = $ws->getConfigVars("Lbl_status_0");
	}
	return $label;
}

/**
* transform string to code format
*
* @param string transform string by using uppercase
*
* @return string
*/
function strtocode($str)
{
	$str = strtoupper($str);
	$str = utf8_decode($str);
	$str = trim($str);
	$str = strtr($str, "äâàáåãéèëêòóôõöøìíîïùúûüýñçþÿæœðø", "ÄÂÀÁÅÃÉÈËÊÒÓÔÕÖØÌÍÎÏÙÚÛÜÝÑÇÞÝÆŒÐØ");
	$str = utf8_encode($str);
	return $str;
}

/**
* search value in a array
*
* @param string search value
*        array search value
*
* @return boolean
*/
function arraySearch($search, $array) {
	$return = false;
	foreach($array as $key=>$value) {
		$currentKey=$key;
		if (is_array($value)) {
			$return = arraySearch($search, $value);
		}
		else {
			if ($value == $search) {
				$return = true;
			}
		}
		if ($return) {
			break;
		}
	}
	return $return;
}	

/**
* search value in a $_SERVER array
*
* @param string key for $_SERVER array
*
* @return string
*/
function getServer($key) {

	$return = isset($_SERVER[$key]) ? $_SERVER[$key] : '';
	
	return $return;
}	

/**
* search value in a $_COOKIE array
*
* @param string key for $_COOKIE array
*
* @return string
*/
function getCookie($key) {

	$return = isset($_COOKIE[$key]) ? $_COOKIE[$key] : '';
	
	return $return;
}	

function now() {
	$strDate = date('Y-m-d H:i:s.v');
    $now = new DateTime($strDate);
    return $now;
}

function duration($startDateTime, $endDateTime) {
    return $endDateTime->diff($startDateTime);
}

/**
* Read json file 
*
* @param string File
*
* @return array
*/
function jsonRead($filePath) {
	$jsonArray = array();

	if (file_exists($filePath)) {
        $fp = fopen($filePath, "r");
        $fpSize = filesize($filePath);
        $strTemp = fread($fp, $fpSize);
        fclose($fp);
		$jsonArray = json_decode( $strTemp, true);
	}
	
	return $jsonArray;
}

/**
* copy file or folder 
*
* @param string File or folder source
*        string File or folder destination
*        int    New folder right RIGHT_UPDATE or RIGHT_READ
*
* @return boolean
*/
function xcopy($source, $destination, $right = RIGHT_UPDATE) {
	$return  = true;
	
	$permissions = 0775;
	if ($right != RIGHT_UPDATE) {
		$permissions = 0755;
	}
	$source = str_replace('\/','/',$source);
	$destination = str_replace('\/','/',$destination);
	if ((substr($source,-1) != '.') && (substr($source,-2) != '..')) {
		if (is_dir($source)) {
			xmkdir($destination, $permissions);
			foreach (scandir($source) as $file) {
				xcopy($source . '/' . $file, $destination . '/' . $file, $right);
			}
		}
		else {
			copy($source, $destination);
			chmod($destination, $permissions);
			if (defined('GROUP_NAME')) {
				chgrp($destination, GROUP_NAME);
			}
		}
	}

	return $return;
}

function xpath($source) {

	$source .= '/';
	$source = str_replace('\/','/',$source);
	$source = str_replace('//','/',$source);

	return $source;
}

/**
* create folder 
*
* @param string folder to create
*        int    New folder right RIGHT_UPDATE or RIGHT_READ
*
* @return boolean
*/
function xmkdir($destination, $right = RIGHT_UPDATE) {
	$return  = true;
	
	$permissions = 0775;
	if ($right != RIGHT_UPDATE) {
		$permissions = 0755;
	}
	$destination = str_replace('\/','/',$destination);
	
	if (!file_exists($destination)) {
		@mkdir($destination, $permissions, true);
	}
	$file = $destination.'/index.html';
	if (!file_exists($file)) {
		$fp = fopen($file, 'w');
		fwrite($fp, '<html><body></body></html>');
		fclose($fp);
	}

	return $return;
}

/**
* delete file or folder (with all files) 
*
* @param string folder or file to delete
*
* @return boolean
*/
function xdelete($source) {
	$return  = true;
	
	if (is_dir($source)) {
		$objects = scandir($source);
		foreach ($objects as $object) {
			if ($object != "." && $object != "..") {
				if (filetype($source."/".$object) == "dir") {
					xdelete($source."/".$object);
				}
				else {
					unlink($source."/".$object);
				}
			}
		}
		reset($objects);
		rmdir($source);
	}
	else {
		unlink($source);
	}

	return $return;
}

/**
* replace string in a file 
*
* @param string file to process
*        string string to replace
*        string string changed string
*
* @return boolean
*/
function xreplaceInfile($file, $find, $replace) {
	$return  = true;
	
	if ((file_exists($file)) and (!empty($find)) and ($find != $replace)) {
		$content = file_get_contents($file);
		if ($content === false) {
			$return  = false;
		} 
		else {
			$content = str_replace($find, $replace, $content);
			if (file_put_contents($file, $content) === false) {
				$return  = false;
			}
		}
	}

	return $return;
}

/**
* list files in folder and sub-folder 
*
* @param string source folder
*        string Filter to apply (regex)
*        int    New folder right RIGHT_UPDATE or RIGHT_READ
*
* @return boolean
*/
function xscan($source, $filter) {
	$return  = array();
	
	if (is_dir($source)) {
		$source = str_replace('\/','/',$source);
		if ((substr($source,-1) != '.') && (substr($source,-2) != '..')) {
			foreach (preg_grep($filter, scandir($source)) as $file) {
				$return[] = $source . '/' . $file;
			}
			foreach (scandir($source) as $file) {
				if (is_dir($source . '/' . $file)) {
					$return = array_merge($return, xscan($source . '/' . $file, $filter));
				}
			}
		}
	}

	return $return;
}


function initWorkConfig(&$smarty, $reference = "") {
	$ws = workspace::ws_open();

	$smarty->cache_dir = $ws->paramGet('CACHE_DIR');
	$smarty->compile_dir = $ws->paramGet('COMPILE_DIR');
	$smarty->debugging = $ws->paramGet('SMARTY_DEBUG');
		
	// Language directories load
	$ws->addConfigDir($ws->paramGet($ws->paramGet('APP_NAME') . '_LANGUAGE_DIR'), 'one');
	$ws->addConfigDir($ws->paramGet('LANGUAGE_DIR'), 'two');
	
	// Language files load
	$filePath = $ws->paramGet('LANGUAGE_DIR').$ws->sessionGet('lang').'/lang.txt';
	if (file_exists($filePath)) {
		$smarty->configLoad($filePath, $reference);
	}
	$filePath = $ws->paramGet('LANGUAGE_DIR').$ws->sessionGet('lang').'/message.txt';
	if (file_exists($filePath)) {
		$smarty->configLoad($filePath, $reference);
	}
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_LANGUAGE_DIR').$ws->sessionGet('lang').'/lang.txt';
	if (file_exists($filePath)) {
		$smarty->configLoad($filePath, $reference);
	}
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_LANGUAGE_DIR').$ws->sessionGet('lang').'/message.txt';
	if (file_exists($filePath)) {
		$smarty->configLoad($filePath, $reference);
	}
	$filePath = $ws->paramGet('LANGUAGE_DIR').$ws->sessionGet('lang').'/'.$ws->paramGet('APP_NAME').'_lang.txt';
	if (file_exists($filePath)) {
		$smarty->configLoad($filePath, $reference);
	}
	$filePath = $ws->paramGet('LANGUAGE_DIR').$ws->sessionGet('lang').'/'.$ws->paramGet('APP_NAME').'_message.txt';
	if (file_exists($filePath)) {
		$smarty->configLoad($filePath, $reference);
	}
	$smarty->assign('baseUrl', $ws->baseUrlGet());

}

/**
* Empêcher la mise en cache des pages avec PHP
*
* La fonction doit-être appellée avant toute balise HTML,
* espace blanc, echo(), print()...
*
* @param : void
* @return : void
*/
function preventPageCaching()
{
	header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
}

function dateFormat($format, $timestamp = null)
{
	$ws = workspace::ws_open();

	if ($timestamp === null) {
		$timestamp = time();
	}
    if (strpos($format, '%') !== false) {
		$return = utf8_encode(strftime($format, $timestamp));
	}
	else {
		$fmt = datefmt_create(
			$ws->paramGet('LOCAL_PARAM', 'en_US'),
			IntlDateFormatter::FULL,
			IntlDateFormatter::FULL,
			$ws->paramGet('LOCAL_ZONE','Europe/London'),
			IntlDateFormatter::GREGORIAN,
			$format
		);		
		
		$return = datefmt_format($fmt, $timestamp);		
	}
	return $return;
}

/**
* Class workpage for page and widget design
*/
class workpage extends Smarty
{

    public function __construct($reference = "") 
    {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		parent::__construct();
		initWorkConfig($this, $reference);

		return $this;
	}
}

/**
* Class "space work" for the application
*/
class workspace extends Smarty
{
    private static $_instance;
	private $_direct;
	public $_arrayGet = array();
	private $_baseUrl;
	private $_urlRewriting;
	private $_cookieFlag;
	private $_cookieResponse;
	private $_cssFile = array();
	private $_jsFile = array();
	private $_cssOneFile = array();
	private $_jsOneFile = array();
	private $_cssCombineFile = array();
	private $_jsCombineFile = array();
	private $_templateName;

	private $_siteTitle;
	private $_canonical;
	private $_keywords;
	private $_urlLink;
	private $_errorPage;
	private $_favicon;
	private $_twitterTitle;
	
	private $_urlTitle;
	private $_urlDescription;
	private $_urlKeywords;
	private $_urlNewsKeywords;
	private $_urlImage;
	
	private $_pageTitle;
	private $_pageDescription;
	private $_pageKeywords;
	private $_pageNewsKeywords;
	private $_pageImage;
	
    public $_paramarray = array ();


	public static function codeToLabel($code) {
		$ws = self::ws_open();
	
		$label = $ws->getConfigVars($code);
		if (empty($label)) {
			$label = $code;
		}
		return $label;
	}


	public static function ws_open($baseUrl='', $connexionDuration=30, $cacheDuration=0, $sessionServer='') {
		if (!isset(self::$_instance)) {
			self::$_instance = new workspace();
			/* Démarre la session */
			if (!empty($sessionServer)) {
				ini_set('session.cookie_domain', '.' . $sessionServer); 
			}
			ini_set('session.gc_maxlifetime', $connexionDuration*60);
			ini_set('session.cookie_lifetime', $connexionDuration*60);
			session_start();

			$date = new DateTime();
			$dateTimeCur = $date->getTimestamp();
			if (isset($_SESSION['global_dateTimeMaj'])) {
				$dateTimeOld = $_SESSION['global_dateTimeMaj'];
				$diffDate = $dateTimeCur - $dateTimeOld;
				if ($diffDate > $connexionDuration*60) {
					session_destroy();
					session_unset();
					session_start();
				}
			}
			$_SESSION['global_dateTimeMaj'] = $dateTimeCur;
			if (isset($_SESSION['cache_dateTimeMaj'])) {
				$dateTimeOld = $_SESSION['cache_dateTimeMaj'];
				$diffDate = $dateTimeCur - $dateTimeOld;
				if (($cacheDuration <> 0) and ($diffDate > $cacheDuration*60)) {
					unset($_SESSION['cache']);
					$_SESSION['cache_dateTimeMaj'] = $dateTimeCur;
				}
			}
			else {
				$_SESSION['cache_dateTimeMaj'] = $dateTimeCur;
			}		
			if (!isset($_SESSION['lang'])) {
				$_SESSION['lang'] = DEFAULT_LANGUAGE;
			}
			self::$_instance->_templateName = '';
			
			if (self::$_instance->script()) {
				self::$_instance->_arrayGet = array();
			}
			else {
				self::$_instance->_arrayGet = $_GET;	
			}
			self::$_instance->_direct = true;
			self::$_instance->_baseUrl = $baseUrl;
			self::$_instance->_urlRewriting = false;
			$cookieFlag = self::$_instance->sessionGet('cookie_flag');
			if (!is_bool($cookieFlag)) {
				$cookieFlag = true;
				self::$_instance->sessionSet('cookie_flag', true);
			}
			$cookieResponse = self::$_instance->sessionGet('cookie_response');
			if (!is_bool($cookieResponse)) {
				$cookieResponse = false;
				self::$_instance->sessionSet('cookie_response', false);
			}
			self::$_instance->_cookieFlag = $cookieFlag;
			self::$_instance->_cookieResponse = $cookieResponse;
			self::$_instance->_siteTitle = '';
			self::$_instance->_canonical = '';
			self::$_instance->_keywords = '';
			self::$_instance->_urlLink = '';
			self::$_instance->_errorPage = '';
			self::$_instance->_favicon = '';
			self::$_instance->_twitterTitle = '';
			
			self::$_instance->_urlTitle = '';
			self::$_instance->_urlDescription = '';
			self::$_instance->_urlKeywords = '';
			self::$_instance->_urlNewsKeywords = '';
			self::$_instance->_urlImage = '';
			
			self::$_instance->_pageTitle = '';
			self::$_instance->_pageDescription = '';
			self::$_instance->_pageKeywords = '';
			self::$_instance->_pageNewsKeywords = '';
			self::$_instance->_pageImage = '';
			
			if (self::$_instance->script()) {
				self::$_instance->sessionSet('connect_id', '0');
			}

		}
		return self::$_instance;
	}

	public static function convBool($value)
	{
		$return = false;
		
		if ($value == 1) {
			$return = true;
		}
		if ($value == 'true') {
			$return = true;
		}
		if ($value) {
			$return = true;
		}
		
		return $return;		
	}

	public static function convInt($value)
	{
		$return = 0;
		
		return $return;		
	}

	public function logSys($log_type, $message_text, $logger='sys', $message_params=null, $message_type="text")
	{
		$trace_array = debug_backtrace();

		$connect_id = $this->sessionGet('connect_id');
		$connect_name = $this->sessionGet('connect_name');

		if (LOG4PHP_GROUP) {
			$logger='sys';
		}
		$text_syslog = "";
		$text_syslog = $text_syslog . "Session : [" . session_id() . "]|User id : " . $connect_id . "|Name : " . $connect_name . "|\n";
		$text_syslog = $text_syslog . "  ==> File : " . $trace_array[0]["file"] . "|\n";
		if (isset($trace_array[1])) {
			$text_syslog = $text_syslog . "  ==> Traitement : [" . basename($trace_array[0]["file"],".php") . "]|Function : [" . $trace_array[1]["function"] . "]| Line : " . $trace_array[0]["line"] . "| ".  $message_text ."|";
		}
		else {
			$text_syslog = $text_syslog . "  ==> Traitement : [" . basename($trace_array[0]["file"],".php") . "]|Function : []| Line : " . $trace_array[0]["line"] . "| ".  $message_text ."|";
		}
		if (isset($message_params)) {
			$message_detail = json_encode($message_params);
		}
		else {
			$message_detail = "none";
		}

		switch ($message_type) {
			case 'arguments':
				$text_syslog = $text_syslog . " Arguments : " . $message_detail . "|";
				break;

			case 'results':
				$text_syslog = $text_syslog . " Results : " . $message_detail . "|";
				break;

			default :
				$text_syslog = $text_syslog . " Detail : " . $message_detail . "|";
				break;
		}
		
		switch ($log_type) {
			case 'info':
				$syslog = Logger::getLogger($logger);
				if (isset($syslog)) {
					$syslog->info($text_syslog);
				}
				break;
			case 'debug':
				$syslog = Logger::getLogger($logger);
				if (isset($syslog)) {
					$syslog->debug($text_syslog);
				}
				break;
			case 'error':
				$syslog = Logger::getLogger($logger);
				if (isset($syslog)) {
					$syslog->error($text_syslog);
				}
				break;
			default :
				$syslog = Logger::getLogger($logger);
				if (isset($syslog)) {
					$syslog->trace($text_syslog);
				}
				break;
		}
	}

	public function logfunc($log_type, $message_text, $message_params=null)
	{
		$trace_array = debug_backtrace();
		$connect_id = $this->sessionGet('connect_id');
		$connect_name = $this->sessionGet('connect_name');
		$message_code = '';
		
		if (($log_type == 'info') or ($log_type == 'error')) {
			$message_code = $message_text;
			$message_text = $this->messageCodeSet($message_code, $message_params);
		}
			
		$text_funclog = "";
		$text_funclog = $text_funclog . "Session : [" . session_id() . "]|User id : " . $connect_id . "|Name : " . $connect_name . "|";
		$text_funclog = $text_funclog . "Module : [" . basename($trace_array[0]["file"],".php") . "]|Function : [" . $trace_array[1]["function"] . " - " . $trace_array[2]["function"] . "]|";
		if ($message_code == '') {
			$text_funclog = $text_funclog . " " . $message_text . "";
		}
		else {
			$text_funclog = $text_funclog . " [" . $message_code . "] " . $message_text . "";
		}
		
		switch ($log_type) {
			case 'info':
				$funclog = Logger::getLogger('func');
				$funclog->info($text_funclog);
				break;

			case 'error':
				$funclog = Logger::getLogger('func');
				$funclog->error($text_funclog);
				break;

			default :
				$funclog = Logger::getLogger('func');
				$funclog->trace($text_funclog);
				break;
		}
	}

	public function logTrace($app, $page, $id, $title)
	{
		$connectId = $this->sessionGet('connect_id');
		$referer = getServer('HTTP_REFERER');
		$userAgent = getServer('HTTP_USER_AGENT');
		$url = getServer('REQUEST_URI');
		$server = getServer('SERVER_NAME');
		$cookie = getCookie($this->paramGet('COOKIE'));
		
		$text = session_id() . "|";
		$text .= $app . "|";
		$text .= $this->getIp(). "|";
		$text .= $page . "|";
		$text .= $id . "|";
		$text .= $title . "|";
		$text .= $connectId . "|";
		$text .= $referer . "|";
		$text .= $userAgent . "|";
		$text .= $url . "|";
		$text .= $server . "|";
		$text .= $this->getUser(). "|";
		$text .= $cookie;
		
		$tracelog = Logger::getLogger('trace');
		$tracelog->info($text);
	}
	
    public function messageCodeSet($message_code, $message_params=null)
    {
		$message_text = $this->getConfigVars($message_code);
		if (isset($message_params)) {
			foreach($message_params as $param_key=>$param_value) {
					$message_text = str_replace("[" . $param_key . "]", $param_value, $message_text);
			}
		}
		$this->sessionSet('message_code', $message_code);
		$this->sessionSet('message_text', $message_text);
		return $message_text;
	}
	
    public function messageDisplay()
    {
		$message_code = $this->sessionGet('message_code');
		$message_text = $this->sessionGet('message_text');
		$this->sessionSet('message_code', '');
		$this->sessionSet('message_text', '');
		$this->assign('MessageCode', $message_code);
		$this->assign('MessageText', $message_text);
	}

    public function messageCodeGet()
    {
		return $this->_message_code;
	}

    public function messageTextGet()
    {
		return $this->_message_text;
	}

    public function directGet()
    {
		return $this->_direct;
	}
	
    public function directSet($value)
    {
		if ($value == true) {
			$this->_direct = true;
		}
		else {
			$this->_direct = false;
		}
	}

    public function urlRewritingGet()
    {
		return $this->_urlRewriting;
	}
	
    public function urlRewritingSet($value)
    {
		if ($value == true) {
			$this->_urlRewriting = true;
		}
		else {
			$this->_urlRewriting = false;
		}
	}

    public function cookieFlagGet()
    {
		return $this->_cookieFlag;
	}
	
    public function cookieFlagSet($value)
    {
		if ($value == true) {
			$this->_cookieFlag = true;
			$this->sessionSet('cookie_flag', true);
		}
		else {
			$this->_cookieFlag = false;
			$this->sessionSet('cookie_flag', false);
		}
	}

    public function cookieResponseGet()
    {
		return $this->_cookieResponse;
	}
	
    public function cookieResponseSet($value)
    {
		if ($value == true) {
			$this->_cookieResponse = true;
			$this->sessionSet('cookie_response', true);
		}
		else {
			$this->_cookieResponse = false;
			$this->sessionSet('cookie_response', false);
		}
	}

    public function siteTitleGet()
    {
		return $this->_siteTitle;
	}
	
    public function siteTitleSet($value)
    {
		$this->_siteTitle = $value;
	}

    public function twitterTitleGet()
    {
		return $this->_twitterTitle;
	}
	
    public function twitterTitleSet($value)
    {
		$this->_twitterTitle = $value;
	}

    public function canonicalGet()
    {
		return $this->_canonical;
	}
	
    public function canonicalSet($value)
    {
		$this->_canonical = $value;
	}

    public function keywordsGet()
    {
		return $this->_keywords;
	}
	
    public function keywordsSet($value)
    {
		$this->_keywords = $value;
	}

    public function urlLinkGet()
    {
		return $this->_urlLink;
	}
	
    public function urlLinkSet($value)
    {
		$this->_urlLink = $value;
	}

    public function errorPageGet()
    {
		return $this->_errorPage;
	}
	
    public function errorPageSet($value)
    {
		$this->_errorPage = $value;
	}
	
    public function faviconGet()
    {
		return $this->_favicon;
	}
	
    public function faviconSet($value)
    {
		$this->_favicon = $value;
	}

    public function urlTitleGet()
    {
		return $this->_urlTitle;
	}
	
    public function urlTitleSet($value)
    {
		$this->_urlTitle = $value;
	}

    public function urlDescriptionGet()
    {
		return $this->_urlDescription;
	}
	
    public function urlDescriptionSet($value)
    {
		$this->_urlDescription = $value;
	}

    public function urlKeywordsGet()
    {
		return $this->_urlKeywords;
	}
	
    public function urlKeywordsSet($value)
    {
		$this->_urlKeywords = $value;
	}

    public function urlNewsKeywordsGet()
    {
		return $this->_urlNewsKeywords;
	}
	
    public function urlNewsKeywordsSet($value)
    {
		$this->_urlNewsKeywords = $value;
	}

    public function urlImageGet()
    {
		return $this->_urlImage;
	}
	
    public function urlImageSet($value)
    {
		$this->_urlImage = $value;
	}

    public function pageTitleGet()
    {
		return $this->_pageTitle;
	}
	
    public function pageTitleSet($value)
    {
		$this->_pageTitle = $value;
	}

    public function pageDescriptionGet()
    {
		return $this->_pageDescription;
	}
	
    public function pageDescriptionSet($value)
    {
		$this->_pageDescription = $value;
	}

    public function pageKeywordsGet()
    {
		return $this->_pageKeywords;
	}
	
    public function pageKeywordsSet($value)
    {
		$this->_pageKeywords = $value;
	}

    public function pageNewsKeywordsGet()
    {
		return $this->_pageNewsKeywords;
	}
	
    public function pageNewsKeywordsSet($value)
    {
		$this->_pageNewsKeywords = $value;
	}

    public function pageImageGet()
    {
		return $this->_pageImage;
	}
	
    public function pageImageSet($value)
    {
		$this->_pageImage = $value;
	}
	
	public function userConnected() {
		$flagConnect = false;

		if (!empty($this->paramGet('USER_GUEST'))) {
			if ($this->sessionGet('connect_id') != $this->paramGet('USER_GUEST')) {
				$flagConnect = $this->connected();
			}
		}
		else {
			$flagConnect = $this->connected();
		}
		return $flagConnect;
	}

	public function adminConnected() {
		$flagConnect = false;

		if (!empty($this->paramGet('USER_SUPERADMIN'))) {
			if ($this->sessionGet('connect_id') == $this->paramGet('USER_SUPERADMIN')) {
				$flagConnect = $this->connected();
			}
		}
		return $flagConnect;
	}

	public function connected() {
		$flagConnect = false;

		if ((!isset($argv)) && ($this->sessionGet('connect_id') == '')) {
			$flagConnect = false;
		}
		else {
			$flagConnect = true;			
		}
		return $flagConnect;
	}

	public function connected_id() {
		if ($this->connected()) {
			return $this->sessionGet('connect_id');
		}
		else {
			return 0;
		}		
	}

	public function connected_name() {
		if ($this->connected()) {
			return $this->sessionGet('connect_name');
		}
		else {
			return '';
		}
	}

	public function connected_surname() {
		if ($this->connected()) {
			return $this->sessionGet('connect_surname');
		}
		else {
			return '';
		}
	}

	public function connected_appCount() {
		$appCount = 0;
		if ($this->connected()) {
			if ($this->paramGet('APP_ONLY') == '') {
				$appCount = $this->sessionGet('connect_app_count');
			}
			else {
				$appCount = 1;
			}
		}
		return $appCount;
	}

	public function connected_appDefault() {
		if ($this->connected()) {
			return $this->sessionGet('connect_app_default');
		}
		else {
			return '';
		}
	}

	
	/**
	* Get param variable value
	*
	* @param string - param variable name
	*
	* @return undefined  - param variable value
	*
    * @access public
	*/
	public function paramGet($variable, $default='') {
		$variable = strtoupper($variable);
		if (isset($this->_paramarray[$variable])) {
			return $this->_paramarray[$variable];
		} 
		else {
			return $default;
		}
	}
	
	/**
	* set param variable
	*
	* @param string - param variable name
	* 	 undefined  - param variable value
	*
	* @return boolean - true : Set ok
	*                 - false : Set Ko
	*
    * @access public
	*/
	public function paramSet($variable, $value) {
		$variable = strtoupper($variable);
		$this->_paramarray[$variable] = $value;
		if ($this->_paramarray[$variable]==$value) {
			return true;
		} else {

			return false;
		}
	}
	
	/**
	* control param variable
	*
	* @param string - param variable name
	*
	* @return boolean - true : valide variable
	*                 - false : unvalide variable
	*
    * @access public
	*/
	public function ctrlParam($variable) {
		return isset($this->_paramarray[$variable]);				
	}

	public function paramTo_array() {
		return $this->_paramarray;
	}
	
	public function redirect($url_redirection) {
		header('Location: ' . $url_redirection);
		exit();
	}
	
	/**
	* Set base Url
	*
	* @param  string - base Url value
	*
	* @return none
	*
    * @access public
	*/
	public function baseUrlSet($baseUrl) {
		self::$_instance->_baseUrl = $baseUrl;
	}

	/**
	* Get base Url
	*
	* @param none
	*
	* @return string - base Url value
	*
    * @access public
	*/
	public function baseUrlGet() {
		$baseUrl = self::$_instance->_baseUrl;
		return $baseUrl;
	}

	/**
	* control arg ($_GET) variable
	*
	* @param string - arg variable name for web or number for script
	*
	* @return boolean - true : valide variable
	*                 - false : unvalide variable
	*
    * @access public
	*/
	public function ctrlGet($variable) {
		return isset($this->_arrayGet[$variable]);				
	}

	/**
	* Get arg ($_GET) variable
	*
	* @param string - arg variable name for web or number for script
	*
	* @return void - arg variable value
	*
    * @access public
	*/
	public function argGet($variable) {
		if (isset($this->_arrayGet[$variable])) {
			return $this->_arrayGet[$variable];
		} 
		else {
			return '';				
		}
	}

	/**
	* Get all arg ($_GET) variables
	*
	* @param no
	*
	* @return array - arg array
	*
    * @access public
	*/
	public function argAllGet() {
		return $this->_arrayGet;
	}

	/**
	* Load arg ($argv) variable
	*
	* @param array - $argv 
	*
	* @return - no
	*
    * @access public
	*/
	public function argLoad($array, $index=0) {
		for ($i=$index; $i < count($array); $i++) {
			$this->_arrayGet[] = $array[$i];
		}
	}
	
	/**
	* control arg ($_POST) variable
	*
	* @param string - arg variable name
	*
	* @return boolean - true : valide variable
	*                 - false : unvalide variable
	*
    * @access public
	*/
	public function ctrlPost($variable) {
		
		return isset($_POST[$variable]);
	}

	/**
	* Get arg ($_POST) variable
	*
	* @param string - arg variable name
	*
	* @return void - arg variable value
	*
    * @access public
	*/
	public function argPost($variable = '') {
		if (!empty($variable)) {
			if (isset($_POST[$variable])) {
				$value = $_POST[$variable];
				return $value;
			} 
			else {
				return '';				
			}
		}
		else {
			return $_POST;
		}
	}

	/**
	* Get session ($_SESSION) variable
	*
	* @param string - session variable name
	*
	* @return void - session variable value
	*
    * @access public
	*/
	public function sessionGet($variable) {
		if (isset($_SESSION[$variable])) {
			if ($variable == 'cache') {
				if (isset($_SESSION['connect_cache'])) {
					$connectCache = $_SESSION['connect_cache'];
				}
				else {
					$connectCache = true;
				}
				if ((SESSION_CACHE) and ($connectCache)) {
					return $_SESSION[$variable];
				}
				else {
					return array();
				}
			}
			else {
				return $_SESSION[$variable];
			}
		} 
		else {
			if ($variable == 'cache') {
				return array();
			}
			else {
				return '';
			}
		}
	}

	/**
	* Set session ($_SESSION) variable
	*
	* @param string - session variable name
	* 		 string - session variable value
	*
	* @return boolean - process return
	*
    * @access public
	*/
	public function sessionSet($variable, $value) {
		if ($variable == 'cache') {
			if (isset($_SESSION['connect_cache'])) {
				$connectCache = $_SESSION['connect_cache'];
			}
			else {
				$connectCache = true;
			}
			if ((SESSION_CACHE) and ($connectCache)) {
				$_SESSION[$variable] = $value;
			}
		}
		else {
			$_SESSION[$variable] = $value;
		}
		if (isset($_SESSION[$variable])) {
			return true;
		} else {
			return false;
		}
	}

	/**
	* control cache variable
	*
	* @param string - cache variable name
	*		 string - cache category : 'data' by default
	*
	* @return boolean - true : valide variable
	*                 - false : unvalide variable
	*
    * @access public
	*/
	public function cacheCtrl($name, $category = 'data') {
		if (isset($_SESSION['connect_cache'])) {
			$connectCache = $_SESSION['connect_cache'];
		}
		else {
			$connectCache = true;
		}
		if ((SESSION_CACHE) and ($connectCache)) {
			$cache = $this->sessionGet('cache');
			$return = isset($cache[$category . '_' . $this->connected_id()][$this->paramGet('APP_ID')][$name]);
		}
		else {
			$return = false;
		}
		return $return;
	}

	/**
	* Get cache variable
	*
	* @param string - cache variable name
	*		 string - cache category : 'data' by default
	*
	* @return string - cache variable value
	*
    * @access public
	*/
	public function cacheGet($name, $category = 'data') {
		$cache = $this->sessionGet('cache');
		if (isset($cache[$category . '_' . $this->connected_id()][$this->paramGet('APP_ID')][$name])) {
			$value = $cache[$category . '_' . $this->connected_id()][$this->paramGet('APP_ID')][$name];
		}
		else {
			$value = '';			
		}
		return $value;
	}

	/**
	* Set cache variable
	*
	* @param string - cache variable name
	* 		 string - cache variable value
	*		 string - cache category : 'data' by default
	*
    * @access public
	*/
	public function cacheSet($name, $value, $category = 'data') {
		$cache = $this->sessionGet('cache');
		$cache[$category . '_' . $this->connected_id()][$this->paramGet('APP_ID')][$name] = $value;
		$this->sessionSet('cache', $cache);
		$date = new DateTime();
		$this->sessionSet('cache_dateTimeMaj', $date->getTimestamp());
	}

	/**
	* Clear cache
	*
	* @param string - cache category : 'data' by default
	*
    * @access public
	*/
	public function cacheClear($name, $category = 'data') {
		$cache = $this->sessionGet('cache');
		unset($cache[$category . '_' . $this->connected_id()][$this->paramGet('APP_ID')][$name]);
		$this->sessionSet('cache', $cache);
		$date = new DateTime();
		$this->sessionSet('cache_dateTimeMaj', $date->getTimestamp());
	}

	/**
	* add css file
	*
	* @param string  - css file name
	* 		 boolean - combine flag
	*
	* @return - no return
	*
    * @access public
	*/
    public function addcss($css_file, $combine=true)
    {
		$css_result = $css_file;
		if (preg_match("#\.less$#Usi",$css_file)) {
			$name_result = $css_file;
			$name_result = preg_replace("#^\./#Usi", '', $name_result);
			$name_result = preg_replace("#\.less$#Usi", '', $name_result);
			$name_result = preg_replace("#/#Usi", '_', $name_result);
			$css_result = $this->paramGet('RELA_CACHE_DIR') . $name_result . '.css';
			$less = new lessc;
			$file_input = SITE_ROOT_DIR . preg_replace('#^\./#Usi', '', $css_file);
			$file_output = SITE_ROOT_DIR . preg_replace('#^\./#Usi', '', $css_result); 
			$less->checkedCompile($file_input, $file_output);
			
		}
		$key = array_search($css_result, $this->_cssFile);
		if ($key === false) {
			$this->_cssFile[]=$css_result;
		
			if (($combine) and ($this->paramGet('CSS_COMBINE'))) {
				$this->_cssCombineFile[] = preg_replace('#^\.#Usi', '', $css_result);
			}
			else {
				$this->_cssOneFile[]=$css_result;
			}
		}
	}

    public function clearcss($css_file = '')
    {
		if (empty($css_file)) {
			$this->_cssFile = array();
			$this->_cssCombineFile = array();
			$this->_cssOneFile = array();
		}
		else {
			$key = array_search($css_file, $this->_cssFile);
			if ($key !== false) {
				unset($this->_cssFile[$key]);
				$this->_cssFile = array_values($this->_cssFile);
			}
			$key = array_search(preg_replace('#^\.#Usi', '', $css_file), $this->_cssCombineFile);
			if ($key !== false) {
				unset($this->_cssCombineFile[$key]);
				$this->_cssCombineFile = array_values($this->_cssCombineFile);
			}
			$key = array_search($css_file, $this->_cssOneFile);
			if ($key !== false) {
				unset($this->_cssOneFile[$key]);
				$this->_cssOneFile = array_values($this->_cssOneFile);
			}
		}
	}
	
	/**
	* add js file
	*
	* @param string  - js file name
	* 		 boolean - combine flag
	*
	* @return - no return
	*
    * @access public
	*/
    public function addjs($js_file, $combine=true)
    {
		$key = array_search($js_file, $this->_jsFile);
		if ($key === false) {
			$this->_jsFile[]=$js_file;
		
			if (($combine) and ($this->paramGet('JS_COMBINE'))) {
				$this->_jsCombineFile[] = preg_replace('#^\.#Usi', '', $js_file);
			}
			else {
				$this->_jsOneFile[]=$js_file;
			}
		}
	}

    public function clearjs($js_file='')
    {
		if (empty($js_file)) {
			$this->_jsFile = array();
			$this->_jsCombineFile = array();
			$this->_jsOneFile = array();
		}
		else {
			$key = array_search($js_file, $this->_jsFile);
			if ($key !== false) {
				unset($this->_jsFile[$key]);
				$this->_jsFile = array_values($this->_jsFile);
			}
			$key = array_search(preg_replace('#^\.#Usi', '', $js_file), $this->_jsCombineFile);
			if ($key !== false) {
				unset($this->_jsCombineFile[$key]);
				$this->_jsCombineFile = array_values($this->_jsCombineFile);
			}
			$key = array_search($js_file, $this->_jsOneFile);
			if ($key !== false) {
				unset($this->_jsOneFile[$key]);
				$this->_jsOneFile = array_values($this->_jsOneFile);
			}
		}
	}

    public function getjs()
    {
		return $this->_jsFile;
	}

    public function getCombinejs()
    {
		return $this->_jsCombineFile;
	}

    public function getOnejs()
    {
		return $this->_jsOneFile;
	}

    public function isCached($template_name = null, $cache_id = null, $compile_id = null, $parent = null)
    {
		if (($template_name <> 'refresh') and ($template_name <> 'return') and ($template_name <> 'simple')) {
			$return = parent::isCached($template_name, $this->baseUrlGet() . '_' . $this->sessionGet('connect_id')  . '_' . $this->paramGet('APP_CODE') . '_' . $this->paramGet('PAGE_NAME') . '_' . $this->paramGet('MODULE_NAME') . '_' . $this->paramGet('ID'));
		}
		else {
			$return = parent::isCached($template_name . '.tpl', $this->baseUrlGet() . '_' . $this->sessionGet('connect_id'));
		}
		return $return;
	}

    public function clearCache($template_name)
    {
		if (($template_name <> 'refresh') and ($template_name <> 'return') and ($template_name <> 'simple')) {
			parent::clearCache($template_name, $this->baseUrlGet() . '_' . $this->sessionGet('connect_id')  . '_' . $this->paramGet('APP_CODE') . '_' . $this->paramGet('PAGE_NAME') . '_' . $this->paramGet('MODULE_NAME') . '_' . $this->paramGet('ID'));
		}
		else {
			parent::clearCache($template_name . '.tpl', $this->baseUrlGet() . '_' . $this->sessionGet('connect_id'));
		}
	}
	
	/**
	* display template
	*
	* @param string  - template name
	*
	* @return - no return
	*
    * @access public
	*/
     public function build($template_name)
    {
		if (!$this->paramGet('BROWSER_CACHE')) {
			preventPageCaching();
		}
		$this->_cssFile = array_unique($this->_cssFile);
		$this->_jsFile = array_unique($this->_jsFile);
		
		$this->assign('baseUrl',$this->_baseUrl);
		$this->assign('filecss',$this->_cssFile);
		$this->assign('filejs',$this->_jsFile);

		$this->assign('fileOnecss',$this->_cssOneFile);
		$this->assign('fileOnejs',$this->_jsOneFile);
		
		$this->assign('fileCombinecss',$this->_cssCombineFile);
		$this->assign('fileCombinejs',$this->_jsCombineFile);
		$this->assign('outputCombinecss','/' . CACHE_PATH . strtolower($this->paramGet('APP_CODE')) . '_mini.css');
		$this->assign('outputCombinejs','/' . CACHE_PATH . strtolower($this->paramGet('APP_CODE')) . '_mini.js');

		$this->assign('siteTitle',$this->_siteTitle);
		$this->assign('urlLink',$this->_urlLink);
		$this->assign('favicon',$this->_favicon);
		if (!empty($this->_twitterTitle)) {
			$this->assign('twitterTitle',$this->_twitterTitle);
		}
		else {
			$this->assign('twitterTitle',$this->_siteTitle);
		}
		
		$this->assign('urlTitle',$this->_urlTitle);
		$this->assign('urlDescription',$this->_urlDescription);
		$this->assign('urlKeywords',$this->_urlKeywords);
		$this->assign('urlNewsKeywords',$this->_urlNewsKeywords);
		$this->assign('urlImage',$this->_urlImage);
		
		$this->assign('pageTitle',$this->_pageTitle);
		$this->assign('pageDescription',$this->_pageDescription);
		$this->assign('pageKeywords',$this->_pageKeywords);
		$this->assign('pageNewsKeywords',$this->_pageNewsKeywords);
		$this->assign('pageImage',$this->_pageImage);
		
		$this->assign('combineFlag',$this->paramGet('COMBINE_FLAG'));
		$this->assign('pageAppCode',$this->paramGet('APP_CODE'));
		$this->assign('pageAppOnly',$this->paramGet('APP_ONLY'));
		$this->assign('pageAppId',$this->paramGet('APP_ID'));
		$this->assign('pageAppName',$this->paramGet('APP_NAME'));
		$this->assign('pageName',$this->paramGet('PAGE_NAME'));
		$this->assign('pageContent',$this->paramGet('CONTENT_PAGE'));
		$this->assign('pageModuleName',$this->paramGet('MODULE_NAME'));
		$this->assign('pageModeName',$this->paramGet('MODE_NAME'));
		
		$this->assign('pageRightCreate',$this->paramGet('RIGHT_CREATE'));
		$this->assign('pageRightRead',$this->paramGet('RIGHT_READ'));
		$this->assign('pageRightUpdate',$this->paramGet('RIGHT_UPDATE'));
		$this->assign('pageRightDelete',$this->paramGet('RIGHT_DELETE'));
		$this->assign('pageRightEvent',$this->paramGet('RIGHT_EVENT'));

		// browser cache
		$this->assign('browserCache', $this->paramGet('BROWSER_CACHE'));

		// cookies informations
		$this->assign('cookieParam', $this->paramGet('COOKIE_PARAM'));
		$this->assign('cookieResponse', $this->cookieResponseGet());
		$this->assign('cookieFlag', $this->cookieFlagGet());
		
		if (($template_name <> 'refresh') and ($template_name <> 'return') and ($template_name <> 'reload') and ($template_name <> 'simple')) {
			$this->messageDisplay();
			$this->display($template_name, $this->baseUrlGet() . '_' . $this->sessionGet('connect_id')  . '_' . $this->paramGet('APP_CODE') . '_' . $this->paramGet('PAGE_NAME') . '_' . $this->paramGet('MODULE_NAME') . '_' . $this->paramGet('ID'));
		}
		else {
			if ($template_name == 'simple') {
				$this->messageDisplay();
			}
			$this->display($template_name . '.tpl', $this->baseUrlGet() . '_' . $this->sessionGet('connect_id'));
		}
	}
	
	/**
	* fetch template
	*
	* @param string  - template name
	*
	* @return - page html
	*
    * @access public
	*/
     public function displayFetch($template_name)
    {
		$this->_cssFile = array_unique($this->_cssFile);
		$this->_jsFile = array_unique($this->_jsFile);
		
		$this->assign('baseUrl',$this->_baseUrl);
		$this->assign('filecss',$this->_cssFile);
		$this->assign('filejs',$this->_jsFile);

		$this->assign('fileOnecss',$this->_cssOneFile);
		$this->assign('fileOnejs',$this->_jsOneFile);
		
		$this->assign('fileCombinecss',$this->_cssCombineFile);
		$this->assign('fileCombinejs',$this->_jsCombineFile);
		$this->assign('outputCombinecss','/' . CACHE_PATH . strtolower($this->paramGet('APP_CODE')) . '_mini.css');
		$this->assign('outputCombinejs','/' . CACHE_PATH . strtolower($this->paramGet('APP_CODE')) . '_mini.js');

		$this->assign('siteTitle',$this->_siteTitle);
		$this->assign('urlLink',$this->_urlLink);
		$this->assign('favicon',$this->_favicon);
		if (!empty($this->_twitterTitle)) {
			$this->assign('twitterTitle',$this->_twitterTitle);
		}
		else {
			$this->assign('twitterTitle',$this->_siteTitle);
		}
		
		$this->assign('urlTitle',$this->_urlTitle);
		$this->assign('urlDescription',$this->_urlDescription);
		$this->assign('urlKeywords',$this->_urlKeywords);
		$this->assign('urlNewsKeywords',$this->_urlNewsKeywords);
		$this->assign('urlImage',$this->_urlImage);
		
		$this->assign('pageTitle',$this->_pageTitle);
		$this->assign('pageDescription',$this->_pageDescription);
		$this->assign('pageKeywords',$this->_pageKeywords);
		$this->assign('pageNewsKeywords',$this->_pageNewsKeywords);
		$this->assign('pageImage',$this->_pageImage);
		
		$this->assign('combineFlag',$this->paramGet('COMBINE_FLAG'));
		$this->assign('pageAppCode',$this->paramGet('APP_CODE'));
		$this->assign('pageAppOnly',$this->paramGet('APP_ONLY'));
		$this->assign('pageAppId',$this->paramGet('APP_ID'));
		$this->assign('pageAppName',$this->paramGet('APP_NAME'));
		$this->assign('pageName',$this->paramGet('PAGE_NAME'));
		$this->assign('pageContent',$this->paramGet('CONTENT_PAGE'));
		$this->assign('pageModuleName',$this->paramGet('MODULE_NAME'));
		$this->assign('pageModeName',$this->paramGet('MODE_NAME'));
		
		$this->assign('pageRightCreate',$this->paramGet('RIGHT_CREATE'));
		$this->assign('pageRightRead',$this->paramGet('RIGHT_READ'));
		$this->assign('pageRightUpdate',$this->paramGet('RIGHT_UPDATE'));
		$this->assign('pageRightDelete',$this->paramGet('RIGHT_DELETE'));
		$this->assign('pageRightEvent',$this->paramGet('RIGHT_EVENT'));

		// browser cache
		$this->assign('browserCache', $this->paramGet('BROWSER_CACHE'));

		// cookies informations
		$this->assign('cookieParam', $this->paramGet('COOKIE_PARAM'));
		$this->assign('cookieResponse', $this->cookieResponseGet());
		$this->assign('cookieFlag', $this->cookieFlagGet());
		
		if (($template_name <> 'refresh') and ($template_name <> 'return') and ($template_name <> 'simple')) {
			$this->messageDisplay();
			$return = $this->fetch($template_name, $this->baseUrlGet() . '_' . $this->sessionGet('connect_id')  . '_' . $this->paramGet('APP_CODE') . '_' . $this->paramGet('PAGE_NAME') . '_' . $this->paramGet('MODULE_NAME') . '_' . $this->paramGet('ID'));
		}
		else {
			if ($template_name == 'simple') {
				$this->messageDisplay();
			}
			$return = $this->fetch($template_name . '.tpl', $this->baseUrlGet() . '_' . $this->sessionGet('connect_id'));
		}
		return $return;
	}

    public function keyValue($argv, $key)
    {
		$value = '';
		for ($temp=0; $temp < count($argv); $temp++) {
			$atemp = explode('=', $argv[$temp], 2);
			if (trim(strtoupper($key)) == trim(strtoupper($atemp[0]))) {
				$value = $atemp[1];
				$temp = count($argv);
			}
		}
		return $value;
	}

	public function script() {
		if (_WSEXEC == SCRIPT_TYPE) {
			return true;
		}
		else {
			return false;			
		}		
	}

    public function control($templateName = '', $type = WEB_TYPE)
    {
		if (!empty($templateName)) {
			$this->_templateName = $templateName;
			if ($this->isCached($templateName)) {
				$this->build($templateName);
				exit();
			}
		}
		$dieFlag = false;
		$redirectionFlag = false;
		$type = trim(strtoupper($type));
		switch  ($type) {
			case WEB_TYPE:
				if ($this->script()) {
					$dieFlag = true;
				}
				break;
			case SCRIPT_TYPE:
				if (!$this->script()) {
					$dieFlag = true;
				}
				break;
			case 'ALL':
				break;
			default :
			
		}
		if ($dieFlag) {
			die();
		}
		if ($redirectionFlag) {
		}
	}

	public function getIp() {

		$return = '0.0.0.0';
		// IP si internet partagé
		if (isset($_SERVER['HTTP_CLIENT_IP'])) {
			$return = $_SERVER['HTTP_CLIENT_IP'];
		}
		// IP derrière un proxy
		elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$return = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		// Sinon : IP normale
		elseif (isset($_SERVER['REMOTE_ADDR'])) {
			$return = $_SERVER['REMOTE_ADDR'];
		}
		return $return;
	}

	public function getUser() {

		$user = getServer('REMOTE_ADDR');
		$user .= '~'.getServer('REMOTE_HOST');
		$user .= '~'.'f'.preg_replace('#[^a-z0-9]#i','',getServer('HTTP_ACCEPT_LANGUAGE'));
		$user .= '~'.getServer('HTTP_X_FORWARDED_FOR');
		$user .= '~'.getServer('HTTP_VIA');
		$user .= '~'.getServer('HTTP_CLIENT_IP');
		$user .= '~'.getServer('HTTP_PROXY_CONNECTION');
		$user .= '~'.strrev(preg_replace('#[^0-9a-z]#i','',getServer('HTTP_USER_AGENT')));
		$user .= '~'.getServer('HTTP_ACCEPT_ENCODING');
		$user .= '~'.getServer('HTTP_ACCEPT_LANGUAGE');
		$user .= '~'.getServer('FORWARDED_FOR');
		$user .= '~'.getServer('X_FORWARDED_FOR');
		$user .= '~'.getServer('X_HTTP_FORWARDED_FOR');
		$user .= '~'.getServer('HTTP_FORWARDED');
		$return = md5(preg_replace('#~+#','~',$user));

		return $return;
	}
	
	public function extractPage($fileName) {
		preg_match('#.*([^\\\|^/]*)\.php#isU', $fileName, $strArray);
		$pageName = $strArray[1];
		return $pageName;
	}

	public function printl($value) {
		print $value;
		if ($this->script()) {
			print "\n";			
		}
		else {
			print "<br/>";			
		}
	}
}

/**
* Class to manage function return
*/
class return_function
{
    private static $_instance;
    private $_status;
    private $_return;
	
    public function __construct()
    {
		$this->_status = false;
	}
	
	public static function ws_open() 
	{
		if (!isset(self::$_instance)) {
			self::$_instance = new return_function();
		}
		return self::$_instance;
	}

	public function errorSet($return = null) 
	{
		$this->_status = false;
		if (!is_null($return)) {
			$this->_return = $return;
		}
	}

	public function noterrorSet() 
	{
		$this->_status = true;
	}

	public function statusGet() 
	{
		return $this->_status;
	}
   
	public function returnSet($return) 
	{
		$this->_status = true;
		$this->_return = $return;
	}

	public function returnGet() 
	{
		return $this->_return;
	}
}

?>