<!-- Questo file è da usare solo se si vuole attivare la modalita custom-template -->
<table
	class="table  dataTable no-footer dtr-inline" id="dataTables">
	<thead>
		<th></th>
		<th>Settore</th>
	</thead>
	{foreach from=$src.rows key=myId item=row}
	<tr>
		<td>{form_edit id=$row.$pk writable=$isWritable}{form_delete id=$row.$pk writable=$isWritable}</td>
		<td>{$row.settore}</td>

	</tr>
	{/foreach}
</table>