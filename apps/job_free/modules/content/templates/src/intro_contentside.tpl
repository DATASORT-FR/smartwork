<div class="row article_row intro_contentside">
	<article class="col-xs-12 article" itemscope itemtype="http://schema.org/Article">
		<h2>
			<a href="{$Content_link}" title="{$Content_titlePage}" itemprop="title">{$Content_title}</a>
		</h2>
		<div class="article_intro">
			{if $Content_image != ''}
				<a href="{$Content_link}" title="{$Content_titlePage}">
					<div class="container_img">
						<div class="intro_img">
							<img alt="{$Content_imageAlt}" src="{$Content_image}" onerror="this.src = '';" title="{$Content_imageTitle}">
						</div>
					</div>
				</a>
			{/if}
			{$Content_intro}
		</div>
	</article>
</div>
