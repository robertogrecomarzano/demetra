{if !$src["custom-template"]}
	{form_table src=$src view='index'}
{else}
{form_link value=$src.title text=true img="add" title=$src.title class="btn btn-primary" writable=$src.writable href="{$siteUrl}/{$src.alias}/create"}<hr />
	<table
	class="table table-striped table-hover dataTable no-footer dtr-inline"
	id="dataTables">
	<thead>
		<th></th>
		<th>{form_lang value="Gruppi"}</th>
		<th>{form_lang value="Servizi"}</th>
		<th>{form_lang value="Username"}</th>
		<th>{form_lang value="Cognome e Nome"}</th>
		<th>{form_lang value="Email"}</th>
	</thead>
	<tbody>
		{foreach from=$src.rows item=r}
		<tr>
			<td>{form_link href="{$siteUrl}/{$src.alias}/{$r.{$src.pk}}" img='visibility' class="btn btn-primary"}{form_link href="{$siteUrl}/{$src.alias}/{$r.{$src.pk}}/edit" img='edit' class="btn btn-warning"}
			{form_opening  action="{$siteUrl}/{$src.alias}/{$r.{$src.pk}}" style="display:inline;"}
				{form_delete id={$r.{$src.pk}} leading-icon=false}
			{form_closing data-method='DELETE'}
			</td>
			<td>{$r.profili}</td>
			<td>{$r.servizi}</td>
			<td>{$r.username}</td>
			<td>{$r.cognome} {$r.nome}</td>
			<td>{$r.email}</td>
		</tr>
		{/foreach}
	</tbody>
</table>

{/if}


