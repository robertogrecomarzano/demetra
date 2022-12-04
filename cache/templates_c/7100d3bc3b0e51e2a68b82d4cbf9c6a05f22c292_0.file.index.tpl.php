<?php
/* Smarty version 4.2.1, created on 2022-12-02 10:10:23
  from 'D:\wamp\www\square-app\pages\admin\configurazione\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6389c0ffd16186_99696283',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7100d3bc3b0e51e2a68b82d4cbf9c6a05f22c292' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\pages\\admin\\configurazione\\templates\\index.tpl',
      1 => 1669972221,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6389c0ffd16186_99696283 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row">
	<div class="row col-md-8 mb-4">
		<div class="col-md-8">
		<h3 class="text-primary"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Dati generali"),$_smarty_tpl ) );?>
</h3>
		<table class="table table-striped mb-0">
			<tbody>
				<tr>
					<td><strong>Denominazione</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['row']->value['denominazione'];?>
</span></td>
				</tr>
				<tr>
					<td><strong>Sede</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['row']->value['sede'];?>
</span></td>
				</tr>
				<tr>
					<td><strong>Indirizzo web</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['row']->value['web'];?>
</span></td>
				</tr>
				<tr>
					<td><strong>Indirizzo email</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['row']->value['email'];?>
</span></td>
				</tr>
				<tr>
					<td><strong>Indirizzo email tencico</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['row']->value['email_support'];?>
</span></td>
				</tr>
				<tr>
					<td><strong>Telefono</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['row']->value['telefono'];?>
</span></td>
				</tr>
				<tr>
					<td><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Debug attivo'),$_smarty_tpl ) );?>
</strong></td>
					<td><span><?php if ($_smarty_tpl->tpl_vars['row']->value['is_debug']) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('switch'=>true,'checked'=>"checked",'disabled'=>"disabled"),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('switch'=>true,'disabled'=>"disabled"),$_smarty_tpl ) );
}?></span></td>
				</tr>
				<tr>
					<td><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Sistema in manutenzione'),$_smarty_tpl ) );?>
</strong></td>
					<td><span><?php if ($_smarty_tpl->tpl_vars['row']->value['is_offline']) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('switch'=>true,'checked'=>"checked",'disabled'=>"disabled"),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('switch'=>true,'disabled'=>"disabled"),$_smarty_tpl ) );
}?></span></td>
				</tr>
				<tr>
					<td><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Sistema di collaudo'),$_smarty_tpl ) );?>
</strong></td>
					<td><span><?php if ($_smarty_tpl->tpl_vars['row']->value['is_collaudo']) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('switch'=>true,'checked'=>"checked",'disabled'=>"disabled"),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('switch'=>true,'disabled'=>"disabled"),$_smarty_tpl ) );
}?></span></td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="col-md-4">
		<h3 class="text-primary"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Server di posta elettronica"),$_smarty_tpl ) );?>
</h3>
		<table class="table table-striped mb-0">
			<tbody>
				<tr>
					<td><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Invio delle mail abilitato"),$_smarty_tpl ) );?>
</strong></td>
					<td><span><?php if ($_smarty_tpl->tpl_vars['row']->value['mail_enable']) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('switch'=>true,'checked'=>"checked",'disabled'=>"disabled"),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('switch'=>true,'disabled'=>"disabled"),$_smarty_tpl ) );
}?></span></td>
				</tr>
				<tr>
					<td><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Invio tramite server SMTP"),$_smarty_tpl ) );?>
</strong></td>
					<td><span><?php if ($_smarty_tpl->tpl_vars['row']->value['mail_smtp']) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('switch'=>true,'checked'=>"checked",'disabled'=>"disabled"),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('switch'=>true,'disabled'=>"disabled"),$_smarty_tpl ) );
}?></span></td>
				</tr>
				<tr>
					<td><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Server SMTP"),$_smarty_tpl ) );?>
</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['row']->value['mail_smtp_server'];?>
</span></td>
				</tr>
				<tr>
					<td><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Il server SMTP richiede autenticazione"),$_smarty_tpl ) );?>
</strong></td>
					<td><span><?php if ($_smarty_tpl->tpl_vars['row']->value['mail_smtp_auth']) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('checked'=>"checked",'disabled'=>"disabled"),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('disabled'=>"disabled"),$_smarty_tpl ) );
}?></span></td>
				</tr>
				<tr>
					<td><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Utente SMTP"),$_smarty_tpl ) );?>
</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['row']->value['mail_smtp_user'];?>
</span></td>
				</tr>
				<tr>
					<td><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Password SMTP"),$_smarty_tpl ) );?>
</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['row']->value['mail_smtp_password'];?>
</span></td>
				</tr>
				<tr>
					<td><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Porta SMTP"),$_smarty_tpl ) );?>
</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['row']->value['mail_smtp_port'];?>
</span></td>
				</tr>
				<tr>
					<td><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Prevista la crittografia"),$_smarty_tpl ) );?>
</strong></td>
					<td><span><?php if ($_smarty_tpl->tpl_vars['row']->value['mail_smtp_secure']) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('checked'=>"checked",'disabled'=>"disabled"),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('disabled'=>"disabled"),$_smarty_tpl ) );
}?></span></td>
				</tr>
				<tr>
					<td><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Tipo di protezione"),$_smarty_tpl ) );?>
</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['row']->value['mail_smtp_secure_type'];?>
</span></td>
				</tr>
				<tr>
					<td><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Debug"),$_smarty_tpl ) );?>
</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['debugs']->value[$_smarty_tpl->tpl_vars['row']->value['mail_smtp_debug']];?>
</span></td>
				</tr>
			</tbody>
		</table>
		</div>
	</div>
</div>
<div class="text-end">
	<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Modifica'),$_smarty_tpl ) );
$_prefixVariable1=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_link'][0], array( array('href'=>((string)$_smarty_tpl->tpl_vars['siteUrl']->value)."/".((string)$_smarty_tpl->tpl_vars['alias']->value)."/0/edit",'type'=>'button','img'=>"edit",'text'=>true,'value'=>$_prefixVariable1,'class'=>"btn btn-primary"),$_smarty_tpl ) );?>

</div><?php }
}
