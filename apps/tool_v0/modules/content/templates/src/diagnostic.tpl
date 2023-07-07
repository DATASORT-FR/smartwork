<h1 class="{$Content_class}">
	{if $Content_icon != ''}
		<i class="fa fa-{$Content_icon}" aria-hidden="true"></i> 
	{/if}
	{$Content_title}
</h1>
{$Content_intro}
{if $btEdit or $btDelete}
	<div class="content_btn {$Content_class}">
		{if $btEdit}
			<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="{#Txt_loading#}" event="{$Content_linkEdit}">
				<span class="fa fa-edit" width="16" height="16"></span>  {#Txt_Content_edit#}
			</button>
		{/if}
		{if $btDelete}
			<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="{#Txt_loading#}" event="{$Content_linkDelete}">
				<span class="fa fa-trash" width="16" height="16"></span>  {#Txt_Content_delete#}
			</button>
		{/if}
	</div>
{/if}
{if $Content_image|default:'' != ''}
	<figure class="post-image">
		<img alt="{$Content_imageAlt|default:''}" src="{$Content_image|default:''}" title="{$Content_imageTitle|default:''}">
	</figure>
{/if}
<div class="article_content {$Content_class}">
	{$Content_content}
</div>
<div class="list-etapes">
	{if $Content_image1|default:'' != ''}
		<div class="etape">
			<figure class="image">
				<img alt="{$Content_image1Alt|default:''}" src="{$Content_image1|default:''}" title="{$Content_image1Title|default:''}">
			</figure>
			<div class="label">
				<p><strong>{$Content_image1Alt|default:''}</strong></p>
				<p>{$Content_image1Title|default:''}<p>
			</div>
		</div>
	{/if}
	{if $Content_image2|default:'' != ''}
		<div class="etape">
			<figure class="image">
				<img alt="{$Content_image2Alt|default:''}" src="{$Content_image2|default:''}" title="{$Content_image2Title|default:''}">
			</figure>
			<div class="label">
				<p><strong>{$Content_image2Alt|default:''}</strong></p>
				<p>{$Content_image2Title|default:''}<p>
			</div>
		</div>
	{/if}
</div>

