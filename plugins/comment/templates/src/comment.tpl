{if $field_value.readonly == true}
	<div class="input-editor" id="{$field_id}" name="{$field_name}" {$field_attr}>{$field_value.value}</div>
{else}
	<script>
		$(document).ready(
			function() {
				var {$field_id}_size = ({$field_param.rows}*(parseInt($('#{$field_id}').css('font-size'))*4/3)) - 159;
				var {$field_id}_editor;
				
				ClassicEditor
					.create(document.querySelector('#{$field_id}'),{
						toolbar: {
							items: [
								'fontColor', 'fontBackgroundColor', 'bold', 'italic', 'underline', 'blockquote', 'bulletedList', 'numberedList'
							],
							viewportTopOffset: 30,
							shouldNotGroupWhenFull: true
						}
					})
					.then( editor => {
						{$field_id}_editor = editor;
						editors['{$field_name}'] = editor;
						
						editor.model.document.on('change:data', () => {
							document.getElementById('{$field_id}').innerHTML = editor.getData();
							$("#{$field_id}").val(editor.getData());
						});
					})
					.catch( error => {
						console.error(error);
					});
				
			}
		);
	</script>
	<textarea class="form-control input-editor {$field_class}" id="{$field_id}" name="{$field_name}" {$field_style} {$field_attr}>{$field_value.value}</textarea>
{/if}
	