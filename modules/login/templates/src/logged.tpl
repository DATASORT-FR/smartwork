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
	<form id="logged_box" class="form-logged login-flag" Method="POST" Action="{$LogoutAction}">
		{if $FlagConnect}
			<div class="form-group">
				<label class="name-logged">{$ConnectName}</label>
			</div>
			<button type="submit" class="btn btn-primary">
				<span class="fa fa-user"></span>  {#Bt_login_logout#}
			</button>
		{else}
			<div class="form-group">
				<label class="name-logged">{#Txt_login_login#}</label>
			</div>
		{/if}
	</form>
{elseif $Style == 'inline'}
	<form id="logged_box" class="form-inline form-logged login-flag" Method="POST" Action="{$LogoutAction}">
		{if $FlagConnect}
			<label class="name-logged">{$ConnectName}</label>
			<button type="submit" class="btn btn-primary">
				<span class="fa fa-user"></span>  {#Bt_login_logout#}
			</button>
		{else}
			<label class="name-logged">{#Txt_login_login#}</label>
		{/if}
	</form>
{else}
	<div class="block-logged block"> 
		<form id="logged_box" class="form-inline form-logged login-flag" Method="POST" Action="{$LogoutAction}">
			{if $FlagConnect}
				<label class="name-logged">{$ConnectName}</label>
				<button type="submit" class="btn btn-primary">
					<span class="fa fa-user"></span>  {#Bt_login_logout#}
				</button>
			{else}
				<div class="name-logged">
					{#Txt_login_login#}
				</div>
			{/if}
		</form>
	</div>
{/if}
					 