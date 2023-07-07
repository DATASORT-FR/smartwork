{extends file="standard.tpl"}

{block name=Main}
<link href="{$visuCss}" rel="stylesheet" type="text/css">
<script src="{$visuJs}"></script>
	<script>
		$(document).ready(
			function() {
				init_ws("#slides", $("#select-visu").val() + "?id=" + {$domainId});

				$("#select-visu").on({				
					change : function(e) {
						e.preventDefault();
						windowSize = 0;
						init_ws("#slides", $("#select-visu").val() + "?id=" + {$domainId});
					}
				});

			}
		);
	</script>

	<div id="visu-slides" class="box-header block-adm block-diagram" box-id="slides" box-model="box-model">
		<header class="page-header">
			<h1>{#Title_visualisation_slides#}</h1>
		</header>
		<div class="row crud form-group">
			<label for="select-visu" class="col-xl-1 col-md-2 col-sm-3 col-form-label">{#Label_visualisation_slides#}</label>
			<div class="col-xl-11 col-md-10 col-sm-9">
				<select id="select-visu" class="form-control form-select select-visu">
					<option value="{$pageRefSimple}">{#Label_visualisation_slides_simple#}</option>  
					<option value="{$pageRefSheets}" selected>{#Label_visualisation_slides_sheets#}</option>  
				</select>
			</div>
		</div>
		<div id="slides" class="box-header block-adm block-diagram-visu">
		</div>
	</div>
{/block}
