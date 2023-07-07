<!DOCTYPE html>
<html lang="fr">
<head>
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

<header id="header-page" class="{$classPage|default:''}">
	<div id="header-home">
		<a class="logo" href="/" >
			<img alt="" src="./images/mediation/logo.png" onerror="this.src = '';">
		</a>
		{if $flagConnect}
			<a class="nav-link contactus" href="./login.php">{$nameConnect}
			</a>					 
		{else}
			<a class="nav-link contactus" href="./login.php">{#Txt_connect#}
			</a>
		{/if}
	</div>
	
	<nav class="container-fluid navigation-zone">
		<div class="nav-bar"> 
			<a class="menu-home" href="/" >
				<i class="fa fa-home"></i>
			</a>
			{$MenuNavHome}
		</div>
	</nav>
	<div class="container-fluid navigation-zone">
	</div>
</header>

<div id="content-page" class="{$classPage|default:''}">
	<div class="container-fluid main-zone">
	{if $RightSideDisplay|default:0 == 1}
		{if $LeftSideDisplay|default:0 == 1}
			<div class="col-sm-12 col-md-12 col-lg-4 push-lg-4 content-zone">
		{else}
			<div class="col-sm-12 col-md-12 col-lg-8 content-zone">
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
			<div class="col-sm-12 col-md-12 col-lg-4 pull-lg-6 left-zone">
				{block name=LeftSide}
				{/block}
			</div>
		{/if}
	
		<div class="col-sm-12 col-md-12 col-lg-4 right-zone"> 
			{block name=RightSide}
			{/block}
		</div>
	{else}
		{if $LeftSideDisplay|default:0 == 1}
			<div class="col-sm-12 col-md-12 col-lg-8 push-lg-3">
		{else}
			<div class="col-sm-12 col-md-12 col-lg-12">
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
			<div class="col-sm-12 col-md-12 col-lg-4 pull-lg-6">
				{block name=LeftSide}
				{/block}
			</div>
		{/if}	
	{/if}
	
	</div>
</div>
	
<footer id="footer-page">
	<div id="footer-block">
		<div class="container contenu">
			<div class="row">
				<div class="footer-block col-md-4">
					{$Footer1Block}
				</div>
				<div class="footer-block col-md-4">
					{$Footer2Block}
				</div>
				<div class="footer-block col-md-4">
					{$Footer3Block}
				</div>
			</div>
		</div>
    </div>
        
    <div id="footer2">
		<div class="contenu">
			<div class="menu-footer">
				<p>{$MenuFooter}</p>
			</div>
       	</div>
    </div>
</footer>
	
</body>

</html>
