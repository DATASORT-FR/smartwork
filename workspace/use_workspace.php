<?php
/**
* This file contains classes and function for the PHP developpement help
* This "work space" use smarty and extend smarty classes
*
* @package   administration_workspace
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
/** default script type if not defined = SCRIPT */
	define('SCRIPT_TYPE', 'SCRIPT');
}
if (!defined('WEB_TYPE')) {
/** default web type if not defined = WEB */
	define('WEB_TYPE', 'WEB');
}
if (!defined('_WSEXEC')) {
	if (isset($argv)) {
/** define le type of execution if not defined : script or web */
		define('_WSEXEC', SCRIPT_TYPE);
	}
	else {
/** define le type of execution if not defined : script or web */
		define('_WSEXEC', WEB_TYPE);
	}
}

// global define
if (!defined('PLUGIN_FORM_FIELD')) {
/** default form field in CRUD if not defined */
	define('PLUGIN_FORM_FIELD', 'form_field');
}
if (!defined('SESSION_CACHE')) {
/** define session cache flag if not defined : false = no session cache, true = session cache */
	define('SESSION_CACHE', false);
}

if (!defined('RIGHT_READ')) {
/** define default read right if not defined */
	define('RIGHT_READ', 1);
}
if (!defined('RIGHT_UPDATE')) {
/** define default update right if not defined */
	define('RIGHT_UPDATE', 2);
}

if (!defined('GROUP_NAME')) {
/** define default group name on linux if not defined */
	define('GROUP_NAME', 'www-data');
}

/**
* resize a content in label format (60 chars)
*
* @param  string $value
*         content to resize
*
* @return string
*         content resized
*/
function labelSize($value) {
	$label = mb_substr($value, 0, 60, 'UTF-8');
	return $label;
}

/**
* resize a content in name format (60 chars)
*
* @param  string $value
*         content to resize
*
* @return string
*         content resized
*/
function nameSize($value) {
	$name = mb_substr($value, 0, 30, 'UTF-8');
	return $name;
}

