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

<body class="diagram">
	{block name=Main}
	{/block}
</body>

</html>
