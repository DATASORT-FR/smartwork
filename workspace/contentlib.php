<?php
/**
* Content analyse functions
*
* @package   content_analyse
* @version   1.0
* @date      18 august  2020
* @author    Alain VANDEPUTTE
* @copyright datasort.fr
*/

defined('_WSEXEC') or die();

define('STATUS_DUPLICATE', -2);
define('STATUS_KO', -1);
define('STATUS_INIT', 0);
define('STATUS_ACTIVE', 1);
define('STATUS_CLOSED', 2);
define('STATUS_BACKUPED', 3);

/**
* Classes for content analyse.
*/
class LIB_content { 

	private static $_accent = array(
		'ç' => 'c',
		'Ç' => 'c',
		'c' => '(ç|c)',
		'é' => 'e',
		'è' => 'e',
		'ê' => 'e',
		'ë' => 'e',
		'É' => 'e',
		'È' => 'e',
		'Ê' => 'e',
		'Ë' => 'e',
		'e' => '(ë|ê|è|é|e)',
		'à' => 'a',
		'á' => 'a',
		'â' => 'a',
		'ã' => 'a',
		'ä' => 'a',
		'å' => 'a',
		'À' => 'a',
		'Á' => 'a',
		'Â' => 'a',
		'Ã' => 'a',
		'Ä' => 'a',
		'Å' => 'a',
		'a' => '(à|á|â|ã|ä|å|a)',
		'ì' => 'i',
		'í' => 'i',
		'î' => 'i',
		'ï' => 'i',		
		'Ì' => 'i',
		'Í' => 'i',
		'Î' => 'i',
		'Ï' => 'i',
		'i' => '(ì|í|î|ï|i)',		
		'ð' => 'o',
		'ò' => 'o',
		'ó' => 'o',
		'ô' => 'o',
		'õ' => 'o',
		'ö' => 'o',
		'Ò' => 'o',
		'Ó' => 'o',
		'Ô' => 'o',
		'Õ' => 'o',
		'Ö' => 'o',
		'o' => '(ð|ò|ó|ô|õ|ö|o)',		
		'œ' => 'oe',
		'Œ' => 'oe',
		'oe' => '(œ|oe)',
		'ù' => 'u',
		'ú' => 'u',
		'û' => 'u',
		'ü' => 'u',
		'Ù' => 'u',
		'Ú' => 'u',
		'Û' => 'u',
		'Ü' => 'u',
		'u' => '(ù|ú|û|ü|u)',
		'ý' => 'y',
		'ÿ' => 'y',
		'Ý' => 'y',
		'y' => '(ý|ÿ|y)'
	);
	private static $_beginWord = "(^|\.|:|\?|!|;|-|\r\n|,|\s|’)";
	private static $_endWord = "(\.|:|\?|!|;|-|\r\n|,|\s|$)";

	private static $_keyTable = array();
	
	public static function markWord($keywords, $begin, $end, $content) {
		$keywordsArray = explode(";", $keywords);
		foreach ($keywordsArray as $search) {
			$value = $search;
			foreach(self::$_accent as $accent=>$accentReplace) {
				$search = mb_ereg_replace($accent, $accentReplace, $search, 'i');
			}
			$search = "#" . self::$_beginWord . $search . self::$_endWord . "#isU";
			$n = substr_count($search, "(");
			$value = '$1' . $begin . $value . $end . '$' . $n;
			$content = preg_replace($search, $value, $content);
		}		
		return $content;
	}
	
	public static function cleanSpecial($value) {
		$return = $value;
		
		$return = preg_replace('#Ç#usU', 'C', $return);
		$return = preg_replace('#ç#usU', 'c', $return);
		$return = preg_replace('#è|é|ê|ë#usU', 'e', $return);
		$return = preg_replace('#È|É|Ê|Ë#usU', 'E', $return);
		$return = preg_replace('#à|á|â|ã|ä|å#usU', 'a', $return);
		$return = preg_replace('#À|Á|Â|Ã|Ä|Å#usU', 'A', $return);
		$return = preg_replace('#ì|í|î|ï#usU', 'i', $return);
		$return = preg_replace('#Ì|Í|Î|Ï#usU', 'I', $return);
		$return = preg_replace('#ð|ò|ó|ô|õ|ö#usU', 'o', $return);
		$return = preg_replace('#Ò|Ó|Ô|Õ|Ö#usU', 'O', $return);
		$return = preg_replace('#Œ#usU', 'OE', $return);
		$return = preg_replace('#œ#usU', 'oe', $return);
		$return = preg_replace('#ù|ú|û|ü#usU', 'u', $return);
		$return = preg_replace('#Ù|Ú|Û|Ü#usU', 'U', $return);
		$return = preg_replace('#ý|ÿ#usU', 'y', $return);
		$return = preg_replace('#Ý#usU', 'Y', $return);
		return $return;
	}
	
