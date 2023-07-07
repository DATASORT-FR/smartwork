<div class="row article_row">
	<article class="col-xs-12 article" itemscope itemtype="http://schema.org/Article">
		<h2>
			{if $Content_icon != ''}
				<i class="fa fa-{$Content_icon}" aria-hidden="true"></i> 
			{/if}
			{$Content_title}
		</h2>
		<div class="article_intro" itemprop="description">
			{$Content_intro}
		</div>
	</article>
</div>
