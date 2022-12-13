{if !$src["custom-template"]}
	{form_table src=$src view='edit'}
{else}
{form_opening action="{$siteUrl}/{$src.alias}/create/{$pageId}"}
<div class="row">
	<div class="col-md-8 mb-4">
		<table class="table table-striped mb-0">
			<tbody>
				<tr>
					<td><strong>LABEL_1</strong></td>
					<td><span>HTML_OBJECT_1</span></td>
				</tr>
				<tr>
					<td><strong>LABEL_2</strong></td>
					<td><span>HTML_OBJECT_2</span></td>
				</tr>
				<tr>
					<td><strong>LABEL_N</strong></td>
					<td><span>HTML_OBJECT_N</span></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="text-end">{form_edit_dropdown}</div>
{form_closing}
{/if}