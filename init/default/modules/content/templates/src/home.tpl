<div class="article_intro">
	<h1>
		{if $Content_icon != ''}
			<i class="fa fa-{$Content_icon}" aria-hidden="true"></i> 
		{/if}
		{$Content_title}
	</h1>
	{if $btEdit or $btDelete}
		<div class="content_btn">
			{if $btEdit}
				<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="{#Txt_loading#}" event="{$Content_linkEdit}">
					<span class="fa fa-edit" width="16" height="16"></span>  {#Txt_Content_edit#}
				</button>
			{/if}
		</div>
	{/if}
	<div class="">
		{$Content_intro}
	</div>
	{if $Content_image != ''}
		<div class="container_img">
			<div class="home_img">
				<img alt="{$Content_imageAlt}" src="{$Content_image}" onerror="this.src = '';" title="{$Content_imageTitle}">
			</div>
		</div>
	{/if}
	<div class="">
		{$Content_content}
	</div>
</div>
<br>
