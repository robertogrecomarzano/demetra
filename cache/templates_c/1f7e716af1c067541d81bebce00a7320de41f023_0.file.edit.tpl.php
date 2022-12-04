<?php
/* Smarty version 4.2.1, created on 2022-12-02 11:23:13
  from 'D:\wamp\www\square-app\pages\admin\permessi\servizi\templates\edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6389d211182e68_99369552',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1f7e716af1c067541d81bebce00a7320de41f023' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\pages\\admin\\permessi\\servizi\\templates\\edit.tpl',
      1 => 1669976590,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6389d211182e68_99369552 (Smarty_Internal_Template $_smarty_tpl) {
if (!$_smarty_tpl->tpl_vars['src']->value["custom-template"]) {?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_table'][0], array( array('src'=>$_smarty_tpl->tpl_vars['src']->value,'view'=>'edit'),$_smarty_tpl ) );?>

<?php } else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_opening'][0], array( array('action'=>((string)$_smarty_tpl->tpl_vars['siteUrl']->value)."/".((string)$_smarty_tpl->tpl_vars['src']->value['alias'])."/create/".((string)$_smarty_tpl->tpl_vars['pageId']->value)),$_smarty_tpl ) );?>

<div class="row">
	<div class="col-md-8 mb-4">
		<table class="table table-striped mb-0">
			<tbody>
				<tr>
					<td><strong>LABEL_1</strong></td>
					<td><span>HTML_OBJECT_1</span></td>
				</tr>
				<tr>
					<td><strong>LABEL_2</strong></td>
					<td><span>HTML_OBJECT_2</span></td>
				</tr>
				<tr>
					<td><strong>LABEL_N</strong></td>
					<td><span>HTML_OBJECT_N</span></td>
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
<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_closing'][0], array( array('data-method'=>'PUT'),$_smarty_tpl ) );?>

<?php }?>

<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_opening'][0], array( array('action'=>((string)$_smarty_tpl->tpl_vars['siteUrl']->value)."/".((string)$_smarty_tpl->tpl_vars['src']->value['alias'])."/create/".((string)$_smarty_tpl->tpl_vars['pageId']->value)),$_smarty_tpl ) );?>

<div class="row">
	<div class="col-md-8 mb-4">
		<table class="table table-striped mb-0">
			<tbody>
				<tr>
					<td><strong>LABEL_1</strong></td>
					<td><span>HTML_OBJECT_1</span></td>
				</tr>
				<tr>
					<td><strong>LABEL_2</strong></td>
					<td><span>HTML_OBJECT_2</span></td>
				</tr>
				<tr>
					<td><strong>LABEL_N</strong></td>
					<td><span>HTML_OBJECT_N</span></td>
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
<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_closing'][0], array( array('data-method'=>'PUT'),$_smarty_tpl ) );?>

<?php }
}
