<h1>{$Content_title}</h1>
{$Content_intro}
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
{$Content_content}
{if $Content_image != ''}
	<div class="intro_img">
		<a title="{$Content_titlePage}" href="{$Content_link}">
			<img alt="{$Content_imageAlt}" src="{$Content_image}" onerror="this.src = '';" title="{$Content_imageTitle}">
		</a>
	</div>
{/if}