	public static function cleanHTML($value) {
		$return = $value;
		
		$return = preg_replace("#\r\n#iusU",'<br>', $return);
		$return = preg_replace("#\n\r#iusU", '<br>', $return);
		$return = preg_replace("#\r#iusU", '<br>', $return);
		$return = preg_replace("#\n#iusU", '<br>', $return);
		$return = preg_replace("#\t#iusU", ' ', $return);
		$return = preg_replace("#\f#iusU", ' ', $return);
		
		$return = preg_replace("#<form[^>]*>#iusU", ' ', $return);
		$return = preg_replace("#</form>#iusU", '<br>', $return);
		$return = preg_replace("#<input[^>]*>#iusU", '', $return);
		$return = preg_replace("#<select[^>]*>.*</select>#iusU", '', $return);
		$return = preg_replace("#<button[^>]*>.*</button>#iusU", '', $return);
		
		$return = preg_replace("#<h[^>]*>#iusU", ' ', $return);
		$return = preg_replace("#</h[^>]*>#iusU", '<br>', $return);
		$return = preg_replace("#<article[^>]*>#iusU", ' ', $return);
		$return = preg_replace("#</article>#iusU", '<br>', $return);
		$return = preg_replace("#<section[^>]*>#iusU", ' ', $return);
		$return = preg_replace("#</section>#iusU", '<br>', $return);
		$return = preg_replace("#<div[^>]*>#iusU", ' ', $return);
		$return = preg_replace("#</div>#iusU", '<br>', $return);
		$return = preg_replace("#<p[^>]*>#iusU", ' ', $return);
		$return = preg_replace("#</p>#iusU", '<br>', $return);
		$return = preg_replace("#<figure[^>]*>#iusU", '', $return);
		$return = preg_replace("#</figure>#iusU", '<br>', $return);
		$return = preg_replace("#<figcaption[^>]*>#iusU", '', $return);
		$return = preg_replace("#</figcaption>#iusU", '<br>', $return);
		$return = preg_replace("#<a[^>]*>#iusU", ' ', $return);
		$return = preg_replace("#</a>#iusU", '<br>', $return);
		$return = preg_replace("#<ul[^>]*>#iusU", '<br>', $return);
		$return = preg_replace("#</ul>#iusU", ' ', $return);
		$return = preg_replace("#<li[^>]*>#iusU", '- ', $return);
		$return = preg_replace("#</li>#iusU", '<br>', $return);
		$return = preg_replace("#<dl[^>]*>#iusU", '<br>', $return);
		$return = preg_replace("#</dl>#iusU", ' ', $return);
		$return = preg_replace("#<dt[^>]*>#iusU", '- ', $return);
		$return = preg_replace("#</dt>#iusU", '<br>', $return);
		$return = preg_replace("#<dd[^>]*>#iusU", ' : ', $return);
		$return = preg_replace("#</dd>#iusU", '<br>', $return);
		$return = preg_replace("#<table[^>]*>#iusU", ' ', $return);
		$return = preg_replace("#</table>#iusU", '<br>', $return);
		$return = preg_replace("#<tr[^>]*>#iusU", ' ', $return);
		$return = preg_replace("#</tr>#iusU", '<br>', $return);
		$return = preg_replace("#<td[^>]*>#iusU", '- ', $return);
		$return = preg_replace("#</td>#iusU", '<br>', $return);
		
		$return = preg_replace("#<b[^>]*>#iusU", '', $return);
		$return = preg_replace("#</b>#iusU", '', $return);
		$return = preg_replace("#<blockquote[^>]*>#iusU", '', $return);
		$return = preg_replace("#</blockquote>#iusU", '', $return);
		$return = preg_replace("#<em[^>]*>#iusU", '', $return);
		$return = preg_replace("#</em>#iusU", '', $return);
		$return = preg_replace("#<label[^>]*>#iusU", '', $return);
		$return = preg_replace("#</label>#iusU", '', $return);
		$return = preg_replace("#<big[^>]*>#iusU", '', $return);
		$return = preg_replace("#</big>#iusU", '', $return);
		$return = preg_replace("#<center[^>]*>#iusU", '', $return);
		$return = preg_replace("#</center>#iusU", '', $return);
		$return = preg_replace("#<font[^>]*>#iusU", '', $return);
		$return = preg_replace("#</font>#iusU", '', $return);
		$return = preg_replace("#<i[^>]*>#iusU", '', $return);
		$return = preg_replace("#</i>#iusU", '', $return);
		$return = preg_replace("#<small[^>]*>#iusU", '', $return);
		$return = preg_replace("#</small>#iusU", '', $return);
		$return = preg_replace("#<span[^>]*>#iusU", '', $return);
		$return = preg_replace("#</span>#iusU", '', $return);
		$return = preg_replace("#<tt[^>]*>#iusU", '', $return);
		$return = preg_replace("#</tt>#iusU", '', $return);
		$return = preg_replace("#<u[^>]*>#iusU", '', $return);
		$return = preg_replace("#</u>#iusU", '', $return);
		$return = preg_replace("#<strong[^>]*>#iusU", '', $return);
		$return = preg_replace("#</strong>#iusU", '', $return);
		$return = preg_replace("#<tbody[^>]*>#iusU", '', $return);
		$return = preg_replace("#</tbody>#iusU", '', $return);
		$return = preg_replace("#<time[^>]*>#iusU", '', $return);
		$return = preg_replace("#</time>#iusU", '', $return);
		$return = preg_replace("#<img[^>]*>#iusU", ' ', $return);

		$return = preg_replace("#<![^>]*>#iusU", '', $return);
		
		$return = preg_replace("#<style[^>]*>.*</style>#iusU", '', $return);
		$return = preg_replace("#<script[^>]*>.*</script>#iusU", '', $return);
		$return = preg_replace("#<br[^>]*>#iusU", '<br>', $return);
		$return = preg_replace("#\s*(<br>)+\s*#iusU", '<br>', $return);

		return $return;
	}

