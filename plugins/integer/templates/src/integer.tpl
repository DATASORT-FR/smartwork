{if $display == 'edit'}
	<input id="{$field_id}_1" type="number" class="integer form-control {$field_class}" name="{$field_name}" step="1" style ="appearance: textfield;" pattern="\d*" min="-99999" max="99999" size="5" maxlength="5" {$field_style} {$field_attr} value="{$field_value.value}">
{else}
	<input id="{$field_id}_1" type="number" class="integer form-control {$field_class}" name="{$field_name}" step="1" style ="appearance: textfield;" pattern="\d*" min="-99999" max="99999" size="5" maxlength="5" {$field_style} {$field_attr}>
{/if}