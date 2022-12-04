<div class="row">
	<div class="row col-md-8 mb-4">
		<div class="col-md-8">
		<h3 class="text-primary">{form_lang value="Dati generali"}</h3>
		<table class="table table-striped mb-0">
			<tbody>
				<tr>
					<td><strong>Denominazione</strong></td>
					<td><span>{$row.denominazione}</span></td>
				</tr>
				<tr>
					<td><strong>Sede</strong></td>
					<td><span>{$row.sede}</span></td>
				</tr>
				<tr>
					<td><strong>Indirizzo web</strong></td>
					<td><span>{$row.web}</span></td>
				</tr>
				<tr>
					<td><strong>Indirizzo email</strong></td>
					<td><span>{$row.email}</span></td>
				</tr>
				<tr>
					<td><strong>Indirizzo email tencico</strong></td>
					<td><span>{$row.email_support}</span></td>
				</tr>
				<tr>
					<td><strong>Telefono</strong></td>
					<td><span>{$row.telefono}</span></td>
				</tr>
				<tr>
					<td><strong>{form_lang value='Debug attivo'}</strong></td>
					<td><span>{if $row.is_debug}{form_check switch=true checked="checked" disabled="disabled"}{else}{form_check switch=true  disabled="disabled"}{/if}</span></td>
				</tr>
				<tr>
					<td><strong>{form_lang value='Sistema in manutenzione'}</strong></td>
					<td><span>{if $row.is_offline}{form_check switch=true checked="checked" disabled="disabled"}{else}{form_check switch=true  disabled="disabled"}{/if}</span></td>
				</tr>
				<tr>
					<td><strong>{form_lang value='Sistema di collaudo'}</strong></td>
					<td><span>{if $row.is_collaudo}{form_check switch=true checked="checked" disabled="disabled"}{else}{form_check switch=true  disabled="disabled"}{/if}</span></td>
				</tr>
			</tbody>
		</table>
		</div>
		<div class="col-md-4">
		<h3 class="text-primary">{form_lang value="Server di posta elettronica"}</h3>
		<table class="table table-striped mb-0">
			<tbody>
				<tr>
					<td><strong>{form_lang value="Invio delle mail abilitato"}</strong></td>
					<td><span>{if $row.mail_enable}{form_check switch=true checked="checked" disabled="disabled"}{else}{form_check switch=true  disabled="disabled"}{/if}</span></td>
				</tr>
				<tr>
					<td><strong>{form_lang value="Invio tramite server SMTP"}</strong></td>
					<td><span>{if $row.mail_smtp}{form_check switch=true checked="checked" disabled="disabled"}{else}{form_check switch=true  disabled="disabled"}{/if}</span></td>
				</tr>
				<tr>
					<td><strong>{form_lang value="Server SMTP"}</strong></td>
					<td><span>{$row.mail_smtp_server}</span></td>
				</tr>
				<tr>
					<td><strong>{form_lang value="Il server SMTP richiede autenticazione"}</strong></td>
					<td><span>{if $row.mail_smtp_auth}{form_check checked="checked" disabled="disabled"}{else}{form_check disabled="disabled"}{/if}</span></td>
				</tr>
				<tr>
					<td><strong>{form_lang value="Utente SMTP"}</strong></td>
					<td><span>{$row.mail_smtp_user}</span></td>
				</tr>
				<tr>
					<td><strong>{form_lang value="Password SMTP"}</strong></td>
					<td><span>{$row.mail_smtp_password}</span></td>
				</tr>
				<tr>
					<td><strong>{form_lang value="Porta SMTP"}</strong></td>
					<td><span>{$row.mail_smtp_port}</span></td>
				</tr>
				<tr>
					<td><strong>{form_lang value="Prevista la crittografia"}</strong></td>
					<td><span>{if $row.mail_smtp_secure}{form_check checked="checked" disabled="disabled"}{else}{form_check disabled="disabled"}{/if}</span></td>
				</tr>
				<tr>
					<td><strong>{form_lang value="Tipo di protezione"}</strong></td>
					<td><span>{$row.mail_smtp_secure_type}</span></td>
				</tr>
				<tr>
					<td><strong>{form_lang value="Debug"}</strong></td>
					<td><span>{$debugs[$row.mail_smtp_debug]}</span></td>
				</tr>
			</tbody>
		</table>
		</div>
	</div>
</div>
<div class="text-end">
	{form_link href="{$siteUrl}/{$alias}/0/edit" type='button' img="edit" text=true value="{form_lang value='Modifica'}" class="btn btn-primary"}
</div>