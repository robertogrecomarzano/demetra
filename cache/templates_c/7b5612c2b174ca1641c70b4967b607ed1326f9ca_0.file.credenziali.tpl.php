<?php
/* Smarty version 4.2.1, created on 2022-11-30 12:27:44
  from 'D:\wamp\www\square-app\core\templates\mail\credenziali.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_63873e30a5b268_96733835',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7b5612c2b174ca1641c70b4967b607ed1326f9ca' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\core\\templates\\mail\\credenziali.tpl',
      1 => 1638266804,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63873e30a5b268_96733835 (Smarty_Internal_Template $_smarty_tpl) {
?><p>
	Procedura di recupero dati di accesso terminata correttamente.<br />Le credenziali di accesso sono le seguenti.<br />
	Username: <b><?php echo $_smarty_tpl->tpl_vars['params']->value['username'];?>
</b><br />
	Password: <b><?php echo $_smarty_tpl->tpl_vars['params']->value['password'];?>
</b>
</p><?php }
}
