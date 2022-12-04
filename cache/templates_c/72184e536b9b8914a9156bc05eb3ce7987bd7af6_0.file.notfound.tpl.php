<?php
/* Smarty version 4.2.1, created on 2022-11-07 19:36:14
  from 'D:\wamp\www\square-app\core\templates\tpl\notfound.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6369501e957c28_18911254',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '72184e536b9b8914a9156bc05eb3ce7987bd7af6' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\core\\templates\\tpl\\notfound.tpl',
      1 => 1667846135,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6369501e957c28_18911254 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="<?php echo substr(App\Core\Config::$defaultLocale,0,2);?>
">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
">
<link
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
	rel="stylesheet">
<link href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
/core/templates/css/error.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato:100"
	rel="stylesheet" type="text/css">
</head>
<title>Event not found</title>
<body>

	<div class="site-wrapper">

		<div class="site-wrapper-inner">

			<div class="cover-container">

				<div class="inner cover">
					<div class="title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Risorsa non trovata"),$_smarty_tpl ) );?>
</div>
					<p class="lead">
						<a href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
" class="btn btn-lg btn-default">Home</a>
					</p>
				</div>

			</div>

		</div>

	</div>


</body>

</html><?php }
}
