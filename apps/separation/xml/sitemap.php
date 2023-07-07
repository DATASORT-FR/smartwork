 <?php
/**
* JobNames api for Job freelance
*
* @package    Job Freelance
* @subpackage Json api
* @version    1.0
* @date       15 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$sitemap = new Wsitemap();
$lastmod = date('Y-m-d');
$sitemap->addMenuContent('sep_main', 'lastmod:' . $lastmod,'changefreq:weekly', 'priority:0.9');
$sitemap->addListContent('dossiers', 'changefreq:weekly', 'priority:1');
$sitemap->addListContent('bonplans', 'changefreq:weekly', 'priority:1');
$sitemap->addListContent('actualites', 'changefreq:weekly', 'priority:1');
$sitemap->addListContent('landing', 'changefreq:weekly', 'priority:1');

$sitemap->displayXml();

?>
