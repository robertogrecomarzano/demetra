<?php
/* Smarty version 4.2.1, created on 2022-12-02 17:23:43
  from 'D:\wamp\www\square-app\core\templates\tpl\authentication\passwordrecovery.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_638a268f0f1374_01795911',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13aaac9adce756afcdbcc481a31563a9cf350d28' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\core\\templates\\tpl\\authentication\\passwordrecovery.tpl',
      1 => 1669998213,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_638a268f0f1374_01795911 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\wamp\\www\\square-app\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<!DOCTYPE html>
<html lang="en">
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
                            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8">
                                <div class="card card-raised shadow-10 mt-5 mt-xl-10 mb-4">
                                    <div class="card-body p-5">
                                        <!-- Auth header with logo image-->
                                        <div class="text-center">
                                            <img class="mb-3" src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/img/logo.png" alt="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
" style="height: 48px" />
                                            <h1 class="display-5 mb-4"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Resetta password"),$_smarty_tpl ) );?>
</h1>
                                        </div>
                                        <?php echo $_smarty_tpl->tpl_vars['mainMessages']->value;
echo $_smarty_tpl->tpl_vars['mainWarnings']->value;
echo $_smarty_tpl->tpl_vars['mainErrors']->value;
echo $_smarty_tpl->tpl_vars['mainInfo']->value;?>

                                        <?php if (!empty($_smarty_tpl->tpl_vars['dump']->value)) {?><div class="border p-3 p-sm-4 bg-black shadow-2 small"><code class="text-white fs-6 mb-2"><?php echo $_smarty_tpl->tpl_vars['dump']->value;?>
</code></div><?php }?>
                                        <!-- Reset password submission form-->
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_opening'][0], array( array('class'=>"needs-validation",'novalidate'=>''),$_smarty_tpl ) );?>

										
										
                                            <div class="mb-4">
                                            	<div class="input-group has-validation">
                                            		<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Indirizzo email'),$_smarty_tpl ) );
$_prefixVariable1=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('iname'=>'email','type'=>'email','mdc'=>true,'placeholder'=>$_prefixVariable1,'outlined'=>true,'required'=>"required"),$_smarty_tpl ) );?>

      											</div>
      											<div class="form-group mt-5"><?php echo $_smarty_tpl->tpl_vars['captcha']->value;?>
</div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small fw-500 text-decoration-none" href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/authentication/login"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Ritorna al login"),$_smarty_tpl ) );?>
</a>
                                                <button class="btn btn-primary" type="submit"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Resetta password"),$_smarty_tpl ) );?>
</button>
                                            </div>
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_closing'][0], array( array(),$_smarty_tpl ) );?>

                                    </div>
                                </div>
                                <!-- Auth card message-->
                                <div class="text-center mb-5"><a class="small fw-500 text-decoration-none link-white" href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/authentication/register"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Non hai un account?"),$_smarty_tpl ) );?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Registrati"),$_smarty_tpl ) );?>
</a></div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <!-- Layout footer-->
            <div id="layoutAuthentication_footer">
                <!-- Auth footer-->
                <footer class="p-4">
                    <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between small">
                        <div class="me-sm-3 mb-2 mb-sm-0"><div class="fw-500 text-white">Copyright &copy; <?php echo $_smarty_tpl->tpl_vars['title']->value;?>
 <?php echo smarty_modifier_date_format(time(),"%Y");?>
</div></div>
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
</html>
<?php }
}
