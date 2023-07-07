{if $topic_top != ''}
	{$topic_top}
{/if}
<div class="header-image" itemprop="title">
	{$topic_subject}
</div>
{if $topic_add != ''}
	{$topic_add}
{/if}
<div class="header-topic">
	<div class="forum-topic-author">Par {$topic_author}</div>
	<h1 class="" itemprop="title">
		{$topic_label}
	</h1>
	<div class="post-date">
		<h3>{$topic_day|default:''}</h3>
		<p>{$topic_month|default:''}</p>
	</div>
</div>
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
