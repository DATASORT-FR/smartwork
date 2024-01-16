<div class="row article_row intro_blog">
	<article class="col-xs-12 article" itemscope itemtype="http://schema.org/Article">
		<h2>
			{if $Content_icon != ''}
				<i class="fa fa-{$Content_icon}" aria-hidden="true"></i> 
			{/if}
			<a href="{$Content_link}" title="{$Content_titlePage}" itemprop="title">{$Content_title}</a>
		</h2>
		<div class="article_info">
			<small class="end">{$Content_datepublication}</small>
			{if $Content_status != ''}
				<small class="end">{$Content_status}</small>
			{/if}
		</div>
		<div class="row article_intro" itemprop="description">
			{if $Content_image != ''}
				<div class="container_img col-md-6 col-lg-4">
					<div class="intro_img">
						<a title="{$Content_titlePage}" href="{$Content_link}">
							<img alt="{$Content_imageAlt}" src="{$Content_image}" onerror="this.src = '';" title="{$Content_imageTitle}">
						</a>
					</div>
				</div>
				<div class="container_txt col-md-6 col-lg-8">
			{else}
				<div class="container_txt col-lg-12">
			{/if}
				{$Content_intro}
			</div>
		</div>
		<div class="article_bottom">
			<div class="content_btn">
				<a class="btn btn-secondary" title="{$Content_titlePage}" href="{$Content_link}">{#Txt_Content_read_more#}</a>
			</div>
		</div>
	</article>
</div>
