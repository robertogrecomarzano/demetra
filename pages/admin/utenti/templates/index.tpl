{if !$src["custom-template"]}
	{form_table src=$src view='index'}
{else}
{form_opening}
<div class='btn btn-group'>{form_link value=$src.title text=true img="add" title=$src.title class="btn btn-primary" writable=$src.writable href="{$siteUrl}/{$src.alias}/create"}</div>
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
		{foreach from=$src.rows item=r}
		<tr>
			<td>{form_link href="{$siteUrl}/{$src.alias}/{$r.{$src.pk}}" img='visibility' class="btn btn-primary"}{form_link href="{$siteUrl}/{$src.alias}/{$r.{$src.pk}}/edit" img='edit' class="btn btn-warning"}{form_delete id={$r.{$src.pk}} leading-icon=false}</td>
			<td>{$r.profili}</td>
			<td>{$r.username}</td>
			<td>{$r.cognome} {$r.nome}</td>
			<td>{$r.email}</td>
		</tr>
		{/foreach}
	</tbody>
</table>
{form_closing}
{/if}