<?php 
/**
* Login module : account box template
*
* @package    module_login
* @subpackage view
* @version    1.0
* @date       23 September 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>
<div class="login-block account">
	<form class="form-account">
		<div class="form-row message msg-error display-none">
			{#Msg_login_account_error#}
		</div>	
		<div class="form-row message msg-password display-none">
			{#Msg_login_password_lost#}
		</div>	
		<div class="form-row">
			<label for="login" class="form-label">{#Lbl_login_login#}</label>
			<input type="text" class="form-input readonly" name="login" readonly value="{$ConnectLogin}">
		</div>
		<div class="form-row">
			<label for="name" class="form-label">{#Lbl_login_name#}</label>
			<input type="text" class="form-input readonly" name="name" readonly value="{$ConnectName}">
		</div>
		<div class="form-row">
			<label for="surname" class="form-label">{#Lbl_login_surname#}</label>
			<input type="text" class="form-input readonly" name="surname" readonly value="{$ConnectSurName}">
		</div>
		<div class="form-row">
			<label for="email" class="form-label">{#Lbl_login_email#}</label>
			<input type="email" class="form-input readonly" name="email" readonly value="{$ConnectEmail}">
		</div>
		<div class="form-row">
			<button class="btn btn-primary login-button center" event="{$LogoutAction|default:''}" success="{$LogoutPage}">
				<span class="fa fa-user"></span>  {#Bt_login_logout#}
			</button>
			<button class="btn btn-primary login-button" event="{$PasswordAction|default:''}" message=".message.msg-password:first">
				<span class="fa fa-user"></span>  {#Bt_login_password#}
			</button>
		</div>
	</form>
</diV>