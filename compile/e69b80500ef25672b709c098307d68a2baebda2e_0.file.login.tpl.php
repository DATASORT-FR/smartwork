<?php
/* Smarty version 4.1.1, created on 2022-10-11 09:36:18
  from 'E:\xampp\htdocs\smartwork\modules\login\templates\src\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63451cf27e4491_92029683',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e69b80500ef25672b709c098307d68a2baebda2e' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\modules\\login\\templates\\src\\login.tpl',
      1 => 1639179038,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63451cf27e4491_92029683 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['Style']->value == 'vertical') {?>
	<form id="login-box" class="form-login login-flag" event="<?php echo $_smarty_tpl->tpl_vars['LoginAction']->value;?>
">
		<div class="form-group">
			<?php if ($_smarty_tpl->tpl_vars['LabelFlag']->value) {?>
				<label for="login" class=""><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_login_login');?>
</label>
			<?php }?>
			<input id="login" type="text" class="form-control" name="login" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_login_login_placeholder');?>
" value="<?php echo $_smarty_tpl->tpl_vars['LoginValue']->value;?>
">
		</div>
		<div class="form-group">
			<input id="password" type="password" class="form-control" name="password" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_login_password_placeholder');?>
">
		</div>
		<button class="btn btn-primary">
			<span class="fa fa-user"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_login_connect');?>

		</button>
	</form>
<?php } elseif ($_smarty_tpl->tpl_vars['Style']->value == 'inline') {?>
	<form id="login-box" class="form-login form-inline login-flag" event="<?php echo $_smarty_tpl->tpl_vars['LoginAction']->value;?>
">
		<div class="form-group">
			<?php if ($_smarty_tpl->tpl_vars['LabelFlag']->value) {?>
				<label for="login" class=""><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_login_login');?>
</label>
			<?php }?>
			<input id="login" type="text" class="form-control" name="login" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_login_login_placeholder');?>
" value="<?php echo $_smarty_tpl->tpl_vars['LoginValue']->value;?>
">
		</div>
		<div class="form-group">
			<input id="password" type="password" class="form-control" name="password" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_login_password_placeholder');?>
">
		</div>
		<div class="form-group">
			<button class="btn btn-primary">
				<span class="fa fa-user"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_login_connect');?>

			</button>
		</div>
	</form>
<?php } else { ?>
	<div class="block-login block"> 
		<form id="login-box" class="form-login form-inline login-flag" event="<?php echo $_smarty_tpl->tpl_vars['LoginAction']->value;?>
">
			<div class="form-group">
				<?php if ($_smarty_tpl->tpl_vars['LabelFlag']->value) {?>
					<label for="login" class=""><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_login_login');?>
</label>
				<?php }?>
				<input id="login" type="text" class="form-control" name="login" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_login_login_placeholder');?>
" value="<?php echo $_smarty_tpl->tpl_vars['LoginValue']->value;?>
">
			</div>
			<div class="form-group">
				<input id="password" type="password" class="form-control" name="password" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_login_password_placeholder');?>
">
			</div>
			<div class="form-group">
				<button class="btn btn-primary">
					<span class="fa fa-user"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_login_connect');?>

				</button>
			</div>
		</form>
	</div>
<?php }?>

<?php }
}
