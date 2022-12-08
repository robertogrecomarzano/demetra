{if !empty($return)}
<div class="border bg-light p-3 p-sm-4 mb-5">	
<pre>
   <code class="language-html">
	{$return}
	</code>
</pre>
</div>
{/if}
{if !empty($debug_message)}
<div class="border bg-light p-3 p-sm-4 mb-5">
<pre>
	<code class="language-html">
	{$debug_message}
	</code>
</pre>
</div>
{/if}

{form_opening}
	
	<div class="row mb-4">
		{form_tbox iname='destinatario' max=50 mwc=true label="{form_lang value='Destinatario'}" outlined=true charcounter="" required="required"}
	</div>
	<div class="row mb-4">
		{form_tbox iname='email' type='email' max=45 mwc=true label="{form_lang value='Email'}" outlined=true charcounter="" required="required"}
	</div>
	<div class="row mb-4">
		{form_tbox iname='oggetto' max=100 mwc=true label="{form_lang value='Oggetto'}" value="{form_lang value='Email di prova'}" outlined=true charcounter="" required="required"}
	</div>
	<div class="row mb-4">
		{form_tbox iname='messaggio' max=100 mwc=true label="{form_lang value='Testo della mail di prova'}" value="{form_lang value='Testo della mail di prova'}" outlined=true charcounter="" required="required"}
	</div>
	
<div class="text-end">
	{form_submit value="{form_lang value='Invia mail'}" img='save' onclick="sendMail(this);"}
</div>
{form_closing}


