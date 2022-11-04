	<table
		class="table table-striped table-hover dataTable no-footer dtr-inline"
		id="dataTables">
		<thead>
			<th></th>
			<th>Gruppi</th>
			<th>Username</th>
			<th>Cognome e Nome</th>
			<th>Email</th>
		</thead>
		<tbody>
			{foreach from=$righe item=r}
			<tr>
				<td>{form_edit id=$r.$pk}{form_delete id=$r.$pk}</td>
				<td>{$r.profili}</td>
				<td>{$r.username}</td>
				<td>{$r.cognome} {$r.nome}</td>
				<td>{$r.email}</td>
			</tr>
			{/foreach}
		</tbody>
	</table>