/**
* init value in a array
*
* @param  array &$fieldArray
*         pointer to the array
* @param  string $key
*         key in the array
* @param  mixed $value
*         default value if the key is not in the array
*
* @return boolean 
*         true if the default value has been seted
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
* @param  array $fieldArray
*         array to read
* @param  string $key
*         key in the array
* @param  mixed $default
*         default value if the key is not in the array
*
* @return mixed
*         return value of the key
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
* @param  string $imgPath
*         image Path
* @param  string $imgType
* 		  image type
*
* @return string
*         coded image
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
* @param  string $fileName
*         File Name
* @param  string $html
*         Html data
* @param  string $format
*         paper format 'A4', 'Letter'
* @param  string $orientation
*         paper orientation 'portrait' or 'landscape'
*
* @return boolean
*         process return - true if the pdf file was created
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
* @param  string $fileName
*         File name
* @param  string $html
*         Html data
* @param  string $format
*         paper format 'A4', 'Letter'
* @param  string $orientation
*         paper orientation 'portrait' or 'landscape'
*
* @return boolean 
*         process return - true if the pdf stream was created
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
* @param  string $from
*         Email sender
* @param  string $to
*         Email destination
* @param  string $subject
*         subject of the mail
* @param  string $bodyHtml
*         html body of the mail
* @param  string $bodyTxt
*         text (or alternative text) mail's body
*
* @return boolean
*         process return - true if the mail was sent 
*/
function mailSend($from, $to, $subject, $bodyHtml='', $bodyTxt='', $fileName='') {
	$ws = workspace::ws_open();
	$return = false;

	if (!defined('MAIL_HOST')) {
/** define default mail host if not already defined = UNKNOW */
		define('MAIL_HOST', 'UNKNOW');
	}
	if (!defined('MAIL_PORT')) {
/** define default mail port if not already defined = 0*/
		define('MAIL_PORT', 0);
	}
	if (!defined('MAIL_AUTH')) {
/** define default mail auth flag if not already defined = false*/
		define('MAIL_AUTH', false);
	}
	if (!defined('MAIL_SECURE')) {
/** define default mail secure type if not already defined = none*/
		define('MAIL_SECURE', 'none');
	}
	if (!defined('MAIL_USER')) {
/** define default mail user if not already defined = ''*/
		define('MAIL_USER', '');
	}
	if (!defined('MAIL_PASSWORD')) {
/** define default password of the mail user if not already defined = ''*/
		define('MAIL_PASSWORD', '');
	}
	if (!defined('MAIL_NO_VERIFY')) {
/** define default mail no verify flag if not already defined = false*/
		define('MAIL_NO_VERIFY', false);
	}
	if (!defined('MAIL_DEBUG')) {
/** define default mail debug flag if not already defined = false*/
		define('MAIL_DEBUG', false);
	}
	if (!defined('MAIL_DEBUG_LEVEL')) {
/** define default mail debug level if debug actived if not already defined = 0*/
		define('MAIL_DEBUG_LEVEL', 0);
	}
	if (!defined('MAIL_DEBUG_TO')) {
/** define default mail debug receiver if not already defined = ''*/
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

#[AllowDynamicProperties]
/**
* Class Soap API use : extend SoapClient
*/
class WorkSoapClient extends SoapClient {
	
	/**
	* Request the soap api client
	*
	* @param  string $request
	*         request
	* @param  string $location
	*         location
	* @param  string $action
	*         action
	* @param  int $version
	*         version
	* @param  boolean $one_way
	*         one way or not
	*
	* @return string
	*         xml string
	*/
    public function __doRequest(string $request, string $location, string $action, int $version, bool $one_way = false): ?string {
        $response = parent::__doRequest( $request, $location, $action, $version );
        if ($response) {
			if (isset($this->_cookies)) {
				$_SESSION['soap_cookies'] = $this->_cookies;
			}
			else {
				$_SESSION['soap_cookies'] = '';
			}
		}
        return $response;
    }

 	/**
	* Construct the Soap api client
	*
	* @param  string $serverpath
	*         url of the api
	* @param  array $options
	*         options of the connection
	*
	* @return object
	*         SoapClient object
	*/
    public function __construct($serverpath, $options = array('soap_version'=>SOAP_1_2)) 
    {

		$context = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
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
		if (!isset($options['stream_context'])) {
			$options['stream_context'] = stream_context_create($context);
		}
		$client = parent::__construct($serverpath, $options);
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
		return $client;
	}
	
}

/**
* Class for Rest API use
*/
class WorkRestClient {

	/** url of the REST API. Loaded in the construct function */
	private $_url;

	/**
	* Construct the Rest api client
	*
	* @param  string $urlpath
	*         url of the REST API
	*
	* @access public
	*/
    public function __construct($urlpath) 
    {
		$this->_url = $urlpath;
	}

	/**
	* Use get method of the REST api : object display
	*
	* @param  mixed $id
	*         object identifier to display
	* @param  array $argArray
	*         filter array
	* @return return_function
	*         return flag and array of the object fields
	*/
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

	/**
	* Use post method of the REST api : object create
	*
	* @param  array $argArray
	*         array of the field/value of the object	
	*
	* @return return_function
	*         return flag and message error
	*/
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
 
	/**
	* Use put method of the REST api : object update
	*
	* @param  array $argArray
	*         array of the field/value to change in the object. Item with 'id' key is mandatory
	*
	* @return return_function
	*         return flag and message error
	*/
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
	
	/**
	* Use delete method of the REST api : object delete
	*
	* @param  mixed $id
	*         object identifier to delete
	*
	* @return return_function
	*         return flag and message error
	*/
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

/**
* Convert array to json string
*
* @param  array $array
*         array to convert
*
* @return string
*         json string
*/
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

/**
* Json encode
*
* @param  mixed $val
*         value to encode
*
* @return string
*         json string
*/
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
* @param string	$value
*        message
* @param string	$key
*        key to display for the message
* @param integer $level
*        display level (1, 2 or 3). default = 1
* @param boolean $truncate
*        the displayed message. True bu default
*
* @return none
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

/**
* Display main Params of the framework
*
* @param integer $level
*        display level (1, 2 or 3). default = 1
* @param boolean $truncate
*        the displayed message. True bu default
*
* @return none
*/
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


/**
* analyse et explode image string (format of the framework)
*
* @param  string $imageStr
*         string to analyse
*
* @return array
*         array of image values
*/
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

/**
* find label for a status id
*
* @param  integer $id
*         stastus identifier
*
* @return string 
*         status message
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
* transform string to code format (UPPERCASE UFT8)
*
* @param  string $str
*         transform string by using uppercase
*
* @return string 
*         formated code
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
* @param  string $search
*         search value
* @param  array  $array
*         array where searched the key
*
* @return boolean 
*         true = value found in the array
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
* search value in the $_SERVER array
*
* @param  string $key
*         key for $_SERVER array
*
* @return string 
*         value of the key. '' if not found
*/
function getServer($key) {

	$return = isset($_SERVER[$key]) ? $_SERVER[$key] : '';
	
	return $return;
}	

/**
* search value in the $_COOKIE array
*
* @param  string$key
*         key for $_COOKIE array
*
* @return string  
*         value of the key. '' if not found
*/
function getCookie($key) {

	$return = isset($_COOKIE[$key]) ? $_COOKIE[$key] : '';
	
	return $return;
}	

/**
* DateTime at the time of the call
*
* @param  none
*
* @return string
*         dateTime with the format 'Y-m-d H:i:s.v'
*/
function now() {
	$strDate = date('Y-m-d H:i:s.v');
    $now = new DateTime($strDate);
    return $now;
}

/**
* DateTime at the time of the call
*
* @param  dateTime $startDateTime
*         start dateTime
* @param  dateTime $endDateTime
*         end dateTime
*
* @return dateTime
*         duration between start and end dateTime
*/
function duration($startDateTime, $endDateTime) {
    return $endDateTime->diff($startDateTime);
}

/**
* Read json file 
*
* @param  string $filePath
*         File Path of the file
*
* @return array
*         array with the decoded json
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
* @param  string $source
*         File or folder source
* @param  string $destination
*         File or folder destination
* @param  int $right
*        New folder right RIGHT_UPDATE or RIGHT_READ
*
* @return boolean
*         true if copy is ok
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

/**
* format path string
*
* @param  string $source
*         path string to format
*
* @return string
*         path string
*/
function xpath($source) {

	$source .= '/';
	$source = str_replace('\/','/',$source);
	$source = str_replace('//','/',$source);

	return $source;
}

/**
* create directory 
*
* @param string $destination
*        folder to create
* @param int $right
*        New folder right RIGHT_UPDATE or RIGHT_READ
*
* @return boolean
*         true if directory is created
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
* delete file or directory (with all files) 
*
* @param  string $source
*         directory or file to delete
*
* @return boolean
*         true if directory/file is deleted
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
* @param  string $file
*         file to process
* @param  string $find
*         string to replace
* @param  string $replace
*         string changed
*
* @return boolean
*         true if replace ok (file found)
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
* @param  string $source
*         source directory
* @param  string $filter
*         filter string to apply
* @return array
*         files and directories found in the source directory
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


/**
* config smarty instance
*
* @param  smarty &$smarty
*         smarty instance pointer
* @param  string $reference
*         reference to apply
* @return none
*/
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
* Prevent page caching with PHP
*
* The function must be called before any HTML tag,
* white space, echo(), print()...
*
* @param  none
* @return nome
*/
function preventPageCaching()
{
	header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
}

/**
* format dateTime
*
* @param  string $format
*         format string
* @param  timestamp $timestamp
*         timestamp or dateTime at the moment
* @return dateTime
*         formated dateTime
*/
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

	/**
	* construct workpage instance
	*
	* @param  string $reference
	*         reference to apply
	* @return workpage
	*         new instance of workpage
	*/
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
* Class global for the application
*/
class workspace extends Smarty
{
	/** direct flag */
	private $_direct;

	/** current instance workspace */
    private static $_instance;
	/** Transformed get Array */
	public $_arrayGet = array();

	/** base url of the flag */
	private $_baseUrl;
	/** url Rewriting flag */
	private $_urlRewriting;
	/** cookie flag */
	private $_cookieFlag;
	/** cookie user response flag */
	private $_cookieResponse;
	
	/** array of all css files of the page */
	private $_cssFile = array();
	/** array of all js files of the page */
	private $_jsFile = array();
	/** array of not combined css files of the page */
	private $_cssOneFile = array();
	/** array of not combined js files of the page */
	private $_jsOneFile = array();
	/** array of combined css files of the page */
	private $_cssCombineFile = array();
	/** array of combined js files of the page */
	private $_jsCombineFile = array();
	/** smarty template for the page */
	private $_templateName;

	/** Title of the site */
	private $_siteTitle;
	/** canonical url of the site */
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
	
	/** Title of the page */
	private $_pageTitle;
	/** Description of the page */
	private $_pageDescription;
	/** Keywords of the page */
	private $_pageKeywords;
	private $_pageNewsKeywords;
	/** Image of the page */
	private $_pageImage;
	
	/** Parameters of the process (page construction or script) */
    public $_paramarray = array ();

	/**
	* label to disply for a code
	*
	* @param  string $code
	*         code of the label
	* @return string
	*         label to display
	*/
	public static function codeToLabel($code) {
		$ws = self::ws_open();
	
		$label = $ws->getConfigVars($code);
		if (empty($label)) {
			$label = $code;
		}
		return $label;
	}

	/**
	* Convert value to boolean
	*
	* @param  mixed $value
	*         value to convert
	* @return boolean
	*/
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

	/**
	* Convert value to integer
	*
	* @param  mixed $value
	*         value to convert
	* @return integer
	*/
	public static function convInt($value)
	{
		$return = 0;
		
		return $return;		
	}

	/**
	* create or open the workspace of the app page
	*
	* @param  string $baseUrl
	*         base url of the page
	* @param  integer $connexionDuration
	*         duration of the connexion
	* @param  integer $cacheDuration
	*         duration of the cache
	* @param  string $sessionServer
	*         server for the connexion (connexion share)
	* @return workspace
	*         workspace instance
	*/
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

	/**
	* log system message 
	*
	* @param  string $log_type
	*         message type (info, debug, error)
	* @param  string $message_text
	*         message text
	* @param  string $logger
	*         logger to use ('sys' by default)
	* @param  string $message_params
	*         message parameters
	* @param  string $message_type
	*         message type (arguments, results, text)
	* @return none
	*/
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

	/**
	* log function message 
	*
	* @param  string $log_type
	*         message type (info, debug, error)
	* @param  string $message_text
	*         message text
	* @param  string $message_params
	*         message parameters
	* @return none
	*/
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

	/**
	* log page trace
	*
	* @param  string $app
	*         application code
	* @param  string $page
	*         page name
	* @param  mixed $id
	*         identifier for the page
	* @param  string $title
	*         title of the page
	* @return none
	*/
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
	
	/**
	* Places the code and message text in the session after finding the message text from the code
	*
	* @param  string $message_code
	*         message code
	* @param  string $message_params
	*         message parameters
	* @return none
	*/
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
		
	/**
	* display message in the page
	*
	* @param  none
	* @return none
	*/
    public function messageDisplay()
    {
		$message_code = $this->sessionGet('message_code');
		$message_text = $this->sessionGet('message_text');
		$this->sessionSet('message_code', '');
		$this->sessionSet('message_text', '');
		$this->assign('MessageCode', $message_code);
		$this->assign('MessageText', $message_text);
	}

 	/**
	* get Direct flag
	*
	* @param  none
	* @return boolean
	*         direct flag
	*/
   public function directGet()
    {
		return $this->_direct;
	}
	
	/**
	* set Direct flag
	*
	* @param  boolean $value
	*         value to set
	* @return none
	*/
    public function directSet($value)
    {
		if ($value == true) {
			$this->_direct = true;
		}
		else {
			$this->_direct = false;
		}
	}

 	/**
	* get url rewriting flag
	*
	* @param  none
	* @return boolean
	*         url rewriting flag
	*/
    public function urlRewritingGet()
    {
		return $this->_urlRewriting;
	}
	
	/**
	* set url rewriting flag
	*
	* @param  boolean $value
	*         value to set
	* @return none
	*/
    public function urlRewritingSet($value)
    {
		if ($value == true) {
			$this->_urlRewriting = true;
		}
		else {
			$this->_urlRewriting = false;
		}
	}

 	/**
	* get cookie flag
	*
	* @param  none
	* @return boolean
	*         cookie flag
	*/
    public function cookieFlagGet()
    {
		return $this->_cookieFlag;
	}
	
	/**
	* set cookie flag
	*
	* @param  boolean $value
	*         value to set
	* @return none
	*/
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

 	/**
	* get cookie user response flag
	*
	* @param  none
	* @return boolean
	*         cookie user response flag
	*/
    public function cookieResponseGet()
    {
		return $this->_cookieResponse;
	}
	
	/**
	* set cookie user response flag
	*
	* @param  boolean $value
	*         value to set
	* @return none
	*/
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

 	/**
	* get site title 
	*
	* @param  none
	* @return string
	*         site Title
	*/
    public function siteTitleGet()
    {
		return $this->_siteTitle;
	}
	
	/**
	* set site Title
	*
	* @param  string $value
	*         value to set
	* @return none
	*/
    public function siteTitleSet($value)
    {
		$this->_siteTitle = $value;
	}

 	/**
	* get twitter title 
	*
	* @param  none
	* @return string
	*         twitter Title
	*/
    public function twitterTitleGet()
    {
		return $this->_twitterTitle;
	}
	
	/**
	* set twitter Title
	*
	* @param  string $value
	*         value to set
	* @return none
	*/
     public function twitterTitleSet($value)
    {
		$this->_twitterTitle = $value;
	}

 	/**
	* get site canonical url 
	*
	* @param  none
	* @return string
	*         site canonical url 
	*/
    public function canonicalGet()
    {
		return $this->_canonical;
	}
	
	/**
	* set site canonical url
	*
	* @param  string $value
	*         value to set
	* @return none
	*/
    public function canonicalSet($value)
    {
		$this->_canonical = $value;
	}

 	/**
	* get global keywords
	*
	* @param  none
	* @return string
	*         global keywords
	*/
    public function keywordsGet()
    {
		return $this->_keywords;
	}
	
	/**
	* set global keywords
	*
	* @param  string $value
	*         global keywords list to set
	* @return none
	*/
    public function keywordsSet($value)
    {
		$this->_keywords = $value;
	}

 	/**
	* get page url link
	*
	* @param  none
	* @return string
	*         page url link
	*/
    public function urlLinkGet()
    {
		return $this->_urlLink;
	}
	
	/**
	* set page url link
	*
	* @param  string $value
	*         value to set
	* @return none
	*/
    public function urlLinkSet($value)
    {
		$this->_urlLink = $value;
	}

 	/**
	* get error page name
	*
	* @param  none
	* @return string
	*         error page name
	*/
    public function errorPageGet()
    {
		return $this->_errorPage;
	}
	
	/**
	* set error page name
	*
	* @param  string $value
	*         value to set
	* @return none
	*/
    public function errorPageSet($value)
    {
		$this->_errorPage = $value;
	}
	
 	/**
	* get favicon name
	*
	* @param  none
	* @return string
	*         favicon name
	*/
    public function faviconGet()
    {
		return $this->_favicon;
	}
	
	/**
	* set favicon name
	*
	* @param  string $value
	*         value to set
	* @return none
	*/
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
	* @param  string $variable
	*         param variable name
	* @param  string $default
	*         default param variable value
	* @return mixed
	*         param variable value
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
	* @param  string $variable
	*         param variable name
	* @param  mixed $value
	*         param variable value
	* @return boolean 
	*         true = Set ok, false = Set Ko
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
	* control if param variable exist
	*
	* @param  string $variable
	*         param variable name
	* @return boolean
	*         true = valide variable, false = unvalide variable
	*/
	public function ctrlParam($variable) {
		return isset($this->_paramarray[$variable]);				
	}

	/**
	* get the param array
	*
	* @param  none
	* @return array
	*         param array
	*/
	public function paramTo_array() {
		return $this->_paramarray;
	}
	
	/**
	* redirect page
	*
	* @param  none
	* @return none
	*/
	public function redirect($url_redirection) {
		header('Location: ' . $url_redirection);
		exit();
	}
	
	/**
	* Set base Url
	*
	* @param  string $baseUrl
	*         value to set
	* @return none
	*/
	public function baseUrlSet($baseUrl) {
		self::$_instance->_baseUrl = $baseUrl;
	}

	/**
	* Get base Url
	*
	* @param none
	* @return string 
	*         base Url value
	*/
	public function baseUrlGet() {
		$baseUrl = self::$_instance->_baseUrl;
		return $baseUrl;
	}

	/**
	* control arg ($_GET) variable
	*
	* @param  string $variable
	*         arg variable name for web or number for script
	* @return boolean 
	*         true = valide variable, false = unvalide variable
	*/
	public function ctrlGet($variable) {
		return isset($this->_arrayGet[$variable]);				
	}

	/**
	* Get arg ($_GET) variable
	*
	* @param  string $variable
	*         arg variable name for web or number for script
	* @return mixed 
	*         arg variable value
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
	* @param  none
	* @return array 
	*         arg array
	*/
	public function argAllGet() {
		return $this->_arrayGet;
	}

	/**
	* Load arg ($_GET) variable
	*
	* @param  array $array
	*         array to load ($argv) 
	* @return none
	*/
	public function argLoad($array, $index=0) {
		for ($i=$index; $i < count($array); $i++) {
			$this->_arrayGet[] = $array[$i];
		}
	}
	
	/**
	* control arg ($_POST) variable
	*
	* @param  string $variable
	*         arg variable name
	* @return boolean 
	*         true = valide variable, false = unvalide variable
	*/
	public function ctrlPost($variable) {
		
		return isset($_POST[$variable]);
	}

	/**
	* Get $_POST variable
	*
	* @param  string $variable
	*         arg variable name
	* @return mixed 
	*         arg variable value or $_POST array if variable name is empty
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
	* Get $_SESSION variable
	*
	* @param  string $variable
	*         session variable name
	* @return mixed
	*         session variable value
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
	* Set $_SESSION variable
	*
	* @param  string $variable
	*         session variable name
	* @param  string $value
	*         session variable value
	* @return boolean 
	*         process return
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
	* @param  string $name
	*         cache variable name
	* @param  string $category
	*         cache category : 'data' by default
	* @return boolean - true = valide variable, false = unvalide variable
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
	* @param  string $name
	*         cache variable name
	* @param  string $category
	*         cache category : 'data' by default
	* @return string 
	*         cache variable value
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
	* @param  string $name
	*         cache variable name
	* @param  string $value
	*         cache variable value
	* @param  string $category
	*         cache category : 'data' by default
	* @return none 
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
	* @param  string $name
	*         cache variable name
	* @param  string $category
	*         cache category : 'data' by default
	* @return none 
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
	* @param  string  $css_file
	*         css file name
	* @param  boolean $combine
	*         combine flag
	* @return none
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

	/**
	* remove css file and all css files if arg is empty
	*
	* @param  string  $css_file
	*         css file name
	* @return none
	*/
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
	* @param  string $js_file
	*         js file name
	* @param  boolean $combine
	*         combine flag
	* @return none
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

	/**
	* remove js file and all js files if arg is empty
	*
	* @param  string  $css_file
	*         js file name
	* @return none
	*/
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
	* @return none
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
	* @param string - template name
	*
	* @return text - page html
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