<?php
/* Smarty version 4.1.1, created on 2022-10-11 09:36:40
  from 'E:\xampp\htdocs\smartwork\modules\login\templates\src\logged.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63451d08b17b11_45757727',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2d7c8c959de65b13c8996ae346512e4f0842fb47' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\modules\\login\\templates\\src\\logged.tpl',
      1 => 1494847918,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63451d08b17b11_45757727 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?php'; ?>
 
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
<?php echo '?>'; ?>

<?php if ($_smarty_tpl->tpl_vars['Style']->value == 'vertical') {?>
	<form id="logged_box" class="form-logged login-flag" Method="POST" Action="<?php echo $_smarty_tpl->tpl_vars['LogoutAction']->value;?>
">
		<?php if ($_smarty_tpl->tpl_vars['FlagConnect']->value) {?>
			<div class="form-group">
				<label class="name-logged"><?php echo $_smarty_tpl->tpl_vars['ConnectName']->value;?>
</label>
			</div>
			<button type="submit" class="btn btn-primary">
				<span class="fa fa-user"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_login_logout');?>

			</button>
		<?php } else { ?>
			<div class="form-group">
				<label class="name-logged"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_login_login');?>
</label>
			</div>
		<?php }?>
	</form>
<?php } elseif ($_smarty_tpl->tpl_vars['Style']->value == 'inline') {?>
	<form id="logged_box" class="form-inline form-logged login-flag" Method="POST" Action="<?php echo $_smarty_tpl->tpl_vars['LogoutAction']->value;?>
">
		<?php if ($_smarty_tpl->tpl_vars['FlagConnect']->value) {?>
			<label class="name-logged"><?php echo $_smarty_tpl->tpl_vars['ConnectName']->value;?>
</label>
			<button type="submit" class="btn btn-primary">
				<span class="fa fa-user"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_login_logout');?>

			</button>
		<?php } else { ?>
			<label class="name-logged"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_login_login');?>
</label>
		<?php }?>
	</form>
<?php } else { ?>
	<div class="block-logged block"> 
		<form id="logged_box" class="form-inline form-logged login-flag" Method="POST" Action="<?php echo $_smarty_tpl->tpl_vars['LogoutAction']->value;?>
">
			<?php if ($_smarty_tpl->tpl_vars['FlagConnect']->value) {?>
				<label class="name-logged"><?php echo $_smarty_tpl->tpl_vars['ConnectName']->value;?>
</label>
				<button type="submit" class="btn btn-primary">
					<span class="fa fa-user"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_login_logout');?>

				</button>
			<?php } else { ?>
				<div class="name-logged">
					<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_login_login');?>

				</div>
			<?php }?>
		</form>
	</div>
<?php }?>
					 <?php }
}
