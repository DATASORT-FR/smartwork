<script>
	$(document).ready(
		function() {
			init_mediarename();
		}
	);
</script>

<form id="mediarename" class="box-header container crud mediarename" box-size="200" title="{#Title_mediarename_box#}" box-id="mediarename_box">
	<input class="form-control " id="mediarename_path" name="path" value="" type="hidden">
	<input class="form-control " id="mediarename_filename" name="filename" value="" type="hidden">
	<div class="row mediarename_name">
		<label for="mediarename_name" class="col-lg-2 col-sm-3 form-label text-sm-end">{#Lbl_mediarename_name#}</label>
		<div class="col-lg-10 col-sm-9">
			<div class="input-group">
				<input class="form-control " id="mediarename_name" name="name" maxlength="30" size="30" value="" type="text">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<button type="button" id="mediarename_button_close" class="btn btn-primary bt-mediarename-close mr-2">
				<span class="fa fa-chevron-close"></span>{#Txt_mediarename_close#}
			</button>
			<button type="submit" id="mediarename_button_create" class="btn btn-primary bt-mediarename-create mr-2" event="{$renameActionRef}">
				<span class="fa fa-check"></span>{#Txt_mediarename_upload#}
			</button>
		</div>
	</div>
</form>
