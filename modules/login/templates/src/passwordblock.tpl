<div class="changepassword-block">
	<div class="tab-content">
		<div class="form">
			<form id="user-form" class="" method="POST">
				<div class="form-row message msg-error display-none">
					{#Txt_password_error#}
				</div>	
				<div class="form-row">
					<label for="user_password" class="form-label">{#Lbl_user_password#}</label>
					<input type="password" class="user_password form-input" name="password" autocomplete="off" size="15" maxlength="15">
					<div class="message msg-password display-none">
						{#Txt_control_password#}
					</div>	
				</div>
				<div class="form-row">
					<label for="user_password_confirm" class="form-label">{#Lbl_user_confirm#}</label>
					<input type="password" class="user_password_confirm form-input" autocomplete="off" size="15" maxlength="15">
					<div class="message msg-password_confirm display-none">
						{#Txt_control_password_confirm#}
					</div>	
				</div>
				<div class="form-row">
					<div class="link-btn user_password_button center" event="{$passwordAction|default:''}">
						{#Bt_password_valider#}
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="tab-validation display-none">
		<div class="form-row">
			{#Msg_password_validation#}
		</div>
	</div>
</div>
