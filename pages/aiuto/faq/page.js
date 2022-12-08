$(document)
	.ready(
		function() {

			$('#question, #answer').summernote({
				height: "250px"
			});

			$('#dataTablesFaq')
				.DataTable(
					{

						"columns": [
							{ "width": "20%" },
							{ "width": "30%" },
							{ "width": "50%" },
						],

						dom: "<'row'<'col-md-4'l><'col-md-4'B><'col-md-4'f>><'row't><'row'<'col-md-12'ip>>",
						buttons: [{
							extend: 'copy', text:
								'Copia'
						}, {
							extend: 'csv', text:
								'Csv'
						}, {
							extend: 'excel', text:
								'Excel'
						}, {
							extend: 'pdfHtml5',
							orientation: 'landscape', pageSize:
								'LEGAL', text: 'Pdf'
						}, {
							extend:
								'print', text: 'Stampa'
						}],

						"lengthMenu": [
							[25, 50, 100, 500, 1000, -1],
							[25, 50, 100, 500, 1000, _e("Tutto")]],
						"paging": true,
						"ordering": true,
						"info": true,
						"responsive": true,
						"language": {
							"decimal": ",",
							"thousands": ".",
							"sEmptyTable": _e("Nessuna riga"),
							"sInfo": _e("Vista da _START_ a _END_ di _TOTAL_ righe"),
							"sInfoEmpty": _e("Vista da 0 a 0 di 0 righe"),
							"sInfoFiltered": _e("(filtrati da _MAX_ righe totali)"),
							"sInfoPostFix": "",
							"sInfoThousands": ".",
							"sLengthMenu": _e("_MENU_ righe"),
							"sLoadingRecords": _e("Caricamento..."),
							"sProcessing": _e("Elaborazione..."),
							"sSearch": _e("Cerca"),
							"sZeroRecords": _e("La ricerca non ha portato alcun risultato."),
							"oPaginate": {
								"sFirst": _e("Inizio"),
								"sPrevious": _e("Precedente"),
								"sNext": _e("Successivo"),
								"sLast": _e("Fine")
							},
							"oAria": {
								"sSortAscending": ": "
									+ _e("attiva per ordinare la colonna in ordine crescente"),
								"sSortDescending": ": "
									+ _e("attiva per ordinare la colonna in ordine decrescente")
							}

						}

					});

			$('div.dataTables_length select').prop("class", "form-select dataTable-selector");
		});


