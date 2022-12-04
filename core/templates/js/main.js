var Localization = Localization || {};



$(document)
	.ready(
		function() {


			// tooltip demo
			$('.tooltip-demo').tooltip({
				selector: "[data-toggle=tooltip]",
				container: "body"
			});
			// popover demo
			$("[data-toggle=popover]").popover();

			$(document).on("focus", ":input", function(e) {
				$(this).addClass("inputhighlight");
			}).on("blur", ":input", function(e) {
				$(this).removeClass("inputhighlight");
			});


			$('.js-tooltip').tooltip();

			$('.js-copy').click(function() {
				var text = $(this).attr('data-copy');
				var el = $(this);
				copyToClipboard(text, el);
			});

			$('#dataTables')
				.DataTable(
					{
						/*
						 * dom : "<'row'<'col-md-4'l><'col-md-4'B><'col-md-4'f>><'row't><'row'<'col-md-12'ip>>",
						 * buttons : [ { extend : 'copy', text :
						 * 'Copia' }, { extend : 'csv', text :
						 * 'Csv' }, { extend : 'excel', text :
						 * 'Excel' }, { extend : 'pdfHtml5',
						 * orientation : 'landscape', pageSize :
						 * 'LEGAL', text : 'Pdf' }, { extend :
						 * 'print', text : 'Stampa' } ],
						 */
						"lengthMenu": [
							[10, 25, 50, 100, 500, 1000,
								-1],
							[10, 25, 50, 100, 500, 1000,
								_e("Tutto")]],
						"paging": true,
						"ordering": true,
						"info": true,
						"responsive": true,
						"language": {
							"decimal": ",",
							"thousands": ".",
							"sEmptyTable": _e("Nessuna riga"),
							"sInfo": _e("Vista da _START_ a _END_ di _TOTAL_ elementi"),
							"sInfoEmpty": _e("Vista da 0 a 0 di 0 elementi"),
							"sInfoFiltered": _e("(filtrati da _MAX_ elementi totali)"),
							"sInfoPostFix": "",
							"sInfoThousands": ".",
							"sLengthMenu": _e("Visualizza _MENU_ elementi"),
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

			$('#myModal').modal({
				show: true
			});
			$('.modal-backdrop').removeClass("modal-backdrop");

			/*
			 * var Localization_path = codebase + "/languages/"; //
			 * Localization = {}; try {
			 * jQuery.getScript(Localization_path + lang+ ".js"); }
			 * catch (e) { console.log(e); }
			 */

		});

jQuery.fn.fadeInOrOut = function(status) {
	return status ? this.fadeIn() : this.fadeOut();
};

function checkRequired(fields) {
	var out = "";
	var v, pre;
	for (var i in fields) {
		if (i.substr(0, 1) == "*") {
			v = eval(i.substr(1));
			pre = "<br /><b>" + _e("Errore:") + "</b> ";
		} else {
			v = $("#" + i).val();
			pre = "<br /><b>" + _e("Campo obbligatorio") + ":</b> ";
		}
		if (!v || v == "")
			out += pre + fields[i] + "\n";
	}
	if (out != "") {
		bootbox.alert("<h3>" + _e("Attenzione") + "</h3>" + out);
		return false;
	} else
		return true;
}

function jsutil_len(id) {
	return $("#" + id).val().length;
}

function HideMenu() {
	$("#leftcolumn .innertube").toggle(
		150,
		function() {
			var visible = $("#leftcolumn .innertube").is(":visible");

			if (visible) {
				$("#contentcolumn").animate({
					"margin-left": 190
				});
				$("#leftcolumn").width(180);
				$("#minimize").attr("src",
					codebase + "/core/templates/img/minimize.png");
			} else {
				$("#contentcolumn").animate({
					"margin-left": 30
				});
				$("#leftcolumn").width(30);
				$("#minimize").attr("src",
					codebase + "/core/templates/img/show.png");
			}
		});

}

function changeuser(obj, idUtente) {
	var form = $(obj).parents("form");
	form.find("#form_changeuser").val(idUtente);
	$("#loading").show();
	form.submit();
}

function keyCheck(eventObj, obj, filter) {
	var keyCode;
	if (!eventObj)
		eventObj = window.event;
	if (document.all)
		keyCode = eventObj.keyCode;
	else
		keyCode = eventObj.which;
	// var str = obj.value;
	var bNumericKey = keyCode > 47 && keyCode < 58;
	var bNumericPad = keyCode > 95 && keyCode < 106;
	var bNum = bNumericKey || bNumericPad;
	var bBackSpace = keyCode == 8;
	var bTab = keyCode == 9;
	var bEnter = keyCode == 13;
	var bAllowed = bBackSpace || bTab || bEnter;
	switch (filter) {
		case "num":
			return bAllowed || bNum;
			break;
		case "data":
			obj.onkeyup = function() {
				dataFormat(this);
			};
			obj.onblur = function() {
				dataCheck(this);
			};
			return bAllowed || bNum;
			break;
		default:
			return false;
	}
}

function dataCheck(obj) {
	var good = true;
	var valore = $(obj).val();

	if (valore == "" || valore == undefined)
		return good;

	var s = extractNums(valore);
	var d = s.substring(0, 2);
	var m = s.substring(2, 4);
	var y = s.substring(4);
	var s2 = d + "/" + m + "/" + y;
	if (s2 != valore || s.length != 8) {
		bootbox.alert(_e("Attenzione! La data") + " " + valore + " "
			+ _e("è in formato non corretto (gg/mm/aaaa)!"));
		good = false;
	} else if (d < 1 || d > 31 || m < 1 || m > 12 || y < 1900 || y > 2100) {
		bootbox.alert(_e("Attenzione! Valori non permessi nella data") + " " + valore
			+ ".");
		good = false;
	}
	var color = good ? "green" : "red";
	$(obj).attr("style", "color:" + color);
	/*
	 * if (!good) $(obj).val("");
	 */
	return good;
}

function dataFormat(obj) {
	var v = obj.value;
	if (v.length > 2 && v.length <= 5) {
		if (v.length == 3 && v.charAt(2) == '/')
			obj.value = v.substring(0, 2);
		else {
			var s = extractNums(obj.value);
			var s2 = s.substring(0, 2) + "/" + s.substring(2);
			obj.value = s2;
		}
	}
	if (v.length > 5) {
		if (v.length == 6 && v.charAt(5) == '/')
			obj.value = v.substring(0, 5);
		else {
			var s = extractNums(v);
			var s2 = s.substring(0, 2) + "/" + s.substring(2, 4) + "/"
				+ s.substring(4, 8);
			obj.value = s2;
		}
	}
}

function extractNums(str) {
	var o = "";
	for (var i = 0; i < str.length; i++)
		if ("0123456789".indexOf(str.charAt(i)) > -1)
			o += str.charAt(i);
	return o;
}

function solonumeri(campo) {

	var testonum = $(":input[id='" + campo + "']").val();
	if (isNaN(testonum)) {
		bootbox.alert(_e('Inserire solo valori numerici'));
		$(":input[id='" + campo + "']").val("");
		$(":input[id='" + campo + "']").focus();
	}
}

function isNumberKey(evt) {
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	return true;
}

/*
 * Funzione creata per la traduzione del testo nei file javascript. METODO DI
 * UTILIZZO: Passare il testo da tradurre alla funzione nel seguente modo:
 * _a("testo da tradurre"). Se non trova la traduzione del testo restituisce il
 * testo passato.
 * 
 * Alla funzione è collegato un file dizionario situato nella cartella
 * languages. I dizionari devono avere il nome della lingua da tradurre.
 * esempio: en_US.js, it_IT.js ecc. In base alla localizzazione seleziona il
 * dizionario.
 * 
 * @param: string @return string
 */
function _e(s) {

	if (Localization && (v = Localization[s]))
		return v;
	return s;
}

// COPY TO CLIPBOARD
// Attempts to use .execCommand('copy') on a created text field
// Falls back to a selectable alert if not supported
// Attempts to display status in Bootstrap tooltip
// ------------------------------------------------------------------------------

function copyToClipboard(text, el) {
	var copyTest = document.queryCommandSupported('copy');
	var elOriginalText = el.attr('data-original-title');

	if (copyTest === true) {
		var copyTextArea = document.createElement("textarea");
		copyTextArea.value = text;
		document.body.appendChild(copyTextArea);
		copyTextArea.select();
		try {
			var successful = document.execCommand('copy');
			var msg = successful ? _e('Copiato!') : _e('Whoops, non copiato!');
			el.attr('data-original-title', msg).tooltip('show');
		} catch (err) {
			console.log(_e('Oops, impossibile copiare'));
		}
		document.body.removeChild(copyTextArea);
		el.attr('data-original-title', elOriginalText);
	} else {
		// Fallback if browser doesn't support .execCommand('copy')
		window.prompt(_e("Per copiare: Ctrl+C o Command+C, Enter"), text);
	}
}