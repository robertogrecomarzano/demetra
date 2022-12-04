{if !$src["custom-template"]}
	{form_table src=$src view='edit' data-method='PUT' data-action="{$siteUrl}/{$src.alias}/{$id}/edit"}
{else}
	{form_opening action="{$siteUrl}/{$src.alias}/{$id}/edit"}
	    	<div class="card-title">Dati utente</div>
            <div class="card-subtitle mb-4">Modifica dati dell'utente</div>
            
            <div class="row mb-4">
            	<div class="col-md-6">{form_tbox iname='cognome' max=45 mwc=true label='Cognome' outlined=true}</div>
                <div class="col-md-6">{form_tbox iname='nome' max=45 mwc=true label='Nome' outlined=true}</div>
            </div>
            
            <div class="row mb-4">
                <div class="col-md-6">{form_tbox iname='email' max=45 mwc=true outlined=true label="Indirizzo email" type="email"}</div>
                <div class="col-md-6">
					{form_check iname='sola_lettura' label='Spuntare se si vuole dare accesso in sola lettura'}
					
				</div>
            </div>
            
            <div class="row mb-4">
            	<div class="col-md-6">
            			<h6 class="h6 mb-1">Profili</h6>
						<span class="text text-muted">Selezionare i profili da assegnare all'utente</span>
						{form_checks iname='gruppo' src=$gruppi cols=1 }
				</div>
                <div class="col-md-6">
					<div class="col-md-6">
            			<h6 class="h6 mb-1">Servizi</h6>
						<span class="text text-muted">Selezionare i servizi a cui l'utente ha accesso</span>
						{form_checks iname='servizio' src=$servizi cols=1 }
				</div>
				</div>
            </div>
            
            <div class="row mb-4">
				<div class="col-md-6">{form_tbox iname='username' mwc=true outlined=true label="Username"}</div>
				<div class="col-md-6">{form_tbox iname='password' mwc=true outlined=true label="Password" type="password"}</div>
            </div>
            
            <div class="text-end">
             	{form_edit_dropdown action_id={$id}}   
            </div>
    {form_closing data-method='PUT'}
{/if}