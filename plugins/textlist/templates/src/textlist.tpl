<script>
	$(document).ready(
		function() {
			$("#{$field_id}_list").change(function() {
				var values = $("#{$field_id}_list").val();
				var value = '';
				for (i = 0; i < values.length; i++) {
					if (i > 0) value = value + ';';
					value = value + values[i];
				}
				$("#{$field_id}").val(value);
			});
			
		}
	);
</script>

<input type="hidden" id="{$field_id}" name="{$field_name}" value="{$field_value.value}">
{if $field_value.readonly == true}
	<select multiple class="form-control {$field_class}" id="{$field_id}_list" {$field_style} {$field_attr} size=4 disabled>  
		{section name=idy loop=$field_value.list}
			{$selected=false}
			{section name=idz loop=$field_value.values}
				{if $field_value.values[idz]==$field_value.list[idy].id}
					{$selected=true}
				{/if}
			{/section}
			{if $selected==true}
				<option value="{$field_value.list[idy].id}" disabled>
					{$field_value.list[idy].description}
				</option>  
			{/if}
		{/section}
	</select>
{else}
	<select multiple class="form-control {$field_class}" id="{$field_id}_list" {$field_style} {$field_attr} size=4>  
		{section name=idy loop=$field_value.list}
			{$selected=false}
			{if $display == 'edit'}
				{section name=idz loop=$field_value.values}
					{if $field_value.values[idz]==$field_value.list[idy].id}
						{$selected=true}
					{/if}
				{/section}
			{/if}
			{if $selected==true}
				<option value="{$field_value.list[idy].id}" selected>
			{else}
				<option value="{$field_value.list[idy].id}">
			{/if}
			{$field_value.list[idy].description}</option>  
		{/section}
	</select>
{/if}
