{if $field_value.readonly == true}
		<input id="{$field_id}_1" type="text" class="form-control {$field_class}" name="{$field_name}" maxlength="10" size="10" {$field_style} {$field_attr} value="{$field_value.value}">
{else}
	{if $display == 'edit'}
		<input id="{$field_id}_1" type="text" class="hasDatepicker form-control {$field_class}" name="{$field_name}" maxlength="10" size="10" data-date-format="{$field_value.format}" placeholder="{$field_value.format}" {$field_style} {$field_attr} value="{$field_value.value}">
	{else}
		<input id="{$field_id}_1" type="text" class="hasDatepicker form-control {$field_class}" name="{$field_name}" maxlength="10" size="10" data-date-format="{$field_value.format}" placeholder="{$field_value.format}" {$field_style} {$field_attr} value="">
	{/if}
{/if}