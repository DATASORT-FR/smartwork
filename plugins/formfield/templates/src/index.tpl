{$line = 0}
{section name=idx loop=$field_value.displayonly}
	{if $line == 0}
		<script>
			$(document).ready(
				function() {
	{/if}
				{$field_displayonly = $field_value.displayonly[idx]}
				{$field_id_displayonly = $field_displayonly.field_id}
				{$ope_displayonly = $field_displayonly.ope}
				{$value_displayonly = $field_displayonly.value}
			

				$("#{$field_id}_1, input[name={$field_name}]").change(function() {
					{$line1 = 0}
					if (
						{section name=idy loop=$value_displayonly}
							{if $line1 == 1}
								&&
							{/if}
							{if $ope_displayonly == '!='}
								(this.value == '{$value_displayonly[idy]}') 
							{else}
								(this.value != '{$value_displayonly[idy]}') 
							{/if}
							{$line1 = 1}
						{/section}
					) {
						$("a[href='#{$field_id_displayonly}']").addClass('display-none-{$field_id}');
						$("label[for='{$field_id_displayonly}']").addClass('display-none-{$field_id}');
						$("#{$field_id_displayonly}").addClass('display-none-{$field_id}');
						$("#{$field_id_displayonly}_list").addClass('display-none-{$field_id}');
						$(".{$field_id_displayonly}_class").addClass('display-none-{$field_id}');
					}
					else {
						$("a[href='#{$field_id_displayonly}']").removeClass('display-none-{$field_id}');
						$("label[for='{$field_id_displayonly}']").removeClass('display-none-{$field_id}');
						$("#{$field_id_displayonly}").removeClass('display-none-{$field_id}');			
						$("#{$field_id_displayonly}_list").removeClass('display-none-{$field_id}');			
						$(".{$field_id_displayonly}_class").removeClass('display-none-{$field_id}');
					}
				});
				
				{$line1 = 0}
				if (
					{section name=idy loop=$value_displayonly}
						{if $line1 == 1}
							&&
						{/if}
						{if $field_type == 'choice'}
							{if $ope_displayonly == '!='}
								($("input[name={$field_name}]:checked").val() == '{$value_displayonly[idy]}') 
							{else}
								($("input[name={$field_name}]:checked").val() != '{$value_displayonly[idy]}') 
							{/if}
						{else}
							{if $ope_displayonly == '!='}
								($("#{$field_id}_1").val() == '{$value_displayonly[idy]}') 
							{else}
								($("#{$field_id}_1").val() != '{$value_displayonly[idy]}') 
							{/if}
						{/if}
						{$line1 = 1}
					{/section}
				) {
					$("a[href='#{$field_id_displayonly}']").addClass('display-none-{$field_id}');
					$("label[for='{$field_id_displayonly}']").addClass('display-none-{$field_id}');
					$("#{$field_id_displayonly}").addClass('display-none-{$field_id}');
					$("#{$field_id_displayonly}_list").addClass('display-none-{$field_id}');
					$(".{$field_id_displayonly}_class").addClass('display-none-{$field_id}');
				}
				
	{$line = 1}
{/section}
	{if $line == 1}
				}
			);
		</script>
	{/if}
{$field_html}
