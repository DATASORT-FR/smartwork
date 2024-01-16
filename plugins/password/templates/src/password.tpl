<script>
	$(document).ready(
		function() {

			ctrl_{$field_id}  = function() {
				var return_value = false;
				if ($("#{$field_id}").val() == $("#{$field_id}_conform").val()) {
					return_value = true; 
				}
				return return_value;
			}
			
		}
	);
</script>

{$label_size = $field_value.labelsize + 1}
{$input_size = 12 - $label_size}
<div class="row">
	<label for="{$field_id}" class="col-lg-{$label_size} form-label text-sm-end">{$field_value.label1}</label>
	<div class="col-lg-{$input_size}">
		<input type="password" class="form-control {$field_class}" id="{$field_id}" name="{$field_name}" control="ctrl_{$field_id}" {$field_style} {$field_attr}>
	</div>
</div>
<div class="row">
	<label for="{$field_id}_conform" class="col-lg-{$label_size} form-label text-sm-end">{$field_value.label2}</label>
	<div class="col-lg-{$input_size}">
		<input type="password" class="form-control {$field_class}" id="{$field_id}_conform" name="{$field_name}_conform" {$field_style} {$field_attr}>
	</div>
</div>
	