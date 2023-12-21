<!DOCTYPE html>
<html lang="fr">
<head>
	{if !empty($GoogleTag)}
		<script async src="https://www.googletagmanager.com/gtag/js?id={$GoogleTag|default:''}"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag() {
				dataLayer.push(arguments);
			}
			{if $cookieParam|default:true}
				gtag('js', new Date());
				gtag('config', '{$GoogleTag|default:''}');
			{/if}
		</script>
	{/if}
	{if $pageTitle|default:'' == ''}
		<title>{$urlTitle|default:''}</title>
	{else}
		<title>{$pageTitle|default:''}</title>
	{/if}
	<base href="{$baseUrl|default:''}" >
	<meta name="google-site-verification" content="G87DX9ApoNpAjGI9r-Lyd4T4IkblanS6G-QK_FKmCSU" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
	<link rel="alternate" href="{$baseUrl|default:''}" hreflang="fr-FR"/>
	<link rel="icon" type="image/x-icon" href="{$favicon|default:''}" />
    <link rel="canonical" href="{$urlLink|default:''}"/>
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

    <!-- Open Graph data -->
	<meta property="og:site_name" content="{$siteTitle|default:''}">
	{if $pageTitle|default:'' == ''}
		<meta property="og:title" content="{$urlTitle|default:''}">
	{else}
		<meta property="og:title" content="{$pageTitle|default:''}">
	{/if}		
	<meta property="og:type" content="website">
	{if $pageDescription|default:'' == ''}
		<meta property="og:description" content="{$urlDescription|default:''}">
	{else}
		<meta property="og:description" content="{$pageDescription|default:''}">
	{/if}
	<meta property="og:url" content="{$urlLink|default:''}">
	{if $pageImage|default:'' == ''}
		<meta property="og:image" content="{$urlImage|default:''}">
	{else}
		<meta property="og:image" content="{$pageImage|default:''}">
	{/if}

    <!-- Twitter Card data -->
	<meta name="twitter:card" content="summary"/>
	<meta name="twitter:site" content="@{$siteTitle|default:''}"/>
	{if $pageTitle|default:'' == ''}
		<meta name="twitter:title" content="{$urlTitle|default:''}"/>    
	{else}
		<meta name="twitter:title" content="{$pageTitle|default:''}"/>    
	{/if}		
	{if $pageDescription|default:'' == ''}
		<meta name="twitter:description" content="{$urlDescription|default:''}"/>
	{else}
		<meta name="twitter:description" content="{$pageDescription|default:''}"/>
	{/if}
	{if $pzgeImage|default:'' == ''}
		<meta name="twitter:image" content="{$urlImage|default:''}"/>
	{else}
		<meta name="twitter:image" content="{$pageImage|default:''}"/>
	{/if}

	{if $combineFlag}
		{section name=idx loop=$fileOnecss}
			<link href="{$fileOnecss[idx]}" rel="stylesheet" type="text/css">
		{/section}
		{section name=idx loop=$fileOnejs}
			<script src="{$fileOnejs[idx]}"></script>
		{/section}

		{if !empty($fileCombinecss)}
			{combine input=$fileCombinecss output=$outputCombinecss use_true_path=false age='30' debug=false}
		{/if}
	
		{if !empty($fileCombinejs)}
			{combine input=$fileCombinejs output=$outputCombinejs use_true_path=false age='30' debug=false}
		{/if}
	{else}
		{section name=idx loop=$filecss}
			<link href="{$filecss[idx]}" rel="stylesheet" type="text/css">
		{/section}
	
		{section name=idx loop=$filejs}
			<script src="{$filejs[idx]}"></script>
		{/section}
	{/if}
	
