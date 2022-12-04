<?php
/* Smarty version 4.2.1, created on 2022-11-29 10:16:49
  from 'D:\wamp\www\square-app\core\templates\head.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6385ce01608fd4_80587499',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '73b6883bcf53a699e99d3f51902e815ef6cefcdb' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\core\\templates\\head.tpl',
      1 => 1669713402,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6385ce01608fd4_80587499 (Smarty_Internal_Template $_smarty_tpl) {
?><meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="" />
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>

<!-- Load Favicon-->
<link href="assets/img/favicon.ico" rel="shortcut icon" type="image/x-icon" />

<!-- Load Material Icons from Google Fonts-->
<link
	href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />

<!-- Load Simple DataTables Stylesheet-->
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />

<!-- Roboto and Roboto Mono fonts from Google Fonts-->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Roboto+Mono:400,500" rel="stylesheet" />

<!-- Load main stylesheet-->
<link href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/css/styles.css" rel="stylesheet" />

<!-- Text Color Stylesheet-->
<link href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/css/text-color.css" rel="stylesheet" />

<!-- Custom Stylesheet-->
<link href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/css/custom.css" rel="stylesheet" />

<!-- Load Font Awesome Icons Stylesheet-->
<link href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/vendor/fontawesome-free-6.2.1-web/css/all.css" rel="stylesheet" />

<?php echo $_smarty_tpl->tpl_vars['css']->value;?>



<!-- Required styles for Material Web -->
<link rel="stylesheet" href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">
  <?php }
}
