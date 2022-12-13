<!-- Load Bootstrap JS bundle-->
<script
	src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
	crossorigin="anonymous"></script>

<!-- Load global scripts-->
<script type="module" src="{$siteUrl}/core/templates/js/material.js"></script>
<script src="{$siteUrl}/core/templates/js/scripts.js"></script>

<!-- JQuery -->
<script
	src="{$siteUrl}/core/templates/vendor/jquery/jquery-3.3.1.min.js"></script>


<!-- Datatables -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-colvis-2.3.3/b-html5-2.3.3/b-print-2.3.3/date-1.2.0/r-2.4.0/datatables.min.js"></script>


<!-- Bootbox dialog boxes JavaScript -->
<script src="{$siteUrl}/core/templates/vendor/bootbox/bootbox.min.js"></script>

<!-- Required Material Web JavaScript library -->
<script
	src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>

<!-- Attach mdc event to mdc components -->
<script src="{$siteUrl}/core/templates/js/mdc-attach.js"></script>

<!-- LitePicker -->
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>

<!-- Summernote, usato per l'editing html -->
<link href="{$siteUrl}/core/templates/vendor/summernote/summernote.css"
	rel="stylesheet">
<script
	src="{$siteUrl}/core/templates/vendor/summernote/summernote.min.js"></script>
<!-- Summernote language -->
<script
	src="{$siteUrl}/core/templates/vendor/summernote/lang/summernote-{$lang_country|replace:'_':'-'}.js"></script>
<script
	src="{$siteUrl}/core/templates/vendor/summernote/summernote-cleaner.js"></script>

<!-- Bootstrap select picker -->
<script src="{$siteUrl}/core/templates/vendor/bootstrap-select-1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script src="{$siteUrl}/core/templates/vendor/bootstrap-select-1.14.0-beta3/js/i18n/defaults-{$lang_country}.js"></script>

<!-- Custom script -->
{$js}

<!-- Inizializza datepicker -->
<script src="{$siteUrl}/core/templates/js/date.js"></script>

<!-- Inizializza datatable -->
<script src="{$siteUrl}/core/templates/js/datatables.js"></script>