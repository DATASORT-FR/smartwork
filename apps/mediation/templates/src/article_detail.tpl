		<div class="col-md-12 block-header">
			<h1 itemprop="title">{$Article.title}</h1>
		</div>
		<div class="col-md-12 content_btn">
			<div class="col-sm-6 text-left">
				<small>{$Article.date_publication}</small>
			</div>
			{if $pageRightUpdate == 1}
				<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="Chargement..." event="{$AdminLink}">
					<span class="fa fa-edit" width="16" height="16"></span>
					{#Txt_article_edit#}
				</button>
			{/if}
		</div>
		<div class="col-md-12 article-intro">
			{$Article.intro}
		</div>
		{if $Article.displayImage != ''}
			<div class="col-md-12 container-img">
				{$Article.displayImage}
			</div>
		{/if}
		{if $pageRightUpdate == 1}
			<div class="col-md-12">
				<div class="card">
					<div class="card-header p-b-0">
						<h2 class="card-title">
							<i class="fa fa-eye" aria-hidden="true"></i> 
							{#Lbl_article_info#}
						</h2>
					</div>
					<div class="card-body">
						<div class="col-md-6">
							<div class="form-group">
								<label class="font-weight-bold">{#Lbl_article_reference#}</label>
								<span class="article-reference">{$Article.reference}</span>
							</div>
							<div class="form-group">
								<label class="font-weight-bold">{#Lbl_article_category#}</label>
								<span class="article-name" itemprop="name">{$Article.category}</span>
							</div>
							<div class="form-group">
								<label class="font-weight-bold">{#Lbl_article_thematic#}</label>
								<span class="article-name" itemprop="name">{$Article.thematic}</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="font-weight-bold">{#Lbl_article_status#}</label>
								<span class="article-status" itemprop="datePosted">{$Article.statusName}</span>
							</div>
							<div class="form-group">
								<label class="font-weight-bold">{#Lbl_article_sub_category#}</label>
								<span class="article-object">{$Article.subcategory}</span>
							</div>
							<div class="form-group">
								<label class="font-weight-bold">{#Lbl_article_sub_thematic#}</label>
								<span class="article-object">{$Article.subthematic}</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		{/if}
		<div class="col-md-12 block-content">
			<div class="article-description" itemprop="description">
				{$Article.description}
			</div>
		</div>
		<div class="col-md-12 block-content">
			<div class="col-sm-4 text-left link-article">
				{if $Article.linkTitle != ''}
					<small>
						<a href="{$Article.linkUrl}" target="_blank">{$Article.linkSite}</a>
					</small>
				{/if}
			</div>
			<div class="col-sm-8">
				{$SocialShare}
			</div>
		</div>
