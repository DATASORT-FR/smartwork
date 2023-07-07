<?php
/* Smarty version 4.1.1, created on 2022-12-09 11:14:47
  from 'E:\xampp\htdocs\smartwork\apps\forum\modules\forum\templates\src\listsubject.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63930a9713a4a0_38983055',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b3df5434d9a5f0a80cd54a64a408ae51315026fd' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\forum\\modules\\forum\\templates\\src\\listsubject.tpl',
      1 => 1644661125,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63930a9713a4a0_38983055 (Smarty_Internal_Template $_smarty_tpl) {
?><h3 class="subject-header">
	Les thèmes du forum
</h3>
<?php if ((($tmp = $_smarty_tpl->tpl_vars['btCreate']->value ?? null)===null||$tmp==='' ? false ?? null : $tmp)) {?>
	<div class="forum-btn">
		<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_loading');?>
" event="<?php echo $_smarty_tpl->tpl_vars['subject_linkCreate']->value;?>
">
			<span class="fa fa-edit" width="16" height="16"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_forum_subject_create');?>

		</button>
	</div>
<?php }?>
<table class="forum-list forum-list-subject table table-borderless table-striped table-hover text-left">
	<tbody>
	<?php
$__section_idx_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['listSubject']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_1_total = $__section_idx_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_1_total !== 0) {
for ($__section_idx_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_1_iteration <= $__section_idx_1_total; $__section_idx_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
		<tr class="forum-subject">
			<td class="forum-subject" width="80%">
				<a href="<?php echo $_smarty_tpl->tpl_vars['listSubject']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['href'];?>
">
					<div class="forum-resume">
						<div class="forum-subject-name">
							<h3><?php echo $_smarty_tpl->tpl_vars['listSubject']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['name'];?>
</h3>
							<?php if ($_smarty_tpl->tpl_vars['flagAdmin']->value) {?>
								<div class="forum-subject-status"><?php echo $_smarty_tpl->tpl_vars['listSubject']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['status'];?>
</div>
							<?php }?>
						</div>
						<div class="forum-subject-label"><?php echo $_smarty_tpl->tpl_vars['listSubject']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['label'];?>
</div>
					</div>
				</a>
			</td>
			<td class="forum-subject-topic" width="20%">
				<a href="<?php echo $_smarty_tpl->tpl_vars['listSubject']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['href'];?>
">
					<div class="forum-resume">
						<figure class="topic-image">
							<img src="./images/separation/forum/bulles-filet-bleu.svg" alt="" title="">
						</figure>
						<p class="forum-subject-topic-nb"><?php echo $_smarty_tpl->tpl_vars['listSubject']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['nb_topic'];?>
</p>
						<p class="forum-subject-topic-message"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_forum_nbtopic');?>
</p>
					</div>
				</a>
			</td>
		</tr>
	<?php
}
}
?>
	</tbody>
</table>
<?php }
}
