
<!-- Profile content row-->
<div class="row gx-5">
	<div class="col-lg-8">
		<!-- Account details card-->
		<div class="card card-raised mb-5">
			<div class="card-body p-5">
				<div class="card-title">{form_lang value="Dati generali"}</div>
				<div class="card-subtitle mb-4">{form_lang value="Aggiorna i dati generali della piattaforma"}</div>
					{form_opening}
					<div class="mb-4">
						{form_tbox iname='denominazione' max=45 mwc=true label="{form_lang value='Denominazione'}" outlined=true required="required" charcounter=""}
					</div>
					<!-- Form Row-->
					<div class="row mb-4">
						<!-- Form Group (first name)-->
						<div class="col-md-6">
							{form_tbox iname='sede' max=45 mwc=true label="{form_lang value='Sede'}" outlined=true charcounter=""}
						</div>
						<!-- Form Group (last name)-->
						<div class="col-md-6">
							{form_tbox iname='web' max=45 mwc=true label="{form_lang value='Indirizzo web'}" outlined=true required="required" charcounter=""}
						</div>
					</div>
					
					<!-- Form Row-->
					<div class="row mb-4">
						<!-- Form Group (first name)-->
						<div class="col-md-6">
							{form_tbox iname='email' type='email' max=45 mwc=true label="{form_lang value='Email'}" outlined=true charcounter="" required="required"}
						</div>
						<!-- Form Group (last name)-->
						<div class="col-md-6">
							{form_tbox iname='email_support' type='email' max=45 mwc=true label="{form_lang value='Email di supporto tecnico'}" outlined=true required="required" charcounter=""}
						</div>
					</div>
					
					<!-- Form Row-->
					<div class="row mb-4">
						<!-- Form Group (first name)-->
						<div class="col-md-6">
							{form_tbox iname='telefono' max=20 mwc=true label="{form_lang value='Telefono'}" outlined=true charcounter=""}
						</div>
						<!-- Form Group (last name)-->
						<div class="col-md-6">
							{form_check iname='is_debug' mwc=true label="{form_lang value='Attivare la modalità di DEBUG'}" switch=true}
							{form_check iname='is_offline' mwc=true label="{form_lang value='Mettere il sistema in manutenzione'}" switch=true}
							{form_check iname='is_collaudo' mwc=true label="{form_lang value='Impostare il sistema come Collaudo'}" switch=true}
						</div>
					</div>
					
					<div class="text-end">
						{form_submit value="{form_lang value='Salva dati generali'}" img='save' onclick="setConfig(this);"}
					</div>
					{form_closing data-method='PUT' data-action='update'}
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<!-- Change password card-->
		<div class="card card-raised mb-5">
			<div class="card-body p-5">
				<div class="card-title">{form_lang value="Gestione posta elettronica"}</div>
				<div class="card-subtitle mb-4">{form_lang value="Impostare i parametri del server di posta elettronia"}</div>
					{form_opening}
					<div class="mb-4">
						{form_check iname='mail_enable' mwc=true label="{form_lang value='ABILITARE INVIO DELLE EMAIL'}" switch=true}
						
					</div>
					<div class="mb-4">
						{form_check iname='mail_smtp' mwc=true label="{form_lang value='Invio tramite server SMTP'}" switch=true}
					</div>
					<div class="mb-4">
						{form_tbox mdc=true iname='mail_smtp_server' placeholder="{form_lang value='Nome del server SMTP'}" outlined=true}
					</div>
					<div class="mb-4">
						{form_check iname='mail_smtp_auth' label="{form_lang value='Richiesta autenticazione?'}"}
					</div>
					<div class="mb-4">
						{form_tbox mdc=true iname='mail_smtp_user' placeholder="{form_lang value='Nome utente'}" outlined=true}
					</div>
					<div class="mb-4">
						{form_tbox mdc=true iname='mail_smtp_password' placeholder="{form_lang value='Password'}" outlined=true}
					</div>
					<div class="mb-4">
						{form_tbox mdc=true iname='mail_smtp_port' max=5 placeholder="{form_lang value='Porta del server SMTP'}" outlined=true}
					</div>
					<div class="mb-4">
						{form_check iname='mail_smtp_secure' label="{form_lang value='Prevista crittografia?'}"}
					</div>
					<div class="mb-4">
						{form_select iname='mail_smtp_secure_type' src=["ssl"=>"SSL","tls"=>"TLS","starttls"=>"STARTTLS"]  first=true outlined=true placeholder="{form_lang value='Tipo di crittografia'}"}
					</div>
					<div class="mb-4">
						{form_select iname='mail_smtp_debug' src=$debugs  outlined=true placeholder="{form_lang value='Livello di debug'}" class="w-100" first=true}
					</div>
					<div class="text-end">
						{form_submit value="{form_lang value='Salva parametri email'}" img='save' onclick="setConfig(this);"}
					</div>
					{form_closing data-method='PUT' data-action='email'}
				
			</div>
		</div>

	</div>

	<div class="text-end">{form_link href="{$siteUrl}/{$alias}" type='button' img="undo" text=true value="Indietro"}</div>
</div>

