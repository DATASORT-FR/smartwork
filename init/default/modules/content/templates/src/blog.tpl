<div class="row">
	<h1 class="{$Content_class}" itemprop="title">
		{if $Content_icon != ''}
			<i class="fa fa-{$Content_icon}" aria-hidden="true"></i> 
		{/if}
		{$Content_title}
	</h1>
</div>
<div class="row">
	<div class="content_btn">
		{if $btEdit}
			<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="{#Txt_loading#}" event="{$Content_linkEdit}">
				<span class="fa fa-edit" width="16" height="16"></span>  {#Txt_Content_edit#}
			</button>
		{/if}
		{if $btDelete}
			<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="{#Txt_loading#}" event="{$Content_linkDelete}">
				<span class="fa fa-trash" width="16" height="16"></span>  {#Txt_Content_delete#}
			</button>
		{/if}
	</div>
</div>
{if $Content_top != ''}
	{$Content_top}
{/if}
<div class="row article_info {$Content_class}">
	<div class="col-lg-12">
		<small class="begin">{$Content_daypublication}</small>
		{if $Content_status != ''}
			<small class="end">{$Content_status}</small>
		{/if}
	</div>
</div>
<div class="row article_intro {$Content_class}">
	{if $Content_image != ''}
		<div class="container_img col-md-6 col-lg-4">
			<div class="intro_img">
				<img alt="{$Content_imageAlt}" src="{$Content_image}" onerror="this.src = '';" title="{$Content_imageTitle}">
			</div>
		</div>
		<div class="container_txt col-md-6 col-lg-8">
	{else}
		<div class="container_txt col-lg-12">
	{/if}
		{$Content_intro}
	</div>
</div>
{if $Content_add != ''}
	<div class="row">
		<div class="col-lg-12">
			{$Content_add}
		</div>
	</div>
{/if}
<div class="row article_content {$Content_class}" itemprop="articleBody">
	<div class="col-lg-12">
		{$Content_content}
	</div>
</div>
{if $Content_bottom != ''}
	<div class="row">
		<div class="col-lg-12">
			{$Content_bottom}
		</div>
	</div>
{/if}
