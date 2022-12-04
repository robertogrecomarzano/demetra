<?php
/* Smarty version 4.2.1, created on 2022-11-14 19:00:16
  from 'D:\wamp\www\square-app\core\templates\tpl\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63728230a24144_07532639',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '44ba3108ab9078346c2b918abd29432b27e5c191' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\core\\templates\\tpl\\login.tpl',
      1 => 1668448814,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63728230a24144_07532639 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>

<!-- Bootstrap Core CSS -->
<link
	href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/vendor/bootstrap/css/bootstrap.min.css"
	rel="stylesheet">

<!-- Common CSS -->
<link href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/css/common.css" rel="stylesheet">

<!-- Login CSS -->
<link href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/css/login.css" rel="stylesheet">

<!-- font awesome  -->
<link
	href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/vendor/font-poppins/font-poppins.css"
	rel="stylesheet">

<!-- font awesome  -->
<link
	href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/vendor/font-awesome-free-5.6.3/css/all.css"
	rel="stylesheet">
<link
	href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/vendor/font-awesome-4.7.0/css/font-awesome.min.css"
	rel="stylesheet">
	
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"><?php echo '</script'; ?>
>
    <![endif]-->
<!-- jQuery -->
<link rel="shortcut icon"
	href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/img/favicon.png">
</head>

<body>



	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
				<div class="login-panel panel panel-default">

					<div class="panel-body text-center">
						<img class="img img-responsive hidden-xs logo"
							src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/img/<?php echo $_smarty_tpl->tpl_vars['logo']->value;?>
.png" />
						<div class="panel-body text-center">
							<h2 class='title lead'><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h2>
							<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_opening'][0], array( array('class'=>"form-signin"),$_smarty_tpl ) );?>

								
								<!-- Modal -->
	<div class="modal fade" id="myCustomModal" tabindex="-1" role="dialog"
		aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content" id='myCustomModalContent'>
				<div class="modal-header">
					<h2 class="modal-title" id="myCustomModalTitle"></h2>
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id='myCustomModalBody'></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary"
						data-dismiss="modal">chiudi</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /.modal -->
								<fieldset>
									<p id="profile-name" class="profile-name-card"></p>
									<div class="form-group input-group">
									<span class="input-group-addon"><i class='fas fa-user'></i></span>
										<input type="text" id="username" name="username"
											class="form-control" placeholder="Username" required
											style="width: 100%;">
									</div>
									<div class="form-group input-group">
									<span class="input-group-addon"><i class='fas fa-key'></i></span>
										<input type="password" name="password" id="password"
											class="form-control" placeholder="Password" required
											style="width: 100%;">
									</div>
									<div class="form-group">
										<button class="btn btn-lg btn-primary btn-block login-button"
											type="submit">Accedi</button>
									</div>
								</fieldset>
							<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_closing'][0], array( array(),$_smarty_tpl ) );?>

							<a href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/authentication/register">Registrati</a>
							<button class="btn btn-lg btn-default btn-block btn-sm" type="button" onclick="showRecoveryForm(this);">Recupera credenziali di accesso</button>
							<hr />
							© Square Srls<br /><a target="_blanck" href="https://www.squareinformatica.it" title="Square Srls">squareinformatica.it</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- JQuery -->
	<?php echo '<script'; ?>

		src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/vendor/jquery/jquery-3.3.1.min.js"><?php echo '</script'; ?>
>


	<!-- Bootstrap Core JavaScript -->
	<?php echo '<script'; ?>

		src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/vendor/bootstrap/js/bootstrap.min.js"><?php echo '</script'; ?>
>



	<!-- Bootbox dialog boxes JavaScript -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/vendor/bootbox/bootbox.min.js"><?php echo '</script'; ?>
>

	<!-- Bootstrap Notify -->
	<?php echo '<script'; ?>

		src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/vendor/bootstrap-notify-master/bootstrap-notify.min.js"><?php echo '</script'; ?>
>

	
	<!-- DataTables -->
	<?php echo '<script'; ?>

		src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/vendor/datatables/jquery.dataTables.min.js"><?php echo '</script'; ?>
>

	<link rel="stylesheet" type="text/css"
		href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/vendor/datatables/datatables.min.css" />

	<?php echo '<script'; ?>
 type="text/javascript"
		src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/vendor/datatables/datatables.min.js"><?php echo '</script'; ?>
>
		
	<?php echo $_smarty_tpl->tpl_vars['css']->value;
echo $_smarty_tpl->tpl_vars['js']->value;?>


		<div id='loading' onclick="$(this).hide();" class="modal fade in"
		tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
		data-backdrop="static" data-keyboard="false"
		style="padding-right: 17px;" aria-hidden="false">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Attendi...</h4>
					<h4 class="modal-title">
						<small id="myModalLabel"></small>
					</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							<div class="progress progress-striped active">
								<div class="progress-bar" style="width: 100%;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	[<?php echo $_smarty_tpl->tpl_vars['mainMessages']->value;
echo $_smarty_tpl->tpl_vars['mainWarnings']->value;
echo $_smarty_tpl->tpl_vars['mainErrors']->value;
echo $_smarty_tpl->tpl_vars['mainInfo']->value;?>
]

</body>
</html><?php }
}
