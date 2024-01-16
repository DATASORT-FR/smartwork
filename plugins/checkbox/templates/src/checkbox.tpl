{if $field_value.readonly == true}
	<label for="{$field_id}_1" class="form-check-label {$field_class}" {$field_style} {$field_attr}>
		{if $display == 'edit'}
			{if $field_value.value == 1}
				<input class="form-check-input" type="checkbox" name="{$field_name}" value="1" id="{$field_id}_1" disabled>
			{else}
				<input class="form-check-input" type="checkbox" name="{$field_name}" value="1" id="{$field_id}_1" checked disabled>
			{/if}
		{else}
			<input class="form-check-input" type="checkbox" name="{$field_name}" value="1" id="{$field_id}_1" checked disabled>
		{/if}
		{$field_value.label}
	</label>
{else}
	<label for="{$field_id}_1" class="form-check-label {$field_class}" {$field_style} {$field_attr}>
		{if $display == 'edit'}
			{if $field_value.value == 1}
				<input class="form-check-input" type="checkbox" name="{$field_name}" value="1" id="{$field_id}_1">
			{else}
				<input class="form-check-input" type="checkbox" name="{$field_name}" value="1" id="{$field_id}_1" checked>
			{/if}
		{else}
			<input class="form-check-input" type="checkbox" name="{$field_name}" value="1" id="{$field_id}_1" checked>
		{/if}
		{$field_value.label}
	</label>
{/if}
