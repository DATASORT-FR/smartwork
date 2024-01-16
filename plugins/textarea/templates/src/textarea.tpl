{if $display == 'edit'}
	<textarea id="{$field_id}_1" class="form-control {$field_class}" name="{$field_name}" {$field_style} {$field_attr}>{$field_value.value}</textarea>
{else}
	<textarea id="{$field_id}_1" class="form-control {$field_class}" name="{$field_name}" {$field_style} {$field_attr}></textarea>
{/if}