<h1>
	{if $Content_icon != ''}
		<i class="fa fa-{$Content_icon}" aria-hidden="true"></i> 
	{/if}
	{$Content_title}
</h1>
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
{if $Content_top != ''}
	{$Content_top}
{/if}
<div class="article_info">
	<small class="begin">{$Content_daypublication}</small>
	{if $Content_status != ''}
		<small class="end">{$Content_status}</small>
	{/if}
</div>
<div class="row article_intro">
	{if $Content_image != ''}
		<div class="container_img col-md-6 col-lg-4">
			<div class="intro_img">
				<img alt="{$Content_imageAlt}" src="{$Content_image}" onerror="this.src = '';" title="{$Content_imageTitle}">
			</div>
		</div>
	{/if}
	<div class="container_txt col-md-6 col-lg-8">
		{$Content_intro}
	</div>
</div>
<div class="article_content">
	{$Content_content}
</div>
{if $Content_bottom != ''}
	{$Content_bottom}
{/if}
