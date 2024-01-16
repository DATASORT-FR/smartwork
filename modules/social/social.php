<?php
/**
* Social class
*
* @package    module_social
* @version    1.2
* @date       2 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('WSOCIAL_NAME', 'social');

// Menu Path
$ws->paramSet($ws->paramGet('WSOCIAL_NAME') . '_TEMPLATES_SRC_DIR', $ws->paramGet('MODULES_DIR') . $ws->paramGet('WSOCIAL_NAME') . '/' . TEMPLATES_SRC_PATH);
$ws->paramSet($ws->paramGet('WSOCIAL_NAME') . '_TEMPLATES_CSS_DIR', $ws->paramGet('RELA_MODULES_DIR') . $ws->paramGet('WSOCIAL_NAME') . '/' . TEMPLATES_CSS_PATH);

// Template css & js
$ws->paramSet($ws->paramGet('WSOCIAL_NAME') . '_TEMPLATE_STYLE', 'social.css');

$ws->addcss($ws->paramGet($ws->paramGet('WSOCIAL_NAME') . '_TEMPLATES_CSS_DIR') . $ws->paramGet($ws->paramGet('WSOCIAL_NAME') . '_TEMPLATE_STYLE'));

/**
* Classes for social module.
*/
class Wsocial extends Wmodule
{

    public function __construct() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