	public static function analyseText($value) {
		$return = '';		
		$value = preg_replace("#\\r#iusU","\r", $value);
		$value = preg_replace("#\\n#iusU","\n", $value);
		$value = preg_replace("#\r#iusU","", $value);
		
		$return = $value;
		
		return $return;
	}
	
	public static function formatHTML($value) {
		$return = '';	
		$value = self::analyseText($value);	
		$items = explode("\n", $value);

		$level1 = false;
		$firstLevel1 = false;
		$endLevel1 = false;
		$level2 = false;
		$firstLevel2 = false;
		$endLevel2 = false;
		$nbLines = 0;
		foreach($items as $item) {
			$flagFirstLevel1 =  false;
			$flagLevel1 =  false;
			$flagEndLevel1 =  false;
			
			$flagLine = true;
			if (preg_match("#^\s*-\s*#iusU", $item)) {
				if (!$level1) {
					$level1 = true;
					$firstLevel1 = true;
					
					$flagFirstLevel1 = true;
				}
				else {
					$firstLevel1 = false;
				}
				$item = preg_replace("#^\s*-\s*#iusU","", $item);

				$flagLine = false;
				$flagLevel1 = true;
			}
			else {
				if ($level1) {
					$level1 = false;
					$firstLevel1 = false;
					$endLevel1 = true;

					$flagLine = false;
					$flagEndLevel1 = true;
				}
				else {
					if ($endLevel1) {
						$endLevel1 = false;
					}
				}
			}
			if ($flagLine) {
				if (!preg_match("#^[A-Z]#usU", $item)) {
					$flagLine = false;
				}
			}
			$itemValue = '';
			if ($flagFirstLevel1) {
				$itemValue .= '<ul>';
			}
			if ($flagEndLevel1) {
				$itemValue .= '</ul>';
			}
			if ($flagLevel1) {
				$itemValue .= '<li>';
			}
			$itemValue .= $item;
			if ($flagLevel1) {
				$itemValue .= '</li>';
			}
			if (($flagLine) and (!empty($return))) {
				$return .= '<br>';
			}
			$return .= $itemValue;
			$nbLines++;
		}
		$itemValue = '';
		if ($level1) {
			$level1 = false;
			$flagEndLevel1 = true;
		}
		if ($flagEndLevel1) {
			$itemValue .= '</ul>';
		}
		$return .= $itemValue;
		
		return $return;
	}
	
	/** 
	* Constructor
	*
	* @param 	object : node elem
	*
	* @access public
	*/
	public function __construct() {
		
	}
}
