{form_opening class="form-horizontal"}
	<div class="form-group">
		<label class="control-label col-md-6 col-sm-6 col-xs-12">Email<span class="help-block">indirizzo email supporto tecnico</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">{form_tbox size=45 iname='email_support' writable=$isWritable}</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-6 col-sm-6 col-xs-12">Indirizzo web<span class="help-block">sito web del software</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">{form_tbox size=45 iname='web' writable=$isWritable}</div>
	</div>
	
	<div class="form-group">
		<label class="control-label col-md-6 col-sm-6 col-xs-12">Offline</label>
		<div class="col-md-6 col-sm-6 col-xs-12">{form_check iname='offline' writable=$isWritable label="spuntare per mettere il servizio offline"}</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-6 col-sm-6 col-xs-12">Debug</label>
		<div class="col-md-6 col-sm-6 col-xs-12">{form_check iname='debug' writable=$isWritable label="spuntare per attivare il debug"}</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-6 col-sm-6 col-xs-12">Collaudo</label>
		<div class="col-md-6 col-sm-6 col-xs-12">{form_check iname='collaudo' writable=$isWritable label="spuntare se si tratta di una installazione di collaudo"}</div>
	</div>

<div class='btn-group'>{form_button iname='conferma' onclick="setConfig(this,{$pkValue});" class='btn btn-primary' text=true value="Conferma"}</div>
{form_closing}
