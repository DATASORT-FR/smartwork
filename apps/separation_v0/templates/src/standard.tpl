<!DOCTYPE html>
<html lang="fr" class="no-js">
<head>
	<script type="text/javascript" async src="https://www.googletagmanager.com/gtag/js?id=G-LKS36WLSEH"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() {
			dataLayer.push(arguments);
		}
		{if $cookieParam|default:true}
			{if $cookieFlag|default:true}
				function gtag_report_conversion(url) {
					var callback = function () {
						if (typeof(url) != 'undefined') {
						}
					};
					gtag('event', 'conversion', {
						'send_to': 'AW-10797084116/7J91CNr31v4CENTbuZwo',
						'event_callback': callback
					});
					return false;
				}
				function gtag_report_conversion2(url) {
					var callback = function () {
						if (typeof(url) != 'undefined') {
						}
					};
					gtag('event', 'conversion', {
						'send_to': 'AW-10797084116/QWSPCJ2hq4IDENTbuZwo',
						'event_callback': callback
					});
					return false;
				}
				gtag('js', new Date());
				gtag('config', 'G-LKS36WLSEH');
				gtag('config', 'AW-10797084116');
			{/if}
		{/if}
	</script>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="google-site-verification" content="{$appGoogleVerif|default:''}" />

	{if !$browserCache|default:true}
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
	{/if}

    <!-- Main data -->
	{if $pageTitle|default:'' == ''}
		<title>{$urlTitle|default:''}</title>
	{else}
		<title>{$pageTitle|default:''}</title>
	{/if}
	{if $pageDescription|default:'' == ''}
		<meta name="description" content="{$urlDescription|default:''}">
	{else}
		<meta name="description" content="{$pageDescription|default:''}">
	{/if}
	{if $pageNewsKeywords|default:'' == ''}
		<meta name="news_keywords" content="{$urlNewsKeywords|default:''}">
	{else}
		<meta name="news_keywords" content="{$pageNewsKeywords|default:''}">
	{/if}
	{if $pageKeywords|default:'' == ''}
		<meta name="keywords" content="{$urlKeywords|default:''}">
	{else}
		<meta name="keywords" content="{$pageKeywords|default:''}">
	{/if}

    <!-- Twitter Card data -->
	<meta name="twitter:card" content="summary"/>
	<meta name="twitter:site" content="@{$twitterTitle|default:''}"/>
	<meta name="twitter:creator" content="@{$twitterTitle|default:''}"/>

    <!-- Open Graph data -->
	<meta property="og:site_name" content="{$siteTitle|default:''}">
	<meta property="og:type" content="website">
	<meta property="og:url" content="{$urlLink|default:''}">
	{if $pageTitle|default:'' == ''}
		<meta property="og:title" content="{$urlTitle|default:''}">
	{else}
		<meta property="og:title" content="{$pageTitle|default:''}">
	{/if}		
	{if $pageDescription|default:'' == ''}
		<meta property="og:description" content="{$urlDescription|default:''}">
	{else}
		<meta property="og:description" content="{$pageDescription|default:''}">
	{/if}
	{if $pageImage|default:'' == ''}
		<meta property="og:image" content="{$urlImage|default:''}">
	{else}
		<meta property="og:image" content="{$pageImage|default:''}">
	{/if}

	<!-- base ref -->
	<base href="{$baseUrl|default:''}" >
	<link rel="alternate" href="{$baseUrl|default:''}" hreflang="fr-FR"/>
    <link rel="canonical" href="{$urlLink|default:''}"/>
	<link rel="icon" type="image/x-icon" href="{$favicon|default:''}" />

	{if $combineFlag}
		{section name=idx loop=$fileOnecss}
			<link href="{$fileOnecss[idx]}" rel="stylesheet" type="text/css">
		{/section}

		{if !empty($fileCombinecss)}
			{combine input=$fileCombinecss output=$outputCombinecss use_true_path=false age='30' debug=false}
		{/if}
	{else}
		{section name=idx loop=$filecss}
			<link href="{$filecss[idx]}" rel="stylesheet" type="text/css">
		{/section}
	{/if}

	<script src="./libs/jquery-3.6.0/js/jquery.min.js"></script>
	{if $flagAdmin}
		<script src="./libs/workspace-1.0.3/js/workspace.js"></script>
		<script src="./libs/ckeditor-5/ckeditor.js"></script>
	{/if}

