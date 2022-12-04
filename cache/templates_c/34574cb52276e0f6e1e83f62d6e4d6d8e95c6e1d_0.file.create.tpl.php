<?php
/* Smarty version 4.2.1, created on 2022-12-02 11:20:25
  from 'D:\wamp\www\square-app\pages\admin\permessi\servizi\templates\create.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6389d1690505f1_17349553',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '34574cb52276e0f6e1e83f62d6e4d6d8e95c6e1d' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\pages\\admin\\permessi\\servizi\\templates\\create.tpl',
      1 => 1669976421,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6389d1690505f1_17349553 (Smarty_Internal_Template $_smarty_tpl) {
if (!$_smarty_tpl->tpl_vars['src']->value["custom-template"]) {?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_table'][0], array( array('src'=>$_smarty_tpl->tpl_vars['src']->value,'view'=>'create'),$_smarty_tpl ) );?>

<?php } else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_opening'][0], array( array('action'=>((string)$_smarty_tpl->tpl_vars['siteUrl']->value)."/".((string)$_smarty_tpl->tpl_vars['src']->value['alias'])."/create"),$_smarty_tpl ) );?>

<div class="row">
	<div class="col-md-8 mb-4">
		<table class="table table-striped mb-0">
			<tbody>

				<tr>
					<td><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Servizio"),$_smarty_tpl ) );?>
</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['src']->value['rows']['servizio'];?>
</span></td>
				</tr>
				<tr>
					<td><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Descrizione"),$_smarty_tpl ) );?>
</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['src']->value['rows']['descrizione'];?>
</span></td>
				</tr>
				<tr>
					<td><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Voce di menù"),$_smarty_tpl ) );?>
</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['src']->value['rows']['menu'];?>
</span></td>

				</tr>
				<tr>
					<td><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Posizione"),$_smarty_tpl ) );?>
</strong></td>
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
<div class="text-end"><?php ob_start();
echo $_smarty_tpl->tpl_vars['id']->value;
$_prefixVariable1 = ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_link'][0], array( array('href'=>((string)$_smarty_tpl->tpl_vars['siteUrl']->value)."/".((string)$_smarty_tpl->tpl_vars['src']->value['alias']),'type'=>'button','img'=>"undo",'text'=>true,'value'=>"Indietro",'action_id'=>$_prefixVariable1),$_smarty_tpl ) );?>
</div>
<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_closing'][0], array( array('data-method'=>'POST'),$_smarty_tpl ) );?>

<?php }?>


<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_opening'][0], array( array('action'=>((string)$_smarty_tpl->tpl_vars['siteUrl']->value)."/".((string)$_smarty_tpl->tpl_vars['src']->value['alias'])."/create"),$_smarty_tpl ) );?>

<div class="row">
	<div class="col-md-8 mb-4">
		<table class="table table-striped mb-0">
			<tbody>

				<tr>
					<td><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Servizio"),$_smarty_tpl ) );?>
</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['src']->value['rows']['servizio'];?>
</span></td>
				</tr>
				<tr>
					<td><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Descrizione"),$_smarty_tpl ) );?>
</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['src']->value['rows']['descrizione'];?>
</span></td>
				</tr>
				<tr>
					<td><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Voce di menù"),$_smarty_tpl ) );?>
</strong></td>
					<td><span><?php echo $_smarty_tpl->tpl_vars['src']->value['rows']['menu'];?>
</span></td>

				</tr>
				<tr>
					<td><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Posizione"),$_smarty_tpl ) );?>
</strong></td>
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
<div class="text-end"><?php ob_start();
echo $_smarty_tpl->tpl_vars['id']->value;
$_prefixVariable2 = ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_link'][0], array( array('href'=>((string)$_smarty_tpl->tpl_vars['siteUrl']->value)."/".((string)$_smarty_tpl->tpl_vars['src']->value['alias']),'type'=>'button','img'=>"undo",'text'=>true,'value'=>"Indietro",'action_id'=>$_prefixVariable2),$_smarty_tpl ) );?>
</div>
<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_closing'][0], array( array('data-method'=>'POST'),$_smarty_tpl ) );
}
}
