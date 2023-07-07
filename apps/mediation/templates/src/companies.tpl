{$LeftSideDisplay = 0}
{extends file="templateSearch.tpl"}

{block name=Main}
	{$PageBlock}
	<div class="col-sm-12 col-md-12 col-lg-8 push-lg-4">
		<div class="row ">
			<form id="search-form" class="col-sm-12 form-inline">
				<input  id="search-id" name="search" class="form-control input-large" type="text" placeholder="{#Txt_offers_search_placeholder#}" size="50" value="{$SearchValue}">
				<button id="searchBtn-id" class="btn btn-primary" type="submit">Search</button>
			</form>
		</div>
			
		<div id="companies-list">
		</div>
	</div>
	<div class="col-sm-12 col-md-12 col-lg-4 pull-lg-8">
	</div>
{literal}
   <script>
		$(document).ready(
			function() {
				
				// Companies list display
				function displayCompaniesList() {
					post_data = $("#search-form").serialize();
					box = $("#companies-list");
					theHREF = '{/literal}{$SearchHref}{literal}';
					ajax_postload(theHREF, box, post_data);
				};

				displayOffersList();
				
				$(document).on("click", "#searchBtn-id",
					function(e) {
						e.preventDefault();
						if($(this).length) {
							displayCompaniesList();
						}
					}
				);
				

			}			
		);
    </script> 
{/literal}
	
{/block}

