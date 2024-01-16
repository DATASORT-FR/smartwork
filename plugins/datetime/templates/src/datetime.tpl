{if $display == 'edit'}
	<input id="{$field_id}_1" type="text" class="hasDatetimepicker form-control {$field_class}" name="{$field_name}" maxlength="19" size="17" data-date-format="dd/mm/yyyy H:i:s" {$field_style} {$field_attr} value="{$field_value.value}">
{else}
	<input id="{$field_id}_1" type="text" class="hasDatetimepicker form-control {$field_class}" name="{$field_name}" maxlength="19" size="17" data-date-format="dd/mm/yyyy H:i:s" placeholder="dd/mm/yyyy" {$field_style} {$field_attr}>
{/if}