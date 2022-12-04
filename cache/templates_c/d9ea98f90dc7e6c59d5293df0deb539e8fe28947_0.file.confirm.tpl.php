<?php
/* Smarty version 4.2.1, created on 2022-11-15 17:48:02
  from 'D:\wamp\www\square-app\core\templates\mail\authentication\confirm.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6373c2c212ce53_20118508',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd9ea98f90dc7e6c59d5293df0deb539e8fe28947' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\core\\templates\\mail\\authentication\\confirm.tpl',
      1 => 1668530879,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6373c2c212ce53_20118508 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['siteRoot']->value)."/core/templates/mail/header_mail.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
<p>
	Per confermare la registrazione clicca sul seguente link <a
		href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/authentication/confirm?token=<?php echo $_smarty_tpl->tpl_vars['params']->value['token'];?>
"><?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/authentication/confirm?token=<?php echo $_smarty_tpl->tpl_vars['params']->value['token'];?>
</a>
</p>
<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['siteRoot']->value)."/core/templates/mail/footer_mail.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
