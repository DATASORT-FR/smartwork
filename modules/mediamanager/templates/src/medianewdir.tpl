<script>
	$(document).ready(
		function() {
			init_medianewdir();
		}
	);
</script>

<form id="medianewdir" class="box-header container crud medianewdir" box-size="200" title="{#Title_medianewdir_box#}" box-id="medianewdir_box">
	<input class="form-control " id="medianewdir_base" name="base" value="" type="hidden">
	<div class="row medianewdir_name">
		<label for="medianewdir_name" class="col-lg-2 col-sm-3 form-label text-sm-end">{#Lbl_medianewdir_name#}</label>
		<div class="col-lg-10 col-sm-9">
			<div class="input-group">
				<input class="form-control " id="medianewdir_name" name="name" maxlength="30" size="30" value="" type="text">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<button type="button" id="medianewdir_button_close" class="btn btn-primary bt-medianewdir-close mr-2">
				<span class="fa fa-chevron-close"></span>{#Txt_medianewdir_close#}
			</button>
			<button type="submit" id="medianewdir_button_create" class="btn btn-primary bt-medianewdir-create mr-2" event="{$createDirRef}">
				<span class="fa fa-check"></span>{#Txt_medianewdir_upload#}
			</button>
		</div>
	</div>
</form>
