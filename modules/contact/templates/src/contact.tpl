<div class="block-contact block">
	<form id="contact-box" class="form-contact" method="POST">
		<div class="form-row message msg-error display-none">
			{#Txt_contact_error#}
		</div>	
		<div class="row form-row form-group">
			<div class="div-label col-sm-12 col-md-2 col-lg-2 text-md-end">
				<label for="name" class="">{#Lbl_contact_name#}</label>					
			</div>
			<div class="col-sm-12 col-md-8 col-lg-4">
				<input type="text" class="form-control" required name="name" size="50" maxlength="50" value="">
				<div class="message display-none">
					{#Txt_control_name#}
				</div>
			</div>
		</div>
		<div class="row form-row form-group">
			<div class="div-label col-sm-12 col-md-2 col-lg-2 text-md-end">
				<label for="email" class="">{#Lbl_contact_email#}</label>					
			</div>
			<div class="col-sm-12 col-md-8 col-lg-4">
				<input type="text" class="form-control email" required name="email" size="50" maxlength="50" value="">
				<div class="message display-none">
					{#Txt_control_email#}
				</div>
			</div>
		</div>
		<div class="row form-row form-group">
			<div class="div-label col-sm-12 col-md-2 col-lg-2 text-md-end">
				<label for="phone" class="">{#Lbl_contact_phone#}</label>					
			</div>
			<div class="col-sm-12 col-md-8 col-lg-4">
				<input type="text" class="form-control" name="phone" size="10" maxlength="10" value="">
				<div class="message display-none">
					{#Txt_control_phone#}
				</div>
			</div>
		</div>
		<div class="row form-row form-group">
			<div class="col-sm-12 col-md-2 col-lg-2 text-md-end">
				<label for="message" class="">{#Lbl_contact_message#}</label>					
			</div>
			<div class="col-sm-12 col-md-8 col-lg-6">
				<textarea class="form-control" required name="message" rows="8" cols="120"></textarea>
				<div class="message display-none">
					{#Txt_control_message#}
				</div>	
			</div>	
		</div>
		<div class="row form-group"> 
			<div class="offset-sm-2 col-sm-10">
				<button class="btn btn-primary" event="{$ContactAction|default:''}">
					{#Bt_contact_valider#}
				</button>
			</div>
		</div>
	</form>
	<div class="validation display-none">
		<h2>
			<div class="form-row msg-ok">
			{#Title_contact_validation#}
			</div>
		</h2>
		</br>
		<div class="form-row msg-validation">
			{#Msg_contact_validation#}
		</div>
	</div>
</div>
