{if $field_value.readonly == true}
	<select multiple class="form-control form-select {$field_class}" id="{$field_id}" name="{$field_name}[]" {$field_style} {$field_attr} size=4 disabled>  
		{section name=idy loop=$field_value.list}
			{$selected=false}
			{section name=idz loop=$field_value.value}
				{if $field_value.value[idz].listid==$field_value.list[idy].id}
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
	<select multiple class="form-control form-select {$field_class}" id="{$field_id}" name="{$field_name}[]" {$field_style} {$field_attr} size=4>  
		{section name=idy loop=$field_value.list}
			{$selected=false}
			{if $display == 'edit'}
				{section name=idz loop=$field_value.value}
					{if $field_value.value[idz].listid==$field_value.list[idy].id}
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
