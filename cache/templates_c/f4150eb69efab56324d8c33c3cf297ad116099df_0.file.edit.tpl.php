<?php
/* Smarty version 4.2.1, created on 2022-12-02 10:01:46
  from 'D:\wamp\www\square-app\pages\admin\configurazione\templates\edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6389befa570074_59595002',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f4150eb69efab56324d8c33c3cf297ad116099df' => 
    array (
      0 => 'D:\\wamp\\www\\square-app\\pages\\admin\\configurazione\\templates\\edit.tpl',
      1 => 1669971546,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6389befa570074_59595002 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- Profile content row-->
<div class="row gx-5">
	<div class="col-lg-8">
		<!-- Account details card-->
		<div class="card card-raised mb-5">
			<div class="card-body p-5">
				<div class="card-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Dati generali"),$_smarty_tpl ) );?>
</div>
				<div class="card-subtitle mb-4"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Aggiorna i dati generali della piattaforma"),$_smarty_tpl ) );?>
</div>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_opening'][0], array( array(),$_smarty_tpl ) );?>

					<div class="mb-4">
						<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Denominazione'),$_smarty_tpl ) );
$_prefixVariable1=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('iname'=>'denominazione','max'=>45,'mwc'=>true,'label'=>$_prefixVariable1,'outlined'=>true,'required'=>"required",'charcounter'=>''),$_smarty_tpl ) );?>

					</div>
					<!-- Form Row-->
					<div class="row mb-4">
						<!-- Form Group (first name)-->
						<div class="col-md-6">
							<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Sede'),$_smarty_tpl ) );
$_prefixVariable2=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('iname'=>'sede','max'=>45,'mwc'=>true,'label'=>$_prefixVariable2,'outlined'=>true,'charcounter'=>''),$_smarty_tpl ) );?>

						</div>
						<!-- Form Group (last name)-->
						<div class="col-md-6">
							<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Indirizzo web'),$_smarty_tpl ) );
$_prefixVariable3=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('iname'=>'web','max'=>45,'mwc'=>true,'label'=>$_prefixVariable3,'outlined'=>true,'required'=>"required",'charcounter'=>''),$_smarty_tpl ) );?>

						</div>
					</div>
					
					<!-- Form Row-->
					<div class="row mb-4">
						<!-- Form Group (first name)-->
						<div class="col-md-6">
							<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Email'),$_smarty_tpl ) );
$_prefixVariable4=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('iname'=>'email','type'=>'email','max'=>45,'mwc'=>true,'label'=>$_prefixVariable4,'outlined'=>true,'charcounter'=>'','required'=>"required"),$_smarty_tpl ) );?>

						</div>
						<!-- Form Group (last name)-->
						<div class="col-md-6">
							<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Email di supporto tecnico'),$_smarty_tpl ) );
$_prefixVariable5=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('iname'=>'email_support','type'=>'email','max'=>45,'mwc'=>true,'label'=>$_prefixVariable5,'outlined'=>true,'required'=>"required",'charcounter'=>''),$_smarty_tpl ) );?>

						</div>
					</div>
					
					<!-- Form Row-->
					<div class="row mb-4">
						<!-- Form Group (first name)-->
						<div class="col-md-6">
							<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Telefono'),$_smarty_tpl ) );
$_prefixVariable6=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('iname'=>'telefono','max'=>20,'mwc'=>true,'label'=>$_prefixVariable6,'outlined'=>true,'charcounter'=>''),$_smarty_tpl ) );?>

						</div>
						<!-- Form Group (last name)-->
						<div class="col-md-6">
							<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Attivare la modalità di DEBUG'),$_smarty_tpl ) );
$_prefixVariable7=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('iname'=>'is_debug','mwc'=>true,'label'=>$_prefixVariable7,'switch'=>true),$_smarty_tpl ) );?>

							<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Mettere il sistema in manutenzione'),$_smarty_tpl ) );
$_prefixVariable8=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('iname'=>'is_offline','mwc'=>true,'label'=>$_prefixVariable8,'switch'=>true),$_smarty_tpl ) );?>

							<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Impostare il sistema come Collaudo'),$_smarty_tpl ) );
$_prefixVariable9=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('iname'=>'is_collaudo','mwc'=>true,'label'=>$_prefixVariable9,'switch'=>true),$_smarty_tpl ) );?>

						</div>
					</div>
					
					<div class="text-end">
						<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Salva dati generali'),$_smarty_tpl ) );
$_prefixVariable10=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_submit'][0], array( array('value'=>$_prefixVariable10,'img'=>'save','onclick'=>"setConfig(this);"),$_smarty_tpl ) );?>

					</div>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_closing'][0], array( array('data-method'=>'PUT','data-action'=>'update'),$_smarty_tpl ) );?>

			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<!-- Change password card-->
		<div class="card card-raised mb-5">
			<div class="card-body p-5">
				<div class="card-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Gestione posta elettronica"),$_smarty_tpl ) );?>
</div>
				<div class="card-subtitle mb-4"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>"Impostare i parametri del server di posta elettronia"),$_smarty_tpl ) );?>
</div>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_opening'][0], array( array(),$_smarty_tpl ) );?>

					<div class="mb-4">
						<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'ABILITARE INVIO DELLE EMAIL'),$_smarty_tpl ) );
$_prefixVariable11=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('iname'=>'mail_enable','mwc'=>true,'label'=>$_prefixVariable11,'switch'=>true),$_smarty_tpl ) );?>

						
					</div>
					<div class="mb-4">
						<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Invio tramite server SMTP'),$_smarty_tpl ) );
$_prefixVariable12=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('iname'=>'mail_smtp','mwc'=>true,'label'=>$_prefixVariable12,'switch'=>true),$_smarty_tpl ) );?>

					</div>
					<div class="mb-4">
						<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Nome del server SMTP'),$_smarty_tpl ) );
$_prefixVariable13=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('mdc'=>true,'iname'=>'mail_smtp_server','placeholder'=>$_prefixVariable13,'outlined'=>true),$_smarty_tpl ) );?>

					</div>
					<div class="mb-4">
						<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Richiesta autenticazione?'),$_smarty_tpl ) );
$_prefixVariable14=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('iname'=>'mail_smtp_auth','label'=>$_prefixVariable14),$_smarty_tpl ) );?>

					</div>
					<div class="mb-4">
						<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Nome utente'),$_smarty_tpl ) );
$_prefixVariable15=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('mdc'=>true,'iname'=>'mail_smtp_user','placeholder'=>$_prefixVariable15,'outlined'=>true),$_smarty_tpl ) );?>

					</div>
					<div class="mb-4">
						<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Password'),$_smarty_tpl ) );
$_prefixVariable16=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('mdc'=>true,'iname'=>'mail_smtp_password','placeholder'=>$_prefixVariable16,'outlined'=>true),$_smarty_tpl ) );?>

					</div>
					<div class="mb-4">
						<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Porta del server SMTP'),$_smarty_tpl ) );
$_prefixVariable17=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_tbox'][0], array( array('mdc'=>true,'iname'=>'mail_smtp_port','max'=>5,'placeholder'=>$_prefixVariable17,'outlined'=>true),$_smarty_tpl ) );?>

					</div>
					<div class="mb-4">
						<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Prevista crittografia?'),$_smarty_tpl ) );
$_prefixVariable18=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_check'][0], array( array('iname'=>'mail_smtp_secure','label'=>$_prefixVariable18),$_smarty_tpl ) );?>

					</div>
					<div class="mb-4">
						<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Tipo di crittografia'),$_smarty_tpl ) );
$_prefixVariable19=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_select'][0], array( array('iname'=>'mail_smtp_secure_type','src'=>array("ssl"=>"SSL","tls"=>"TLS","starttls"=>"STARTTLS"),'first'=>true,'outlined'=>true,'placeholder'=>$_prefixVariable19),$_smarty_tpl ) );?>

					</div>
					<div class="mb-4">
						<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Livello di debug'),$_smarty_tpl ) );
$_prefixVariable20=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_select'][0], array( array('iname'=>'mail_smtp_debug','src'=>$_smarty_tpl->tpl_vars['debugs']->value,'outlined'=>true,'placeholder'=>$_prefixVariable20,'class'=>"w-100",'first'=>true),$_smarty_tpl ) );?>

					</div>
					<div class="text-end">
						<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_lang'][0], array( array('value'=>'Salva parametri email'),$_smarty_tpl ) );
$_prefixVariable21=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_submit'][0], array( array('value'=>$_prefixVariable21,'img'=>'save','onclick'=>"setConfig(this);"),$_smarty_tpl ) );?>

					</div>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_closing'][0], array( array('data-method'=>'PUT','data-action'=>'email'),$_smarty_tpl ) );?>

				
			</div>
		</div>

	</div>

	<div class="text-end"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_link'][0], array( array('href'=>((string)$_smarty_tpl->tpl_vars['siteUrl']->value)."/".((string)$_smarty_tpl->tpl_vars['alias']->value),'type'=>'button','img'=>"undo",'text'=>true,'value'=>"Indietro"),$_smarty_tpl ) );?>
</div>
</div>

<?php }
}
