{if $field_value.readonly == true}
	<div id="{$field_id}" class="form-control check-container" {$field_attr}>
		<div class="form-check-inline">
			<label for="{$field_id}_1" class="form-check-label {$field_class}" {$field_style} {$field_attr}>
				{if $display == 'edit'}
					{if $field_value.value == 1}
						<input class="form-check-input" type="radio" name="{$field_name}" value="0" id="{$field_id}_1" disabled>
					{else}
						<input class="form-check-input" type="radio" name="{$field_name}" value="0" id="{$field_id}_1" checked disabled>
					{/if}
				{else}
					<input class="form-check-input" type="radio" name="{$field_name}" value="0" id="{$field_id}_1" checked disabled>
				{/if}
				{$field_value.label1}
			</label>
		</div>
		<div class="form-check-inline">
			<label for="{$field_id}_2" class="form-check-label control-label {$field_class}" {$field_style} {$field_attr}>
				{if $display == 'edit'}
					{if $field_value.value == 1}
						<input class="form-check-input" type="radio" name="{$field_name}" value="1" id="{$field_id}_2" checked disabled>
					{else}
						<input class="form-check-input" type="radio" name="{$field_name}" value="1" id="{$field_id}_2" disabled>
					{/if}
				{else}
					<input class="form-check-input" type="radio" name="{$field_name}" value="1" id="{$field_id}_2" disabled>
				{/if}
				{$field_value.label2}
			</label>
		</div>
	</div>
{else}
	<div id="{$field_id}" class="form-inline">
		<div class="form-check-inline">
			<label for="{$field_id}_1" class="form-check-label {$field_class}" {$field_style} {$field_attr}>
				{if $display == 'edit'}
					{if $field_value.value == 1}
						<input class="form-check-input" type="radio" name="{$field_name}" value="0" id="{$field_id}_1">
					{else}
						<input class="form-check-input" type="radio" name="{$field_name}" value="0" id="{$field_id}_1" checked>
					{/if}
				{else}
					<input class="form-check-input" type="radio" name="{$field_name}" value="0" id="{$field_id}_1" checked>
				{/if}
				{$field_value.label1}
			</label>
		</div>
		<div class="form-check-inline">
			<label for="{$field_id}_2" class="form-check-label control-label {$field_class}" {$field_style} {$field_attr}>
				{if $display == 'edit'}
					{if $field_value.value == 1}
						<input class="form-check-input" type="radio" name="{$field_name}" value="1" id="{$field_id}_2" checked>
					{else}
						<input class="form-check-input" type="radio" name="{$field_name}" value="1" id="{$field_id}_2">
					{/if}
				{else}
					<input class="form-check-input" type="radio" name="{$field_name}" value="1" id="{$field_id}_2">
				{/if}
				{$field_value.label2}
			</label>
		</div>
	</div>
{/if}
