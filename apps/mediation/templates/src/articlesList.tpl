{extends file="simple.tpl"}

{block name=Main}
		{if $ListText != ''}
			<div class="row ">
				<div class="col-sm-12">
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
							<i class="fa fa-close" aria-hidden="true"></i>
						</button>
						{$ListText}
					</div>
				</div>		
			</div>
		{/if}
		{if $pageRightCreate}
			<div class="content_btn">
				{if $pageRightCreate}
					<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="{#Txt_loading#}" event="{$ArticleCreate}">
						<span class="fa fa-edit" width="16" height="16"></span>  {#Txt_article_create#}
					</button>
				{/if}
			</div>
		{/if}
		{if $ListPageCount > 1}
			<div class="row pagination-container">
				<ul class="pagination">
					{section name=idx loop=$ListPagination}
						{if $ListPagination[idx].page == 0}
							<li class="page-item">
								<a class="pagination-link page-link" event="{$ListPagination[idx].href}" rel="nofollow">
									<span class="fa fa-angle-double-left" aria-hidden="true"></span>
								</a>
							</li>
						{elseif $ListPagination[idx].page == -1}
							<li class="page-item">
								<a class="pagination-link page-link" event="{$ListPagination[idx].href}" rel="nofollow">
									<span class="fa fa-angle-double-right" aria-hidden="true"></span>
								</a>
							</li>
						{elseif $ListPagination[idx].page > 0}
							{if $ListPagination[idx].page == $ListPage}
								<li class="page-item active">
									<a class="page-link">{$ListPagination[idx].page}</a>
								</li>
							{else}
								<li class="page-item">
									<a class="pagination-link page-link" event="{$ListPagination[idx].href}" rel="nofollow">{$ListPagination[idx].page}</a>
								</li>
							{/if}
						{/if}
					{/section}
				</ul>
			</div>
		{/if}
		{section name=idx loop=$ListArticle}
			<div class="article-row">
				{if $ListArticle[idx].status != ''}
					<article class="article row expired" itemscope itemtype="http://schema.org/Article">
				{else}
					<article class="article row" itemscope itemtype="http://schema.org/Article">
				{/if}
					<div class="container-img col-md-6 col-lg-4">
						{if $ListArticle[idx].displayImage != ''}
							<a title="{$ListArticle[idx].title}" href="{$ListArticle[idx].href}">
								{$ListArticle[idx].displayImage}
							</a>
						{/if}
					</div>
					<div class="col-md-6 col-lg-8">
						<h2><a href="{$ListArticle[idx].href}" itemprop="title">{$ListArticle[idx].title}</a></h2>
						<div class="article-info">
							<small itemprop="datePosted">{$ListArticle[idx].date_publication}</small>
							{if $ListArticle[idx].status != ''}
								<small class="status end">{$ListArticle[idx].status}</small>
							{/if}
						</div>
						<div class="article-intro" itemprop="description">
							<p>
								{$ListArticle[idx].intro}
							</p>
						</div>
						<div class="article_bottom">
							{$ArticleTags = $ListArticle[idx].list_tag}
							{if $ArticleTags|@count > 0}
								<p class="tag-list" itemprop="skills">
									{section name=idy loop=$ArticleTags}
										<a class="tag-default tag-link" href="{$ArticleTags[idy].href}">{$ArticleTags[idy].tag}</a>
									{/section}
								</p>
							{/if}
						</div>
					</div>
				</article>
			</div>
			<hr>
		{/section}
		{if $ListPageCount > 1}
			<div class="row pagination-container">
				<ul class="pagination">
					{section name=idx loop=$ListPagination}
						{if $ListPagination[idx].page == 0}
							<li class="page-item">
								<a class="pagination-link page-link" event="{$ListPagination[idx].href}" rel="nofollow">
									<span class="fa fa-angle-double-left" aria-hidden="true"></span>
								</a>
							</li>
						{elseif $ListPagination[idx].page == -1}
							<li class="page-item">
								<a class="pagination-link page-link" event="{$ListPagination[idx].href}" rel="nofollow">
									<span class="fa fa-angle-double-right" aria-hidden="true"></span>
								</a>
							</li>
						{elseif $ListPagination[idx].page > 0}
							{if $ListPagination[idx].page == $ListPage}
								<li class="page-item active">
									<a class="page-link">{$ListPagination[idx].page}</a>
								</li>
							{else}
								<li class="page-item">
									<a class="pagination-link page-link" event="{$ListPagination[idx].href}" rel="nofollow">{$ListPagination[idx].page}</a>
								</li>
							{/if}
						{/if}
					{/section}
				</ul>
			</div>
		{/if}

{/block}

