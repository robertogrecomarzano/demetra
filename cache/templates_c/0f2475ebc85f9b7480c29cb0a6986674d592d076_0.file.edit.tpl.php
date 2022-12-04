<?php
/* Smarty version 4.2.1, created on 2022-11-30 09:32:50
  from 'D:\wamp\www\square-app\pages\admin\utenti\templates\edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63871532e64882_99630657',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0f2475ebc85f9b7480c29cb0a6986674d592d076' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\pages\\admin\\utenti\\templates\\edit.tpl',
      1 => 1669797131,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63871532e64882_99630657 (Smarty_Internal_Template $_smarty_tpl) {
if (!$_smarty_tpl->tpl_vars['src']->value["custom-template"]) {?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_table'][0], array( array('src'=>$_smarty_tpl->tpl_vars['src']->value,'view'=>'edit','data-method'=>'PUT','data-action'=>((string)$_smarty_tpl->tpl_vars['siteUrl']->value)."/".((string)$_smarty_tpl->tpl_vars['src']->value['alias'])."/".((string)$_smarty_tpl->tpl_vars['id']->value)."/edit"),$_smarty_tpl ) );?>

<?php } else { ?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_opening'][0], array( array('action'=>((string)$_smarty_tpl->tpl_vars['siteUrl']->value)."/".((string)$_smarty_tpl->tpl_vars['src']->value['alias'])."/".((string)$_smarty_tpl->tpl_vars['id']->value)."/edit"),$_smarty_tpl ) );?>

	    	<div class="card-title">Dati utente</div>
            <div class="card-subtitle mb-4">Modifica dati dell'utente</div>
            
            <div class="row mb-4">
            	<div class="col-md-6"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('iname'=>'cognome','max'=>45,'mwc'=>true,'label'=>'Cognome','outlined'=>true),$_smarty_tpl ) );?>
</div>
                <div class="col-md-6"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('iname'=>'nome','max'=>45,'mwc'=>true,'label'=>'Nome','outlined'=>true),$_smarty_tpl ) );?>
</div>
            </div>
            
            <div class="row mb-4">
                <div class="col-md-6"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('iname'=>'email','max'=>45,'mwc'=>true,'outlined'=>true,'label'=>"Indirizzo email",'type'=>"email"),$_smarty_tpl ) );?>
</div>
                <div class="col-md-6">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('iname'=>'sola_lettura','label'=>'Spuntare se si vuole dare accesso in sola lettura'),$_smarty_tpl ) );?>

					
				</div>
            </div>
            
            <div class="row mb-4">
            	<div class="col-md-6">
            			<h6 class="h6 mb-1">Profili</h6>
						<span class="text text-muted">Selezionare i profili da assegnare all'utente</span>
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_checks'][0], array( array('iname'=>'gruppo','src'=>$_smarty_tpl->tpl_vars['gruppi']->value,'cols'=>1),$_smarty_tpl ) );?>

				</div>
                <div class="col-md-6">
					<div class="col-md-6">
            			<h6 class="h6 mb-1">Servizi</h6>
						<span class="text text-muted">Selezionare i servizi a cui l'utente ha accesso</span>
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_checks'][0], array( array('iname'=>'servizio','src'=>$_smarty_tpl->tpl_vars['servizi']->value,'cols'=>1),$_smarty_tpl ) );?>

				</div>
				</div>
            </div>
            
            <div class="row mb-4">
				<div class="col-md-6"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('iname'=>'username','mwc'=>true,'outlined'=>true,'label'=>"Username"),$_smarty_tpl ) );?>
</div>
				<div class="col-md-6"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('iname'=>'password','mwc'=>true,'outlined'=>true,'label'=>"Password",'type'=>"password"),$_smarty_tpl ) );?>
</div>
            </div>
            
            <div class="text-end">
             	<?php ob_start();
echo $_smarty_tpl->tpl_vars['id']->value;
$_prefixVariable1 = ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_edit_dropdown'][0], array( array('action_id'=>$_prefixVariable1),$_smarty_tpl ) );?>
   
            </div>
    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_closing'][0], array( array('data-method'=>'PUT'),$_smarty_tpl ) );?>

<?php }
}
}