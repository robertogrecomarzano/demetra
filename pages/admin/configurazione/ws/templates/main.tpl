<form method="post" class="form-horizontal">
	{$formToken} {form_hidden iname='form_action'} {form_hidden
	iname='form_id'} 
	{foreach from=$fields item=r }

	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12">{$r["Field"]|upper|replace:"_":" "}<span class="help-block">{$r["Comment"]}</span></label>
		<div class="col-md-9 col-sm-9 col-xs-12">
			{include "../../templates/field.tpl"}
		</div>
	</div>
	{/foreach}
	<div class='btn-group'>{form_button iname='conferma' onclick="setConfig(this,{$pkValue});" class='btn btn-primary' text=true value="Conferma"}</div>
</form>