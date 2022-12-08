{if !$src["custom-template"]}
	{form_table src=$src view='index'}
{else}
{form_link value=$src.title text=true img="add" title=$src.title class="btn btn-primary" writable=$src.writable href="{$siteUrl}/{$src.alias}/create"}<hr />
	<table	class="table table-striped table-hover dataTable no-footer dtr-inline"	id="dataTables">
	<thead>
		<th></th>
		<th>LABEL_1</th>
		<th>LABEL_2</th>
		<th>LABEL_N</th>
	</thead>
	<tbody>
		{foreach from=$src.rows item=r}
		<tr>
			<td>{form_link href="{$siteUrl}/{$src.alias}/{$r.{$src.pk}}" img='visibility' class="btn btn-primary"}{form_link href="{$siteUrl}/{$src.alias}/{$r.{$src.pk}}/edit" img='edit' class="btn btn-warning"}{form_delete id={$r.{$src.pk}} leading-icon=false}</td>
			<td>{$r.FIELD_1}</td>
			<td>{$r.FIELD_2}</td>
			<td>{$r.FIELD_N}</td>
		</tr>
		{/foreach}
	</tbody>
</table>
{/if}