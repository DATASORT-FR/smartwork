{extends file="templateMain.tpl"}

{block name=Content}
	<script>
		$(document).ready(
			function() {
				init_ws("#list_data_files", "{$page_ref}");
			}
		);
	</script>

	<div id="list_data_files" class="box-header block-adm block-data_files_list" title="{#Title_data_files#}" box-id="data_files" box-model="box-model">			
	</div>
	
{/block}
