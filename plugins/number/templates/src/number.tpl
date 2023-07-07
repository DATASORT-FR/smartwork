{if $field_value.readonly == true}
		<input id="{$field_id}_1" type="text" class="number form-control {$field_class}" name="{$field_name}" step="0.01" size="9" maxlength="9" {$field_style} {$field_attr} value="{$field_value.value}">
{else}
	{if $display == 'edit'}
		<input id="{$field_id}_1" type="number" class="number form-control {$field_class}" name="{$field_name}" step="0.01" style ="appearance: textfield;" pattern="" min="-9999999" max="9999999" size="9" maxlength="9" {$field_style} {$field_attr} value="{$field_value.value}">
	{else}
		<input id="{$field_id}_1" type="number" class="number form-control {$field_class}" name="{$field_name}" step="0.01" style ="appearance: textfield;" pattern="" min="-9999999" max="9999999" size="9" maxlength="9" {$field_style} {$field_attr}>
	{/if}
{/if}	