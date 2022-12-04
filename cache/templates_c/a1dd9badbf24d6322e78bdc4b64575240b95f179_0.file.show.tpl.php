<?php
/* Smarty version 4.2.1, created on 2022-12-01 13:22:38
  from 'D:\wamp\www\square-app\pages\admin\utenti\templates\show.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63889c8ec0a9b5_85862344',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a1dd9badbf24d6322e78bdc4b64575240b95f179' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\pages\\admin\\utenti\\templates\\show.tpl',
      1 => 1669897356,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63889c8ec0a9b5_85862344 (Smarty_Internal_Template $_smarty_tpl) {
if (!$_smarty_tpl->tpl_vars['src']->value["custom-template"]) {?> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_table'][0], array( array('src'=>$_smarty_tpl->tpl_vars['src']->value,'view'=>'show'),$_smarty_tpl ) );?>
 <?php } else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_opening'][0], array( array('class'=>"form-horizontal",'action'=>((string)$_smarty_tpl->tpl_vars['siteUrl']->value)."/".((string)$_smarty_tpl->tpl_vars['src']->value['alias'])."/".((string)$_smarty_tpl->tpl_vars['pageId']->value)),$_smarty_tpl ) );?>

<div class="row">

	<div class="col-md-8 mb-4">
		<table class="table table-striped mb-0">
			<tbody>

				<tr>
					<td><strong>Gruppo</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['src']->value['rows']['gruppo'];?>
</span></td>
				</tr>
				<tr>
					<td><strong>Cognome</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['src']->value['rows']['cognome'];?>
</span></td>
				</tr>
				<tr>
					<td><strong>Nome</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['src']->value['rows']['nome'];?>
</span></td>

				</tr>
				<tr>
					<td><strong>Servizi</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['src']->value['rows']['servizi'];?>
</span></td>

				</tr>
				<tr>
					<td><strong>Username</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['src']->value['rows']['username'];?>
</span></td>
				</tr>

				<tr>
					<td><strong>Consultazione</strong></td>
					<td><span><?php if ($_smarty_tpl->tpl_vars['src']->value['rows']['sola_lettura']) {?>SI<?php }?></span></td>
				</tr>

				<tr>
					<td><strong>Email</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['src']->value['rows']['email'];?>
</span></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="text-end">
	<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Indietro'),$_smarty_tpl ) );
$_prefixVariable1=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_link'][0], array( array('href'=>((string)$_smarty_tpl->tpl_vars['siteUrl']->value)."/".((string)$_smarty_tpl->tpl_vars['src']->value['alias']),'type'=>'button','img'=>"undo",'text'=>true,'value'=>$_prefixVariable1),$_smarty_tpl ) );?>

	<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Modifica'),$_smarty_tpl ) );
$_prefixVariable2=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_link'][0], array( array('href'=>((string)$_smarty_tpl->tpl_vars['siteUrl']->value)."/".((string)$_smarty_tpl->tpl_vars['src']->value['alias'])."/".((string)$_smarty_tpl->tpl_vars['pageId']->value)."/edit",'type'=>'button','img'=>"edit",'text'=>true,'value'=>$_prefixVariable2,'class'=>"btn btn-warning"),$_smarty_tpl ) );?>

	<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Elimina'),$_smarty_tpl ) );
$_prefixVariable3=ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['pageId']->value;
$_prefixVariable4 = ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_delete'][0], array( array('text'=>true,'value'=>$_prefixVariable3,'id'=>$_prefixVariable4),$_smarty_tpl ) );?>

</div>
<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_closing'][0], array( array('data-method'=>'DELETE'),$_smarty_tpl ) );?>
 <?php }
}
}
