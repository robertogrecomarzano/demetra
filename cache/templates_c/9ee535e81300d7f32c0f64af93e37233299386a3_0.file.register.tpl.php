<?php
/* Smarty version 4.2.1, created on 2022-11-15 17:45:06
  from 'D:\wamp\www\square-app\core\templates\mail\authentication\register.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6373c2125ec053_39791172',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9ee535e81300d7f32c0f64af93e37233299386a3' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\core\\templates\\mail\\authentication\\register.tpl',
      1 => 1668530694,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6373c2125ec053_39791172 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['siteRoot']->value)."/core/templates/mail/header_mail.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
<p>
	The registration on the Portal <b><?php echo $_smarty_tpl->tpl_vars['sitename']->value;?>
</b> was successful.<br />To
	To log in use the following username: <b><?php echo $_smarty_tpl->tpl_vars['params']->value['username'];?>
</b>
</p>
The password will be sent in a separate email.
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['siteRoot']->value)."/core/templates/mail/footer_mail.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
