 <?php
/**
* Sitemap page
*
* @package    default_initialization
* @version    1.0
* @date       15 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$pageValue = $ws->argGet('p');

$sitemap = new Wsitemap();
if ($pageValue == '') {
	$lastmod = date('Y-m-d');
	$sitemap->addMenuContent('jf_main', 'lastmod:' . $lastmod,'changefreq:weekly', 'priority:1');
	$sitemap->addContent('engage', 'priority:0.9');
	$sitemap->addContent('4', 'priority:0.9');
	$sitemap->addContent('5', 'priority:0.9');
	$sitemap->addContent('6', 'priority:0.9');
	$sitemap->addListContent('blog', 'changefreq:weekly', 'priority:1');
	$sitemap->addListContent('jobname', 'changefreq:weekly', 'priority:1');
	$sitemap->addListContent('landing', 'changefreq:weekly', 'priority:1');
}

$param = array();
if ($pageValue != '') {
	$param['page'] = $pageValue;
}
$param['score'] = 4;
$param['nb_lines'] = 500;
$param['max_lines'] = 5000;
$job = new object_job();
$listHeader = $job->getListJob($param);
$list = $listHeader['list'];
for ($i=0; $i < count($list); $i++) {
	$mission = get_object_vars($list[$i]);
	$missionRef = $mission['reference'];
	$missionTitle = $mission['title'];
	$missionLink = constructMissionHref($missionRef, $missionTitle);
	$missionDate = dateFormat('YYYY-MM-dd', strtotime($mission['date_publication']));

	$sitemap->addLoc($missionTitle, $missionLink, 'changefreq:monthly', 'priority:0.5', 'lastmod:' . $missionDate);
}
$sitemap->displayXml();

?>
