<!DOCTYPE html>
<html lang="fr" class="no-js">
<head>
	{if $cookieParam|default:true}
		<script type="text/javascript" async src="https://www.googletagmanager.com/gtag/js?id=G-LKS36WLSEH"></script>
	{/if}
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
	{if $cookieParam|default:true}
		<meta name="google-site-verification" content="{$appGoogleVerif|default:''}" />
	{/if}

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

        <!-- NAV START -->
		<nav class="navbar navbar-expand-lg top">
			<div class="container">
				<figure class="navbar-logo">
					<a href="{$LinkHome|default:''}">
						<img class="top" src="./images/separation/icon-planete_separation_blanc.svg" alt="Tout savoir sur ma séparation, mon divorce" title="Divorcer ou se séparer, un diagnostic complet">
					</a>
				</figure>
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
									<a href="{$LinkParameters|default:''}" class="dropdown-item">{#Mnu_parameters#}</a>
								</div>
							</li>
						{/if}
						<li class="nav-connect">
							{if $flagConnect|default:false}
								<a class="nav-item nav-link mnu-connected" href="{$LinkMonCompte|default:''}">{#Mnu_account#}</a>
							{else}
								<a class="nav-item nav-link mnu-connected display-none" href="{$LinkMonCompte|default:''}">{#Mnu_account#}</a>
							{/if}
							{if $flagConnect|default:false}
								<a class="nav-item nav-link mnu-connection display-none" href="{$LinkLogin|default:''}">{#Mnu_registration#}</a>
							{else}
								<a class="nav-item nav-link mnu-connection" href="{$LinkLogin|default:''}">{#Mnu_registration#}</a>
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

    <!--COOKIES-->
	{if $classPage|default:'' != 'cookies'}
		{if $cookieParam|default:true}
			{if !$cookieResponse|default:false}
				<div class="cookie-tool cookie-choice">
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
