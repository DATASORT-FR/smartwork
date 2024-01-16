<script>
	$(document).ready(
		function() {
		init_ws("#{$field_id}", "{$field_value.ref}", "not");
		}
	);
</script>

<div id="{$field_id}" class="box-header block-{$field_name}_list" title="{#Title_list#}" box-id="{$field_value.object_id}" box-model="box-model">
</div>