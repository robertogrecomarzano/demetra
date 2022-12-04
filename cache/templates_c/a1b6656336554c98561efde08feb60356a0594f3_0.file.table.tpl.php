<?php
/* Smarty version 4.2.1, created on 2022-11-09 13:15:56
  from 'D:\wamp\www\square-app\pages\admin\utenti\templates\table.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_636b99fc0fc087_36146689',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a1b6656336554c98561efde08feb60356a0594f3' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\pages\\admin\\utenti\\templates\\table.tpl',
      1 => 1667996098,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_636b99fc0fc087_36146689 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- table
	class="table table-striped table-hover dataTable no-footer dtr-inline"
	id="dataTables">
	<thead>
		<th></th>
		<th>Gruppi</th>
		<th>Username</th>
		<th>Cognome e Nome</th>
		<th>Email</th>
	</thead>
	<tbody>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['righe']->value, 'r');
$_smarty_tpl->tpl_vars['r']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['r']->value) {
$_smarty_tpl->tpl_vars['r']->do_else = false;
?>
		<tr>
			<td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_link'][0], array( array('href'=>((string)$_smarty_tpl->tpl_vars['siteUrl']->value)."/admin/utenti/".((string)$_smarty_tpl->tpl_vars['r']->value['id_utente'])."/edit",'img'=>'save','class'=>"btn btn-warning btn-xs"),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_delete'][0], array( array('id'=>$_smarty_tpl->tpl_vars['r']->value['id_utente']),$_smarty_tpl ) );?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['r']->value['profili'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['r']->value['username'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['r']->value['cognome'];?>
 <?php echo $_smarty_tpl->tpl_vars['r']->value['nome'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['r']->value['email'];?>
</td>
		</tr>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</tbody>
</table--><?php }
}
