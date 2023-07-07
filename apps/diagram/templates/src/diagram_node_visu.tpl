<div class="header-content">
	<header class="visu-header" style="">
		<button class="bt-exit">
			<span class="fa fa-window-close-o"></span>
		</button>
		<button class="bt-maximize">
			<span class="fa fa-window-maximize"></span>
		</button>
		<button class="bt-minimize">
			<span class="fa fa-window-minimize"></span>
		</button>
	</header>
	<h1 class="title">
		{$Content_title}
	</h1>
</div>
<div class="main-content">
	<div class="intro">
		{if $Content_image != ''}
			<div class="img">
				<img alt="{$Content_imageAlt}" src="{$Content_image}" onerror="this.src = '';" title="{$Content_imageTitle}">
			</div>
		{/if}
		{$Content_intro}
	</div>
	<div class="content">
		{$Content_content}
	</div>
</div>
