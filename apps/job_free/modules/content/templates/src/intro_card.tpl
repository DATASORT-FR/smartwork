
<div class="card intro_card">
	<div class="card-header p-b-0">
		<h2 class="card-title">
			{if $Content_icon != ''}
				<i class="fa fa-{$Content_icon}" aria-hidden="true"></i> 
			{/if}
			{$Content_title}
		</h2>
	</div>
	{if $Content_image != ''}
		<a class="" title="{$Content_titlePage}" href="{$Content_link}">
			<img class="card-img-top" alt="{$Content_imageAlt}" src="{$Content_image}" onerror="this.src = '';" title="{$Content_imageTitle}">
		</a>
	{/if}
	<div class="card-body">
		<div class="card-text">
			{$Content_intro}
		</div>
		<div class="content_btn">
			<a class="btn btn-secondary" title="{$Content_titlePage}" href="{$Content_link}">{#Txt_Content_read_more#}</a>
		</div>
	</div>
</div>
