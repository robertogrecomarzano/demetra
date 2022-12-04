<?php
/* Smarty version 4.2.1, created on 2022-11-14 19:06:25
  from 'D:\wamp\www\square-app\core\templates\tpl\register.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_637283a1f3ca63_70828766',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9f202bfe84b03f3d45635d156ec925ea077ad685' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\core\\templates\\tpl\\register.tpl',
      1 => 1668449184,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_637283a1f3ca63_70828766 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="robots" content="none" />
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="">
<meta name="author" content="Square Srls">
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>

<!-- Bootstrap Core CSS -->
<link
	href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/vendor/bootstrap/css/bootstrap.min.css"
	rel="stylesheet">

<!-- DataTables CSS -->
<link
	href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/vendor/datatables-plugins/dataTables.bootstrap.css"
	rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link
	href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/vendor/datatables-responsive/dataTables.responsive.css"
	rel="stylesheet">

<!-- Custom CSS -->
<link href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/css/common.css" rel="stylesheet">

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

<style>
.login-sidebar:after {
	background: rgba(0, 0, 0, 0)
		-moz-linear-gradient(-135deg, #ffffff, #ffffff) repeat scroll 0 0;
	background: -webkit-linear-gradient(-135deg, #ffffff, #ffffff);
}

.login-button, .bar:before, .bar:after {
	background: #22a7f0 none repeat scroll 0 0;
}
</style>



<div class="row">
	<div class="faded-bg animated"></div>
	<div class="col-sm-12 col-md-12">
		<div class="clearfix">
			<div class="col-sm-12 col-md-12">
				<div class="logo-title-container logo-title-container">
					<div id='errorbox'><?php echo $_smarty_tpl->tpl_vars['mainMessages']->value;
echo $_smarty_tpl->tpl_vars['mainWarnings']->value;
echo $_smarty_tpl->tpl_vars['mainErrors']->value;?>
</div>
					<form method="post" role='form' class="col-lg-6 col-md-offset-3">
						<?php echo $_smarty_tpl->tpl_vars['formToken']->value;?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_hidden'][0], array( array('iname'=>'form_action'),$_smarty_tpl ) );?>

						<h1>Recupero dati di accesso</h1>
						<div class="panel">
							<blockquote><p>Hai dimenticato i dati di accesso?</p><small>Inserisci l'email usata in fase di registrazione ed il codice di sicurezza e clicca sul tasto "Recupera".</small></blockquote>
						</div>

						<div class="form-group input-group">
							<span class="input-group-addon">@</span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('iname'=>'email','size'=>30,'max'=>45,'tabindex'=>'11','placeholder'=>"Email",'type'=>'email','required'=>"email",'oninvalid'=>"this.setCustomValidity('Email obbligatoria')"),$_smarty_tpl ) );?>

						</div>

						<div class="form-group"><?php echo $_smarty_tpl->tpl_vars['captcha']->value;?>
</div>



						<div class='btn-group'>
							<input type='button' value="Recupera" onclick='recovery(this);' class="btn btn-primary" />
								
							
						<a href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
" class="btn btn-default">Annulla</a>
					
						</div>
						
						
					</form>
				</div>
				<!-- .logo-title-container -->

			</div>

		</div>

	</div>


</div>
<!-- .row -->
</div>
<!-- .container-fluid -->

<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.3.1.min.js"><?php echo '</script'; ?>
>


<!-- Bootstrap Core JavaScript -->
<?php echo '<script'; ?>

	src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/vendor/bootstrap/js/bootstrap.min.js"><?php echo '</script'; ?>
>

<!-- Bootbox dialog boxes JavaScript -->
<?php echo '<script'; ?>

	src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"><?php echo '</script'; ?>
>

<!-- Bootstrap Notify -->
<?php echo '<script'; ?>

	src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/vendor/bootstrap-notify-master/bootstrap-notify.min.js"><?php echo '</script'; ?>
>

<!-- DataTables JavaScript -->
<?php echo '<script'; ?>

	src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/vendor/datatables/js/jquery.dataTables.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>

	src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/vendor/datatables-plugins/dataTables.bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>

	src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/vendor/datatables-responsive/dataTables.responsive.js"><?php echo '</script'; ?>
>


<!-- Custom Theme JavaScript -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/js/template-script.js"><?php echo '</script'; ?>
>


<!-- Main JavaScript -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/js/main.js"><?php echo '</script'; ?>
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
<?php echo $_smarty_tpl->tpl_vars['mainMessages']->value;
echo $_smarty_tpl->tpl_vars['mainWarnings']->value;
echo $_smarty_tpl->tpl_vars['mainErrors']->value;
echo $_smarty_tpl->tpl_vars['mainInfo']->value;?>



</body>
</html>
<?php }
}
