{if $field_value.readonly == true}
	<div class="input-editor" id="{$field_id}" name="{$field_name}" {$field_attr}>{$field_value.value}</div>
{else}
	<script>
		$(document).ready(
			function() {
				var {$field_id}_size = ({$field_param.rows}*(parseInt($('#{$field_id}').css('font-size'))*4/3)) - 159;
				var {$field_id}_extrabox = $('#{$field_id}').parents('div.extra-box');

				ClassicEditor
					.create(document.querySelector('#{$field_id}'))
					.then(editor => {
						console.log( editor );
						})
					.catch( error => {
						console.error( error );
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
	