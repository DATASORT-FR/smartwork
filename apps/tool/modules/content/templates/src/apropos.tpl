<h1 itemprop="title">
	{$Content_title|default:''}
</h1>
<div class="blog-intro">
	{$Content_intro|default:''}
</div>
{if $btEdit or $btDelete}
	<div class="container mt-2 mb-2">
		<div class="content_btn {$Content_class}">
			{if $btEdit}
				<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="{#Txt_loading#}" event="{$Content_linkEdit}">
					<span class="fa fa-edit" width="16" height="16"></span>  {#Txt_Content_edit#}
				</button>
			{/if}
		</div>
	</div>
{/if}
<div class="blog-content">
	{if $Content_image != ''}
		<figure class="post-image">
			<img alt="{$Content_imageAlt|default:''}" src="{$Content_image|default:''}" onerror="this.src='./images/separation/image-non-trouvee.webp';" title="{$Content_imageTitle|default:''}">
		</figure>
	{/if}
	<div class="post-content">
		{$Content_content|default:''}
	</div>
</div>
