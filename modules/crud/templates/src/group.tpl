{block name=Main}

	{if $group_id != ''}
		<fieldset id ="{$group_id}" class="form-group">
	{/if}
		{$display_html}
	{if $group_id != ''}
		</fieldset>
	{/if}

{/block}
