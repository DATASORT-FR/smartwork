<?php
/* Smarty version 4.1.1, created on 2022-12-26 23:54:19
  from 'E:\xampp\htdocs\smartwork\apps\job_free\templates\src\offersList.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63aa261bf12108_85819875',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4cb46dcfb34f791e869546999044baef4e258ba8' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\job_free\\templates\\src\\offersList.tpl',
      1 => 1646229570,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63aa261bf12108_85819875 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_178402557663aa261bee3d47_33735463', 'Main');
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "simple.tpl");
}
/* {block 'Main'} */
class Block_178402557663aa261bee3d47_33735463 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_178402557663aa261bee3d47_33735463',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php if ($_smarty_tpl->tpl_vars['ListText']->value != '') {?>
			<div class="row ">
				<div class="col-sm-12">
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
						</button>
						<?php echo $_smarty_tpl->tpl_vars['ListText']->value;?>

					</div>
				</div>		
			</div>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['ListPageCount']->value > 1) {?>
			<div class="row pagination-container">
				<ul class="pagination">
					<?php
$__section_idx_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['ListPagination']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_0_total = $__section_idx_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_0_total !== 0) {
for ($__section_idx_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_0_iteration <= $__section_idx_0_total; $__section_idx_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
						<?php if ($_smarty_tpl->tpl_vars['ListPagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['page'] == 0) {?>
							<li class="page-item">
								<a class="pagination-link page-link" event="<?php echo $_smarty_tpl->tpl_vars['ListPagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['href'];?>
" rel="nofollow">
									<span class="fa fa-angle-double-left" aria-hidden="true"></span>
								</a>
							</li>
						<?php } elseif ($_smarty_tpl->tpl_vars['ListPagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['page'] == -1) {?>
							<li class="page-item">
								<a class="pagination-link page-link" event="<?php echo $_smarty_tpl->tpl_vars['ListPagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['href'];?>
" rel="nofollow">
									<span class="fa fa-angle-double-right" aria-hidden="true"></span>
								</a>
							</li>
						<?php } elseif ($_smarty_tpl->tpl_vars['ListPagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['page'] > 0) {?>
							<?php if ($_smarty_tpl->tpl_vars['ListPagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['page'] == $_smarty_tpl->tpl_vars['ListPage']->value) {?>
								<li class="page-item active">
									<a class="page-link"><?php echo $_smarty_tpl->tpl_vars['ListPagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['page'];?>
</a>
								</li>
							<?php } else { ?>
								<li class="page-item">
									<a class="pagination-link page-link" event="<?php echo $_smarty_tpl->tpl_vars['ListPagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['href'];?>
" rel="nofollow"><?php echo $_smarty_tpl->tpl_vars['ListPagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['page'];?>
</a>
								</li>
							<?php }?>
						<?php }?>
					<?php
}
}
?>
				</ul>
			</div>
		<?php }?>
		<?php $_smarty_tpl->_assignInScope('line', 0);?>
		<?php
$__section_idx_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['ListMission']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_1_total = $__section_idx_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_1_total !== 0) {
for ($__section_idx_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_1_iteration <= $__section_idx_1_total; $__section_idx_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
			<div class="row mission_row">
				<?php if ($_smarty_tpl->tpl_vars['ListMission']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['status'] != '') {?>
					<article class="col-xs-12 offer expired" itemscope itemtype="http://schema.org/JobPosting">
				<?php } else { ?>
					<article class="col-xs-12 offer" itemscope itemtype="http://schema.org/JobPosting">
				<?php }?>
					<h2><a href="<?php echo $_smarty_tpl->tpl_vars['ListMission']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['href'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['ListMission']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['title_alt'];?>
" itemprop="title"><?php echo $_smarty_tpl->tpl_vars['ListMission']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['title'];?>
</a></h2>
					<div class="mission_header">
						<small itemprop="datePosted"><?php echo $_smarty_tpl->tpl_vars['ListMission']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['date_publication'];?>
</small>
						<?php if ($_smarty_tpl->tpl_vars['ListMission']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['status'] != '') {?>
							<small class="status"><?php echo $_smarty_tpl->tpl_vars['ListMission']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['status'];?>
</small>
						<?php }?>
						<small class="job-employment hidden" itemprop="employmentType">contract</small>
						<small class="score">
							<label class="display-star font-weight-bold"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_score');?>
</label>
							<ul class="list display-star">
								<?php if ($_smarty_tpl->tpl_vars['ListMission']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['score'] > 0) {?>
									<li class='light'>
								<?php } else { ?>
									<li class=''>
								<?php }?>
									<i class="fa fa-star" aria-hidden="true">
									</i>
								</li>
								<?php if ($_smarty_tpl->tpl_vars['ListMission']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['score'] > 1) {?>
									<li class='light'>
								<?php } else { ?>
									<li class=''>
								<?php }?>
									<i class="fa fa-star" aria-hidden="true">
									</i>
								</li>
								<?php if ($_smarty_tpl->tpl_vars['ListMission']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['score'] > 2) {?>
									<li class='light'>
								<?php } else { ?>
									<li class=''>
								<?php }?>
									<i class="fa fa-star" aria-hidden="true">
									</i>
								</li>
								<?php if ($_smarty_tpl->tpl_vars['ListMission']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['score'] > 3) {?>
									<li class='light'>
								<?php } else { ?>
									<li class=''>
								<?php }?>
									<i class="fa fa-star" aria-hidden="true">
									</i>
								</li>
								<?php if ($_smarty_tpl->tpl_vars['ListMission']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['score'] > 4) {?>
									<li class='light'>
								<?php } else { ?>
									<li class=''>
								<?php }?>
									<i class="fa fa-star" aria-hidden="true">
									</i>
								</li>
							</ul>
						</small>
					</div>
					<div class="mission_intro" itemprop="description">
						<?php echo $_smarty_tpl->tpl_vars['ListMission']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['intro'];?>

					</div>
					<div class="mission_bottom">
						<?php $_smarty_tpl->_assignInScope('MissionTags', $_smarty_tpl->tpl_vars['ListMission']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['list_tag']);?>
						<?php if (count($_smarty_tpl->tpl_vars['MissionTags']->value) > 0) {?>
							<p class="tag-list" itemprop="skills">
								<?php
$__section_idy_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['MissionTags']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idy_2_total = $__section_idy_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idy'] = new Smarty_Variable(array());
if ($__section_idy_2_total !== 0) {
for ($__section_idy_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] = 0; $__section_idy_2_iteration <= $__section_idy_2_total; $__section_idy_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']++){
?>
									<a class="tag-default tag-link" href="<?php echo $_smarty_tpl->tpl_vars['MissionTags']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['href'];?>
"><?php echo $_smarty_tpl->tpl_vars['MissionTags']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['tag'];?>
</a>
								<?php
}
}
?>
							</p>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['line']->value == 0) {?>
							<a class="read_more btn btn-outline-success" href="<?php echo $_smarty_tpl->tpl_vars['ListMission']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['href'];?>
"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_read_more');?>
</a>
							<?php $_smarty_tpl->_assignInScope('line', 1);?>
						<?php } elseif ($_smarty_tpl->tpl_vars['line']->value == 1) {?>
							<a class="read_more btn btn-outline-primary" href="<?php echo $_smarty_tpl->tpl_vars['ListMission']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['href'];?>
"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_read_more');?>
</a>
							<?php $_smarty_tpl->_assignInScope('line', 2);?>
						<?php } elseif ($_smarty_tpl->tpl_vars['line']->value == 2) {?>
							<a class="read_more btn btn-outline-danger" href="<?php echo $_smarty_tpl->tpl_vars['ListMission']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['href'];?>
"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_read_more');?>
</a>
							<?php $_smarty_tpl->_assignInScope('line', 0);?>
						<?php }?>
					</div>
				</article>
			</div>
			<hr>
		<?php
}
}
?>
		<?php if ($_smarty_tpl->tpl_vars['ListPageCount']->value > 1) {?>
			<div class="row pagination-container">
				<ul class="pagination">
					<?php
$__section_idx_3_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['ListPagination']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_3_total = $__section_idx_3_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_3_total !== 0) {
for ($__section_idx_3_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_3_iteration <= $__section_idx_3_total; $__section_idx_3_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
						<?php if ($_smarty_tpl->tpl_vars['ListPagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['page'] == 0) {?>
							<li class="page-item">
								<a class="pagination-link page-link" event="<?php echo $_smarty_tpl->tpl_vars['ListPagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['href'];?>
" rel="nofollow">
									<span class="fa fa-angle-double-left" aria-hidden="true"></span>
								</a>
							</li>
						<?php } elseif ($_smarty_tpl->tpl_vars['ListPagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['page'] == -1) {?>
							<li class="page-item">
								<a class="pagination-link page-link" event="<?php echo $_smarty_tpl->tpl_vars['ListPagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['href'];?>
" rel="nofollow">
									<span class="fa fa-angle-double-right" aria-hidden="true"></span>
								</a>
							</li>
						<?php } elseif ($_smarty_tpl->tpl_vars['ListPagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['page'] > 0) {?>
							<?php if ($_smarty_tpl->tpl_vars['ListPagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['page'] == $_smarty_tpl->tpl_vars['ListPage']->value) {?>
								<li class="page-item active">
									<a class="page-link"><?php echo $_smarty_tpl->tpl_vars['ListPagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['page'];?>
</a>
								</li>
							<?php } else { ?>
								<li class="page-item">
									<a class="pagination-link page-link" event="<?php echo $_smarty_tpl->tpl_vars['ListPagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['href'];?>
" rel="nofollow"><?php echo $_smarty_tpl->tpl_vars['ListPagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['page'];?>
</a>
								</li>
							<?php }?>
						<?php }?>
					<?php
}
}
?>
				</ul>
			</div>
		<?php }?>

<?php
}
}
/* {/block 'Main'} */
}
