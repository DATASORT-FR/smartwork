<h1 class="article {$Content_class}" itemprop="title">
	{if $Content_block1|default:'' != ''}
		{$Content_block1|default:''}
	{else}
		{$Content_title|default:''}
	{/if}
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
			{if $btDelete}
				<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="{#Txt_loading#}" event="{$Content_linkDelete}">
					<span class="fa fa-trash" width="16" height="16"></span>  {#Txt_Content_delete#}
				</button>
			{/if}
		</div>
	</div>
{/if}
<div class="blog-content">
	<figure class="post-image">
		<img alt="{$Content_imageAlt|default:''}" src="{$Content_image|default:''}" onerror="this.src='./images/separation/image-non-trouvee.webp';" title="{$Content_imageTitle|default:''}">
        <div class="post-date">
			<h3>{$Content_day|default:''}</h3>
			<p>{$Content_month|default:''}</p>
        </div>
    </figure>
	<div class="post-content">
		<div class="article-info">
			<div class="article-duration">
			{if $Content_block2|default:'' != ''}
				<p>
					<span class="icon">
						<i class="fa fa-clock"></i> 
					</span>
					{$Content_block2|default:''}
				</p>
			{/if}
			</div>
			<div class="article-author"> 
				{if $Content_block5|default:'' != ''}
					<p class="author">{$Content_block5|default:''}</p>
				{/if}
				{if $Content_block6|default:'' != ''}
					<p class="profession">{$Content_block6|default:''}</p>
				{/if}
			</div>
		</div>
		{if $Content_block3|default:'' != ''}
			<p class="article-resume">
				{$Content_block3|default:''}
			</p>
		{/if}
		{if $Content_block4|default:'' != ''}
            <blockquote class="ludwig article-encart">
				{$Content_block4|default:''}
            </blockquote>
		{/if}
		{if $Content_add|default:'' != ''}
			<div class="row">
				<div class="col-lg-12">
					{$Content_add}
				</div>
			</div>
		{/if}
		{$Content_content|default:''}
	</div>
</div>
