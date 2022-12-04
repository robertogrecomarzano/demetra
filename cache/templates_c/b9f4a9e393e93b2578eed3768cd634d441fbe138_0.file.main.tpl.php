<?php
/* Smarty version 4.2.1, created on 2022-11-07 16:10:43
  from 'D:\wamp\www\square-app\pages\admin\configurazione\templates\main.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63691ff3d0ced2_86672471',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b9f4a9e393e93b2578eed3768cd634d441fbe138' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\pages\\admin\\configurazione\\templates\\main.tpl',
      1 => 1643638627,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63691ff3d0ced2_86672471 (Smarty_Internal_Template $_smarty_tpl) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_opening'][0], array( array('class'=>"form-horizontal"),$_smarty_tpl ) );?>

	<div class="form-group">
		<label class="control-label col-md-6 col-sm-6 col-xs-12">Email<span class="help-block">indirizzo email supporto tecnico</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('size'=>45,'iname'=>'email_support','writable'=>$_smarty_tpl->tpl_vars['isWritable']->value),$_smarty_tpl ) );?>
</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-6 col-sm-6 col-xs-12">Indirizzo web<span class="help-block">sito web del software</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('size'=>45,'iname'=>'web','writable'=>$_smarty_tpl->tpl_vars['isWritable']->value),$_smarty_tpl ) );?>
</div>
	</div>
	
	<div class="form-group">
		<label class="control-label col-md-6 col-sm-6 col-xs-12">Offline</label>
		<div class="col-md-6 col-sm-6 col-xs-12"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('iname'=>'offline','writable'=>$_smarty_tpl->tpl_vars['isWritable']->value,'label'=>"spuntare per mettere il servizio offline"),$_smarty_tpl ) );?>
</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-6 col-sm-6 col-xs-12">Debug</label>
		<div class="col-md-6 col-sm-6 col-xs-12"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('iname'=>'debug','writable'=>$_smarty_tpl->tpl_vars['isWritable']->value,'label'=>"spuntare per attivare il debug"),$_smarty_tpl ) );?>
</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-6 col-sm-6 col-xs-12">Collaudo</label>
		<div class="col-md-6 col-sm-6 col-xs-12"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('iname'=>'collaudo','writable'=>$_smarty_tpl->tpl_vars['isWritable']->value,'label'=>"spuntare se si tratta di una installazione di collaudo"),$_smarty_tpl ) );?>
</div>
	</div>

<div class='btn-group'><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_button'][0], array( array('iname'=>'conferma','onclick'=>"setConfig(this,".((string)$_smarty_tpl->tpl_vars['pkValue']->value).");",'class'=>'btn btn-primary','text'=>true,'value'=>"Conferma"),$_smarty_tpl ) );?>
</div>
<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_closing'][0], array( array(),$_smarty_tpl ) );?>

<?php }
}
