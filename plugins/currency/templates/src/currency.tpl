{if $field_value.readonly == true}
	<span id="{$field_id}_1" type="text" class="currency form-control {$field_class}" name="{$field_name}" {$field_style} {$field_attr}>
		{$field_value.value}
		<i class="fa {$field_value.currency}" aria-hidden="true"></i>
	</span>
{else}
	{if $display == 'edit'}
		<input id="{$field_id}_1" type="number" class="currency form-control {$field_class}" name="{$field_name}" step="0.01" style ="appearance: textfield;" pattern="" min="-9999999" max="9999999" size="9" maxlength="9" {$field_style} {$field_attr} value="{$field_value.value}">
		<i class="fa {$field_value.currency}" aria-hidden="true"></i>
	{else}
		<input id="{$field_id}_1" type="number" class="currency form-control {$field_class}" name="{$field_name}" step="0.01" style ="appearance: textfield;" pattern="" min="-9999999" max="9999999" size="9" maxlength="9" {$field_style} {$field_attr}>
		<i class="fa {$field_value.currency}" aria-hidden="true"></i>
	{/if}
{/if}	
