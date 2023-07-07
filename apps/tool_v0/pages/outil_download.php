<?php
/**
* Main file for diagram results design
*
* @package    Diagram 
* @subpackage controller
* @version    1.0
* @date       14 March 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();

$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_diagnostic.php';
require_once($filePath);

$categoryName = SEPARATION_DOSSIER_CATEGORY;
$displayHtml = displayResult($categoryName);
$ws->assign('contentBlock', $displayHtml);
$ws->assign('imgLogo', encode_img_base64(SITE_ROOT_DIR . '/images/separation/en-tete-planete-separation.jpeg', 'jpeg'));
$html = $ws->displayFetch('outil_download.tpl');

$title = 'Diagnostic-Download dossier';
$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $title);

html2PdfStream('dossier-avocat.pdf', $html);

?>