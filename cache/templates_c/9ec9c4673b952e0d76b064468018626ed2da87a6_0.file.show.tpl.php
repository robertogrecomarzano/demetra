<?php
/* Smarty version 4.2.1, created on 2022-12-02 11:28:07
  from 'D:\wamp\www\square-app\pages\admin\permessi\servizi\templates\show.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6389d33778c940_96141007',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9ec9c4673b952e0d76b064468018626ed2da87a6' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\pages\\admin\\permessi\\servizi\\templates\\show.tpl',
      1 => 1669976877,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6389d33778c940_96141007 (Smarty_Internal_Template $_smarty_tpl) {
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
