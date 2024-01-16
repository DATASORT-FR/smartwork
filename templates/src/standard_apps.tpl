<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<base href="{$baseUrl}" >

	<title>{$urlTitle}</title>
	<meta name="description" content="{$urlDescription}">
	<meta name="keywords" content="{$urlKeywords}">	
	<meta name="news_keywords" content="{$urlNewsKeywords}">

	<meta property="og:site_name" content="{$siteTitle}">
	<meta property="og:title" content="{$pageTitle}">	
	<meta property="og:type" content="website">
	<meta property="og:description" content="{$pageDescription}">
	<meta property="og:url" content="{$urlLink}">
	<meta property="og:image" content="{$pageImage}">

	{section name=idx loop=$filecss}
		<link href="{$filecss[idx]}" rel="stylesheet" type="text/css">
	{/section}
	
	{section name=idx loop=$filejs}
		<script src="{$filejs[idx]}"></script>
	{/section}

</head>
<body>

	<!-- Conteneur principal -->
	<header class="container-fluid header-zone">
		<div class="row">
			<div class="col-lg-12">			
				<div class="header_left pull-left">
					{block name=Header_Left}
					{/block}
				</div>

				<div class="header_right pull-right">
					{block name=Header_Right}
					{/block}
				</div>
			</div>
		</div>
	</header>

	<div class="container-fluid navigation-zone">
		<div class="row">
			{block name=Nav_Block}
			{/block}
		</div>
	</div>

	<div id="message-box" class="container-fluid">
		<div class="row">
			<div class="message-txt">
			</div>
		</div>
	</div>
	
	<div class="container-fluid main-zone">
		<article class="work-zone row">
			<div class="col-lg-12">			
				{block name=Main}
				{/block}
			</div>
		</article>
	</div>

	<footer class="container-fluid footer-zone minus-zone">
		<div class="row">
			<div class="col-lg-12">			
				<div class="nav_left pull-left">
					{block name=Footer_Left}
					{/block}
				</div>

				<div class="nav_right pull-right">
					{block name=Footer_Right}
					{/block}
				</div>
			</div>
		</div>
	</footer>
			
	<div class="box-model display-none">
	</div>
	<div class="subbox-model display-none">
	</div>
	<div class="box-confirm display-none">
	</div>
	<div id="message-ws" class="box-message" message_code="{$MessageCode}" message_text="{$MessageText}">
	</div>

</body>

</html> 