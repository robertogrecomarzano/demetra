{form_opening}

<table class="table">
<thead>
	<th>{form_lang value='Gruppo'}</th>
	<th>{form_lang value='Servizi'}</th>
</thead>
<tbody>
{foreach from=$righe key=myId item=i name=gruppi}
	<tr>
		<td>{$myId}</td>
		<td>{foreach $i.servizi key=s item=i2 name=servizio} 
				{form_check iname="attivo[{$i2.id}]" label="{$i2.servizio} ({$i2.descrizione})"}
			{/foreach}
		</td>
	</tr>
{/foreach}		
</tbody>
</table>


<div class="text-end">
	{form_submit value="{form_lang value='Salva'}" img='save' onclick="setServiziGruppi(this);"}
</div>
{form_closing data-method='PUT' data-action='update'}
