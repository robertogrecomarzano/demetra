<table
	class="table table-striped table-hover dataTable no-footer dtr-inline" id='dataTables'>
	<thead>
		<tr>
			<th>{form_lang value="Utente"}</th>
			<th>{form_lang value="Gruppo"}</th>
			<th>{form_lang value="Pagina"}</th>
			<th>{form_lang value="Indirizzo IP"}</th>
			<th>{form_lang value="Aggiornato al"}</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$righe key=myId item=i}
		<tr>
			<td>{$i.utente}</td>
			<td>{$i.gruppo}</td>
			<td><a target='_blank' href="{$siteUrl}/{$i.page}">{$i.page}</a></td>
			<td>{$i.ip}</td>
			<td>{$i.orario}</td>
		</tr>
		{/foreach}
	</tbody>
</table>