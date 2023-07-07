{if $subject_top != ''}
	{$subject_top}
{/if}
<h1 class="{$subject_class}" itemprop="title">
	{if $subject_icon != ''}
		<i class="fa fa-{$subject_icon}" aria-hidden="true"></i> 
	{/if}
	{$subject_name}
</h1>
{if $subject_add != ''}
	{$subject_add}
{/if}
{if $btEdit or $btDelete}
	<div class="forum-btn {$subject_class}">
		{if $btEdit}
			<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="{#Txt_loading#}" event="{$subject_linkEdit}">
				<span class="fa fa-edit" width="16" height="16"></span>  {#Txt_forum_edit#}
			</button>
		{/if}
		{if $btDelete}
			<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="{#Txt_loading#}" event="{$subject_linkDelete}">
				<span class="fa fa-trash" width="16" height="16"></span>  {#Txt_forum_delete#}
			</button>
		{/if}
	</div>
{/if}
<div class="forum-description {$subject_class}">
	{$subject_label}
	{$subject_content}
</div>
{if $subject_bottom != ''}
	{$subject_bottom}
{/if}
