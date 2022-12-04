<?php
/* Smarty version 4.2.1, created on 2022-11-09 17:23:14
  from 'D:\wamp\www\square-app\core\templates\mail\registrazione.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_636bd3f2ea6e45_32344347',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2a3a9c65d7d3bfc37612676edde663e3f0d50611' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\core\\templates\\mail\\registrazione.tpl',
      1 => 1638266962,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_636bd3f2ea6e45_32344347 (Smarty_Internal_Template $_smarty_tpl) {
?><p>
	Gentile <?php echo $_smarty_tpl->tpl_vars['params']->value['nominativo'];?>
, <br /> per accedere utilizzare le
	seguenti credenziali.<br /> Username: <b><?php echo $_smarty_tpl->tpl_vars['params']->value['username'];?>
</b><br />
	Password: <b><?php echo $_smarty_tpl->tpl_vars['params']->value['password'];?>
</b>
</p>
Grazie
<?php }
}
