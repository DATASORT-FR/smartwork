<div class="row article_row intro_default">
	<article class="col-xs-12 article" itemscope itemtype="http://schema.org/Article">
		<h2>
			{if $Content_icon != ''}
				<i class="fa fa-{$Content_icon}" aria-hidden="true"></i> 
			{/if}
			<a href="{$Content_link}" title="{$Content_titlePage}" itemprop="title">{$Content_title}</a>
		</h2>
		<div class="article_intro" itemprop="description">
			{if $Content_image != ''}
				<div class="container_img col-md-6 col-lg-4">
					<div class="intro_img">
						<img alt="{$Content_imageAlt}" src="{$Content_image}" onerror="this.src = '';" title="{$Content_imageTitle}">
					</div>
				</div>
			{/if}
			{$Content_intro}
		</div>
	</article>
</div>
