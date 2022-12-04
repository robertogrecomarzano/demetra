<?php
/* Smarty version 4.2.1, created on 2022-11-29 15:03:36
  from 'D:\wamp\www\square-app\core\templates\tpl\error.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63861138a7f8c8_31220425',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '39de6941f1379be3493b8e372270762a6775d0cc' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\core\\templates\\tpl\\error.tpl',
      1 => 1669730615,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63861138a7f8c8_31220425 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\wamp\\www\\square-app\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<!DOCTYPE html>
<html lang="<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
" direction=<?php echo $_smarty_tpl->tpl_vars['direction']->value;?>
>
<head><?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['siteRoot']->value)."/core/templates/head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</head>
<body>
	<!-- Layout wrapper-->
	<div id="layoutError">
		<!-- Layout content-->
		<div id="layoutError_content">
			<!-- Main page content-->
			<main>
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-6">
							<!-- Error message content-->
							<div class="text-center my-5 mt-sm-10">
								<img class="img-fluid mb-4"
									src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/img/illustrations/error-404.svg"
									alt="404 <?php echo $_smarty_tpl->tpl_vars['title']->value;?>
"
									style="max-width: 30rem" />
								<p class="lead"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"La risorsa cercata non è presente"),$_smarty_tpl ) );?>
</p>
								<a class="btn btn-primary" href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
"> <i
									class="material-icons leading-icon">arrow_back</i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"ritorna alla home"),$_smarty_tpl ) );?>

								</a>
							</div>
						</div>
					</div>
				</div>
			</main>
		</div>
		<!-- Layout footer-->
		<div id="layoutError_footer">
			<!-- Footer-->
			<!-- Min-height is set inline to match the height of the drawer footer-->
			<footer class="p-4">
				<div
					class="d-flex flex-column flex-sm-row align-items-center justify-content-between small">
					<div class="me-sm-3 mb-2 mb-sm-0">
						<div class="fw-500 text-white">Copyright &copy; <?php echo $_smarty_tpl->tpl_vars['title']->value;?>
 <?php echo smarty_modifier_date_format(time(),"%Y");?>
</div>
					</div>
					<div class="ms-sm-3">
						<a class="fw-500 text-decoration-none link-white" href="#!"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Privacy"),$_smarty_tpl ) );?>
</a>
						<a class="fw-500 text-decoration-none link-white mx-4" href="#!"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Termini"),$_smarty_tpl ) );?>
</a>
						<a class="fw-500 text-decoration-none link-white" href="#!"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Aiuto"),$_smarty_tpl ) );?>
</a>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<!-- Load Bootstrap JS bundle-->
	<?php echo '<script'; ?>

		src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
		crossorigin="anonymous"><?php echo '</script'; ?>
>
	<!-- Load global scripts-->
	<?php echo '<script'; ?>
 type="module" src="js/material.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="js/scripts.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
