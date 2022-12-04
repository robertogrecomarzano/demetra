<?php
/* Smarty version 4.2.1, created on 2022-12-02 17:22:35
  from 'D:\wamp\www\square-app\core\templates\mail\authentication\credenziali.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_638a264befc964_75365947',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b0d7e07ae6b5c7d72f6651190cc2a3eb5c2adbca' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\core\\templates\\mail\\authentication\\credenziali.tpl',
      1 => 1638266804,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_638a264befc964_75365947 (Smarty_Internal_Template $_smarty_tpl) {
?><p>
	Procedura di recupero dati di accesso terminata correttamente.<br />Le credenziali di accesso sono le seguenti.<br />
	Username: <b><?php echo $_smarty_tpl->tpl_vars['params']->value['username'];?>
</b><br />
	Password: <b><?php echo $_smarty_tpl->tpl_vars['params']->value['password'];?>
</b>
</p><?php }
}
