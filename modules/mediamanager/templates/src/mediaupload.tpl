<script>
	$(document).ready(
		function() {
			init_mediaupload();
		}
	);
</script>

<form id="mediaupload" class="box-header container crud mediaupload" box-size="200" title="{#Title_mediaupload_box#}" box-id="mediaupload_box" enctype="multipart/form-data">
	<input class="form-control " id="mediaupload_base" name="base" value="" type="hidden">
	<div class="row mediaupload_name">
		<label for="mediaupload_name" class="col-lg-2 col-sm-3 form-label text-sm-end">{#Lbl_mediaupload_name#}</label>
		<div class="col-lg-10 col-sm-9">
			<input type="file" id="mediaupload_name" name="name" class="form-control-file">
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<button type="button" id="mediaupload_button_close" class="btn btn-primary bt-mediaupload-close mr-2">
				<span class="fa fa-chevron-close"></span>{#Txt_mediaupload_close#}
			</button>
			<button type="submit" id="mediaupload_button_create" class="btn btn-primary bt-mediaupload-create mr-2" event="{$uploadFileRef}">
				<span class="fa fa-check"></span>{#Txt_mediaupload_upload#}
			</button>
		</div>
	</div>
</form>
