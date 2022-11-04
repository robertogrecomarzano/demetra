{if $r["Type"] == "tinyint(1)"}
	{form_check iname={$r["Field"]} label=' '}
{/if}
{if $r["Type"]|strpos:'varchar'===0}
	{form_tbox iname={$r["Field"]} size='100'}
{/if}
{if $r["Type"]|strpos:'char'===0}
	{form_tbox iname={$r["Field"]} size='20'}
{/if}
{if $r["Type"]|strpos:'int'===0 || $r["Type"]|strpos:'smallint'===0}
	{form_tbox iname={$r["Field"]} size='10' class="form-control number"}
{/if}

{if $r["Type"] == "text" || $r["Type"] == "tinytext"}
	{form_area iname={$r["Field"]} cols=100 rows=4}
{/if}