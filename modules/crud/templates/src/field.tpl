{block name=Main}
{if $field.container} 
	<div id="{$field.field_id}" class="input-{$field.type} div-control {$field.name} {$field.class}">
{/if}
	{if $field.collabelflag} 
		{if $field.collabel != ''}
			<label class="col-label">{$field.collabel}</label>
		{/if}
	{/if}
	{$display_html}
{if $field.container} 
	</div>
{/if}
{/block}
