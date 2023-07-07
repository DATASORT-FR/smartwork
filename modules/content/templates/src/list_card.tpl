{if $btCreate}
	<div class="content_btn">
		{if $btCreate}
			<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="{#Txt_loading#}" event="{$content_linkCreate}">
				<span class="fa fa-edit" width="16" height="16"></span>  {#Txt_Content_create#}
			</button>
		{/if}
	</div>
{/if}
<div class="list_article list_default">
	{$line = 0}
	{section name=idx loop=$listIntro}
		{$listIntro[idx]}
		{$line = $line + 1}
	{/section}
</div>