<?php
/* Smarty version 4.1.1, created on 2022-10-11 09:54:52
  from 'E:\xampp\htdocs\smartwork\modules\mediamanager\templates\src\mediamanager.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6345214c0453e3_12606426',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '24fb7c7b04287ba00cb8ecf9e90ab06411e46e2c' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\modules\\mediamanager\\templates\\src\\mediamanager.tpl',
      1 => 1646225685,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6345214c0453e3_12606426 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>
	$(document).ready(
		function() {
			init_mediamanager();
		}
	);
<?php echo '</script'; ?>
>

<form id="mediamanager" class="box-header container crud mediamanager" box-size="500" listref="<?php echo $_smarty_tpl->tpl_vars['fileListRef']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Title_mediamanager_box');?>
" fade box-id="mediamanager_box">
	<div class="row mediamanager_path">
		<label for="mediamanager_path" class="col-lg-2 col-sm-3 form-label text-sm-end"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mediamanager_path');?>
</label>
		<div class="col-lg-10 col-sm-9">
			<div class="input-group">
				<input class="form-control" id="mediamanager_path" name="path" size="40" maxlength="100" default="<?php echo $_smarty_tpl->tpl_vars['path']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['path']->value;?>
" type="text">
				<button id="mediamanager_button_reset" type="button" class="btn btn-primary bt-media-reset" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mediamanager_reset');?>
">
					<span class="fa fa-undo"></span>
				</button>
				<?php if ($_smarty_tpl->tpl_vars['btRead']->value) {?>
					<button id="mediamanager_button_parent" type="button" class="btn btn-primary bt-media-parent" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mediamanager_parent');?>
">
						<span class="fa "> ..</span>
					</button>
				<?php }?>
			</div>
		</div>
	</div>
	<div class="row mediamanager_filename">
		<label for="mediamanager_filename" class="col-lg-2 col-sm-3 form-label text-sm-end"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mediamanager_filename');?>
</label>
		<div class="col-lg-10 col-sm-9">
			<input class="form-control " id="mediamanager_filename" name="filename" maxlength="30" size="60" default="<?php echo $_smarty_tpl->tpl_vars['fileName']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['fileName']->value;?>
" type="text">
			<div class="container_img_preview form-control">
				<img class="img_preview" id="mediamanager_preview" title="<?php echo $_smarty_tpl->tpl_vars['fileName']->value;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['fileName']->value;?>
" src="<?php echo $_smarty_tpl->tpl_vars['fileName']->value;?>
" onerror="this.src = './plugins/image/images/notfound.png';">
			</div>
		</div>
	</div>
	<div class="row mediamanager_bt">
		<div class="col-lg-12">
			<?php if ($_smarty_tpl->tpl_vars['btNewDir']->value) {?>
				<button type="button" id="mediamanager_button_newdir" class="btn btn-primary bt-media-newdir mr-2" event="<?php echo $_smarty_tpl->tpl_vars['newDirRef']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mediamanager_newdir');?>
">
					<span class="fa fa-folder"></span> <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_media_newdir');?>

				</button>
			<?php }?>
			
			<?php if ($_smarty_tpl->tpl_vars['btUpload']->value) {?>
				<button type="button" id="mediamanager_button_upload" class="btn btn-primary bt-media-upload mr-2" event="<?php echo $_smarty_tpl->tpl_vars['uploadRef']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mediamanager_upload');?>
">
					<span class="fa fa-upload"></span> <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_media_upload');?>

				</button>
			<?php }?>
			
			<?php if ($_smarty_tpl->tpl_vars['btRename']->value) {?>
				<button type="button" id="mediamanager_button_rename" class="btn btn-primary bt-media-rename mr-2" event="<?php echo $_smarty_tpl->tpl_vars['renameRef']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mediamanager_rename');?>
">
					<span class="fa fa-edit"></span> <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_media_rename');?>

				</button>
			<?php }?>
		</div>
	</div>
	<div class="row mediamanager_list">
		<div id="mediamanager_list" class="block-ws content-update block-main" box-id="content" box-model="box-model" link_href="">
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<button type="button" id="mediamanager_button_close" class="btn btn-primary bt-media-close mr-2" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mediamanager_close');?>
">
				<span class="fa fa-chevron-left"></span> <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_media_close');?>

			</button>
			<button type="submit" id="mediamanager_button_select" class="btn btn-primary bt-media-select mr-2" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_mediamanager_select');?>
">
				<span class="fa fa-check"></span> <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_media_select');?>

			</button>
		</div>
	</div>
</form>
<?php }
}
