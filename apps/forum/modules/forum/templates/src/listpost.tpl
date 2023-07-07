<div class="forum-btn">
	<button type="button" class="btn btn-primary bt-forum-proc-page bt-forum" data-loadingtext="{#Txt_loading#}" event="{$post_linkCreate}" target="#block-response">
		{#Txt_forum_post_create#}
	</button>
</div>
<table class="forum-list forum-list-post table table-borderless table-striped table-hover text-left">
	<tbody>
	{section name=idx loop=$listPost}
		<tr class="forum-post">
			<td class="forum-post block-ws block-main" scope="row" box-model="box-model" link_href="{$listPost[idx].href}" position="">
				{$listPost[idx].html}
			</td>
		</tr>
	{/section}
	</tbody>
</table>
<div id="block-response" class="block-ws block-main box-header block-create-post" title="">
</div>
