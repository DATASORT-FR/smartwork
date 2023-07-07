<?php
/* Smarty version 4.1.1, created on 2022-10-11 09:40:35
  from 'E:\xampp\htdocs\smartwork\modules\login\templates\src\account.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63451df3aeae54_11987638',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8fb0f67672e8dbc95001acf2128c12015d380aa1' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\modules\\login\\templates\\src\\account.tpl',
      1 => 1637016174,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63451df3aeae54_11987638 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?php'; ?>
 
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
<?php echo '?>'; ?>

<div class="login-block account">
	<form class="form-account">
		<div class="form-row message msg-error display-none">
			<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Msg_login_account_error');?>

		</div>	
		<div class="form-row message msg-password display-none">
			<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Msg_login_password_lost');?>

		</div>	
		<div class="form-row">
			<label for="login" class="form-label"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_login_login');?>
</label>
			<input type="text" class="form-input readonly" name="login" readonly value="<?php echo $_smarty_tpl->tpl_vars['ConnectLogin']->value;?>
">
		</div>
		<div class="form-row">
			<label for="name" class="form-label"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_login_name');?>
</label>
			<input type="text" class="form-input readonly" name="name" readonly value="<?php echo $_smarty_tpl->tpl_vars['ConnectName']->value;?>
">
		</div>
		<div class="form-row">
			<label for="surname" class="form-label"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_login_surname');?>
</label>
			<input type="text" class="form-input readonly" name="surname" readonly value="<?php echo $_smarty_tpl->tpl_vars['ConnectSurName']->value;?>
">
		</div>
		<div class="form-row">
			<label for="email" class="form-label"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_login_email');?>
</label>
			<input type="email" class="form-input readonly" name="email" readonly value="<?php echo $_smarty_tpl->tpl_vars['ConnectEmail']->value;?>
">
		</div>
		<div class="form-row">
			<button class="btn btn-primary login-button center" event="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LogoutAction']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" success="<?php echo $_smarty_tpl->tpl_vars['LogoutPage']->value;?>
">
				<span class="fa fa-user"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_login_logout');?>

			</button>
			<button class="btn btn-primary login-button" event="<?php echo (($tmp = $_smarty_tpl->tpl_vars['PasswordAction']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" message=".message.msg-password:first">
				<span class="fa fa-user"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_login_password');?>

			</button>
		</div>
	</form>
</diV><?php }
}
