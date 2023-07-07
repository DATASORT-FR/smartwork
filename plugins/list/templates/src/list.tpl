{if $field_value.readonly == true}
	{section name=idy loop=$field_value.list}
		{if $field_value.list[idy].id == $field_value.value}
			<input id="{$field_id}_1" type="text" class="form-control {$field_class}" name="{$field_name}" {$field_style} {$field_attr} value="{$field_value.list[idy].description}">
		{/if}
	{/section}
{else}
	{if $field_value.display != ''}
		<script>
			$(document).ready(
				function() {
					$("#{$field_id}_1").change(function() {
						var code= $("#{$field_id}_1").val();
						if (code != '0') {
							var theHREF = '{$field_value.display}' + '/' + code;
							$.ajax({
								url: theHREF,
								success: function(data) {
									console.log(data);
									{section name=idy loop=$field_value.link}
										$('[name="{$field_value.link[idy].field}"]').val(data['{$field_value.link[idy].data}']);
										if ($('[name="{$field_value.link[idy].field}"]').hasClass("input-editor")) {
											editors['{$field_value.link[idy].field}'].setData(data['{$field_value.link[idy].data}']);
										}
										if ($('[name="{$field_value.link[idy].field}"]').hasClass("img_input")) {
											init_image($('[name="{$field_value.link[idy].field}"]'));
										}
									{/section}
								}
							});
						}
						else {
							{section name=idy loop=$field_value.link}
								$('[name="{$field_value.link[idy].field}"]').val('');
								if ($('[name="{$field_value.link[idy].field}"]').hasClass("input-editor")) {
									editors['{$field_value.link[idy].field}'].setData('');
								}
								if ($('[name="{$field_value.link[idy].field}"]').hasClass("img_input")) {
									init_image($('[name="{$field_value.link[idy].field}"]'));
								}
							{/section}
						}
					});
				}
			);
		</script>
	{/if}

	<select id="{$field_id}_1" class="form-control form-select {$field_class}" name="{$field_name}" {$field_style} {$field_attr}>
		{section name=idy loop=$field_value.list}
			{if $display == 'edit'}
				{if $field_value.list[idy].id == $field_value.value}
					<option value="{$field_value.list[idy].id}" selected>{$field_value.list[idy].description}</option>  
				{else}
					<option value="{$field_value.list[idy].id}">{$field_value.list[idy].description}</option>  
				{/if}
			{else}
				<option value="{$field_value.list[idy].id}">{$field_value.list[idy].description}</option>  
			{/if}
		{/section}
	</select>
{/if}
	