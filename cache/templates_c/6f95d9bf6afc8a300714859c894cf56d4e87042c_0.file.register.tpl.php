<?php
/* Smarty version 4.2.1, created on 2022-11-30 12:38:43
  from 'D:\wamp\www\square-app\core\templates\tpl\authentication\register.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_638740c3068177_18548648',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6f95d9bf6afc8a300714859c894cf56d4e87042c' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\core\\templates\\tpl\\authentication\\register.tpl',
      1 => 1669745785,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_638740c3068177_18548648 (Smarty_Internal_Template $_smarty_tpl) {
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
<body class="bg-primary">
        <!-- Layout wrapper-->
        <div id="layoutAuthentication">
            <!-- Layout content-->
            <div id="layoutAuthentication_content">
                <!-- Main page content-->
                <main>
                    <!-- Main content container-->
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xxl-7 col-xl-10">
                                <div class="card card-raised shadow-10 mt-5 mt-xl-10 mb-5">
                                    <div class="card-body p-5">
                                        <!-- Auth header with logo image-->
                                        <div class="text-center">
                                            <img class="mb-3" src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/img/logo.png" alt="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
" style="height: 48px" />
										<h1 class="display-5 mb-20"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Registrazione"),$_smarty_tpl ) );?>
</h1>
                                        </div>
                                        <!-- Register new account form-->
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_opening'][0], array( array(),$_smarty_tpl ) );?>

                                        	<?php echo $_smarty_tpl->tpl_vars['mainMessages']->value;
echo $_smarty_tpl->tpl_vars['mainWarnings']->value;
echo $_smarty_tpl->tpl_vars['mainErrors']->value;
echo $_smarty_tpl->tpl_vars['mainInfo']->value;?>

                                            <div class="row">
                                                <div class="col-sm-6 mb-4"><?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Cognome'),$_smarty_tpl ) );
$_prefixVariable1=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('iname'=>'cognome','mdc'=>true,'placeholder'=>$_prefixVariable1,'outlined'=>true,'required'=>"required"),$_smarty_tpl ) );?>
</div>
                                                <div class="col-sm-6 mb-4"><?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Nome'),$_smarty_tpl ) );
$_prefixVariable2=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('iname'=>'nome','mdc'=>true,'placeholder'=>$_prefixVariable2,'outlined'=>true,'required'=>"required"),$_smarty_tpl ) );?>
</div>
                                            </div>
                                            <div class="mb-4"><?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Indirizzo email'),$_smarty_tpl ) );
$_prefixVariable3=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('iname'=>'email','type'=>'email','mdc'=>true,'placeholder'=>$_prefixVariable3,'outlined'=>true,'required'=>"required"),$_smarty_tpl ) );?>
</div>
                                            <div class="row">
                                                <div class="col-sm-6 mb-4"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('mdc'=>true,'iname'=>'password','type'=>'password','placeholder'=>"Password",'outlined'=>true,'img'=>"visibility_off",'required'=>"required"),$_smarty_tpl ) );?>

                                                	<div class="mdc-text-field-helper-line">
  														<div id="password" class="mdc-text-field-helper-text alert alert-info" aria-hidden="true">
  															<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Deve contenere"),$_smarty_tpl ) );?>
</span>
    														<ul>
																<li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"un numero"),$_smarty_tpl ) );?>
</li>
																<li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"un carattere minuscolo"),$_smarty_tpl ) );?>
</li>
																<li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"un carattere maiuscolo"),$_smarty_tpl ) );?>
</li>
																<li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"un carattere compreso tra "),$_smarty_tpl ) );?>
<b class='text text-muted'>!.@#$%</b></li>
																<li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"avere lunghezza tra 8 e 20 caratteri"),$_smarty_tpl ) );?>
</li>
															</ul>
  														</div>
													</div>
												</div>
                                                <div class="col-sm-6 mb-4"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('mdc'=>true,'iname'=>'password2','type'=>'password','placeholder'=>"Verifica Password",'outlined'=>true,'img'=>"visibility_off",'required'=>"required"),$_smarty_tpl ) );?>

                                                	<div class="mdc-text-field-helper-line">
  														<div id="password2" class="mdc-text-field-helper-text alert alert-info" aria-hidden="true">
  															<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Deve contenere"),$_smarty_tpl ) );?>
</span>
    														<ul>
																<li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"un numero"),$_smarty_tpl ) );?>
</li>
																<li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"un carattere minuscolo"),$_smarty_tpl ) );?>
</li>
																<li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"un carattere maiuscolo"),$_smarty_tpl ) );?>
</li>
																<li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"un carattere compreso tra "),$_smarty_tpl ) );?>
<b class='text text-muted'>!.@#$%</b></li>
																<li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"avere lunghezza tra 8 e 20 caratteri"),$_smarty_tpl ) );?>
</li>
															</ul>
  														</div>
													</div>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <mwc-formfield label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Accetto temini e condizioni'),$_smarty_tpl ) );?>
"><mwc-checkbox></mwc-checkbox></mwc-formfield>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small fw-500 text-decoration-none" href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/authentication/login"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Login"),$_smarty_tpl ) );?>
</a>
                                                <button class="btn btn-primary" type="submit" onclick="return formRegister();"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Crea Account"),$_smarty_tpl ) );?>
</button>
                                            </div>
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_closing'][0], array( array(),$_smarty_tpl ) );?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <!-- Layout footer-->
		<div id="layoutAuthentication_footer">
			<!-- Auth footer-->
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
	<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['siteRoot']->value)."/core/templates/foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</body>
</html><?php }
}
