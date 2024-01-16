{block name=Main}

<script>
	$(document).ready(
		function() {
			init_form();
			
			{if $display == 'edit'}
				{if $saveautoflag}
					$("#{$html_id}{$object_id}-form input, #{$html_id}{$object_id}-form select").on({
						change : function(e) {
							e.preventDefault();
							var theHREF = $("#{$html_id}{$object_id}-form").attr("save");
							var post_data = $("#{$html_id}{$object_id}-form").serialize();
							ajax_postasync(theHREF, post_data);
						}
					});

				{/if}
			{/if}
			
		}
	);
</script>

{$input_size = 12 - $label_size}
{if $titleflag}
	<header class="page-header">
		{if $display == 'edit'}
			{if $titlecode != ''}
				<h1>{#Title_crud_edit#} {$titlecode} {$object_code}</h1>
			{else}
				<h1>{#Title_crud_edit#}  {$object_code}</h1>
			{/if}
		{else}
			{if $titlecode != ''}
				<h1>{#Title_crud_new#} {$titlecode}</h1>
			{else}
				<h1>{#Title_crud_new#}</h1>
			{/if}
		{/if}
	</header>
{/if}

{if $display == 'edit'}
	{if $saveautoref != ''}
		<form id="{$html_id}{$object_id}-form" class="crud box-header" Method="POST" title="{#Title_crud_edit#}  {$object_code}" box-id="{$html_id}_{$object_id}" box-size="{$html_size}" save="{$saveautoref}" onsubmit="return false">
	{else}
		<form id="{$html_id}{$object_id}-form" class="crud box-header" Method="POST" title="{#Title_crud_edit#}  {$object_code}" box-id="{$html_id}_{$object_id}" box-size="{$html_size}" onsubmit="return false">
	{/if}
{else}
	<form id="{$html_id}{$object_id}-form" class="crud box-header" Method="POST" title="{#Title_crud_new#}" box-id="{$html_id}" box-size="{$html_size}" onsubmit="return false">
{/if}
		<div class="form-group row display-none">
			{if $display == 'edit'}
				{if $idflag}
					<label for="{$html_id}{$object_id}-id" class="col-4 form-label">"Id"
					</label>
					<div class="col-8">
						<input type="text" class="form-control input-mini" id="{$html_id}{$object_id}-id" name="id" value="{$object_id}">
					</div>
				{/if}
			{/if}
		</div>
		{$display_html}
		<div class="row form-group"> 
			{if $label_size > 0}
				<div class="offset-sm-{$label_size} col-sm-{$input_size}">
			{else}
				<div class=" col-sm-12">
			{/if}
				{if $btreturnflag}
					<button type="button" id="{$html_id}{$object_id}-bt_close" class="btn btn-primary bt-close" data-loadingtext="{#Txt_loading#}">
						<span class="fa fa-close" width="16" height="16"></span>  {#Bt_close#}
					</button>
				{/if}
				{if $btresetflag}
					<button type="button" id="{$html_id}{$object_id}-bt_reset" class="btn btn-primary bt-reset" data-loadingtext="{#Txt_loading#}" event="{$btresetref}">
						<span class="fa fa-refresh" width="16" height="16"></span>  {#Bt_reset#}
					</button>
				{/if}
				{if $btokflag}
					<button type="submit" id="{$html_id}{$object_id}-bt_update" class="btn btn-primary bt-event" data-loadingtext="{#Txt_loading#}" event="{$btokref}">
					{if $display == 'edit'}
						<span class="fa fa-check" width="16" height="16"></span>  {#Bt_update#}
					{else}
						<span class="fa fa-check" width="16" height="16"></span>  {#Bt_create#}
					{/if}
					</button>
				{/if}
			</div>
		</div>
	</form>

{/block}