</head>
<body>
{if $cookieParam|default:true}
	{if $cookieFlag|default:true}
		{if !empty($GoogleTag)}
			<noscript>
				<iframe src="https://www.googletagmanager.com/ns.html?id={$GoogleTag|default:''}" height="0" width="0" style="display:none;visibility:hidden">
				</iframe>
			</noscript>
		{/if}
	{/if}
{/if}
<div class="menu-header-zone navbar navbar-expand-lg">
	<div class="container-fluid">
		<figure class="navbar-logo d-none d-lg-block">
			<a href="{$LinkHome}" class="home-link">
				<img class="home" src="./images/default/logo.png" alt="" title="">
			</a>
		</figure>
		<a href="{$LinkHome}" class="navbar-brand d-none d-lg-block">
			<div class="first">{$BrandText_1|default:''}</div>
			<div>{$BrandText_1|default:''}</div>
		</a>
		<div class="navbar-social d-none d-lg-block">
			{$SocialBlock|default:''}
		</div>
	</div>
</div>
{$MenuNav|default:''}

<div class="container-fluid main-zone">
<div class="row">

	{if $RightSideDisplay|default:0 == 1}
		{if $LeftSideDisplay|default:0 == 1}
			<div class="col-sm-12 col-md-12 col-lg-6 order-lg-2 content-zone">
		{else}
			<div class="col-sm-12 col-md-12 col-lg-9 order-lg-1 content-zone">
		{/if}
			<div class="row">			
				<div id="message-box" class="col-sm-12">
					<div class="">
					</div>
				</div>
			</div>				
			{block name=Main}
			{/block}
		</div>

		{if $LeftSideDisplay|default:0 == 1}
			<div class="col-sm-12 col-md-12 col-lg-3 order-lg-1 left-zone">
				{block name=LeftSide}
				{/block}
			</div>
		{/if}
	
		{if $LeftSideDisplay|default:0 == 1}
			<div class="col-sm-12 col-md-12 col-lg-3 order-lg-3 right-zone"> 
		{else}
			<div class="col-sm-12 col-md-12 col-lg-3 order-lg-2 right-zone"> 
		{/if}
			{block name=RightSide}
			{/block}
		</div>
	{else}
		{if $LeftSideDisplay|default:0 == 1}
			<div class="col-sm-12 col-md-12 col-lg-9 order-lg-2 content-zone">
		{else}
			<div class="col-sm-12 col-md-12 col-lg-12 order-lg-1 content-zone">
		{/if}
			<div class="row">			
				<div id="message-box" class="col-sm-12">
					<div class="">
					</div>
				</div>
			</div>				
			{block name=Main}
			{/block}
		</div>

		{if $LeftSideDisplay|default:0 == 1}
			<div class="col-sm-12 col-md-12 col-lg-3 order-lg-1 left-zone">
				{block name=LeftSide}
				{/block}
			</div>
		{/if}	
	{/if}
	
</div>
</div>
	
<footer>
	<div class="footer-blurb">
		<div class="container">
			<div class="row">
				<div class="col-md-4 footer-blurb-item">
					{$Footer1Block|default:''}
				</div>
				<div class="col-md-4 footer-blurb-item">
					{$Footer2Block|default:''}
				</div>
				<div class="col-md-4 footer-blurb-item">
					{$Footer3Block|default:''}
				</div>
			</div>
		</div>
    </div>

	<div class="row social-footer-zone d-lg-none">
		{$socialBlock|default:''}
	</div>
        
    <div class="menu-footer small-print">
      	<div class="container">
       		<p>
			{$MenuFooter|default:''}
			{if $flagConnect|default:false}
				<a class="nav-link mnu-connected" href="{$LinkAccount|default:''}" role="button">{#menu_account_text#}</a>
			{else}
				<a class="nav-link mnu-connected display-none" href="{$LinkAccount|default:''}" role="button">{#menu_account_text#}</a>
			{/if}
			{if $flagConnect|default:false}
				<a class="nav-link mnu-connection display-none" href="{$LinkLogin|default:''}" role="button">{#menu_login_text#}</a>
			{else}
				<a class="nav-link mnu-connection" href="{$LinkLogin|default:''}" role="button">{#menu_login_text#}</a>
			{/if}
       	</div>
    </div>
</footer>

</body>

</html>
