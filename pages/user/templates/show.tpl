<div class="row">

	<div class="col-md-8 mb-4">
		<table class="table table-striped mb-0">
			<tbody>
				<tr>
					<td><strong>Cognome</strong></td>
					<td><span>{$utente.cognome}</span></td>
				</tr>
				<tr>
					<td><strong>Nome</strong></td>
					<td><span>{$utente.nome}</span></td>

				</tr>
				<tr>
					<td><strong>Email</strong></td>
					<td><span>{$utente.email}</span></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="text-end">
	{form_link href="{$siteUrl}/{$alias}/{$pageId}/edit" type='button' img="edit" text=true value="{form_lang value='Modifica'}" class="btn btn-primary"}
</div>