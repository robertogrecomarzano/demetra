<?php
/* Smarty version 4.2.1, created on 2022-12-05 14:49:12
  from 'D:\wamp\www\square-app\core\templates\main.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_638df6d85769f1_96842505',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '96ba60528d317ff17f02642052ec88a595667311' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\core\\templates\\main.tpl',
      1 => 1670248141,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_638df6d85769f1_96842505 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\wamp\\www\\square-app\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<!DOCTYPE html>
<html lang="<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
" direction=<?php echo $_smarty_tpl->tpl_vars['direction']->value;?>
>
<head>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['siteRoot']->value)."/core/templates/head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</head>
<body class="nav-fixed bg-light">
	<!-- Top app bar navigation menu-->
	<nav class="top-app-bar navbar navbar-expand navbar-dark bg-dark">
		<div class="container-fluid px-4">
			<!-- Drawer toggle button-->
			<button class="btn btn-lg btn-icon order-1 order-lg-0"
				id="drawerToggle" href="javascript:void(0);">
				<i class="material-icons">menu</i>
			</button>
			<!-- Navbar brand-->
			<a class="navbar-brand me-auto" href="index.html"><div
					class="text-uppercase font-monospace"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</div></a>
			<!-- Navbar items-->
			<div class="d-flex align-items-center mx-3 me-lg-0">
				<!-- Navbar-->
				<ul class="navbar-nav d-none d-lg-flex">
					<li class="nav-item"><a class="nav-link">Overview</a></li>
					<li class="nav-item"><a class="nav-link" target="_blank">Documentation</a></li>
				</ul>
				<!-- Navbar buttons-->
				<div class="d-flex">
					<!-- Messages dropdown-->
					<div class="dropdown dropdown-notifications d-none d-sm-block">
						<button class="btn btn-lg btn-icon dropdown-toggle me-3"
							id="dropdownMenuMessages" type="button" data-bs-toggle="dropdown"
							aria-expanded="false">
							<i class="material-icons">mail_outline</i>
						</button>
						<ul
							class="dropdown-menu dropdown-menu-end me-3 mt-3 py-0 overflow-hidden"
							aria-labelledby="dropdownMenuMessages">
							<li><h6 class="dropdown-header bg-primary text-white fw-500 py-3">Messages</h6></li>
							<li><hr class="dropdown-divider my-0" /></li>
							<li><a class="dropdown-item unread" href="#!">
									<div class="dropdown-item-content">
										<div class="dropdown-item-content-text">
											<div class="text-truncate d-inline-block"
												style="max-width: 18rem">Hi there, I had a question about
												something, is there any way you can help me out?</div>
										</div>
										<div class="dropdown-item-content-subtext">Mar 12, 2021
											&middot; Juan Babin</div>
									</div>
							</a></li>
							<li><hr class="dropdown-divider my-0" /></li>
							<li><a class="dropdown-item" href="#!">
									<div class="dropdown-item-content">
										<div class="dropdown-item-content-text">
											<div class="text-truncate d-inline-block"
												style="max-width: 18rem">Thanks for the assistance the other
												day, I wanted to follow up with you just to make sure
												everyting is settled.</div>
										</div>
										<div class="dropdown-item-content-subtext">Mar 10, 2021
											&middot; Christine Hendersen</div>
									</div>
							</a></li>
							<li><hr class="dropdown-divider my-0" /></li>
							<li><a class="dropdown-item" href="#!">
									<div class="dropdown-item-content">
										<div class="dropdown-item-content-text">
											<div class="text-truncate d-inline-block"
												style="max-width: 18rem">Welcome to our group! It's good to
												see new members and I know you will do great!</div>
										</div>
										<div class="dropdown-item-content-subtext">Mar 8, 2021
											&middot; Celia J. Knight</div>
									</div>
							</a></li>
							<li><hr class="dropdown-divider my-0" /></li>
							<li><a class="dropdown-item py-3" href="#!">
									<div
										class="d-flex align-items-center w-100 justify-content-end text-primary">
										<div class="fst-button small">View all</div>
										<i class="material-icons icon-sm ms-1">chevron_right</i>
									</div>
							</a></li>
						</ul>
					</div>
					<!-- Notifications and alerts dropdown-->
					<div class="dropdown dropdown-notifications d-none d-sm-block">
						<button class="btn btn-lg btn-icon dropdown-toggle me-3"
							id="dropdownMenuNotifications" type="button"
							data-bs-toggle="dropdown" aria-expanded="false">
							<i class="material-icons">notifications</i>
						</button>
						<ul
							class="dropdown-menu dropdown-menu-end me-3 mt-3 py-0 overflow-hidden"
							aria-labelledby="dropdownMenuNotifications">
							<li><h6 class="dropdown-header bg-primary text-white fw-500 py-3">Alerts</h6></li>
							<li><hr class="dropdown-divider my-0" /></li>
							<li><a class="dropdown-item unread" href="#!"> <i
									class="material-icons leading-icon">assessment</i>
									<div class="dropdown-item-content me-2">
										<div class="dropdown-item-content-text">Your March performance
											report is ready to view.</div>
										<div class="dropdown-item-content-subtext">Mar 12, 2021
											&middot; Performance</div>
									</div>
							</a></li>
							<li><hr class="dropdown-divider my-0" /></li>
							<li><a class="dropdown-item" href="#!"> <i
									class="material-icons leading-icon">check_circle</i>
									<div class="dropdown-item-content me-2">
										<div class="dropdown-item-content-text">Tracking codes
											successfully updated.</div>
										<div class="dropdown-item-content-subtext">Mar 12, 2021
											&middot; Coverage</div>
									</div>
							</a></li>
							<li><hr class="dropdown-divider my-0" /></li>
							<li><a class="dropdown-item" href="#!"> <i
									class="material-icons leading-icon">warning</i>
									<div class="dropdown-item-content me-2">
										<div class="dropdown-item-content-text">Tracking codes have
											changed and require manual action.</div>
										<div class="dropdown-item-content-subtext">Mar 8, 2021
											&middot; Coverage</div>
									</div>
							</a></li>
							<li><hr class="dropdown-divider my-0" /></li>
							<li><a class="dropdown-item py-3" href="#!">
									<div
										class="d-flex align-items-center w-100 justify-content-end text-primary">
										<div class="fst-button small">View all</div>
										<i class="material-icons icon-sm ms-1">chevron_right</i>
									</div>
							</a></li>
						</ul>
					</div>
					<!-- User profile dropdown-->
					<div class="dropdown">
						<button class="btn btn-lg btn-icon dropdown-toggle"
							id="dropdownMenuProfile" type="button" data-bs-toggle="dropdown"
							aria-expanded="false">
							<i class="material-icons">person</i>
						</button>
						<ul class="dropdown-menu dropdown-menu-end mt-3"
							aria-labelledby="dropdownMenuProfile">
							<li><a class="dropdown-item" href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/user/<?php echo $_smarty_tpl->tpl_vars['userId']->value;?>
"> <i
									class="material-icons leading-icon">person</i>
									<div class="me-3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Profilo"),$_smarty_tpl ) );?>
</div>
							</a></li>
							<li><hr class="dropdown-divider" /></li>
							<li><a class="dropdown-item" href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/authentication/logout"> <i
									class="material-icons leading-icon">logout</i>
									<div class="me-3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Esci"),$_smarty_tpl ) );?>
</div>
							</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</nav>
	<!-- Layout wrapper-->
	<div id="layoutDrawer">
		<!-- Layout navigation-->
		<div id="layoutDrawer_nav">
			<!-- Drawer navigation-->
			<nav class="drawer accordion drawer-light bg-white" id="drawerAccordion">
				<div class="drawer-menu">
					<div class="nav"><?php echo $_smarty_tpl->tpl_vars['left']->value;?>
</div>
				</div>
				<!-- Drawer footer        -->
				<div class="drawer-footer border-top">
					<div class="d-flex align-items-center">
						<i class="material-icons text-muted">account_circle</i>
						<div class="ms-3">
							<div class="caption"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Ciao"),$_smarty_tpl ) );?>
</div>
							<div class="small fw-500"><?php echo $_smarty_tpl->tpl_vars['userNominativo']->value;?>
</div>
						</div>
					</div>
				</div>
			</nav>
		</div>



		<!-- Layout content-->
		<div id="layoutDrawer_content">
			
			<!-- Main page content-->
			<main>
				<div class="p-5">
					<?php echo $_smarty_tpl->tpl_vars['mainMessages']->value;
echo $_smarty_tpl->tpl_vars['mainWarnings']->value;
echo $_smarty_tpl->tpl_vars['mainErrors']->value;
echo $_smarty_tpl->tpl_vars['mainInfo']->value;?>

					<div class="card card-raised mb-5">
						<div class="card-body p-5">
							<?php if (!empty($_smarty_tpl->tpl_vars['contentTitle']->value)) {?><div class="card-title"><?php echo $_smarty_tpl->tpl_vars['contentTitle']->value;?>
</div><?php }?>
							<?php if (!empty($_smarty_tpl->tpl_vars['contentSubTitle']->value)) {?><div class="card-subtitle mb-4"><?php echo $_smarty_tpl->tpl_vars['contentSubTitle']->value;?>
</div><?php }?>
							<?php if (!empty($_smarty_tpl->tpl_vars['dump']->value)) {?><div class="border p-3 p-sm-4 bg-black shadow-2 small"><code class="text-white fs-6 mb-2"><?php echo $_smarty_tpl->tpl_vars['dump']->value;?>
</code></div><?php }?>
							<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['pagina']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
						</div>
					</div>
				</div>
			</main>
			<!-- Footer-->
			<!-- Min-height is set inline to match the height of the drawer footer-->
			<footer class="py-4 mt-auto border-top" style="min-height: 74px">
				<div class="container-xl px-5">
					<div class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between small">
						<div class="me-sm-2">Copyright &copy; <?php echo $_smarty_tpl->tpl_vars['title']->value;?>
 <?php echo smarty_modifier_date_format(time(),"%Y");?>
</div>
						<div class="d-flex ms-sm-2">
							<a class="text-decoration-none" href="#!"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Privacy Policy"),$_smarty_tpl ) );?>
</a>
							<div class="mx-1">&middot;</div>
							<a class="text-decoration-none" href="#!"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Termini e condizioni"),$_smarty_tpl ) );?>
</a>
						</div>
				</div>
				</div>
			</footer>
		</div>
	</div>
	
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['siteRoot']->value)."/core/templates/foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
<!-- Hearbeat JavaScript -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/js/hearbeat.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
