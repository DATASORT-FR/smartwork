<?php
/* Smarty version 4.1.1, created on 2022-12-09 11:14:47
  from 'E:\xampp\htdocs\smartwork\apps\forum\modules\forum\templates\src\listlasttopic.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63930a970864d5_68497355',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6c08c6ad91edf883f4171babb6c15d58691a88a2' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\forum\\modules\\forum\\templates\\src\\listlasttopic.tpl',
      1 => 1644969977,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63930a970864d5_68497355 (Smarty_Internal_Template $_smarty_tpl) {
?><table class="forum-list forum-list-topic table table-borderless table-striped table-hover text-left">
	<tbody>
	<?php
$__section_idx_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['listTopic']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_0_total = $__section_idx_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_0_total !== 0) {
for ($__section_idx_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_0_iteration <= $__section_idx_0_total; $__section_idx_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
		<tr class="forum-topic">
			<td class="forum-topic" scope="row" date-label="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_forum_subject');?>
" width="60%">
				<a href="<?php echo $_smarty_tpl->tpl_vars['listTopic']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['href'];?>
">
					</div>
					<div class="forum-resume">
						<div class="forum-topic-label">
							<h3><?php echo $_smarty_tpl->tpl_vars['listTopic']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['label'];?>
</h3>
						</div>
						<?php if ($_smarty_tpl->tpl_vars['flagAdmin']->value) {?>
							<div class="forum-topic-status"><?php echo $_smarty_tpl->tpl_vars['listTopic']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['status'];?>
</div>
						<?php }?>
						<div class="forum-topic-author">Par <?php echo $_smarty_tpl->tpl_vars['listTopic']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['author'];?>
<span class="forum-topic-author2"> » <?php echo $_smarty_tpl->tpl_vars['listTopic']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['date_creation_time'];?>
</span></div>
					</div>
				</a>
			</td>
			<td class="forum-topic-post" width="40%">
				<a href="<?php echo $_smarty_tpl->tpl_vars['listTopic']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['href'];?>
">
					<div class="forum-resume forum-topic-nb">
						<figure class="post-image">
							<?php if ($_smarty_tpl->tpl_vars['listTopic']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['read']) {?>
								<img src="./images/separation/forum/bulle-filet-gris.svg" alt="" title="">
							<?php } else { ?>
								<img src="./images/separation/forum/bulle-filet-bleu.svg" alt="" title="">
							<?php }?>
						</figure>
							<?php if ($_smarty_tpl->tpl_vars['listTopic']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['read']) {?>
								<div class="forum-topic-nb-text read">
							<?php } else { ?>
								<div class="forum-topic-nb-text no-read">
							<?php }?>
								<p class="forum-topic-post-nb"><?php echo $_smarty_tpl->tpl_vars['listTopic']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['nb_post'];?>
</p>
								<p class="forum-topic-post-message"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_forum_nbpost');?>
</p>
						</div>
					</div>
					<div class="forum-resume">
						<?php if ($_smarty_tpl->tpl_vars['listTopic']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['author_last_post'] != '') {?>
							<div class="forum-topic-lastpost">Par <?php echo $_smarty_tpl->tpl_vars['listTopic']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['author_last_post'];?>
</div>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['listTopic']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['date_last_post_time'] != '') {?>
							<div class="forum-topic-lastpost"><?php echo $_smarty_tpl->tpl_vars['listTopic']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['date_last_post_time'];?>
</div>
						<?php }?>
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
