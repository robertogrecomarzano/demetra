<?php
/* Smarty version 4.2.1, created on 2022-12-01 10:48:53
  from 'D:\wamp\www\square-app\pages\user\templates\edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6388788510cb01_95470796',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7b4cf402a7c8655e325fad57e3b06e74730196d0' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\pages\\user\\templates\\edit.tpl',
      1 => 1669888120,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6388788510cb01_95470796 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- Profile content row-->
<div class="row gx-5">
	<div class="col-lg-8">
		<!-- Account details card-->
		<div class="card card-raised mb-5">
			<div class="card-body p-5">
				<div class="card-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Dettagli account"),$_smarty_tpl ) );?>
</div>
				<div class="card-subtitle mb-4"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Aggiorna i tuoi dati"),$_smarty_tpl ) );?>
</div>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_opening'][0], array( array(),$_smarty_tpl ) );?>

					<div class="mb-4">
						<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Indirizzo email'),$_smarty_tpl ) );
$_prefixVariable1=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('type'=>'email','iname'=>'email','max'=>45,'mwc'=>true,'label'=>$_prefixVariable1,'outlined'=>true,'required'=>"required"),$_smarty_tpl ) );?>

					</div>
					<!-- Form Row-->
					<div class="row mb-4">
						<!-- Form Group (first name)-->
						<div class="col-md-6">
							<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Cognome'),$_smarty_tpl ) );
$_prefixVariable2=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('iname'=>'cognome','max'=>45,'mwc'=>true,'label'=>$_prefixVariable2,'outlined'=>true,'required'=>"required"),$_smarty_tpl ) );?>

						</div>
						<!-- Form Group (last name)-->
						<div class="col-md-6">
							<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Nome'),$_smarty_tpl ) );
$_prefixVariable3=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('iname'=>'nome','max'=>45,'mwc'=>true,'label'=>$_prefixVariable3,'outlined'=>true,'required'=>"required"),$_smarty_tpl ) );?>

						</div>
					</div>

					
					<!-- Save changes button-->
					<div class="text-end">
						<?php ob_start();
echo $_smarty_tpl->tpl_vars['pageId']->value;
$_prefixVariable4 = ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_edit_dropdown'][0], array( array('action_id'=>$_prefixVariable4,'annulla'=>false),$_smarty_tpl ) );?>
  
					</div>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_closing'][0], array( array('data-method'=>'PUT'),$_smarty_tpl ) );?>

			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<!-- Change password card-->
		<div class="card card-raised mb-5">
			<div class="card-body p-5">
				<div class="card-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Cambio Password"),$_smarty_tpl ) );?>
</div>
					<div class="alert alert-info">
						<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Deve contenere"),$_smarty_tpl ) );?>
</span>
						<ul>
							<li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"un numero"),$_smarty_tpl ) );?>
</li>
							<li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"un carattere minuscolo"),$_smarty_tpl ) );?>
</li>
							<li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"un carattere maiuscolo"),$_smarty_tpl ) );?>
</li>
							<li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"un carattere compreso tra "),$_smarty_tpl ) );?>
<b class='text text-muted'>!.@#$%</b></li>
							<li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"avere lunghezza tra 8 e 20 caratteri"),$_smarty_tpl ) );?>
</li>
						</ul>
					</div>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_opening'][0], array( array(),$_smarty_tpl ) );?>

					<div class="mb-4">
						<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Password attuale'),$_smarty_tpl ) );
$_prefixVariable5=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('mdc'=>true,'iname'=>'password_old','type'=>'password','placeholder'=>$_prefixVariable5,'outlined'=>true,'img'=>"visibility_off",'required'=>"required"),$_smarty_tpl ) );?>

					</div>
					<div class="mb-4">
						<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Nuova password'),$_smarty_tpl ) );
$_prefixVariable6=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('mdc'=>true,'iname'=>'password','type'=>'password','placeholder'=>$_prefixVariable6,'outlined'=>true,'img'=>"visibility_off",'required'=>"required"),$_smarty_tpl ) );?>

					</div>
					<div class="mb-4">
						<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Conferma nuova password'),$_smarty_tpl ) );
$_prefixVariable7=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('mdc'=>true,'iname'=>'password2','type'=>'password','placeholder'=>$_prefixVariable7,'outlined'=>true,'img'=>"visibility_off",'required'=>"required"),$_smarty_tpl ) );?>

					</div>
					<div class="text-end">
						<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Resetta Password'),$_smarty_tpl ) );
$_prefixVariable8=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_submit'][0], array( array('value'=>$_prefixVariable8,'img'=>'save','onclick'=>"check(this);"),$_smarty_tpl ) );?>

					</div>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_closing'][0], array( array('data-method'=>'PUT','data-action'=>'password'),$_smarty_tpl ) );?>

				
			</div>
		</div>

	</div>

	<div class="text-end"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_link'][0], array( array('href'=>((string)$_smarty_tpl->tpl_vars['siteUrl']->value)."/".((string)$_smarty_tpl->tpl_vars['alias']->value)."/".((string)$_smarty_tpl->tpl_vars['pageId']->value),'type'=>'button','img'=>"undo",'text'=>true,'value'=>"Indietro"),$_smarty_tpl ) );?>
</div>
</div>

<?php }
}
