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
			    {if $i2.is_attivo}{form_check switch=true checked="checked" disabled="disabled" label="{$i2.servizio} ({$i2.descrizione})"}{else}{form_check switch=true  disabled="disabled" label="{$i2.servizio} ({$i2.descrizione})"}{/if} 
			{/foreach}
		</td>
	</tr>
{/foreach}		
</tbody>
</table>


<div class="text-end">
	{form_link href="{$siteUrl}/{$alias}/0/edit" type='button' img="edit" text=true value="{form_lang value='Modifica'}" class="btn btn-primary"}
</div>
