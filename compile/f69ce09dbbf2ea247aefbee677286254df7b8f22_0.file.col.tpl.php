<?php
/* Smarty version 4.1.1, created on 2022-10-03 17:20:01
  from 'E:\xampp\htdocs\smartwork\modules\crud\templates\src\col.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_633afda11fbb22_44287219',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f69ce09dbbf2ea247aefbee677286254df7b8f22' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\modules\\crud\\templates\\src\\col.tpl',
      1 => 1646213761,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_633afda11fbb22_44287219 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_565737275633afda0f13412_54924612', 'Main');
?>

<?php }
/* {block 'Main'} */
class Block_565737275633afda0f13412_54924612 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_565737275633afda0f13412_54924612',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php if ($_smarty_tpl->tpl_vars['mode']->value) {?>
		<?php if ($_smarty_tpl->tpl_vars['field']->value['colflag']) {?>
			<?php if ($_smarty_tpl->tpl_vars['required']->value) {?> 
				<?php $_smarty_tpl->_assignInScope('labelTxt', ($_smarty_tpl->tpl_vars['field']->value['label']).('*'));?>
			<?php } else { ?>
				<?php $_smarty_tpl->_assignInScope('labelTxt', $_smarty_tpl->tpl_vars['field']->value['label']);?>
			<?php }?>
			<?php $_smarty_tpl->_assignInScope('colSize', 12/$_smarty_tpl->tpl_vars['colNb']->value);?>
			<?php if ($_smarty_tpl->tpl_vars['col_fieldSize']->value > 0) {?>
				<?php $_smarty_tpl->_assignInScope('colSize', $_smarty_tpl->tpl_vars['col_fieldSize']->value);?>
			<?php }?>
			
			<?php if ($_smarty_tpl->tpl_vars['field']->value['labelflag']) {?>
				<?php $_smarty_tpl->_assignInScope('labelSizeLg', $_smarty_tpl->tpl_vars['label_size']->value);?>
			<?php } else { ?>
				<?php $_smarty_tpl->_assignInScope('labelSizeLg', 0);?>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['field']->value['name'] == 'clear') {?> 
				<?php $_smarty_tpl->_assignInScope('labelSizeLg', $_smarty_tpl->tpl_vars['colSize']->value);?>
				<?php $_smarty_tpl->_assignInScope('label_txt', '');?>
			<?php }?>			
			<?php $_smarty_tpl->_assignInScope('inputSizeLg', $_smarty_tpl->tpl_vars['colSize']->value-$_smarty_tpl->tpl_vars['labelSizeLg']->value);?>
			
			<?php if ($_smarty_tpl->tpl_vars['labelTxt']->value == '') {?>
				<?php $_smarty_tpl->_assignInScope('labelSizeMd', 0);?>
			<?php } else { ?>
				<?php $_smarty_tpl->_assignInScope('labelSizeMd', $_smarty_tpl->tpl_vars['labelSizeLg']->value);?>
			<?php }?>
			<?php $_smarty_tpl->_assignInScope('inputSizeMd', $_smarty_tpl->tpl_vars['colSize']->value-$_smarty_tpl->tpl_vars['labelSizeMd']->value);?>
			
			<?php if ($_smarty_tpl->tpl_vars['labelTxt']->value == '') {?>
				<?php $_smarty_tpl->_assignInScope('labelSizeSm', 0);?>
			<?php } else { ?>
				<?php $_smarty_tpl->_assignInScope('labelSizeSm', sprintf("%d",(1.5*$_smarty_tpl->tpl_vars['labelSizeMd']->value)));?>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['colNb']->value == 1) {?>
				<?php $_smarty_tpl->_assignInScope('inputSizeSm', 12-$_smarty_tpl->tpl_vars['labelSizeSm']->value);?>
			<?php } else { ?>
				<?php $_smarty_tpl->_assignInScope('inputSizeSm', 6-$_smarty_tpl->tpl_vars['labelSizeSm']->value);?>
			<?php }?>
			<?php $_smarty_tpl->_assignInScope('labelSizeSm', 12);?>
			<?php $_smarty_tpl->_assignInScope('inputSizeSm', 12);?>
			<?php if ($_smarty_tpl->tpl_vars['col']->value == 3) {?>
				<div class="clearfix hidden-xs-down hidden-md-up">
				</div>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['labelSizeLg']->value != 0) {?>
				<?php if ($_smarty_tpl->tpl_vars['field']->value['collabelflag'] && $_smarty_tpl->tpl_vars['field']->value['collabel'] != '') {?>
					<div class="col-sm-<?php echo $_smarty_tpl->tpl_vars['labelSizeSm']->value;?>
 col-md-<?php echo $_smarty_tpl->tpl_vars['labelSizeMd']->value;?>
 col-lg-<?php echo $_smarty_tpl->tpl_vars['labelSizeLg']->value;?>
 text-md-end align-self-end">
				<?php } else { ?>
					<div class="col-sm-<?php echo $_smarty_tpl->tpl_vars['labelSizeSm']->value;?>
 col-md-<?php echo $_smarty_tpl->tpl_vars['labelSizeMd']->value;?>
 col-lg-<?php echo $_smarty_tpl->tpl_vars['labelSizeLg']->value;?>
 text-md-end">
				<?php }?>
					<label for="<?php echo $_smarty_tpl->tpl_vars['field']->value['field_id'];?>
" class="form-label <?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['field']->value['class'];?>
"><?php echo $_smarty_tpl->tpl_vars['labelTxt']->value;?>
</label>					
				</div>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['inputSizeLg']->value != 0) {?>
				<div class="col-sm-<?php echo $_smarty_tpl->tpl_vars['inputSizeSm']->value;?>
 col-md-<?php echo $_smarty_tpl->tpl_vars['inputSizeMd']->value;?>
 col-lg-<?php echo $_smarty_tpl->tpl_vars['inputSizeLg']->value;?>
">
					<?php echo $_smarty_tpl->tpl_vars['display_html']->value;?>

					<?php echo $_smarty_tpl->tpl_vars['append_html']->value;?>

				</div>
			<?php }?>
		<?php } else { ?>
			<?php echo $_smarty_tpl->tpl_vars['display_html']->value;?>

			<?php echo $_smarty_tpl->tpl_vars['append_html']->value;?>

		<?php }?>
	<?php }?>

<?php
}
}
/* {/block 'Main'} */
}
