<?php
/* Smarty version 4.2.1, created on 2022-11-05 17:48:24
  from 'D:\wamp\www\square-app\pages\user\templates\main.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_636693d8493540_54607976',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '17dae62b69b5403971531ec26767f1e38bd39fe4' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\pages\\user\\templates\\main.tpl',
      1 => 1662544056,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_636693d8493540_54607976 (Smarty_Internal_Template $_smarty_tpl) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_opening'][0], array( array('class'=>"col-lg-8 col-md-offset-2"),$_smarty_tpl ) );?>

	<div class="row">

		<div class="col-lg-6">
			<h3>Dati utente</h3>
			<div class="form-group input-group">
				<span class="input-group-addon"><i class='fas fa-user'></i></span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('iname'=>'cognome','size'=>30,'max'=>45,'tabindex'=>'1','placeholder'=>"Cognome",'required'=>''),$_smarty_tpl ) );?>

			</div>
			<div class="form-group input-group">
				<span class="input-group-addon"><i class='fas fa-user'></i></span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('iname'=>'nome','size'=>30,'max'=>45,'tabindex'=>'2','placeholder'=>"Nome",'required'=>''),$_smarty_tpl ) );?>

			</div>
			<div class="form-group input-group">
				<span class="input-group-addon">@</span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('iname'=>'email','size'=>30,'max'=>45,'tabindex'=>'11','placeholder'=>'Indirizzo email','type'=>'email','required'=>"email"),$_smarty_tpl ) );?>

			</div>
			<?php echo $_smarty_tpl->tpl_vars['captcha']->value;?>

		</div>
		<!-- /.col-lg-4 (nested) -->


		<div class="col-lg-6">
			<h3>Dati di accesso</h3>
			<div class="form-group input-group">
				<span class="input-group-addon"><i class='fas fa-user-secret'></i></span>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('iname'=>'username','size'=>20,'max'=>45,'tabindex'=>'13','placeholder'=>'Username','required'=>''),$_smarty_tpl ) );?>

			</div>

			<div class="form-group input-group">
				<span class="input-group-addon"><i class='fas fa-key'></i></span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('iname'=>'password','size'=>20,'max'=>45,'tabindex'=>'14','placeholder'=>'Password','type'=>'password','required'=>''),$_smarty_tpl ) );?>

			</div>
			<div class="form-group input-group">
				<span class="input-group-addon"><i class='fas fa-key'></i></span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('iname'=>'password2','size'=>20,'max'=>45,'tabindex'=>'15','placeholder'=>'Conferma password','type'=>'password','required'=>''),$_smarty_tpl ) );?>

			</div>
			<label class='alert alert-info'>La password deve contenere almeno:
				<ul>
					<li>un numero</li>
					<li>un carattere minuscolo</li>
					<li>un carattere maiuscolo</li>
					<li>un carattere compreso tra <b class='text text-muted'>!.@#$%</b></li>
					<li>avere lunghezza tra 8 e 20 caratteri</li>
				</ul>
			</label>
		</div>


	</div>
	<div class="btn-group"><input type='submit' name=signup ' value='Conferma dati' onclick='return Check(this);' class="btn btn-primary" /></div>
<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_closing'][0], array( array(),$_smarty_tpl ) );
}
}
