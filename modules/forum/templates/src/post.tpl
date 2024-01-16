{$post_top}
	<td class="forum-post" scope="row" width="70%">
		{$post_add}
		<div class="forum-resume">
			<div class="forum-post-content">{$post_content}</div>
		</div>
	</td>
	<td class="forum-post" scope="row" width="30%">
		{if $btEdit or $btDelete}
			<div class="forum-btn post">
				<span>{$post_status}</span>
				{if $btEdit}
					<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="{#Txt_loading#}" event="{$post_linkEdit}">
						<span class="fa fa-edit" width="16" height="16"></span>  {#Txt_forum_edit#}
					</button>
				{/if}
				{if $btDelete}
					<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="{#Txt_loading#}" event="{$post_linkDelete}">
						<span class="fa fa-trash" width="16" height="16"></span>  {#Txt_forum_delete#}
					</button>
				{/if}
			</div>
		{/if}
		<div class="forum-resume">
			{if $post_read}
				<div>{#Txt_forum_post_read#}</div>
			{else}
				<div>{#Txt_forum_post_noread#}</div>
			{/if}
			<div class="forum-post-date-update">{$post_date}</div>
			<div class="forum-post-author">{$post_author}</div>
		</div>
	</td>
{$post_bottom}
