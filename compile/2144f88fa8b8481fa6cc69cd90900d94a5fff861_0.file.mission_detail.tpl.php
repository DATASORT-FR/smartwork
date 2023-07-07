<?php
/* Smarty version 4.1.1, created on 2022-12-22 00:28:39
  from 'E:\xampp\htdocs\smartwork\apps\job_free\templates\src\mission_detail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63a396a7b73826_39583375',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2144f88fa8b8481fa6cc69cd90900d94a5fff861' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\job_free\\templates\\src\\mission_detail.tpl',
      1 => 1646066702,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63a396a7b73826_39583375 (Smarty_Internal_Template $_smarty_tpl) {
?>		<div class="col-md-12 block-header">
			<h1 itemprop="title"><?php echo $_smarty_tpl->tpl_vars['Mission']->value['title'];?>
</h1>
		</div>
		<div class="col-md-12 content_btn">
			<div class="col-sm-6 text-left">
				<small itemprop="datePosted"><?php echo $_smarty_tpl->tpl_vars['Mission']->value['date_publication'];?>
</small>
				<?php if ($_smarty_tpl->tpl_vars['Mission']->value['status'] != '') {?>
					<small class="status"><?php echo $_smarty_tpl->tpl_vars['Mission']->value['status'];?>
</small>
				<?php }?>
			</div>
			<?php if ($_smarty_tpl->tpl_vars['pageRightUpdate']->value == 1) {?>
				<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="Chargement..." event="<?php echo $_smarty_tpl->tpl_vars['AdminLink']->value;?>
">
					<span class="fa fa-edit" width="16" height="16"></span>
					<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_Content_edit');?>

				</button>
			<?php }?>
			<a class="btn btn-primary" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_list_return_page_title');?>
" href="<?php echo $_smarty_tpl->tpl_vars['ListLink']->value;?>
">
				<span class="fa fa-arrow-left"></span>
				<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_list_return_page');?>

			</a>
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-header p-b-0">
					<h2 class="card-title">
						<i class="fa fa-eye" aria-hidden="true"></i> 
						<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_resume');?>

					</h2>
				</div>
				<div class="card-body">
					<?php if ($_smarty_tpl->tpl_vars['pageRightUpdate']->value == 1) {?>
						<div class="form-group">
							<label class="font-weight-bold"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_reference');?>
</label>
							<span class="job-reference"><?php echo $_smarty_tpl->tpl_vars['Mission']->value['reference'];?>
</span>
						</div>
					<?php }?>
						
					<div class="form-group">
						<label class="font-weight-bold"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_job_name');?>
</label>
						<span class="job-name" itemprop="name"><?php echo $_smarty_tpl->tpl_vars['Mission']->value['job_name'];?>
</span>
					</div>
					
					<div class="form-group">
						<label class="font-weight-bold"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_job_object');?>
</label>
						<span class="job-object"><?php echo $_smarty_tpl->tpl_vars['Mission']->value['job_object'];?>
</span>
					</div>
					
					<div class="form-group">
						<label class="display-star font-weight-bold"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_score');?>
</label>
						<ul class='display-star'>
							<?php if ($_smarty_tpl->tpl_vars['Mission']->value['score'] > 0) {?>
								<li class='light'>
							<?php } else { ?>
								<li class=''>
							<?php }?>
								<i class="fa fa-star" aria-hidden="true">
								</i>
							</li>
							<?php if ($_smarty_tpl->tpl_vars['Mission']->value['score'] > 1) {?>
								<li class='light'>
							<?php } else { ?>
								<li class=''>
							<?php }?>
								<i class="fa fa-star" aria-hidden="true">
								</i>
							</li>
							<?php if ($_smarty_tpl->tpl_vars['Mission']->value['score'] > 2) {?>
								<li class='light'>
							<?php } else { ?>
								<li class=''>
							<?php }?>
								<i class="fa fa-star" aria-hidden="true">
								</i>
							</li>
							<?php if ($_smarty_tpl->tpl_vars['Mission']->value['score'] > 3) {?>
								<li class='light'>
							<?php } else { ?>
								<li class=''>
							<?php }?>
								<i class="fa fa-star" aria-hidden="true">
								</i>
							</li>
							<?php if ($_smarty_tpl->tpl_vars['Mission']->value['score'] > 4) {?>
								<li class='light'>
							<?php } else { ?>
								<li class=''>
							<?php }?>
								<i class="fa fa-star" aria-hidden="true">
								</i>
							</li>
						</ul>
					</div>
					
					<div class="form-group">
						<label class="font-weight-bold"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_job_branch');?>
</label>
						<span class="job-branch" itemprop="industry"><?php echo $_smarty_tpl->tpl_vars['Mission']->value['job_branch'];?>
</span>
					</div>
					
					<div class="form-group last-group">
						<label class="font-weight-bold"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_job_type');?>
</label>
						<span class="job-employment hidden" itemprop="employmentType">contract</span>
						<span class="job-type"><?php echo $_smarty_tpl->tpl_vars['Mission']->value['job_type'];?>
 <?php echo $_smarty_tpl->tpl_vars['Mission']->value['job_style'];?>
</span>
					</div>
					
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-header p-b-0">
					<h2 class="card-title">
						<i class="fa fa-info" aria-hidden="true"></i> 
						<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_info');?>

					</h2>
				</div>
				<div class="card-block">
					<?php if ($_smarty_tpl->tpl_vars['pageRightUpdate']->value == 1) {?>
						<div class="form-group">
							<label class="font-weight-bold"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_status');?>
</label>
							<span class="job-status" itemprop="datePosted"><?php echo $_smarty_tpl->tpl_vars['Mission']->value['statusName'];?>
</span>
						</div>
					<?php }?>
						
					<div class="form-group">
						<label class="font-weight-bold"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_location');?>
</label>
						<span class="job-location" itemprop="jobLocation"><?php echo $_smarty_tpl->tpl_vars['Mission']->value['location'];?>
</span>
						<span class="job-location_address hidden" itemprop="jobLocation.address""><?php echo $_smarty_tpl->tpl_vars['Mission']->value['location'];?>
</span>
					</div>
					
					<div class="form-group">
						<label class="font-weight-bold"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_duration');?>
</label>
						<span class="job-duration"><?php echo $_smarty_tpl->tpl_vars['Mission']->value['duration'];?>
</span>
					</div>
					
					<div class="form-group">
						<label class="font-weight-bold"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_start');?>
</label>
						<span class="job-start"><?php echo $_smarty_tpl->tpl_vars['Mission']->value['start'];?>
</span>
					</div>
					
					<div class="form-group">
						<label class="font-weight-bold"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_rate');?>
</label>
						<span class="job-rate" itemprop="baseSalary"><?php echo $_smarty_tpl->tpl_vars['Mission']->value['rate'];?>
</span>
					</div>
					
					<div class="form-group empty-group last-group">
					</div>
					
				</div>
			</div>
		</div>				
		<div class="col-md-12 block-content">
			<?php echo $_smarty_tpl->tpl_vars['socialShare']->value;?>

			<div class="mission_description" itemprop="description">
				<?php echo $_smarty_tpl->tpl_vars['Mission']->value['description'];?>

			</div>
			<div class="mission_bottom">
				<p class="tag-list" itemprop="skills">
					<?php if (count($_smarty_tpl->tpl_vars['Tags']->value) > 0) {?>
						<?php
$__section_idy_4_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['Tags']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idy_4_total = $__section_idy_4_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idy'] = new Smarty_Variable(array());
if ($__section_idy_4_total !== 0) {
for ($__section_idy_4_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] = 0; $__section_idy_4_iteration <= $__section_idy_4_total; $__section_idy_4_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']++){
?>
							<a class="tag-default tag-link" href="<?php echo $_smarty_tpl->tpl_vars['Tags']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['href'];?>
"><?php echo $_smarty_tpl->tpl_vars['Tags']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['tag'];?>
</a>
						<?php
}
}
?>
					<?php }?>
				</p>
				<p class="return">
					<?php if ($_smarty_tpl->tpl_vars['pageRightUpdate']->value == 1) {?>
						<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="Chargement..." event="<?php echo $_smarty_tpl->tpl_vars['AdminLink']->value;?>
">
							<span class="fa fa-edit" width="16" height="16"></span>
							<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_Content_edit');?>

						</button>
					<?php }?>
					<a class="btn btn-primary" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_list_return_page_title');?>
" href="<?php echo $_smarty_tpl->tpl_vars['ListLink']->value;?>
">
						<span class="fa fa-arrow-left"></span>
						<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_list_return_page');?>

					</a>
				</p>
			</div>
		</div>

		<?php if ($_smarty_tpl->tpl_vars['Mission']->value['original'] == 1) {?>
			<div class="col-md-12 block-footer">
				<div class="card">
					<div class="card-header p-b-0">
						<h2 class="card-title">
							<i class="fa fa-info" aria-hidden="true"></i> 
							<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_contact');?>

						</h2>
					</div>
					<div class="card-block">
						<div class="row">
							<?php if (!empty($_smarty_tpl->tpl_vars['Mission']->value['company'])) {?>
								<div class="form-group col-md-4">
									<label class="font-weight-bold"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_company_name');?>
</label>
									<span class="company-name" itemprop="hiringOrganization"><?php echo $_smarty_tpl->tpl_vars['Mission']->value['company'];?>
</span>
								</div>
							<?php }?>

							<?php if (!empty($_smarty_tpl->tpl_vars['Mission']->value['company_reference'])) {?>
								<div class="form-group col-md-4">
									<label class="font-weight-bold"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_company_reference');?>
</label>
									<span class="company-reference" itemprop="name"><?php echo $_smarty_tpl->tpl_vars['Mission']->value['company_reference'];?>
</span>
								</div>
							<?php }?>
						</div>
						
						<div class="row">
							<?php if (!empty($_smarty_tpl->tpl_vars['Mission']->value['contact'])) {?>
								<div class="form-group col-md-4">
									<label class="font-weight-bold"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_contact_name');?>
</label>
									<span class="contact-name"><?php echo $_smarty_tpl->tpl_vars['Mission']->value['contact'];?>
</span>
								</div>
							<?php }?>
					
							<?php if (!empty($_smarty_tpl->tpl_vars['Mission']->value['contact_mail'])) {?>
								<div class="form-group col-md-4">
									<label class="font-weight-bold"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_contact_mail');?>
</label>
									<span class="contact-mail"><?php echo $_smarty_tpl->tpl_vars['Mission']->value['contact_mail'];?>
</span>
								</div>
							<?php }?>
					
							<?php if (!empty($_smarty_tpl->tpl_vars['Mission']->value['contact_phone'])) {?>
								<div class="form-group col-md-4">
									<label class="font-weight-bold"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_contact_phone');?>
</label>
									<span class="contact-phone"><?php echo $_smarty_tpl->tpl_vars['Mission']->value['contact_phone'];?>
</span>
								</div>
							<?php }?>
						</div>
						
						<div class="col-md-12 text-right">
							<small>
								<a href="<?php echo $_smarty_tpl->tpl_vars['Mission']->value['page'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['Mission']->value['site'];?>
</a>
							</small>
						</div>
					</div>
				</div>
			</div>
		<?php }?>
		
		<?php if (!empty($_smarty_tpl->tpl_vars['Links']->value) && $_smarty_tpl->tpl_vars['Mission']->value['original'] != 1) {?>
			<div class="col-md-12 block-footer">
				<h2><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_links');?>
</h2>
			</div>
			<div class="col-md-12 block-footer">
				<div class="table-responsive">
					<table class="site-link table table-striped">
						<thead>
							<tr>
								<th class="site-header"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_links_site');?>
</th>
								<th class="title-header"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_links_title');?>
</th>
								<th class="status-header hidden-sm-down"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_links_status');?>
</th>
								<th class="score-header hidden-xs-down"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_links_score');?>
</th>
								<th class="rate-header hidden-sm-down"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mission_links_rate');?>
</th>
							</tr>
						</thead>
						<tbody>
							<?php
$__section_idx_5_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['Links']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_5_total = $__section_idx_5_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_5_total !== 0) {
for ($__section_idx_5_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_5_iteration <= $__section_idx_5_total; $__section_idx_5_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
								<tr>
									<th class="site-cell"><?php echo $_smarty_tpl->tpl_vars['Links']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['site'];?>
</th>
									<td class="title-cell">
										<a href="<?php echo $_smarty_tpl->tpl_vars['Links']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['url'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['Links']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['title'];?>
</a>
									</td>
									<td class="status-cell hidden-sm-down"><?php echo $_smarty_tpl->tpl_vars['Links']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['status'];?>
</td>
									<td class="score-cell hidden-xs-down">
										<ul class="display-star hidden-sm-down">
											<?php if ($_smarty_tpl->tpl_vars['Links']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['score'] > 0) {?>
												<li class='light'>
											<?php } else { ?>
												<li class=''>
											<?php }?>
												<i class="fa fa-star" aria-hidden="true">
												</i>
											</li>
											<?php if ($_smarty_tpl->tpl_vars['Links']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['score'] > 1) {?>
												<li class='light'>
											<?php } else { ?>
												<li class=''>
											<?php }?>
												<i class="fa fa-star" aria-hidden="true">
												</i>
											</li>
											<?php if ($_smarty_tpl->tpl_vars['Links']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['score'] > 2) {?>
												<li class='light'>
											<?php } else { ?>
												<li class=''>
											<?php }?>
												<i class="fa fa-star" aria-hidden="true">
												</i>
											</li>
											<?php if ($_smarty_tpl->tpl_vars['Links']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['score'] > 3) {?>
												<li class='light'>
											<?php } else { ?>
												<li class=''>
											<?php }?>
												<i class="fa fa-star" aria-hidden="true">
												</i>
											</li>
											<?php if ($_smarty_tpl->tpl_vars['Links']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['score'] > 4) {?>
												<li class='light'>
											<?php } else { ?>
												<li class=''>
											<?php }?>
												<i class="fa fa-star" aria-hidden="true">
												</i>
											</li>
										</ul>
										<div class="hidden-md-up"><?php echo $_smarty_tpl->tpl_vars['Links']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['score'];?>
/5</div>
									</td>
									<td class="rate-cell hidden-sm-down"><?php echo $_smarty_tpl->tpl_vars['Links']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['rate'];?>
</td>
								</tr>
							<?php
}
}
?>
						</tbody >
					</table>
				</div>
			</div>
		<?php }?>

     
<?php }
}
