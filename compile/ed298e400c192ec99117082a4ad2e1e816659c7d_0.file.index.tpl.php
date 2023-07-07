<?php
/* Smarty version 4.1.1, created on 2022-10-03 17:20:01
  from 'E:\xampp\htdocs\smartwork\modules\crud\templates\src\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_633afda14466e5_75595769',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ed298e400c192ec99117082a4ad2e1e816659c7d' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\modules\\crud\\templates\\src\\index.tpl',
      1 => 1648495514,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_633afda14466e5_75595769 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1470413952633afda14383b2_94411278', 'Main');
?>

<?php }
/* {block 'Main'} */
class Block_1470413952633afda14383b2_94411278 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_1470413952633afda14383b2_94411278',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<?php echo '<script'; ?>
>
	$(document).ready(
		function() {
			init_form();
			
			<?php if ($_smarty_tpl->tpl_vars['display']->value == 'edit') {?>
				<?php if ($_smarty_tpl->tpl_vars['saveautoflag']->value) {?>
					$("#<?php echo $_smarty_tpl->tpl_vars['html_id']->value;
echo $_smarty_tpl->tpl_vars['object_id']->value;?>
-form input, #<?php echo $_smarty_tpl->tpl_vars['html_id']->value;
echo $_smarty_tpl->tpl_vars['object_id']->value;?>
-form select").on({
						change : function(e) {
							e.preventDefault();
							var theHREF = $("#<?php echo $_smarty_tpl->tpl_vars['html_id']->value;
echo $_smarty_tpl->tpl_vars['object_id']->value;?>
-form").attr("save");
							var post_data = $("#<?php echo $_smarty_tpl->tpl_vars['html_id']->value;
echo $_smarty_tpl->tpl_vars['object_id']->value;?>
-form").serialize();
							ajax_postasync(theHREF, post_data);
						}
					});

				<?php }?>
			<?php }?>
			
		}
	);
<?php echo '</script'; ?>
>

<?php $_smarty_tpl->_assignInScope('input_size', 12-$_smarty_tpl->tpl_vars['label_size']->value);
if ($_smarty_tpl->tpl_vars['titleflag']->value) {?>
	<header class="page-header">
		<?php if ($_smarty_tpl->tpl_vars['display']->value == 'edit') {?>
			<?php if ($_smarty_tpl->tpl_vars['titlecode']->value != '') {?>
				<h1><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Title_crud_edit');?>
 <?php echo $_smarty_tpl->tpl_vars['titlecode']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['object_code']->value;?>
</h1>
			<?php } else { ?>
				<h1><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Title_crud_edit');?>
  <?php echo $_smarty_tpl->tpl_vars['object_code']->value;?>
</h1>
			<?php }?>
		<?php } else { ?>
			<?php if ($_smarty_tpl->tpl_vars['titlecode']->value != '') {?>
				<h1><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Title_crud_new');?>
 <?php echo $_smarty_tpl->tpl_vars['titlecode']->value;?>
</h1>
			<?php } else { ?>
				<h1><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Title_crud_new');?>
</h1>
			<?php }?>
		<?php }?>
	</header>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['display']->value == 'edit') {?>
	<?php if ($_smarty_tpl->tpl_vars['saveautoref']->value != '') {?>
		<form id="<?php echo $_smarty_tpl->tpl_vars['html_id']->value;
echo $_smarty_tpl->tpl_vars['object_id']->value;?>
-form" class="crud box-header" Method="POST" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Title_crud_edit');?>
  <?php echo $_smarty_tpl->tpl_vars['object_code']->value;?>
" box-id="<?php echo $_smarty_tpl->tpl_vars['html_id']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['object_id']->value;?>
" box-size="<?php echo $_smarty_tpl->tpl_vars['html_size']->value;?>
" save="<?php echo $_smarty_tpl->tpl_vars['saveautoref']->value;?>
" onsubmit="return false">
	<?php } else { ?>
		<form id="<?php echo $_smarty_tpl->tpl_vars['html_id']->value;
echo $_smarty_tpl->tpl_vars['object_id']->value;?>
-form" class="crud box-header" Method="POST" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Title_crud_edit');?>
  <?php echo $_smarty_tpl->tpl_vars['object_code']->value;?>
" box-id="<?php echo $_smarty_tpl->tpl_vars['html_id']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['object_id']->value;?>
" box-size="<?php echo $_smarty_tpl->tpl_vars['html_size']->value;?>
" onsubmit="return false">
	<?php }
} else { ?>
	<form id="<?php echo $_smarty_tpl->tpl_vars['html_id']->value;
echo $_smarty_tpl->tpl_vars['object_id']->value;?>
-form" class="crud box-header" Method="POST" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Title_crud_new');?>
" box-id="<?php echo $_smarty_tpl->tpl_vars['html_id']->value;?>
" box-size="<?php echo $_smarty_tpl->tpl_vars['html_size']->value;?>
" onsubmit="return false">
<?php }?>
		<div class="form-group row display-none">
			<?php if ($_smarty_tpl->tpl_vars['display']->value == 'edit') {?>
				<?php if ($_smarty_tpl->tpl_vars['idflag']->value) {?>
					<label for="<?php echo $_smarty_tpl->tpl_vars['html_id']->value;
echo $_smarty_tpl->tpl_vars['object_id']->value;?>
-id" class="col-4 form-label">"Id"
					</label>
					<div class="col-8">
						<input type="text" class="form-control input-mini" id="<?php echo $_smarty_tpl->tpl_vars['html_id']->value;
echo $_smarty_tpl->tpl_vars['object_id']->value;?>
-id" name="id" value="<?php echo $_smarty_tpl->tpl_vars['object_id']->value;?>
">
					</div>
				<?php }?>
			<?php }?>
		</div>
		<?php echo $_smarty_tpl->tpl_vars['display_html']->value;?>

		<div class="row form-group"> 
			<?php if ($_smarty_tpl->tpl_vars['label_size']->value > 0) {?>
				<div class="offset-sm-<?php echo $_smarty_tpl->tpl_vars['label_size']->value;?>
 col-sm-<?php echo $_smarty_tpl->tpl_vars['input_size']->value;?>
">
			<?php } else { ?>
				<div class=" col-sm-12">
			<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['btreturnflag']->value) {?>
					<button type="button" id="<?php echo $_smarty_tpl->tpl_vars['html_id']->value;
echo $_smarty_tpl->tpl_vars['object_id']->value;?>
-bt_close" class="btn btn-primary bt-close" data-loadingtext="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_loading');?>
">
						<span class="fa fa-close" width="16" height="16"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_close');?>

					</button>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['btresetflag']->value) {?>
					<button type="button" id="<?php echo $_smarty_tpl->tpl_vars['html_id']->value;
echo $_smarty_tpl->tpl_vars['object_id']->value;?>
-bt_reset" class="btn btn-primary bt-reset" data-loadingtext="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_loading');?>
" event="<?php echo $_smarty_tpl->tpl_vars['btresetref']->value;?>
">
						<span class="fa fa-refresh" width="16" height="16"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_reset');?>

					</button>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['btokflag']->value) {?>
					<button type="submit" id="<?php echo $_smarty_tpl->tpl_vars['html_id']->value;
echo $_smarty_tpl->tpl_vars['object_id']->value;?>
-bt_update" class="btn btn-primary bt-event" event="<?php echo $_smarty_tpl->tpl_vars['btokref']->value;?>
">
					<?php if ($_smarty_tpl->tpl_vars['display']->value == 'edit') {?>
						<span class="fa fa-check" width="16" height="16"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_update');?>

					<?php } else { ?>
						<span class="fa fa-check" width="16" height="16"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_create');?>

					<?php }?>
					</button>
				<?php }?>
			</div>
		</div>
	</form>

<?php
}
}
/* {/block 'Main'} */
}
