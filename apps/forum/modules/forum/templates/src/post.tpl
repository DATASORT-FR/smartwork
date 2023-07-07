	{if $btEdit or $btDelete}
		<div class="forum-btn post">
			<span>{$post_status}</span>
			{if $btEdit}
				<button type="button" class="btn btn-primary bt-proc-page bt-forum-post-edit" data-loadingtext="{#Txt_loading#}" event="{$post_linkEdit}">
					<span class="fa fa-edit" width="16" height="16"></span>  {#Txt_forum_edit#}
				</button>
			{/if}
			{if $btDelete}
				<button type="button" class="btn btn-primary bt-proc-page bt-forum-post-delete" data-loadingtext="{#Txt_loading#}" event="{$post_linkDelete}" position="">
					<span class="fa fa-trash" width="16" height="16"></span>  {#Txt_forum_delete#}
				</button>
			{/if}
		</div>
	{/if}

	<div class="header-post">
		<div class="forum-post-author">Par <span>{$post_author}</span></div>
		<div class="forum-post-date-time">{$post_dateDayTime}</div>
			{if $post_read}
				<div class="post-date read">
			{else}
				<div class="post-date no-read">
			{/if}
			<h3>{$post_day}</h3>
			<p>{$post_month}</p>
		</div>
	</div>
	<div class="forum-resume">
		<div class="forum-post-label">{$post_content}</div>
	</div>
	<div class="forum-resume">
		{if $post_read}
			<button type="button" class="btn btn-primary bt-forum-proc-page bt-forum-post read" data-loadingtext="{#Txt_loading#}" event="{$post_linkCreate}" target="#block-response">
		{else}
			<button type="button" class="btn btn-primary bt-forum-proc-page bt-forum-post no-read" data-loadingtext="{#Txt_loading#}" event="{$post_linkCreate}" target="#block-response">
		{/if}
			{#Txt_forum_post_create#}
		</button>
	</div>
