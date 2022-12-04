<?php
/* Smarty version 4.2.1, created on 2022-12-03 12:48:41
  from 'D:\wamp\www\square-app\pages\admin\permessi\gruppi\templates\show.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_638b3799025cf4_62728560',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '516d5900ae0a8878de2373a8a67cd439c1f5935d' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\pages\\admin\\permessi\\gruppi\\templates\\show.tpl',
      1 => 1670067259,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_638b3799025cf4_62728560 (Smarty_Internal_Template $_smarty_tpl) {
if (!$_smarty_tpl->tpl_vars['src']->value["custom-template"]) {?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_table'][0], array( array('src'=>$_smarty_tpl->tpl_vars['src']->value,'view'=>'show'),$_smarty_tpl ) );?>

<?php } else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_opening'][0], array( array('action'=>((string)$_smarty_tpl->tpl_vars['siteUrl']->value)."/".((string)$_smarty_tpl->tpl_vars['src']->value['alias'])."/".((string)$_smarty_tpl->tpl_vars['id']->value)),$_smarty_tpl ) );?>

<div class="row">
	<div class="col-md-8 mb-4">
		<table class="table table-striped mb-0">
			<tbody>
				<tr>
					<td><strong>LABEL_1</strong></td>
					<td><span>VALUE_1</span></td>
				</tr>
				<tr>
					<td><strong>LABEL_2</strong></td>
					<td><span>VALUE_2</span></td>
				</tr>
				<tr>
					<td><strong>LABEL_N</strong></td>
					<td><span>VALUE_N</span></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="text-end"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_show_dropdown'][0], array( array(),$_smarty_tpl ) );?>
</div>
<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_closing'][0], array( array(),$_smarty_tpl ) );?>

<?php }
}
}
