<?php
/* Smarty version 4.2.1, created on 2022-11-29 10:32:03
  from 'D:\wamp\www\square-app\core\templates\foot.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6385d193d37199_85480994',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '35c2c948e4ebd5bab6f6cccbeb42e29d8a05c123' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\core\\templates\\foot.tpl',
      1 => 1669714218,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6385d193d37199_85480994 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- Load Bootstrap JS bundle-->
<?php echo '<script'; ?>
	src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"><?php echo '</script'; ?>
>

<!-- Load global scripts-->
<?php echo '<script'; ?>
 type="module" src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/js/material.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/js/scripts.js"><?php echo '</script'; ?>
>

<!-- JQuery -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/vendor/jquery/jquery-3.3.1.min.js"><?php echo '</script'; ?>
>

<!-- Bootbox dialog boxes JavaScript -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/vendor/bootbox/bootbox.min.js"><?php echo '</script'; ?>
>

<!-- Required Material Web JavaScript library -->
<?php echo '<script'; ?>
 src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"><?php echo '</script'; ?>
>
<!-- Instantiate single textfield component rendered in the document -->

<!-- Attach mdc event to mdc components -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/js/mdc-attach.js"><?php echo '</script'; ?>
>
   

<?php echo $_smarty_tpl->tpl_vars['js']->value;
}
}
