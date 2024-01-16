	<header class="page-header">
		<h1>{#Title_application_import#}</h1>
	</header>
	<form id="application_import-form" class="crud box-header" method="POST" title="{#Title_application_import#}" onsubmit="return false">
		<div id="main-1" class="row form-row form-group">
			<div class="col-sm-12 col-md-2 col-lg-2 text-md-end">
				<label for="application_source" class="form-label source ">{#Lbl_application_import_source#}</label>					
			</div>
			<div class="col-sm-12 col-md-10 col-lg-10">
				<div id="application_source" class="input-text div-control source ">
					<select id="application_source_1" class="form-control form-select source" name="source" required="required">
						{section name=idy loop=$ListSource}
							<option value="{$ListSource[idy]}">{$ListSource[idy]}</option>  
						{/section}
					</select>
				</div>
			</div>
		</div>
		<div id="main-2" class="row form-row form-group">
			<div class="col-sm-12 col-md-2 col-lg-2 text-md-end">
				<label for="application_name" class="form-label name ">{#Lbl_application_import_name#}</label>					
			</div>
			<div class="col-sm-12 col-md-10 col-lg-10">
				<div id="application_name" class="input-text div-control name ">
					<input id="application_name_1" type="text" class="form-control text-lowercase" name="name" size="10" maxlength="10">
				</div>
			</div>
		</div>
		<div id="main-3" class="row form-row form-group">
			<div class="col-sm-12 col-md-2 col-lg-2 text-md-end">
				<label for="application_code" class="form-label code ">{#Lbl_application_import_code#}</label>					
			</div>
			<div class="col-sm-12 col-md-10 col-lg-10">
				<div id="application_code" class="input-text div-control code ">
					<input id="application_code_1" type="text" class="form-control text-uppercase" name="code" size="10" maxlength="10">
				</div>
			</div>
		</div>

		<div id="main-4" class="row form-row form-group">
			<div class="col-sm-12 col-md-2 col-lg-2 text-md-end">
				<label for="application_copy_42_copy_content" class="form-label copy_content ">{#Lbl_application_import_copy_content#}</label>					
			</div>
			<div class="col-sm-12 col-md-10 col-lg-10">
				<div id="application_copy_42_copy_content" class="form-inline">
					<div class="form-check-inline">
						<label for="application_copy_42_copy_content_1" class="form-check-label ">
							<input class="form-check-input" type="radio" name="copy_content" value="0" id="application_copy_42_copy_content_1" checked="">{#Lbl_application_import_copy_content_1#}
						</label>
					</div>
					<div class="form-check-inline">
						<label for="application_copy_42_copy_content_2" class="form-check-label control-label ">
							<input class="form-check-input" type="radio" name="copy_content" value="1" id="application_copy_42_copy_content_2">{#Lbl_application_import_copy_content_2#}
						</label>
					</div>
				</div>
			</div>
		</div>
						
		<div class="row form-group"> 
			<div class="offset-sm-2 col-sm-10">
				<button type="button" id="application-bt_close" class="btn btn-primary bt-close" data-loadingtext="{#Txt_loading#}">
					<span class="fa fa-chevron-left"></span>{#Bt_return#}
				</button>
				<button type="submit" id="application_import-bt_update" class="btn btn-primary bt-event" data-loadingtext="{#Txt_loading#}" event="{$ImporttAction}">
					<span class="fa fa-check" width="16" height="16"></span>{#Bt_application_import#}
				</button>
			</div>
		</div>
	</form>