</head>
<body class="separation {$classPage|default:''}">
	{if $cookieParam|default:true}
		{if $cookieFlag|default:true}
			<noscript>
				<iframe src="https://www.googletagmanager.com/ns.html?id=G-LKS36WLSEH" height="0" width="0" style="display:none;visibility:hidden">
				</iframe>
			</noscript>
		{/if}
	{/if}
   <header>
        <!-- TOP HEADER START -->
        <div class="top-header-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <ul class="top-contact text-left">
                            <li class="email">
								<a href="mailto:info@planete-separation.fr">
									<span class="fa fa-envelope"></span>
									info@planete-separation.fr
								</a>
							</li>
                        </ul>
                    </div>
                    <div class="col-md-7 text-right">
                        <div class="top-social">
                            <ul class="social-list">
                                <li><a href="https://www.facebook.com/Planète-Séparation-100342455791967/"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://twitter.com/PlanetSep"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="https://www.linkedin.com/company/planete-separation/"><i class="fab fa-linkedin-in"></i></a></li>
                                <li class="m-0">
									{if $flagConnect|default:false}
										<a class="btn user-btn border-btn mnu-connected" href="{$LinkMonCompte|default:''}" role="button">{#Mnu_account#}</a>
									{else}
										<a class="btn user-btn border-btn mnu-connected display-none" href="{$LinkMonCompte|default:''}" role="button">{#Mnu_account#}</a>
									{/if}
									{if $flagConnect|default:false}
										<a class="btn user-btn border-btn mnu-connection display-none" href="{$LinkLogin|default:''}" role="button">{#Mnu_registration#}</a>
									{else}
										<a class="btn user-btn border-btn mnu-connection" href="{$LinkLogin|default:''}" role="button">{#Mnu_registration#}</a>
									{/if}
								</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- TOP HEADER END -->
        
        <!-- NAV START -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container ">
				<figure class="navbar-logo">
					<a href="{$LinkHome|default:''}" class="home-link">
						<img class="standard" src="./images/separation/icon-planete_separation_blanc.svg" alt="Tout savoir sur ma séparation, mon divorce" title="Divorcer ou se séparer, un diagnostic complet">
						<img class="home" src="./images/separation/icon-planete_separation.svg" alt="Tout savoir sur ma séparation, mon divorce" title="Divorcer ou se séparer, un diagnostic complet">
					</a>
				</figure>
                <a href="{$LinkHome|default:''}" class="navbar-brand">
					<div class="first">Planète</div>
					<div>Séparation</div>
				</a>
				<button type="button" class="navbar-toggler collapsed" data-bs-toggle="collapse" data-bs-target="#main-nav">
                    <span class="menu-icon-bar"></span>
                    <span class="menu-icon-bar"></span>
                    <span class="menu-icon-bar"></span>
                </button>
				<div id="main-nav" class="collapse navbar-collapse">
					<ul class="navbar-nav ml-auto">
						<li><a href="{$LinkAPropos|default:''}" class="nav-item nav-link">{#Mnu_apropos#}</a></li>
						<li class="dropdown">
							<a href="#" class="nav-item nav-link" data-bs-toggle="dropdown">{#Mnu_articles#}</a>
							<div class="dropdown-menu">
								<a href="{$LinkDossiers|default:''}" class="dropdown-item">{#Mnu_files#}</a>
								<a href="{$LinkBonPlans|default:''}" class="dropdown-item">{#Mnu_tips#}</a>
								<a href="{$LinkActualites|default:''}" class="dropdown-item">{#Mnu_news#}</a>
							</div>
						</li>
						<li><a href="{$LinkForum|default:''}" class="nav-item nav-link">{#Mnu_forum#}</a></li>
						<li><a href="{$LinkContact|default:''}" class="nav-item nav-link">{#Mnu_contact#}</a></li>
						<li><a href="{$LinkDiagnostic|default:''}" class="nav-item nav-link">{#Mnu_diagnostic#}</a></li>
						{if $flagAdmin}
							<li class="dropdown">
								<a href="#" class="nav-item nav-link" data-bs-toggle="dropdown">{#Mnu_admin#}</a>
								<div class="dropdown-menu">
									<a href="{$LinkUsers|default:''}" class="dropdown-item">{#Mnu_users#}</a>
									<a href="{$LinkStatistics|default:''}" class="dropdown-item">{#Mnu_statistic#}</a>
									<a href="{$LinkLandings|default:''}" class="dropdown-item">{#Mnu_landings#}</a>
									<a href="{$LinkParameters|default:''}" class="dropdown-item">{#Mnu_parameters#}</a>
								</div>
							</li>
						{/if}
						<li class="nav-connect">
							{if $flagConnect|default:false}
								<a href="{$LinkMonCompte|default:''}" class="nav-item nav-link mnu-connected">{#Mnu_account#}</a>
							{else}
								<a href="{$LinkMonCompte|default:''}" class="nav-item nav-link mnu-connected display-none">{#Mnu_account#}</a>
							{/if}
							{if $flagConnect|default:false}
								<a href="{$LinkLogin|default:''}" class="nav-item nav-link mnu-connection display-none">{#Mnu_registration#}</a>
							{else}
								<a href="{$LinkLogin|default:''}" class="nav-item nav-link mnu-connection">{#Mnu_registration#}</a>
							{/if}
						</li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- NAV END -->

     </header>

	<div id="content" loginRef="{$LinkLoginBox|default:''}">
		{block name=Main}
		{/block}
	</div>	

    <!-- FOOTER START -->
	{if $classPage|default:'' != 'diagnostic'}
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-footer">
						<figure class="footer-logo">
							<img src="./images/separation/icon-planete_separation.svg" alt="Tout savoir sur ma séparation, mon divorce" title="Divorcer ou se séparer, un diagnostic complet">
						</figure>
						<p class="footer-logo-text">En quelques clics, vous accédez à une analyse complète.</p>
					</div>
					<div class="col-lg-4 col-footer">
						<h5>Liens</h5>
						<ul class="quick-links left-layer">
							<li><a href="{$LinkHome|default:''}">{#Mnu_home2#}</a></li>
							<li><a href="{$LinkContact|default:''}">{#Mnu_contact2#}</a></li>
							<li><a href="{$LinkPartenaires|default:''}">{#Mnu_partners#}</a></li>
							<li><a href="{$LinkCookies|default:''}">{#Mnu_cookies#}</a></li>
						</ul>
						<ul class="quick-links right-layer">
							<li><a href="{$LinkCGU|default:''}">{#Mnu_cgu#}</a></li>
							<li><a href="{$LinkConfidentialite|default:''}">{#Mnu_confidentiality#}</a></li>
							<li><a href="{$LinkMentionsLegales|default:''}">{#Mnu_legal_notice#}</a></li>
							<li><a href="{$LinkSiteMap|default:''}" target="_newtab">{#Mnu_sitemap#}</a></li>
						</ul>
					</div>
					<div class="col-lg-4 col-footer">
						<h5>Notre Newsletter</h5>
						<p>Souscrivez à notre Newsletter pour recevoir des informations sur nos services.</p>
						<div class="newsletter mt-2">
							<form action="#" method="post" name="sign-up">
								<input type="email" class="input" id="email" name="email" placeholder="Votre adresse mail" required>
								<input type="submit" class="button" id="submit" value="S'inscrire">
							</form>
						</div>
					</div>
				</div>
				<hr class="footer">
				<div class="bottom-footer">
					<div class="row">
						<div class="col-lg-6">
							<p class="right">© 2021 MVSP tous droits réservés.</p>
						</div>
						<div class="col-lg-6">
							<ul class="footer-social">
								<li><a href="https://www.facebook.com/Planète-Séparation-100342455791967/"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="https://twitter.com/PlanetSep"><i class="fab fa-twitter"></i></a></li>
								<li><a href="https://www.linkedin.com/company/planete-separation/"><i class="fab fa-linkedin-in"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</footer>
	{/if}
    <!-- FOOTER END -->

    <!--SCROLL TOP START-->
<!--
    <a href="#0" class="cd-top">Top</a>
-->

    <!--PHONE BOX-->
	{if $flagPhone}
		<div class="phone-ask init-display">
			<figure class="icon ab-box-icon">
				<img src="./images/separation/icon_phone_box.svg" alt="N° de téléphone 01.45.03.13.45" title="Notre N° de téléphone">
			</figure>
		</div>
		<div class="phone-nb init-display-none display-none">
			<p>Besoin d'aide ?</p>
			<p>Appelez-nous au</p>
			<p class="number">01 45 03 13 45</p>
			<p class="small">(Appel non surtaxé)</p>
			<figure class="icon">
				<img src="./images/separation/icon_phone_box_blue.svg" alt="N° de téléphone 01.45.03.13.45" title="Notre N° de téléphone">
			</figure>
		</div>
	{/if}

    <!--COOKIES-->
	{if $classPage|default:'' != 'cookies'}
		{if $cookieParam|default:true}
			{if !$cookieResponse|default:false}
				<div class="cookie-choice">
					<div class="container">
						<div class="cookie-info">
							<p>
								<span>Nous utilisons nos propres cookies de session pour vous offrir une meilleure expérience d’utilisation de nos services et pour améliorer votre expérience de navigation.</span>
								<a class="cookie-more" href="{$LinkCookies|default:''}">Cliquez-ici</a>
								<span> pour en savoir plus.</span>
							</p>
							<p>
								<a class="cookie-dismiss" href="#" event="{$LinkCookieDismiss|default:''}">Cliquez-ici</a>
								<span> pour continuer sans accepter les cookiies de navigation.</span>
							</p>
						</div>
						<div class="cookie-btn">
							<a class="btn border-btn cookie-accept" href="#" event="{$LinkCookieAccept|default:''}">AUTORISER LES COOKIES</a>
						</div>
					</div>
				</div>
			{/if}
		{/if}
	{/if}
	
<div class="extra display-none">
	<div class="box">
		<button class="bt-exit" type="button">
			<i class="fa fa-times"></i>
		</button>
		<div class="main-content">
		</div>
	</div>
</div>

<div class="box-model display-none">
</div>

<div class="box-confirm display-none">
</div>

{if $combineFlag}
	{if !empty($fileCombinejs)}
		{combine input=$fileCombinejs output=$outputCombinejs use_true_path=false age='30' debug=false}
	{/if}
	{section name=idx loop=$fileOnejs}
		<script src="{$fileOnejs[idx]}"></script>
	{/section}
{else}
	{section name=idx loop=$filejs}
		<script src="{$filejs[idx]}"></script>
	{/section}
{/if}
</body>

</html>
