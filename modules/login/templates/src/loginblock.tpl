<div class="login-block">

	<div class="tab-link">
		<div class="link1 up" href="#connexion_tab">
			<h2>{#Title_connexion#}</h2>
			<div class="undertitle">{#Title_connexion_undertitle#}</div>
		</div>
		<div class="link2 down" href="#inscription_tab">
			<h2>{#Title_inscription#}</h2>
			<div class="undertitle">{#Title_inscription_undertitle#}</div>
		</div>
	</div>
	<div class="tab-content">
		<div id="connexion_tab" class="tab up">

			<form class="form-login" Method="POST">
				<div class="form-row message msg-error display-none">
					{#Txt_connect_error#}
				</div>	
				<div class="form-row message msg-ok display-none">
					{#Txt_connect_ok#}
				</div>	
				<div class="form-row">
					<label for="login" class="form-label">{#Lbl_login_login#}</label>
					<input type="text" class="user_login form-input" name="login" size="50" maxlength="50" placeholder="{#Txt_login_login_placeholder#}">
					<div class="message msg-login display-none">
						{#Txt_control_login#}
					</div>	
				</div>
				<div class="form-row">
					<label for="password" class="form-label">{#Lbl_login_password#}</label>
					<input type="password" class="user_password form-input" name="password" autocomplete="off" size="15" maxlength="15" placeholder="{#Txt_login_password_placeholder#}">
					<div class="message msg-password display-none">
						{#Txt_control_password#}
					</div>	
				</div>
				<div class="form-row">
					<label class="form-label"></label>
					<div class="user_password_link link-a center">
						{#Lbl_login_password_lost#}
					</div>
				</diV>
				<div class="form-row">
					<label class="form-label"></label>
					<div class="link-btn user_login_button center" event="{$LoginAction|default:''}" return="{$LoginReturn|default:''}>
						<i class="fas fa-sign-in-alt me-1" aria-hidden="true"></i>
						{#Bt_login_connect#}
					</div>
				</div>
			</form>

		</div>
		<div id="inscription_tab" class="tab down">
			<div class="form">
				<form id="user-form" class="form-inscription" method="POST">
					<div class="form-row message msg-error display-none">
						{#Txt_inscription_error#}
					</div>	
					<div class="form-row message msg-exist display-none">
						{#Txt_inscription_duplicate#}
					</div>	
					<div class="form-row">
						<label for="user_email" class="form-label">{#Lbl_login_email#}</label>					
						<input type="text" class="user_email form-input" name="email" size="50" maxlength="50" value="" placeholder="{#Txt_login_email_placeholder#}">
						<div class="message msg-email display-none">
							{#Txt_control_email#}
						</div>	
					</div>
					<div class="form-row">
						<label for="user_surname" class="form-label">{#Lbl_login_surname#}</label>					
						<input type="text" class="user_surname form-input" name="surname" value="" placeholder="{#Txt_login_surname_placeholder#}">
						<div class="message msg-surname display-none">
							{#Txt_control_pseudo#}
						</div>	
					</div>
					<div class="form-row">
						<label for="user_password" class="form-label">{#Lbl_login_password#}</label>
						<input type="password" class="user_password form-input" name="password" autocomplete="off" size="15" maxlength="15" placeholder="{#Txt_login_password_placeholder#}">
						<div class="message msg-password display-none">
							{#Txt_control_password#}
						</div>	
					</div>
					<div class="form-row">
						<label for="user_password_confirm" class="form-label">{#Lbl_login_confirm#}</label>
						<input type="password" class="user_password_confirm form-input" autocomplete="off" size="15" maxlength="15" placeholder="{#Txt_login_password_placeholder#}">
						<div class="message msg-password_confirm display-none">
							{#Txt_control_password_confirm#}
						</div>	
					</div>
					<div class="form-row">
						<label class="form-label"></label>
						<div class="link-btn user_inscription_button center" event="{$InscriptionAction|default:''}" return="{$InscriptionReturn|default:''}>
							<i class="fas fa-user-plus me-1"></i>
							{#Bt_login_inscription#}
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="tab-validation display-none">
		<h2>{#Title_user_validation#}</h2>
		</br>
		<div class="form-row inscription">
			{#Msg_user_validation#}
		</div>
		<div class="form-row connexion display-none">
			{#Msg_user_validation_connexion#}
		</div>
		<div class="form-row message msg-validation display-none">
			{#Msg_user_validation_resend#}
		</div>
		<div class="form-row">
			<div class="user_validation_button link-a center" event="{$ValidationAction|default:''}">
				{#Bt_resend_validation#}
			</div>
		</diV>
	</div>
	
	<div class="tab-password display-none">
		<h2>{#Title_user_password_lost#}</h2>
		<form class="form-login" Method="POST">
			<div class="form-row">
				<label for="email" class="form-label">{#Lbl_login_email#}</label>
				<input type="text" class="user_email form-input" name="email" placeholder="{#Txt_login_email_placeholder#}">
				<div class="message msg-email display-none">
					{#Txt_control_email#}
				</div>	
			</div>
			<div class="form-row message msg-password_lost display-none">
				{#Msg_login_password_lost#}
			</div>	
			<div class="form-row">
				<div class="link-btn user_password_button center" event="{$PasswordAction|default:''}">
					{#Bt_login_password_lost#}
				</div>
			</div>
		</form>
	</div>

</div>
