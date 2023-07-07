{if $readonly==false}
	<script>
		$(document).ready(
			function() {
				init_image($("#{$field_id}"));
			}
		);
	</script>
	
	<div id="{$field_id}_Container" class="img_container row form-group {$field_class}">
		<input id="{$field_id}" type="hidden" class="img_input" name="{$field_name}" value="{$field_value.value}">
		<div class="img_container_preview col-sm-3 col-xs-12">
			<img id="{$field_id}_Image" class="img_preview" alt="" src="" onerror="this.src = './plugins/image/images/notfound.png';">
		</div>
		<div class="img_container_all col-sm-9 col-xs-12">
			<div class="img_container_img">
				<div class="input-group">
					<input id="{$field_id}_img" type="text" class="img_input_img form-control">
					<button id="{$field_id}_Button_empty" type="button" class="btn btn-primary bt-empty form-control">
						<span class="fa fa-remove"></span>
					</button>
					<button id="{$field_id}_Button_media" type="button" class="btn btn-primary bt-media form-control" event="{$field_value.ref}" default="{$field_value.path}">
						<span class="fa fa-picture-o"></span>
					</button>
				</div>
			</div>
			<div class="img_container_alt row">
				<label for="{$field_id}_alt" class="form-label text-sm-end col-sm-3">{#Lbl_image_alt#}</label>
				<div class="col-sm-9">
					<input id="{$field_id}_alt" type="text" class="img_input_alt form-control">
				</div>
			</div>
			<div class="img_container_title row">
				<label for="{$field_id}_title" class="form-label text-sm-end col-sm-3">{#Lbl_image_title#}</label>
				<div class="col-sm-9">
					<input id="{$field_id}_title" type="text" class="img_input_title form-control">
				</div>
			</div>
		</div>
	</div>
{else}
	<img id="{$field_id}_Image" class="img_preview" alt="{$field_value.alt}" title="{$field_value.title}" src="{$field_value.image}" {$field_style} {$field_attr}>
{/if}
	
	