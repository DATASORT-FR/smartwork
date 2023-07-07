<?php
/* Smarty version 4.1.1, created on 2022-10-11 09:36:18
  from 'E:\xampp\htdocs\smartwork\modules\login\templates\src\apps.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63451cf29fffc3_93040778',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9bafa7fbb75eddd7ae398d463a88714452f2ab84' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\modules\\login\\templates\\src\\apps.tpl',
      1 => 1646066704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63451cf29fffc3_93040778 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?php'; ?>
 
/**
* Login module : login box template
*
* @package    module_login
* @subpackage view
* @version    1.0
* @date       15 September 2013
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
<?php echo '?>'; ?>

<?php
$__section_idx_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['app_array']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_0_total = $__section_idx_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_0_total !== 0) {
for ($__section_idx_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_0_iteration <= $__section_idx_0_total; $__section_idx_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
	<div class="card block-apps block"  onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['app_array']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['href'];?>
';"> 
		<header class="card-header header-apps page-header">
			<?php echo $_smarty_tpl->tpl_vars['app_array']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['label'];?>

		</header>
		<div class="card-body body-apps page-body">
			<div class="card-title image">
				<img src="<?php echo $_smarty_tpl->tpl_vars['app_array']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['app_array']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['description'];?>
" />
			</div>
			<div class="card-text description">
				<?php echo $_smarty_tpl->tpl_vars['app_array']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['description'];?>

			</div>
		</div>
	</div>
<?php
}
}
}
}
