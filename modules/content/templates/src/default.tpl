<h1 class="{$Content_class}" itemprop="title">
	{if $Content_icon != ''}
		<i class="fa fa-{$Content_icon}" aria-hidden="true"></i> 
	{/if}
	{$Content_title}
</h1>
{if $btEdit or $btDelete}
	<div class="content_btn {$Content_class}">
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
{/if}
<div class="article_intro {$Content_class}">
	{$Content_intro}
</div>
<div class="article_content {$Content_class}">
	{$Content_content}
</div>
