{extends file="mail_standard.tpl"}

{block name=Main}
	{#Mail_validation_html_1#}
	<div class="form-row">
		<a class="btn btn-primary center" href="{$validationAction}">
			{#Mail_validation_bt#}
		</a>
	</div>	
	{#Mail_validation_html_2#}
{/block}
