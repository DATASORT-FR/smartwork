{if $btCreate|default:false}
	<div class="forum-btn">
		<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="{#Txt_loading#}" event="{$post_linkCreate}">
			<span class="fa fa-edit" width="16" height="16"></span>  {#Txt_forum_post_create#}
		</button>
	</div>
{/if}
<div class="table-responsive-sm">
	<table class="forum-list table table-borderless table-striped table-hover text-start">
		{if $flagHeader|default:false}
			<thead class="">
				<tr>
					<th class="forum-post" scope="col" width="70%">{#Txt_forum_post#}</th>
					<th class="forum-post-date" scope="col" width="30%">{#Txt_forum_date#}</th>
				</tr>
			</thead>
		{/if}
		<tbody>
		{section name=idx loop=$listPost}
			<tr class="block-ws block-main" box-model="box-model" link_href="{$listPost[idx].href}" target="">
				{$listPost[idx].html}
			</tr>
		{/section}
		</tbody>
		<tfoot class="">
		</tfoot>		
	</table>
</div>
