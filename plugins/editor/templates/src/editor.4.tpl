{if $field_value.readonly == true}
	<div class="input-editor" id="{$field_id}" name="{$field_name}" {$field_attr}>{$field_value.value}</div>
{else}
	<script>
		$(document).ready(
			function() {
				var {$field_id}_size = ({$field_param.rows}*(parseInt($('#{$field_id}').css('font-size'))*4/3)) - 159;
				var {$field_id}_extrabox = $('#{$field_id}').parents('div.extra-box');

				var {$field_id} = CKEDITOR.replace('{$field_id}', {
					on: {
						loaded: function(e) {
						},
						resize: function(e) {
							size_box({$field_id}_extrabox);
						},
						change: function(e) {
							document.getElementById('{$field_id}').innerHTML = {$field_id}.getData();
						}
					},
					height: {$field_id}_size + 'px'
				} );

			}
		);
	</script>
	{if $display == 'edit'}
		<textarea class="form-control input-editor {$field_class}" id="{$field_id}" name="{$field_name}" {$field_style} {$field_attr}>{$field_value.value}</textarea>
	{else}
		<textarea class="form-control input-editor {$field_class}" id="{$field_id}" name="{$field_name}" {$field_style} {$field_attr}></textarea>
	{/if}
{/if}
	