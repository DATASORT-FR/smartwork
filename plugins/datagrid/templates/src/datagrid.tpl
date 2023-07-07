{literal}
<script>
	$(document).ready(
		function() {
		
			$("#{/literal}{$field_id}{literal}").find(".datagrid-value-row").each(
				function() {
					var box = $(this).parents("tr:first");
					elem = box.find(".datagrid-value:first");
					datagridRowValue(elem);
				}
			);
			
			$("#{/literal}{$field_id}{literal}").find("input.datagrid-cell.list").each(
				function() {
					var list = $(this).attr("event");
					var box = $(this).parents("td:first");
					var select = $(".datagrid select." + list + ":first")
					select.val($(this).val());
					$(this).val(select.children("option:selected").text());
				}
			);

		}
	);
</script>
{/literal}

{if $field_value.readonly == true}
	<div class="datagrid">
		<table class="table table-responsive table-bordered table-striped table-sm text-start">

			<thead class="thead-default">
				<tr>
					{$column = 1}
					{section name=idx loop=$field_value.header}
						{$header = $field_value.header[idx]}
						<th class="column-{$column}" width="{$header.pct}%" max-width="{$header.pct}%">
							{$header.field}
						</th>   	
						{$column = $column + 1}
					{/section}
				</tr>
			</thead>

			<tbody>
				{$row = 1}
				{section name=idx loop=$field_value.value}
					{$field_row = $field_value.value[idx]}
					<tr class="row-{$row}">
						{$column = 1}
						{foreach name=outer item=$field from=$field_row}
							<td class="datagrid-line cell-{$row}-{$column}">
								{$field}
							</td>
							{$column = $column + 1}
						{/foreach}
					</tr>   	
					{$row = $row + 1}
				{/section}
			</tbody>

		</table>
	</div>
{else}
	<div class="datagrid">
		<table id="{$field_id}" class="table table-responsive table-bordered table-striped table-sm text-start" {$field_style} {$field_attr}>

			<thead class="thead-default">
				<tr>
					{$column = 1}
					{section name=idx loop=$field_value.header}
						{$header = $field_value.header[idx]}
						<th class="column-{$column} {$header.field} {$header.field_id}_class" width="{$header.pct}%">
							{$header.label}
						</th>   	
						{$column = $column + 1}
					{/section}
					<th class="action" colspan="2">
					</th>
				</tr>
			</thead>

			<tbody>
				{$row = 1}
				{section name=idx loop=$field_value.value}
					{$field_row = $field_value.value[idx]}
					<tr class="row-{$row} datagrid-row">
						<input type="hidden" class="datagrid-value-row" name="{$field_name}[]">
						{$column = 1}
						{foreach name=outer item=$value from=$field_row}
							{$header = $field_value.header[$column - 1]}
							<td class="datagrid-line cell-{$row}-{$column} {$header.field} {$header.field_id}_class">
								{if $header.type == 'list'}
									<input type="hidden" class="datagrid-cell datagrid-value" value="{$value}">
									<input type="text" class="datagrid-cell list" event="list_{$header.field}" value="{$value}">
								{elseif $header.type == 'integer'}
									<input type="text" class="datagrid-cell datagrid-value" pattern="\d*" value="{$value}">
								{elseif $header.type == 'number'}
									<input type="number" class="datagrid-cell datagrid-value" style="-moz-appearance: textfield" value="{$value}">
								{elseif $header.type == 'date'}
									<input type="text" class="hasDatepicker datagrid-cell datagrid-value" data-date-format="{$field_value.format}" placeholder="{$field_value.format}"  value="{$value}">
								{else}
									<input type="text" class="datagrid-cell datagrid-value" value="{$value}">
								{/if}
							</td>
							{$column = $column + 1}
						{/foreach}
						<td class="datagrid-line action" width="2%">
							<a class="datagrid-delete" rel="nofollow">
								<span class="fa fa-trash" width="16" height="16"></span> 
							</a>
						</td>
						<td class="datagrid-line action" width="2%">
							<a class="datagrid-insert" rel="nofollow">
								<span class="fa fa-plus" width="16" height="16"></span> 
							</a>
						</td>
					</tr>   	
					{$row = $row + 1}
				{/section}
				<tr class="row-{$row} datagrid-row datagrid-last">
					<input type="hidden" class="datagrid-value-row" name="{$field_name}[]">
					{$column = 1}
					{section name=idx loop=$field_value.header}
						{$header = $field_value.header[idx]}
						<td class="datagrid-line cell-{$row}-{$column} {$header.field} {$header.field_id}_class">
							{if $header.type == 'list'}
								<input type="hidden" class="datagrid-cell datagrid-value" value="">
								<input type="text" class="datagrid-cell list" event="list_{$header.field}" value="">
							{else}
								<input type="text" class="datagrid-cell datagrid-value" value="">
							{/if}
						</td>
						{$column = $column + 1}
					{/section}
					<td class="datagrid-line action" width="2%">
						<a class="datagrid-bt1" rel="nofollow">
							<span class="fa fa-withe" width="16" height="16"></span> 
						</a>
					</td>
					<td class="datagrid-line action" width="2%">
						<a class="datagrid-bt2" rel="nofollow">
							<span class="fa fa-withe" width="16" height="16"></span> 
						</a>
					</td>
				</tr>   	
			</tbody>

		</table>

		{section name=idx loop=$field_value.header}
			{$header = $field_value.header[idx]}
			{if $header.type == 'list'}
				<select class="list list_{$header.field} display-none" >
					{section name=idy loop=$header.list}
						<option value="{$header.list[idy].id}">{$header.list[idy].description}</option>  
					{/section}
				</select>
			{/if}
		{/section}
	</div>
	
{/if}
