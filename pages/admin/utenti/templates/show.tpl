{if !$src["custom-template"]} {form_table src=$src view='show'} {else}
{form_opening class="form-horizontal" action="{$siteUrl}/{$src.alias}/{$pageId}"}
<div class="row">

	<div class="col-md-8 mb-4">
		<table class="table table-striped mb-0">
			<tbody>

				<tr>
					<td><strong>Gruppo</strong></td>
					<td><span>{$src.rows.gruppo}</span></td>
				</tr>
				<tr>
					<td><strong>Cognome</strong></td>
					<td><span>{$src.rows.cognome}</span></td>
				</tr>
				<tr>
					<td><strong>Nome</strong></td>
					<td><span>{$src.rows.nome}</span></td>

				</tr>
				<tr>
					<td><strong>Servizi</strong></td>
					<td><span>{$src.rows.servizi}</span></td>

				</tr>
				<tr>
					<td><strong>Username</strong></td>
					<td><span>{$src.rows.username}</span></td>
				</tr>

				<tr>
					<td><strong>Consultazione</strong></td>
					<td><span>{if $src.rows.sola_lettura}SI{/if}</span></td>
				</tr>

				<tr>
					<td><strong>Email</strong></td>
					<td><span>{$src.rows.email}</span></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="text-end">
	{form_link href="{$siteUrl}/{$src.alias}"	type='button' img="undo" text=true value="{form_lang value='Indietro'}"}
	{form_link href="{$siteUrl}/{$src.alias}/{$pageId}/edit"	type='button' img="edit" text=true value="{form_lang value='Modifica'}" class="btn btn-warning"}
	{form_delete text=true value="{form_lang value='Elimina'}" id={$pageId}}
</div>
{form_closing data-method='DELETE'} {/if}