 		parent::__construct($ws->paramGet('WSOCIAL_NAME'));
   }

    public function displayShare() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$contentLink = $ws->urlLinkGet();
		$facebookLink = 'https://facebook.com/sharer.php?u=';
		$twitterLink = 'https://twitter.com/intent/tweet?text=';
		$googleLink = 'https://plus.google.com/share?url=';
		$linkedinLink = 'https://www.linkedin.com/shareArticle?mini=true&url=';

		$squareFlag = false;
		$facebookFlag = false;
		$twitterFlag = false;
		$googleFlag = false;
		$linkedinFlag = false;

		$facebookLinkShare = '';
		$twitterLinkShare = '';
		$googleLinkShare = '';
		$linkedinLinkShare = '';
						
		$noident = 1;
		$argFunc = func_get_args();
		for($temp=0; $temp < count($argFunc); $temp++) {
			$paramFlag = false;
			$atemp = explode(':', $argFunc[$temp]);
			switch (strtoupper(trim($atemp[0]))) {
				case "FACEBOOK" :
					$facebookFlag = true;
					break;
				case "TWITTER" :
					$twitterFlag = true;
					break;
				case "GOOGLE" :
					$googleFlag = true;
					break;
				case "LINKEDIN" :
					$linkedinFlag = true;
					break;
				case "SQUARE" :
					if (strtoupper(trim($atemp[1])) == 'YES') {
						$squareFlag = true;
					}
					break;
				default:
					$paramFlag = true;
			}
		}

		$displayFlag = false;
		if (!empty($contentLink)) {
			$displayFlag = true;
		}
		if ($facebookFlag) {
			$facebookLinkShare = $facebookLink . $contentLink;
			$displayFlag = true;
		}
		if ($twitterFlag) {
			$twitterLinkShare = $twitterLink . $contentLink;
			$displayFlag = true;
		}
		if ($googleFlag) {
			$googleLinkShare = $googleLink . $contentLink;
			$displayFlag = true;
		}
		if ($linkedinFlag) {
			$linkedinLinkShare = $linkedinLink . $contentLink;
			$displayFlag = true;
		}
		$smarty = new workpage();
		parent::initSmarty($smarty);
		$smarty->assign('displayFlag',$displayFlag);
		$smarty->assign('squareFlag',$squareFlag);
		$smarty->assign('facebookFlag',$facebookFlag);
		$smarty->assign('facebookLinkShare',$facebookLinkShare);
		$smarty->assign('twitterFlag',$twitterFlag);
		$smarty->assign('twitterLinkShare',$twitterLinkShare);
		$smarty->assign('googleFlag',$googleFlag);
		$smarty->assign('googleLinkShare',$googleLinkShare);
		$smarty->assign('linkedinFlag',$linkedinFlag);
		$smarty->assign('linkedinLinkShare',$linkedinLinkShare);
		if ($displayFlag) {
			$return = $smarty->fetch('social_share.tpl');
		}
		else {
			$return = '';			
		}
		return $return;
	}

    public function display() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$facebookLink = 'https://www.facebook.com/';
		$twitterLink = 'https://twitter.com/';
		$googleLink = 'https://plus.google.com/';
		$pinterestLink = 'https://www.pinterest.com/';
		$linkedinLink = 'https://www.linkedin.com/company/';
		$youtubeLink = 'https://www.youtube.com/user/';
		$feedburnerLink = 'http://feeds2.feedburner.com/';

		$squareFlag = false;
		$facebookFlag = false;
		$twitterFlag = false;
		$googleFlag = false;
		$pinterestFlag = false;
		$linkedinFlag = false;
		$youtubeFlag = false;
		$feedburnerFlag = false;

		$noident = 1;
		$argFunc = func_get_args();
		for($temp=0; $temp < count($argFunc); $temp++) {
			$paramFlag = false;
			$atemp = explode(':', $argFunc[$temp]);
			switch (strtoupper(trim($atemp[0]))) {
				case "FACEBOOK" :
					if (isset($atemp[1])) {
						$facebookLink .= trim($atemp[1]);
					}
					$facebookFlag = true;
					break;
				case "TWITTER" :
					if (isset($atemp[1])) {
						$twitterLink .= trim($atemp[1]);
					}
					$twitterFlag = true;
					break;
				case "GOOGLE" :
					if (isset($atemp[1])) {
						$googleLink .= trim($atemp[1]);
					}
					$googleFlag = true;
					break;
				case "pinterest" :
					if (isset($atemp[1])) {
						$pinterestLink .= trim($atemp[1]);
					}
					$pinterestFlag = true;
					break;
				case "LINKEDIN" :
					if (isset($atemp[1])) {
						$linkedinLink .= trim($atemp[1]);
					}
					$linkedinFlag = true;
					break;
				case "YOUTUBE" :
					if (isset($atemp[1])) {
						$youtubeLink .= trim($atemp[1]);
					}
					$youtubeFlag = true;
					break;
				case "FEEDBURNER" :
					if (isset($atemp[1])) {
						$feedburnerLink .= trim($atemp[1]);
					}
					$feedburnerFlag = true;
					break;
				case "SQUARE" :
					if (isset($atemp[1])) {
						if (strtoupper(trim($atemp[1])) == 'YES') {
							$squareFlag = true;
						}
					}
					break;
				default:
					$paramFlag = true;
			}
		}

		$displayFlag = false;
		if ($facebookFlag) {
			$displayFlag = true;
		}
		if ($twitterFlag) {
			$displayFlag = true;
		}
		if ($googleFlag) {
			$displayFlag = true;
		}
		if ($pinterestFlag) {
			$displayFlag = true;
		}
		if ($linkedinFlag) {
			$displayFlag = true;
		}
		if ($youtubeFlag) {
			$displayFlag = true;
		}
		if ($feedburnerFlag) {
			$displayFlag = true;
		}
		$smarty = new workpage();
		parent::initSmarty($smarty);
		$smarty->assign('displayFlag',$displayFlag);
		$smarty->assign('squareFlag',$squareFlag);
		$smarty->assign('facebookFlag',$facebookFlag);
		$smarty->assign('facebookLink',$facebookLink);
		$smarty->assign('twitterFlag',$twitterFlag);
		$smarty->assign('twitterLink',$twitterLink);
		$smarty->assign('googleFlag',$googleFlag);
		$smarty->assign('googleLink',$googleLink);
		$smarty->assign('pinterestFlag',$pinterestFlag);
		$smarty->assign('pinterestLink',$pinterestLink);
		$smarty->assign('linkedinFlag',$linkedinFlag);
		$smarty->assign('linkedinLink',$linkedinLink);
		$smarty->assign('youtubeFlag',$youtubeFlag);
		$smarty->assign('youtubeLink',$youtubeLink);
		$smarty->assign('feedburnerFlag',$feedburnerFlag);
		$smarty->assign('feedburnerLink',$feedburnerLink);
		if ($displayFlag) {
			$return = $smarty->fetch('social.tpl');
		}
		else {
			$return = '';			
		}
		return $return;
	}

}

?>
