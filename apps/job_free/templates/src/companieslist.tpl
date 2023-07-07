{extends file="simple.tpl"}

{block name=Main}
		{if $ListText != ''}
			<div class="row ">
				<div class="col-sm-12">
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<i class="fa fa-close" aria-hidden="true"></i>
						</button>
						{$ListText}
					</div>
				</div>		
			</div>
		{/if}
		{if $ListPageCount > 1}
			<div class="row pagination-container">
				<ul class="pagination">
					{section name=idx loop=$ListPagination}
						{if $ListPagination[idx].page == 0}
							<li class="page-item">
								<a class="pagination-link page-link" event="{$ListPagination[idx].href}" rel="nofollow">
									<i class="fa fa-angle-double-left" aria-hidden="true"></i>
								</a>
							</li>
						{elseif $ListPagination[idx].page == -1}
							<li class="page-item">
								<a class="pagination-link page-link" event="{$ListPagination[idx].href}" rel="nofollow">
									<i class="fa fa-angle-double-right" aria-hidden="true"></i>
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
		{$line = 0}
		{section name=idx loop=$CompanyList}
			<div class="row">
				<article class="col-xs-12">
					<h2><a href="{$LCompanyList[idx].href}">{$CompanyList[idx].name}</a></h2>
					<p>{$CompanyList[idx].resume}</p>
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
									<i class="fa fa-angle-double-left" aria-hidden="true"></i>
								</a>
							</li>
						{elseif $ListPagination[idx].page == -1}
							<li class="page-item">
								<a class="pagination-link page-link" event="{$ListPagination[idx].href}" rel="nofollow">
									<i class="fa fa-angle-double-right" aria-hidden="true"></i>
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

