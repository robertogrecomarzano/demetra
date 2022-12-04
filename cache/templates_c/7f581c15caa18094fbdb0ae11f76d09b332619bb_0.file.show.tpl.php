<?php
/* Smarty version 4.2.1, created on 2022-11-29 18:59:07
  from 'D:\wamp\www\square-app\pages\user\templates\show.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6386486be97594_72634457',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7f581c15caa18094fbdb0ae11f76d09b332619bb' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\pages\\user\\templates\\show.tpl',
      1 => 1669744745,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6386486be97594_72634457 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row">

	<div class="col-md-8 mb-4">
		<table class="table table-striped mb-0">
			<tbody>
				<tr>
					<td><strong>Cognome</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['utente']->value['cognome'];?>
</span></td>
				</tr>
				<tr>
					<td><strong>Nome</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['utente']->value['nome'];?>
</span></td>

				</tr>
				<tr>
					<td><strong>Email</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['utente']->value['email'];?>
</span></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="text-end">
	<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Modifica'),$_smarty_tpl ) );
$_prefixVariable1=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_link'][0], array( array('href'=>((string)$_smarty_tpl->tpl_vars['siteUrl']->value)."/".((string)$_smarty_tpl->tpl_vars['alias']->value)."/".((string)$_smarty_tpl->tpl_vars['pageId']->value)."/edit",'type'=>'button','img'=>"edit",'text'=>true,'value'=>$_prefixVariable1,'class'=>"btn btn-primary"),$_smarty_tpl ) );?>

</div><?php }
}
