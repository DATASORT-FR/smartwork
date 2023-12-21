{block name=Main}
	{if $mode}
		{if $field.colflag}
			{if $required} 
				{$labelTxt = $field.label|cat:'*'}
			{else}
				{$labelTxt = $field.label}
			{/if}
			{$colSize = 12/$colNb}
			{if $col_fieldSize > 0}
				{$colSize = $col_fieldSize}
			{/if}
			
			{if $field.labelflag}
				{$labelSizeLg = $label_size}
			{else}
				{$labelSizeLg = 0}
			{/if}
			{if $field.name == 'clear'} 
				{$labelSizeLg = $colSize}
				{$label_txt = ''}
			{/if}			
			{$inputSizeLg = $colSize - $labelSizeLg}
			
			{if $labelTxt == ''}
				{$labelSizeMd = 0}
			{else}
				{$labelSizeMd = $labelSizeLg}
			{/if}
			{$inputSizeMd = $colSize - $labelSizeMd}
			
			{if $labelTxt == ''}
				{$labelSizeSm = 0}
			{else}
				{$labelSizeSm = (1.5*$labelSizeMd)|string_format:"%d"}
			{/if}
			{if $colNb == 1}
				{$inputSizeSm = 12 - $labelSizeSm}
			{else}
				{$inputSizeSm = 6 - $labelSizeSm}
			{/if}
			{$labelSizeSm = 12}
			{$inputSizeSm = 12}
			{if $col == 3}
				{if $labelSizeLg != 0}
					<div class="clearfix d-block d-lg-none">
						<br>
					</div>
				{/if}
			{/if}
			{if $labelSizeLg != 0}
				{if $field.collabelflag and $field.collabel != ''}
					<div class="col-sm-{$labelSizeSm} col-md-{$labelSizeMd} col-lg-{$labelSizeLg} text-md-end align-self-end">
				{else}
					<div class="col-sm-{$labelSizeSm} col-md-{$labelSizeMd} col-lg-{$labelSizeLg} text-md-end">
				{/if}
					<label for="{$field.field_id}" class="form-label {$field.name} {$field.class}">{$labelTxt}</label>					
				</div>
			{/if}
			{if $inputSizeLg != 0}
				<div class="col-sm-{$inputSizeSm} col-md-{$inputSizeMd} col-lg-{$inputSizeLg}">
					{$display_html}
					{$append_html}
				</div>
			{/if}
		{else}
			{$display_html}
			{$append_html}
		{/if}
	{/if}

{/block}
