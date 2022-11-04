		<h4>Benvenuto nella sezione del portale di assistenza</h4>
		
		<p>Apri un nuovo ticket o verifica lo stato di avanzamento di uno già aperto.</p>

		<div class='btn-group'>{form_link
			target='_blank' iname="btnTicketNew" value="Apri un ticket" class="btn btn-primary"
			text=true img="info-circle" href="{$ticket_url_open}?nu_key={$ticket_api_key}&nu_server={$ticket_api_server}"}
		{form_link
			target='_blank' iname="btnTicketView" value="Verifica stato ticket"
			text=true img="info-circle" href="{$ticket_url_view}"}</div>
