<?php 
/**
* Login module : connect box template
*
* @package    module_login
* @subpackage view
* @version    1.0
* @date       15 September 2013
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>
{if $Style == 'vertical'}
	<div class="block-logged block">
		<form id="logged-box" class="form-logged login-flag">
			{if $FlagConnect}
				<div class="form-group">
					<label class="name-logged">{$ConnectName}</label>
				</div>
				<button type="submit" class="btn btn-primary" event="{$LogoutAction}" success="{$LogoutSuccess}">
					<span class="fa fa-user"></span>  {#Bt_login_logout#}
				</button>
			{else}
				<div class="form-group">
					<label class="name-logged">{#Txt_login_login#}</label>
				</div>
			{/if}
		</form>
	</div>
{elseif $Style == 'inline'}
	<div class="block-logged block">
		<form id="logged-box" class="form-inline form-logged login-flag">
			{if $FlagConnect}
				<label class="name-logged">{$ConnectName}</label>
				<button type="submit" class="btn btn-primary" event="{$LogoutAction}" success="{$LogoutSuccess}">
					<span class="fa fa-user"></span>  {#Bt_login_logout#}
				</button>
			{else}
				<label class="name-logged">{#Txt_login_login#}</label>
			{/if}
		</form>
	</div>
{else}
	<div class="block-logged block"> 
		<form id="logged-box" class="form-logged login-flag">
			<div class="row form-row form-group">
				<div class="div-label col-sm-12 col-md-2 col-lg-2">
					<label for="login" class="">{#Lbl_login_login#}</label>
				</div>
				<div class="col-sm-12 col-md-8 col-lg-6">
					<input type="text" class="form-control" name="login" readonly value="{$ConnectLogin}">
				</div>
			</div>
			<div class="row form-row form-group">
				<div class="div-label col-sm-12 col-md-2 col-lg-2">
					<label for="name" class="">{#Lbl_login_name#}</label>
				</div>
				<div class="col-sm-12 col-md-8 col-lg-6">
					<input type="text" class="form-control" name="name" readonly value="{$ConnectName}">
				</div>
			</div>
			<div class="row form-row form-group">
				<div class="div-label col-sm-12 col-md-2 col-lg-2">
					<label for="surname" class="">{#Lbl_login_surname#}</label>
				</div>
				<div class="col-sm-12 col-md-8 col-lg-6">
					<input type="text" class="form-control" name="surname" readonly value="{$ConnectSurName}">
				</div>
			</div>
			<div class="row form-row form-group">
				<div class="div-label col-sm-12 col-md-2 col-lg-2">
					<label for="email" class="">{#Lbl_login_email#}</label>
				</div>
				<div class="col-sm-12 col-md-8 col-lg-6">
					<input type="email" class="form-control" name="email" readonly value="{$ConnectEmail}">
				</div>
			</div>
			<div class="row form-group">
				<div class="offset-sm-2 col-sm-10">
					<button type="submit" class="btn btn-primary" event="{$LogoutAction}" success="{$LogoutSuccess}">
						<span class="fa fa-user"></span>  {#Bt_login_logout#}
					</button>
				</div>
			</div>
		</form>
	</div>
{/if}
					 