<div class="form-group">
	<label class="control-label col-md-2 col-sm-2 col-xs-12 required">Settore</label>
	<div class="col-md-10 col-sm-10 col-xs-12">{form_select iname='id_settore' first=true src=$settori writable=$isWritable  key='id_settore' label='label'}</div>
</div>
<label class="text block text-info">I campi in rosso sono obbligatori</label>{form_add_edit  onclick="checkCompetence(this);"}