{if $topic_top != ''}
	{$topic_top}
{/if}
<h1 class="" itemprop="title">
	{$topic_label}
</h1>
{if $topic_add != ''}
	{$topic_add}
{/if}
{if $btEdit or $btDelete}
	<div class="forum-btn topic">
		{if $btEdit}
			<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="{#Txt_loading#}" event="{$topic_linkEdit}">
				<span class="fa fa-edit" width="16" height="16"></span>  {#Txt_forum_edit#}
			</button>
		{/if}
		{if $btDelete}
			<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="{#Txt_loading#}" event="{$topic_linkDelete}">
				<span class="fa fa-trash" width="16" height="16"></span>  {#Txt_forum_delete#}
			</button>
		{/if}
	</div>
{/if}
<div class="forum-description topic">
	{$topic_content}
</div>
{if $topic_bottom != ''}
	{$topic_bottom}
{/if}
