<?php
/* Smarty version 4.2.1, created on 2022-12-05 10:25:17
  from 'D:\wamp\www\square-app\pages\prova\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_638db8fd065ac6_87646753',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '53fa949b50c876b8603a67382906366e83724b33' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\pages\\prova\\templates\\index.tpl',
      1 => 1670232305,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_638db8fd065ac6_87646753 (Smarty_Internal_Template $_smarty_tpl) {
if (!$_smarty_tpl->tpl_vars['src']->value["custom-template"]) {?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_table'][0], array( array('src'=>$_smarty_tpl->tpl_vars['src']->value,'view'=>'index'),$_smarty_tpl ) );?>

<?php } else { ?>
<div class='btn btn-group'><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_link'][0], array( array('value'=>$_smarty_tpl->tpl_vars['src']->value['title'],'text'=>true,'img'=>"add",'title'=>$_smarty_tpl->tpl_vars['src']->value['title'],'class'=>"btn btn-primary",'writable'=>$_smarty_tpl->tpl_vars['src']->value['writable'],'href'=>((string)$_smarty_tpl->tpl_vars['siteUrl']->value)."/".((string)$_smarty_tpl->tpl_vars['src']->value['alias'])."/create"),$_smarty_tpl ) );?>
</div>
	<table	class="table table-striped table-hover dataTable no-footer dtr-inline"	id="dataTables">
	<thead>
		<th></th>
		<th>LABEL_1</th>
		<th>LABEL_2</th>
		<th>LABEL_N</th>
	</thead>
	<tbody>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['src']->value['rows'], 'r');
$_smarty_tpl->tpl_vars['r']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['r']->value) {
$_smarty_tpl->tpl_vars['r']->do_else = false;
?>
		<tr>
			<td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_link'][0], array( array('href'=>((string)$_smarty_tpl->tpl_vars['siteUrl']->value)."/".((string)$_smarty_tpl->tpl_vars['src']->value['alias'])."/".((string)$_smarty_tpl->tpl_vars['r']->value[$_smarty_tpl->tpl_vars['src']->value['pk']]),'img'=>'visibility','class'=>"btn btn-primary"),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_link'][0], array( array('href'=>((string)$_smarty_tpl->tpl_vars['siteUrl']->value)."/".((string)$_smarty_tpl->tpl_vars['src']->value['alias'])."/".((string)$_smarty_tpl->tpl_vars['r']->value[$_smarty_tpl->tpl_vars['src']->value['pk']])."/edit",'img'=>'edit','class'=>"btn btn-warning"),$_smarty_tpl ) );
ob_start();
echo $_smarty_tpl->tpl_vars['r']->value[$_smarty_tpl->tpl_vars['src']->value['pk']];
$_prefixVariable1 = ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_delete'][0], array( array('id'=>$_prefixVariable1,'leading-icon'=>false),$_smarty_tpl ) );?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['r']->value['FIELD_1'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['r']->value['FIELD_2'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['r']->value['FIELD_N'];?>
</td>
		</tr>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</tbody>
</table>
<?php }
}
}
