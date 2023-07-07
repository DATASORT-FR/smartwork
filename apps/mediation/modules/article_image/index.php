<?php
/**
* article image feature
*
* @package    article_image
* @subpackage controller
* @version    1.0
* @date       08 January 2019
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('ARTICLE_IMAGE_NAME', 'article_image');

// Menu Path
$ws->paramSet($ws->paramGet('APP_NAME'). '_' . $ws->paramGet('ARTICLE_IMAGE_NAME') . '_TEMPLATES_SRC_DIR', $ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . $ws->paramGet('ARTICLE_IMAGE_NAME') . '/' . TEMPLATES_SRC_PATH);

class JF_ArticleImage
{

    public function __construct() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
    }

    function display($item, $defaultImage = "", $type="") {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$smarty = new workpage();
		$smarty->template_dir = $ws->paramGet($ws->paramGet('APP_NAME'). '_' . $ws->paramGet('ARTICLE_IMAGE_NAME') . '_TEMPLATES_SRC_DIR') ;

		if (!isset($item['image'])) {
			$item['image'] = "";
		}
		if (!isset($item['imageAlt'])) {
			$item['imageAlt'] = "";
		}
		if (!isset($item['imageTitle'])) {
			$item['imageTitle'] = "";
		}
		if (!isset($item['imageType'])) {
			$item['imageType'] = "";
		}
		if (!isset($item['imageWidth'])) {
			$item['imageWidth'] = "";
		}
		
		if (!isset($item['video'])) {
			$item['video'] = "";
		}
		if (!isset($item['videoAlt'])) {
			$item['videoAlt'] = "";
		}
		if (!isset($item['videoTitle'])) {
			$item['videoTitle'] = "";
		}
		if (!isset($item['videoType'])) {
			$item['videoType'] = "";
		}
		
		$videos = explode(';', $item['video']);
		if (isset($videos[0])) {
			$item['video'] = $videos[0];
		}
		if (isset($videos[1])) {
			$item['videoAlt'] = $videos[1];
		}
		if (isset($videos[2])) {
			$item['videoTitle'] = $videos[2];
		}
		
		$strArray = array();	
		preg_match("#youtu\.*be#isU", $item['video'], $strArray);
		if (isset($strArray[0])) {
			$item['videoType'] = "youtube";
			$stemp = preg_replace("#([^/]*)$#isU", '', $item['video']);
			$stemp = preg_replace("#^" . $stemp . "#isU", '', $item['video']);
			$youtubeId = preg_replace("#\?.*$#isU", '', $stemp);
			$item['video'] = "https://www.youtube.com/embed/" . $youtubeId;
			if (empty($item['image'])) {
				$item['image'] = "http://img.youtube.com/vi/" . $youtubeId . "/hqdefault.jpg";
				$item['imageWidth'] = '600px';	
			}
			if (empty($item['imageAlt'])) {
				$item['imageAlt'] = $item['videoAlt'];
			}
			if (empty($item['imageTitle'])) {
				$item['imageTitle'] = $item['videoTitle'];
			}
		}
		
		$images = explode(';', $item['image']);
		if (isset($images[0])) {
			$item['image'] = $images[0];
		}
		if (isset($images[1])) {
			$item['imageAlt'] = $images[1];
		}
		if (isset($images[2])) {
			$item['imageTitle'] = $images[2];
		}
		if (empty($item['image'])) {
			$item['image'] = $defaultImage;
		}
		
		preg_match("#\.([^.]*)$#isU", $item['image'], $strArray);
		if (isset($strArray[1])) {
			$item['imageType'] = $strArray[1];
		}
		
		if ((empty($item['imageWidth'])) and (!empty($item['image']))) {
			$image = preg_replace("#^\./#Usi", $ws->paramGet('SITE_DIR'), $item['image']);
			$width = 0;
			if (file_exists($image)) {
				list($width, $height) = getimagesize($image);
			}
			if ($width != 0) {
				$item['imageWidth'] = $width . 'px';	
			}
		}
		
		$smarty->assign('type', $type);
		$smarty->assign('item', $item);
		return $smarty->fetch('index.tpl');
	}

}

?>
