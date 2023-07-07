<!DOCTYPE html>
<html lang="fr">
<head>
	{if $pageTitle|default:'' == ''}
		<title>{$urlTitle|default:''}</title>
	{else}
		<title>{$pageTitle|default:''}</title>
	{/if}
	<base href="{$baseUrl|default:''}" >
	<meta name="google-site-verification" content="{$appGoogleVerif|default:''}" />
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
		{if !empty($fileCombinecss)}
			{combine input=$fileCombinecss output=$outputCombinecss use_true_path=false age='30' debug=false}
		{/if}
	
		{if !empty($fileCombinejs)}
			{combine input=$fileCombinejs output=$outputCombinejs use_true_path=false age='30' debug=false}
		{/if}
		{section name=idx loop=$fileOnecss}
			<link href="{$fileOnecss[idx]}" rel="stylesheet" type="text/css">
		{/section}
		{section name=idx loop=$fileOnejs}
			<script src="{$fileOnejs[idx]}"></script>
		{/section}
	{else}
		{section name=idx loop=$filecss}
			<link href="{$filecss[idx]}" rel="stylesheet" type="text/css">
		{/section}
	
		{section name=idx loop=$filejs}
			<script src="{$filejs[idx]}"></script>
		{/section}
	{/if}
	
</head>
<body class="diagram">
<header id="header-page" class="{$classPage|default:''}">
	<nav class="header">
		<button class="nav-button navbar-toggler pull-right" type="button" data-bs-toggle="collapse" data-bs-target="#menu-small" aria-controls="menu-small" aria-expanded="false" aria-label="Toggle navigation">
			☰
		</button>
		<div id="menu-small" class="collapse navbar-collapse">
			<a class="nav-link menu-home" href="{$baseUrl}" >
				{#Txt_home#}
			</a>
			<a class="nav-link " title="" href="{$LinkDomain|default:'/'}">
				{if $domainName|default:'' != ''}
					{#Label_domain#} {$domainName|default:'' }
				{else}
					{#Title_select_domain#}
				{/if}
			</a>
			{if $flagConnect|default:false}
				<a class="nav-link" href="{$LinkLogin|default:'./login.php'}">{$nameConnect|default:''}
				</a>					 
			{else}
				<a class="nav-link" href="{$LinkLogin|default:'./login.php'}">{#Txt_connect#}
				</a>
			{/if}
			{if $domainName|default:'' != ''}
				{$menuNav1|default:''}
			{else}
				{$menuNav2|default:''}
			{/if}
		</div>
		<div class="menu-header">
			<div class="menu-left">
				<div class="menu-header1">
					<a class="logo" href="{$LinkHome|default:'/'}" >
						<div>
						</div>
					</a>
				</div>
				<div class="menu-header2">
					<a class="nav-link " title="" href="{$LinkDomain|default:'/'}">
						{if $domainName|default:'' != ''}
							{#Label_domain#} {$domainName|default:'' }
						{else}
							{#Title_select_domain#}
						{/if}
					</a>
				</div>			
			</div>
			<div class="menu-right">
				<div class="menu-header3">
					{if $flagConnect|default:false}
						<a class="nav-link" href="{$LinkLogin|default:'./login.php'}">{$nameConnect|default:''}
						</a>					 
					{else}
						<a class="nav-link" href="{$LinkLogin|default:'./login.php'}">{#Txt_connect#}
						</a>
					{/if}
				</div>
			</div>
		</div>
	</nav>
</header>

<div id="content-page" class="{$classPage|default:''}">
	<div class="container-fluid  navigation-zone">
		<div class="nav-bar navbar2"> 
			<nav class="navbar navbar-expand-lg {$Menu_classAdd|default:''}">
				{if $menuBack|default:false == true}
					<a class="nav-link mnu_backward" title="" href="./">
						<span class="fa fa-arrow-left"></span>
					</a>
				{/if}
				<a class="menu-home" href="{$LinkHome|default:'/'}" >
					<i class="fa fa-home"></i>
				</a>
				{if $domainName|default:'' != ''}
					{$menuNav1|default:''}
				{else}
					{$menuNav2|default:''}
				{/if}
			</nav>
		</div>
	</div>
	<div id="message-box" class="container-fluid" style="opacity: 0;">
		<div class="row">
			<div class="message-txt">
			</div>
		</div>
	</div>
	<div class="container-fluid main-zone">
		<div class="row">			
			<div id="message-box" class="col-sm-12">
				<div class="">
				</div>
			</div>
		</div>				
		{block name=Main}
		{/block}
	</div>
</div>
	
<footer id="footer-page">
    <div id="footer">
		<div class="contenu">
			<div class="menu-footer">
				<p>{$menuFooter|default:''}</p>
			</div>
       	</div>
    </div>
</footer>
	
<div class="box-model display-none">
</div>
<div class="box-confirm display-none">
</div>
<div id="message-ws" class="box-message" message_code="{$MessageCode}" message_text="{$MessageText}">
</div>

</body>

</html>
