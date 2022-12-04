<?php
/* Smarty version 4.2.1, created on 2022-11-09 16:02:09
  from 'D:\wamp\www\square-app\core\templates\mail\header_mail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_636bc0f1b9ef44_22061376',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ad95c81eb15daba79c661fb86455aa84d9d2dab8' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\core\\templates\\mail\\header_mail.tpl',
      1 => 1637255684,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_636bc0f1b9ef44_22061376 (Smarty_Internal_Template $_smarty_tpl) {
?><link
	href="https://fonts.googleapis.com/css?family=Cormorant+Garamond|Eczar|Gentium+Basic|Libre+Baskerville|Libre+Franklin|Proza+Libre|Rubik|Taviraj|Trirong|Work+Sans"
	rel="stylesheet" type="text/css">
<style>
body, p {
	color: #555555;
}

p.title {
	font-family: 'Cormorant Garamond', serif;
	font-size: 2em;
	color: #9b2018;
	font-weight: bolder;
}
</style>
<div style='clear: both;'>
	<div style='float: left; vertical-align: middle;'>
		<img src="data:image/png;base64,<?php echo $_smarty_tpl->tpl_vars['logo_base64']->value;?>
" height="80px" alt="<?php echo $_smarty_tpl->tpl_vars['info']->value['denominazione'];?>
"/>
	</div>
</div>
<div style='clear: both;'>
	<!-- Questo tag verrà chiudo da footer_mail.tpl --><?php }
}
