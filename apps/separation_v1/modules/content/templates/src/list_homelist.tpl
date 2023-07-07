{$line = 0}
<div class="blog-news-carousel">
	<div class="owl-carousel owl-theme">
		{section name=idx loop=$listIntro}
			{$listIntro[idx]}
			{$line = $line + 1}
		{/section}
	</div>
	<div class="owl-theme">
		<div class="owl-controls">
			<div class="custom-nav owl-nav">
			</div>
		</div>
	</div>
</div>
