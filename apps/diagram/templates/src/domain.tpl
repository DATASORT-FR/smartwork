{extends file="standard.tpl"}

{block name=Main}
	<script>
		$(document).ready(
			function() {

				$(document).on("click", ".l_linedomain",
					function(e) {
						e.preventDefault();
						var domainId = $(this).parents("tr:first").attr("domain");
						var theHREF = $(this).parents("table:first").attr("href");
						if (typeof(theHREF) !== "undefined") {
							document.location.href = theHREF + '?domainid=' + domainId;
						}
					}
				);

			}
		);
						
	</script>
	<div id="select-domain" class="box-header block-adm block-diagram" box-id="domain" box-model="box-model">
		<header class="page-header">
			<h1>{#Title_select_domain#}</h1>
		</header>
		<div class="offset-lg-3 col-lg-6">
			<div class="row list-container">
				<div class ="col-lg-12">
					<table class="select-domain-table table table-responsive table-sm text-left" href="{$pageRef}">
						<thead class="thead-default">
							<tr>
								<th>
								</th>
								<th>
									{#header_list_1#}
								</th>
								<th>
									{#header_list_2#}
								</th>
							</tr>
						</thead>
						<tbody>
						{section name=idy loop=$listDomain}
							<tr domain="{$listDomain[idy].id}">
								<td class="l_linedomain" width="5%">
									{if $listDomain[idy].id == $domainId}
										<span class="fa fa-check"></span>
									{/if}
								</td>
								<td class="l_linedomain" width="30%">{$listDomain[idy].name}</td>
								<td class="l_linedomain" width="70%">{$listDomain[idy].label}</td>
							</tr>
						{/section}
						</tbody>
					</table>
				</div>	
			</div>	
		</div>	
	</div>	
{/block}
