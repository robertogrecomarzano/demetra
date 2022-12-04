<?php
/* Smarty version 4.2.1, created on 2022-11-09 16:02:09
  from 'D:\wamp\www\square-app\core\templates\mail\footer_mail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_636bc0f1bcad19_52867792',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0778e6fd5b2793272f6e3232b075441954345560' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\core\\templates\\mail\\footer_mail.tpl',
      1 => 1639752726,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_636bc0f1bcad19_52867792 (Smarty_Internal_Template $_smarty_tpl) {
?></div>
<!-- Chiusara del tag aperto in header_mail.tpl -->
<p>
	<span style='font-size: 12.0pt; color: #00589A'><?php echo $_smarty_tpl->tpl_vars['info']->value['denominazione'];?>
</span>
	<br /> <span style='color: #555555'><?php echo $_smarty_tpl->tpl_vars['info']->value['sede'];?>
</span> <br /> <span
		style='color: #555555'>Telefono <?php echo $_smarty_tpl->tpl_vars['info']->value['tel'];?>
</span> <br /> <span
		style='color: #555555'>E-mail <a
		style='color: #00589A; text-decoration: none;'
		href="mailto:<?php echo $_smarty_tpl->tpl_vars['info']->value['email'];?>
"> <?php echo $_smarty_tpl->tpl_vars['info']->value['email'];?>
</a></span>
</p>

<p style='font-size: 9pt;'>Titolare del trattamento dei dati personali è
	<?php echo $_smarty_tpl->tpl_vars['info']->value['denominazione'];?>
, con sede legale in <?php echo $_smarty_tpl->tpl_vars['info']->value['sede'];?>
. Informativa
	completa disponibile sul sito <?php echo $_smarty_tpl->tpl_vars['info']->value['sito_web'];?>
.</p><?php }
}
