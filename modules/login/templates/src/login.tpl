{if $Style == 'vertical'}
	<form id="login-box" class="form-login login-flag" event="{$LoginAction}">
		<div class="form-group">
			{if $LabelFlag}
				<label for="login" class="">{#Lbl_login_login#}</label>
			{/if}
			<input id="login" type="text" class="form-control" name="login" placeholder="{#Txt_login_login_placeholder#}" value="{$LoginValue}">
		</div>
		<div class="form-group">
			<input id="password" type="password" class="form-control" name="password" placeholder="{#Txt_login_password_placeholder#}">
		</div>
		<button class="btn btn-primary">
			<span class="fa fa-user"></span>  {#Bt_login_connect#}
		</button>
	</form>
{elseif $Style == 'inline'}
	<form id="login-box" class="form-login form-inline login-flag" event="{$LoginAction}">
		<div class="form-group">
			{if $LabelFlag}
				<label for="login" class="">{#Lbl_login_login#}</label>
			{/if}
			<input id="login" type="text" class="form-control" name="login" placeholder="{#Txt_login_login_placeholder#}" value="{$LoginValue}">
		</div>
		<div class="form-group">
			<input id="password" type="password" class="form-control" name="password" placeholder="{#Txt_login_password_placeholder#}">
		</div>
		<div class="form-group">
			<button class="btn btn-primary">
				<span class="fa fa-user"></span>  {#Bt_login_connect#}
			</button>
		</div>
	</form>
{else}
	<div class="block-login block"> 
		<form id="login-box" class="form-login form-inline login-flag" event="{$LoginAction}">
			<div class="form-group">
				{if $LabelFlag}
					<label for="login" class="">{#Lbl_login_login#}</label>
				{/if}
				<input id="login" type="text" class="form-control" name="login" placeholder="{#Txt_login_login_placeholder#}" value="{$LoginValue}">
			</div>
			<div class="form-group">
				<input id="password" type="password" class="form-control" name="password" placeholder="{#Txt_login_password_placeholder#}">
			</div>
			<div class="form-group">
				<button class="btn btn-primary">
					<span class="fa fa-user"></span>  {#Bt_login_connect#}
				</button>
			</div>
		</form>
	</div>
{/if}

