<script>
	$(document).ready(
		function() {
			init_mediamanager();
		}
	);
</script>

<form id="mediamanager" class="box-header container crud mediamanager" box-size="500" listref="{$fileListRef}" title="{#Title_mediamanager_box#}" fade box-id="mediamanager_box">
	<div class="row mediamanager_path">
		<label for="mediamanager_path" class="col-lg-2 col-sm-3 form-label text-sm-end">{#Lbl_mediamanager_path#}</label>
		<div class="col-lg-10 col-sm-9">
			<div class="input-group">
				<input class="form-control" id="mediamanager_path" name="path" size="40" maxlength="100" default="{$path}" value="{$path}" type="text">
				<button id="mediamanager_button_reset" type="button" class="btn btn-primary bt-media-reset" title="{#Lbl_mediamanager_reset#}">
					<span class="fa fa-undo"></span>
				</button>
				{if $btRead}
					<button id="mediamanager_button_parent" type="button" class="btn btn-primary bt-media-parent" title="{#Lbl_mediamanager_parent#}">
						<span class="fa "> ..</span>
					</button>
				{/if}
			</div>
		</div>
	</div>
	<div class="row mediamanager_filename">
		<label for="mediamanager_filename" class="col-lg-2 col-sm-3 form-label text-sm-end">{#Lbl_mediamanager_filename#}</label>
		<div class="col-lg-10 col-sm-9">
			<input class="form-control " id="mediamanager_filename" name="filename" maxlength="30" size="60" default="{$fileName}" value="{$fileName}" type="text">
			<div class="container_img_preview form-control">
				<img class="img_preview" id="mediamanager_preview" title="{$fileName}" alt="{$fileName}" src="{$fileName}" onerror="this.src = './plugins/image/images/notfound.png';">
			</div>
		</div>
	</div>
	<div class="row mediamanager_bt">
		<div class="col-lg-12">
			{if $btNewDir}
				<button type="button" id="mediamanager_button_newdir" class="btn btn-primary bt-media-newdir mr-2" event="{$newDirRef}" title="{#Lbl_mediamanager_newdir#}">
					<span class="fa fa-folder"></span> {#Txt_media_newdir#}
				</button>
			{/if}
			
			{if $btUpload}
				<button type="button" id="mediamanager_button_upload" class="btn btn-primary bt-media-upload mr-2" event="{$uploadRef}" title="{#Lbl_mediamanager_upload#}">
					<span class="fa fa-upload"></span> {#Txt_media_upload#}
				</button>
			{/if}
			
			{if $btRename}
				<button type="button" id="mediamanager_button_rename" class="btn btn-primary bt-media-rename mr-2" event="{$renameRef}" title="{#Lbl_mediamanager_rename#}">
					<span class="fa fa-edit"></span> {#Txt_media_rename#}
				</button>
			{/if}
		</div>
	</div>
	<div class="row mediamanager_list">
		<div id="mediamanager_list" class="block-ws content-update block-main" box-id="content" box-model="box-model" link_href="">
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<button type="button" id="mediamanager_button_close" class="btn btn-primary bt-media-close mr-2" title="{#Lbl_mediamanager_close#}">
				<span class="fa fa-chevron-left"></span> {#Txt_media_close#}
			</button>
			<button type="submit" id="mediamanager_button_select" class="btn btn-primary bt-media-select mr-2" title="{#Lbl_mediamanager_select#}">
				<span class="fa fa-check"></span> {#Txt_media_select#}
			</button>
		</div>
	</div>
</form>
