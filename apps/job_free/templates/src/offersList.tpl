{extends file="simple.tpl"}

{block name=Main}
		{if $ListText != ''}
			<div class="row ">
				<div class="col-sm-12">
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
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
		{$line = 0}
		{section name=idx loop=$ListMission}
			<div class="row mission_row">
				{if $ListMission[idx].status != ''}
					<article class="col-xs-12 offer expired" itemscope itemtype="http://schema.org/JobPosting">
				{else}
					<article class="col-xs-12 offer" itemscope itemtype="http://schema.org/JobPosting">
				{/if}
					<h2><a href="{$ListMission[idx].href}" title="{$ListMission[idx].title_alt}" itemprop="title">{$ListMission[idx].title}</a></h2>
					<div class="mission_header">
						<small itemprop="datePosted">{$ListMission[idx].date_publication}</small>
						{if $ListMission[idx].status != ''}
							<small class="status">{$ListMission[idx].status}</small>
						{/if}
						<small class="job-employment hidden" itemprop="employmentType">contract</small>
						<small class="score">
							<label class="display-star font-weight-bold">{#Lbl_mission_score#}</label>
							<ul class="list display-star">
								{if $ListMission[idx].score > 0}
									<li class='light'>
								{else}
									<li class=''>
								{/if}
									<i class="fa fa-star" aria-hidden="true">
									</i>
								</li>
								{if $ListMission[idx].score > 1}
									<li class='light'>
								{else}
									<li class=''>
								{/if}
									<i class="fa fa-star" aria-hidden="true">
									</i>
								</li>
								{if $ListMission[idx].score > 2}
									<li class='light'>
								{else}
									<li class=''>
								{/if}
									<i class="fa fa-star" aria-hidden="true">
									</i>
								</li>
								{if $ListMission[idx].score > 3}
									<li class='light'>
								{else}
									<li class=''>
								{/if}
									<i class="fa fa-star" aria-hidden="true">
									</i>
								</li>
								{if $ListMission[idx].score > 4}
									<li class='light'>
								{else}
									<li class=''>
								{/if}
									<i class="fa fa-star" aria-hidden="true">
									</i>
								</li>
							</ul>
						</small>
					</div>
					<div class="mission_intro" itemprop="description">
						{$ListMission[idx].intro}
					</div>
					<div class="mission_bottom">
						{$MissionTags = $ListMission[idx].list_tag}
						{if $MissionTags|@count > 0}
							<p class="tag-list" itemprop="skills">
								{section name=idy loop=$MissionTags}
									<a class="tag-default tag-link" href="{$MissionTags[idy].href}">{$MissionTags[idy].tag}</a>
								{/section}
							</p>
						{/if}
						{if $line == 0}
							<a class="read_more btn btn-outline-success" href="{$ListMission[idx].href}">{#Txt_read_more#}</a>
							{$line = 1}
						{elseif $line == 1}
							<a class="read_more btn btn-outline-primary" href="{$ListMission[idx].href}">{#Txt_read_more#}</a>
							{$line = 2}
						{elseif $line == 2}
							<a class="read_more btn btn-outline-danger" href="{$ListMission[idx].href}">{#Txt_read_more#}</a>
							{$line = 0}
						{/if}
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

