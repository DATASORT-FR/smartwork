{if $Style == 'vertical'}
	<div class="block-login block"> 
		<form id="login-box" class="form-login login-flag">
			<div class="form-group">
				{if $LabelFlagLogin}
					<label for="login" class="">{#Lbl_login_login#}</label>
				{/if}
				<input id="login" type="text" class="form-control" name="login" placeholder="{#Txt_login_login_placeholder#}" value="{$LoginValue}">
			</div>
			<div class="form-group">
				{if $LabelFlagPassword}
					<label for="password" class="">{#Lbl_login_password#}</label>
				{/if}
				<input id="password" type="password" class="form-control" name="password" placeholder="{#Txt_login_password_placeholder#}">
			</div>
			<button class="btn btn-primary" event="{$LoginAction}" success="{$LoginSuccess}">
				<span class="fa fa-user"></span>  {#Bt_login_connect#}
			</button>
		</form>
	</div>
{elseif $Style == 'inline'}
	<div class="block-login block"> 
		<form id="login-box" class="form-login form-inline login-flag">
			<div class="form-group">
				{if $LabelFlagLogin}
					<label for="login" class="">{#Lbl_login_login#}</label>
				{/if}
				<input id="login" type="text" class="form-control" name="login" placeholder="{#Txt_login_login_placeholder#}" value="{$LoginValue}">
			</div>
			<div class="form-group">
				{if $LabelFlagPassword}
					<label for="password" class="">{#Lbl_login_password#}</label>
				{/if}
				<input id="password" type="password" class="form-control" name="password" placeholder="{#Txt_login_password_placeholder#}">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" event="{$LoginAction}" success="{$LoginSuccess}">
					<span class="fa fa-user"></span>  {#Bt_login_connect#}
				</button>
			</div>
		</form>
	</div>
{else}
	<div class="block-login block"> 
		<form id="login-box" class="form-login login-flag">
			<div class="form-row message msg-error display-none">
				{#Txt_connect_error#}
			</div>	
			<div class="form-row message msg-ok display-none">
				{#Txt_connect_ok#}
			</div>	
			<div class="row form-row form-group">
				{if $LabelFlagLogin}
					<div class="div-label col-sm-12 col-md-2 col-lg-2 text-md-end">
						<label for="login" class="">{#Lbl_login_login#}</label>
					</div>
				{/if}
				<div class="col-sm-12 col-md-8 col-lg-4">
					<input id="login" type="text" class="form-control" name="login" required size="50" placeholder="{#Txt_login_login_placeholder#}" value="{$LoginValue}">
				</div>
			</div>
			<div class="row form-row form-group">
				{if $LabelFlagPassword}
					<div class="div-label col-sm-12 col-md-2 col-lg-2 text-md-end">
						<label for="password" class="">{#Lbl_login_Password#}</label>
					</div>
				{/if}
				<div class="col-sm-12 col-md-8 col-lg-4">
					<input id="password" type="password" class="form-control" name="password" required size="50" placeholder="{#Txt_login_password_placeholder#}">
				</div>
			</div>
			<div class="row form-group">
				<div class="offset-sm-2 col-sm-10">
					<button class="btn btn-primary" event="{$LoginAction}" success="{$LoginSuccess}">
						<span class="fa fa-user"></span>  {#Bt_login_connect#}
					</button>
				</div>
			</div>
		</form>
	</div>
{/if}

