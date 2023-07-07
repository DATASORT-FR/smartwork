{if $display == 'edit'}
	<input id="{$field_id}_1" type="text" class="form-control {$field_class}" name="{$field_name}" {$field_style} {$field_attr} value="{$field_value.value}">
{else}
	<input id="{$field_id}_1" type="text" class="form-control {$field_class}" name="{$field_name}" {$field_style} {$field_attr} value="{$field_value.value}">
{/if}