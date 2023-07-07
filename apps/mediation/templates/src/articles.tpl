{$LeftSideDisplay = 0}
{$RightSideDisplay = 0}
{extends file="standard.tpl"}

{block name=Main}
	<div class="row ">
		{$PageBlock}
	</div>
	<div class="row ">
		<div class="col-sm-12 col-md-12 col-lg-8 push-lg-4">
			<div class="row ">
				<form id="search-form" class="col-sm-8 form-inline" method="post" action="{$ArticlesHref}">
					<input  id="tags-id" name="tags" class="form-control" type="hidden" value="{$TagsValue}">
					<input  id="category-id" name="category" class="form-control" type="hidden" value="{$CategoryValue}">
					<input  id="subcategory-id" name="subcategory" class="form-control" type="hidden" value="{$SubCategoryValue}">
					<input  id="thematic-id" name="thematic" class="form-control" type="hidden" value="{$ThematicValue}">
					<input  id="subthematic-id" name="subthematic" class="form-control" type="hidden" value="{$SubThematicValue}">
					<div class="input-group">
						<input  id="search-id" name="search" class="form-control" type="text" placeholder="{#Txt_articles_search_placeholder#}" size="50" value="{$SearchValue}">
						<span class="input-group-btn">
							<button id="resetBtnSmall-id" class="btn btn-primary input-group-addon btn-reset hidden-md-up" type="submit">
								<span class="fa fa-eraser" aria-hidden="true"></span>
							</button>
							<button id="searchBtn-id" class="btn btn-primary input-group-addon btn-search" type="submit">
								<span class="fa fa-search" aria-hidden="true"></span>
							</button>						
						</span>
					</div>
				</form>
				<div class="col-sm-4">
					<button id="resetBtn-id" class="btn btn-primary btn-reset pull-right hidden-md-down" type="submit">
						<span class="fa fa-eraser" aria-hidden="true"></span>Reset
					</button>
				</div>
			</div>
			
			<div id="articles-list" class="block-ws content-update block-main" box-id="content" box-model="box-model" link_href="{$ArticlesLink}">
			</div>
		</div>
		<div class="col-sm-12 col-md-12 col-lg-4 pull-lg-8 left-zone">
			<div class="card tags-choice">
				<div class="card-header p-b-0">
					<h2 class="card-title">
						<i class="fa fa-filter" aria-hidden="true"></i> 
						{#Lbl_articles_tags#}
					</h2>
				</div>
				<div class="card-body">
					<div id="tags-type-loading" class="bootstrap-tagsinput">
					</div>
					<input id="tags-type" class="" type="hidden" value="{$TagsValue}">
					<small class="secondary u-db u-mt1 u-mb2">
						<span>{#Txt_articles_tags_help#}</span>
					</small>	
				</div>
				<div class="card-footer hidden-md-up">
					<button id="tagsBtn-id" class="btn btn-primary btn-search" type="submit">
						<span class="fa fa-search"></span>{#Txt_articles_search_placeholder#}
					</button>
				</div>
			</div>
				
			<div class="card filter-choice">
				<div class="card-header p-b-0">
					<h2 class="card-title">
						<i class="fa fa-filter" aria-hidden="true"></i> 
						{#Lbl_articles_filter#}
					</h2>
				</div>
				<div class="card-body">
					<div class="row form-group">
						<label id="category-label">{#Lbl_articles_category#}</label>
					</div>
					<div class="row form-group">
						<select id="category-type" class="form-control form-select" rows="10">
							<option value="" class="category-item"> </option>
						</select>
					</div>
					<div class="row form-group">
						<label id="subcategory-label">{#Lbl_articles_sub_category#}</label>
					</div>
					<div class="row form-group">
						<select id="subcategory-type" class="form-control form-select" rows="10">
							<option value="" class="subcategory-item"> </option>
						</select>
					</div>
					<div class="row form-group">
						<label id="thematic-label">{#Lbl_articles_thematic#}</label>
					</div>
					<div class="row form-group">
						<select id="thematic-type" class="form-control form-select" rows="10">
							<option value="" class="thematic-item"> </option>
						</select>
					</div>
					<div class="row form-group">
						<label id="subthematic-label">{#Lbl_articles_sub_thematic#}</label>
					</div>
					<div class="row form-group">
						<select id="subthematic-type" class="form-control form-select" rows="10">
							<option value="" class="subthematic-item"> </option>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
{literal}
   <script>
		$(document).ready(
			function() {
				
				// Articles list display
				function displayArticlesList() {
					post_data = $("#search-form").serialize();
					box = $("#articles-list");
					theHREF = '{/literal}{$SearchHref}{literal}';
					ajax_postload(theHREF, box, post_data);
				};

				displayArticlesList();
				
				$(document).on("click", ".btn-search",
					function(e) {
						e.preventDefault();
						if($(this).length) {
							if (navigator.userAgent.search("Chrome") >= 0) {
								$("#search-form").submit();
							}
							else {
								displayArticlesList();
								$("html, body").animate({ scrollTop: 0 }, 500);
							}
						}
					}
				);
				
				$(document).on("click", ".btn-reset",
					function(e) {
						e.preventDefault();
						if($(this).length) {
							$("#search-id").val('');
							$("#tags-type").tagsinput('removeAll');
							$("#tags-type").val('');
							$("#tags-id").val('');
							$("#category-id").val('');
							$("#category-type").val('');
							$("#subcategory-id").val('');
							$("#subcategory-type").val('');
							$("#thematic-id").val('');
							$("#thematic-type").val('');
							$("#subthematic-id").val('');
							$("#subthematic-type").val('');
							if (navigator.userAgent.search("Chrome") >= 0) {
								$("#search-form").submit();
							}
							else {
								displayArticlesList();
								$("html, body").animate({ scrollTop: 0 }, 500);
							}
						}
					}
				);
				
				$(document).on("click", ".tag-link",
					function(e) {
						e.preventDefault();
						if($(this).length) {
							$("#tags-type").tagsinput('removeAll');
							$("#tags-type").tagsinput('add', $(this).text());
							$("#tags-id").val($(this).text());
							displayArticlesList();
						}
					}
				);
				
				// Tags managemnt
				$("#tags-id").change(
					function(e) {
						e.preventDefault();
						$("#tags-type").val($("#tags-id").val());
					}
				);

				$("#tags-type").change(
					function(e) {
						e.preventDefault();
						$("#tags-id").val($("#tags-type").val());
					}
				);

				function getTags() {
					$.ajax({
						url: '{/literal}{$TagsHref}{literal}',
						success: function(data) {
							tags = data;
							$('#tags-type-loading').remove();
							$("#tags-type").tagsinput({
								typeahead: {
									source: tags,
									minLength: 2,
									autoSelect: true,
								},
								trimValue: true,
								freeInput: false,
								maxTags: 6,
								maxChars: 20
							});
						}
					});
				}
				
				getTags();

				function getCategories() {
					$.ajax({
						url: '{/literal}{$CategoryHref}{literal}',
						success: function(data) {
							category = data;
							var $selectCategory = $('#category-type');
							for(var key in category) {
								if (category[key] == $("#category-id").val()) {
									$selectCategory.append('<option value="' + category[key] + '" class="category-item"  selected>' + category[key] + '</option>');
								} 
								else {
									$selectCategory.append('<option value="' + category[key] + '" class="category-item">' + category[key] + '</option>');
								}
							}
						}
					});
				}
				
				getCategories();
			
				// JobName managemnt
				$("#category-id").change(
					function(e) {
						e.preventDefault();
						$("#category-type").val($("#category-id").val());
					}
				);

				$("#category-type").change(
					function(e) {
						e.preventDefault();
						$("#category-id").val($("#category-type").val());
					}
				);

				function getSubCategories() {
					$.ajax({
						url: '{/literal}{$SubCategoryHref}{literal}',
						success: function(data) {
							subcategory = data;
							var $selectSubCategory = $('#subcategory-type');
							for(var key in subcategory) {
								if (subcategory[key] == $("#subcategory-id").val()) {
									$selectSubCategory.append('<option value="' + subcategory[key] + '" class="subcategory-item"  selected>' + subcategory[key] + '</option>');
								} 
								else {
									$selectSubCategory.append('<option value="' + subcategory[key] + '" class="subcategory-item">' + subcategory[key] + '</option>');
								}
							}
						}
					});
				}
				
				getSubCategories();

				// JobName managemnt
				$("#subcategory-id").change(
					function(e) {
						e.preventDefault();
						$("#subcategory-type").val($("#subcategory-id").val());
					}
				);

				$("#subcategory-type").change(
					function(e) {
						e.preventDefault();
						$("#subcategory-id").val($("#subcategory-type").val());
					}
				);

				function getThematics() {
					$.ajax({
						url: '{/literal}{$ThematicHref}{literal}',
						success: function(data) {
							thematic = data;
							var $selectThematic = $('#thematic-type');
							for(var key in thematic) {
								if (thematic[key] == $("#thematic-id").val()) {
									$selectThematic.append('<option value="' + thematic[key] + '" class="thematic-item"  selected>' + thematic[key] + '</option>');
								} 
								else {
									$selectThematic.append('<option value="' + thematic[key] + '" class="thematic-item">' + thematic[key] + '</option>');
								}
							}
						}
					});
				}
				
				getThematics();
			
				// JobName managemnt
				$("#thematic-id").change(
					function(e) {
						e.preventDefault();
						$("#thematic-type").val($("#thematic-id").val());
					}
				);

				$("#thematic-type").change(
					function(e) {
						e.preventDefault();
						$("#thematic-id").val($("#thematic-type").val());
					}
				);

				function getSubThematics() {
					$.ajax({
						url: '{/literal}{$SubThematicHref}{literal}',
						success: function(data) {
							subthematic = data;
							var $selectSubThematic = $('#subthematic-type');
							for(var key in subthematic) {
								if (subthematic[key] == $("#subthematic-id").val()) {
									$selectSubThematic.append('<option value="' + subthematic[key] + '" class="subthematic-item"  selected>' + subthematic[key] + '</option>');
								} 
								else {
									$selectSubThematic.append('<option value="' + subthematic[key] + '" class="subthematic-item">' + subthematic[key] + '</option>');
								}
							}
						}
					});
				}
				
				getSubThematics();

				// JobName managemnt
				$("#subthematic-id").change(
					function(e) {
						e.preventDefault();
						$("#subthematic-type").val($("#subthematic-id").val());
					}
				);

				$("#subthematic-type").change(
					function(e) {
						e.preventDefault();
						$("#subthematic-id").val($("#subthematic-type").val());
					}
				);

				// Pagination management
				$(document).on("click", ".pagination-link",
					function(e) {
						e.preventDefault();
						if($(this).length) {
							post_data = $("#search-form").serialize();
							box = $("#articles-list");
							theHREF = $(this).attr("event");
							ajax_postload(theHREF, box, post_data, false, false);
						}
					}
				);
				
			}			
		);
    </script> 
{/literal}
	
{/block}

