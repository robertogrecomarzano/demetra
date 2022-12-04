
<!-- Profile content row-->
<div class="row gx-5">
	<div class="col-lg-8">
		<!-- Account details card-->
		<div class="card card-raised mb-5">
			<div class="card-body p-5">
				<div class="card-title">{form_lang value="Dettagli account"}</div>
				<div class="card-subtitle mb-4">{form_lang value="Aggiorna i tuoi dati"}</div>
					{form_opening}
					<div class="mb-4">
						{form_tbox type='email' iname='email' max=45 mwc=true label="{form_lang value='Indirizzo email'}" outlined=true required="required"}
					</div>
					<!-- Form Row-->
					<div class="row mb-4">
						<!-- Form Group (first name)-->
						<div class="col-md-6">
							{form_tbox iname='cognome' max=45 mwc=true label="{form_lang value='Cognome'}" outlined=true required="required"}
						</div>
						<!-- Form Group (last name)-->
						<div class="col-md-6">
							{form_tbox iname='nome' max=45 mwc=true label="{form_lang value='Nome'}" outlined=true required="required"}
						</div>
					</div>

					
					<!-- Save changes button-->
					<div class="text-end">
						{form_edit_dropdown action_id={$pageId} annulla=false}  
					</div>
					{form_closing data-method='PUT'}
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<!-- Change password card-->
		<div class="card card-raised mb-5">
			<div class="card-body p-5">
				<div class="card-title">{form_lang value="Cambio Password"}</div>
					<div class="alert alert-info">
						<span>{form_lang value="Deve contenere"}</span>
						<ul>
							<li>{form_lang value="un numero"}</li>
							<li>{form_lang value="un carattere minuscolo"}</li>
							<li>{form_lang value="un carattere maiuscolo"}</li>
							<li>{form_lang value="un carattere compreso tra "}<b class='text text-muted'>!.@#$%</b></li>
							<li>{form_lang value="avere lunghezza tra 8 e 20 caratteri"}</li>
						</ul>
					</div>
					{form_opening}
					<div class="mb-4">
						{form_tbox mdc=true iname='password_old' type='password' placeholder="{form_lang value='Password attuale'}" outlined=true img="visibility_off" required="required"}
					</div>
					<div class="mb-4">
						{form_tbox mdc=true iname='password' type='password' placeholder="{form_lang value='Nuova password'}" outlined=true img="visibility_off" required="required"}
					</div>
					<div class="mb-4">
						{form_tbox mdc=true iname='password2' type='password' placeholder="{form_lang value='Conferma nuova password'}" outlined=true img="visibility_off" required="required"}
					</div>
					<div class="text-end">
						{form_submit value="{form_lang value='Resetta Password'}" img='save' onclick="check(this);"}
					</div>
					{form_closing data-method='PUT' data-action='password'}
				
			</div>
		</div>

	</div>

	<div class="text-end">{form_link href="{$siteUrl}/{$alias}/{$pageId}"
		type='button' img="undo" text=true value="Indietro"}</div>
</div>

