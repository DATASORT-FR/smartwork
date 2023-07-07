		{if $pageRightCreate}
			<div class="content_btn">
			{if $pageRightCreate}
					<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="{#Txt_loading#}" event="{$ArticleCreate}">
						<span class="fa fa-edit" width="16" height="16"></span>  {#Txt_article_create#}
					</button>
				{/if}
			</div>
		{/if}
		{$flagLineCur = 0}
		{$line = 1}
		{section name=idx loop=$ArticleList}
			{if $line == 1}
				<div class="row">
					{if $ArticleList[idx].status != ''}
						<article class="col-md-12 article expired" itemscope itemtype="http://schema.org/Article">
					{else}
						<article class="col-md-12 article" itemscope itemtype="http://schema.org/Article">
					{/if}
						<h2>
							<a href="{$ArticleList[idx].href}" title="{$ArticleList[idx].title}" itemprop="title">{$ArticleList[idx].title}</a>
						</h2>
						<div class="article-info">
							<small itemprop="datePosted">{$ArticleList[idx].date_publication}</small>
							{if $ArticleList[idx].status != ''}
								<small class="status end">{$ArticleList[idx].status}</small>
							{/if}
						</div>
						<div class="article-intro" itemprop="description">
							{if $ArticleList[idx].displayImage != ''}
								<div class="container-img">
									<a title="{$ArticleList[idx].title}" href="{$ArticleList[idx].href}">
										{$ArticleList[idx].displayImage}
									</a>
								</div>
							{/if}
							{$ArticleList[idx].intro}
						</div>
					</article>
				</div>
				<hr>
			{else}
				{if $line <= 7}
					{if $line == 2 or $line == 4 or $line == 6}
						<div class="row">
						{$flagLineCur = 1}
					{/if}
					{if $ArticleList[idx].status != ''}
						<article class="col-md-6 article expired" itemscope itemtype="http://schema.org/Article">
					{else}
						<article class="col-md-6 article" itemscope itemtype="http://schema.org/Article">
					{/if}
						<h2>
							<a href="{$ArticleList[idx].href}" title="{$ArticleList[idx].title}" itemprop="title">{$ArticleList[idx].title}</a>
						</h2>
						{if $ArticleList[idx].displayImage != ''}
							<div class="container-img">
								<a title="{$ArticleList[idx].title}" href="{$ArticleList[idx].href}">
									{$ArticleList[idx].displayImage}
								</a>
							</div>
						{/if}
						<div class="article-info">
							<small itemprop="datePosted">{$ArticleList[idx].date_publication}</small>
							{if $ArticleList[idx].status != ''}
								<small class="status end">{$ArticleList[idx].status}</small>
							{/if}
						</div>
						<div class="article-intro" itemprop="description">
							<p>
							{$ArticleList[idx].intro}
							</p>
						</div>
					</article>
					{if $line == 3 or $line == 5 or $line == 7}
						</div>
						<hr>
						{$flagLineCur = 0}
					{/if}
				{else}
					<div class="article-row">
						{if $ArticleList[idx].status != ''}
							<article class="article row expired" itemscope itemtype="http://schema.org/Article">
						{else}
							<article class="article row" itemscope itemtype="http://schema.org/Article">
						{/if}
							{if $ArticleList[idx].displayImage != ''}
								<div class="container-img col-md-6 col-lg-4">
									<a title="{$ArticleList[idx].title}" href="{$ArticleList[idx].href}">
										{$ArticleList[idx].displayImage}
									</a>
								</div>
								<div class="col-md-6 col-lg-8">
							{else}
								<div class="col-lg-12">
							{/if}
								<h2>
									<a href="{$ArticleList[idx].href}" title="{$ArticleList[idx].title}" itemprop="title">{$ArticleList[idx].title}</a>
								</h2>
								<div class="article-info">
									<small itemprop="datePosted">{$ArticleList[idx].date_publication}</small>
									{if $ArticleList[idx].status != ''}
										<small class="status end">{$ArticleList[idx].status}</small>
									{/if}
								</div>
								<div class="article-intro" itemprop="description">
									<p>
									{$ArticleList[idx].intro}
									</p>
								</div>
							</div>
						</article>
					</div>
					<hr>
				{/if}
			{/if}
			{$line = $line + 1}
		{/section}
		{if $flagLineCur == 1}
			</div>
			<hr>
			{$flagLineCur = 0}
		{/if}
		{if $ListPageCount > 1}
			<div class="row pagination-container">
				<ul class="pagination">
					{section name=idx loop=$ListPagination}
						{if $ListPagination[idx].page == 0}
							<li class="page-item">
								<a class="pagination-link page-link" href="{$ListPagination[idx].href}">
									<span class="fa fa-angle-double-left" aria-hidden="true"></span>
								</a>
							</li>
						{elseif $ListPagination[idx].page == -1}
							<li class="page-item">
								<a class="pagination-link page-link" href="{$ListPagination[idx].href}">
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
									<a class="pagination-link page-link" href="{$ListPagination[idx].href}">{$ListPagination[idx].page}</a>
								</li>
							{/if}
						{/if}
					{/section}
				</ul>
			</div>
		{/if}
