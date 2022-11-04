
$(document)
	.ready(
		function() {

			var docCookies = {
				getItem: function(sKey) {
					if (!sKey || !this.hasItem(sKey)) {
						return null;
					}
					return unescape(document.cookie.replace(new RegExp("(?:^|.*;\\s*)"
						+ escape(sKey).replace(/[\-\.\+\*]/g, "\\$&")
						+ "\\s*\\=\\s*((?:[^;](?!;))*[^;]?).*"), "$1"));
				},
				setItem: function(sKey, sValue, vEnd, sPath, sDomain, bSecure) {
					if (!sKey || /^(?:expires|max\-age|path|domain|secure)$/i.test(sKey)) {
						return;
					}
					var sExpires = "";
					if (vEnd) {
						switch (vEnd.constructor) {
							case Number:
								sExpires = vEnd === Infinity ? "; expires=Tue, 19 Jan 2038 03:14:07 GMT"
									: "; max-age=" + vEnd;
								break;
							case String:
								sExpires = "; expires=" + vEnd;
								break;
							case Date:
								sExpires = "; expires=" + vEnd.toGMTString();
								break;
						}
					}
					document.cookie = escape(sKey) + "=" + escape(sValue) + sExpires
						+ (sDomain ? "; domain=" + sDomain : "")
						+ (sPath ? "; path=" + sPath : "")
						+ (bSecure ? "; secure" : "");
				},
				removeItem: function(sKey, sPath) {
					if (!sKey || !this.hasItem(sKey)) {
						return;
					}
					document.cookie = escape(sKey)
						+ "=; expires=Thu, 01 Jan 1970 00:00:00 GMT"
						+ (sPath ? "; path=" + sPath : "");
				},
				hasItem: function(sKey) {
					return (new RegExp("(?:^|;\\s*)"
						+ escape(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\="))
						.test(document.cookie);
				},
				keys: /*
									 * optional method: you can safely remove
									 * it!
									 */function() {
						var aKeys = document.cookie.replace(
							/((?:^|\s*;)[^\=]+)(?=;|$)|^\s*|\s*(?:\=[^;]*)?(?:\1|$)/g, "")
							.split(/\s*(?:\=[^;]*)?;\s*/);
						for (var nIdx = 0; nIdx < aKeys.length; nIdx++) {
							aKeys[nIdx] = unescape(aKeys[nIdx]);
						}
						return aKeys;
					}
			};

			/*
			 * stampa ricevute sendRequest(); function sendRequest() { $ .ajax({ url :
			 * codebase + "/core/ajax.php?alias=stamparicevute/aj_getCoda", success :
			 * function(data) { $('#listposts').html(data); // insert // text of //
			 * test.php // into your // div }
			 * 
			 * }); } ;
			 */

			$(document).on("focus", ":input", function(e) {
				$(this).addClass("inputhighlight");
			}).on("blur", ":input", function(e) {
				$(this).removeClass("inputhighlight");
			});

			/*
			 * $("a") .bind( 'contextmenu', function(e) { bootbox
			 * .alert("Utilizzo del tasto destro non consentito.");
			 * return false; });
			 */





			if ($('#dataTables').length > 0) {
				$.fn.dataTable.moment('DD/MM/YYYY');

				$('#dataTables')
					.DataTable(
						{
							"aLengthMenu": [25, 50, 100, 200,
								400, 1000],
							"paging": true,
							"ordering": true,
							"info": true,
							"responsive": true,
							"language": {
								"sEmptyTable": "Nessuna riga",
								"sInfo": "Vista da _START_ a _END_ di _TOTAL_ elementi",
								"sInfoEmpty": "Vista da 0 a 0 di 0 elementi",
								"sInfoFiltered": "(filtrati da _MAX_ elementi totali)",
								"sInfoPostFix": "",
								"sInfoThousands": ".",
								"sLengthMenu": "Visualizza _MENU_ elementi",
								"sLoadingRecords": "Caricamento...",
								"sProcessing": "Elaborazione...",
								"sSearch": "Cerca",
								"sZeroRecords": "La ricerca non ha portato alcun risultato.",
								"oPaginate": {
									"sFirst": "Inizio",
									"sPrevious": "Precedente",
									"sNext": "Successivo",
									"sLast": "Fine"
								},
								"oAria": {
									"sSortAscending": ": attiva per ordinare la colonna in ordine crescente",
									"sSortDescending": ": attiva per ordinare la colonna in ordine decrescente"
								}

							}
						});
			}



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
			// pre = "<span class='text-danger'>Errore:</span> ";
		} else {
			v = $("#" + i).val();
			// pre = "<span class='text-warning'>Obbligatorio:</span> ";
		}

		pre = "<span class='text-warning'>Obbligatorio</span> ";

		if (!v || v == "")
			out += pre + fields[i] + "<br />";
	}
	if (out != "") {
		bootbox
			.alert("<h3>ATTENZIONE</h3><p>Sono presenti degli errori, verificare prima di procedere.</p>"
				+ out);
		return false;
	} else
		return true;
}

function jsutil_len(id) {
	return $("#" + id).val().length;
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
		bootbox.alert("Attenzione! La data " + valore
			+ " è in formato non corretto (gg/mm/aaaa)!");
		good = false;
	} else if (d < 1 || d > 31 || m < 1 || m > 12 || y < 1900 || y > 2100) {
		bootbox.alert("Attenzione! Valori non permessi nella data " + valore
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
		bootbox.alert('Inserire solo valori numerici');
		$(":input[id='" + campo + "']").val("");
		$(":input[id='" + campo + "']").focus();
	}
}


function stampaRicevuta(obj, idCoda, url) {

	printJS({
		printable: url,
		type: 'pdf',
		showModal: false,
		onPrintDialogClose: () => bootbox
			.confirm({
				message: "<h2>Stampa riuscita?</h2>",
				buttons: {
					confirm: {
						label: '<i class="fa fa-check"></i> Si',
						className: 'btn-success'
					},
					cancel: {
						label: '<i class="fa fa-times"></i> No',
						className: 'btn-danger'
					}
				},
				callback: function(result) {
					if (result == true) {

						$
							.getJSON(
								codebase
								+ "/core/ajax.php?alias=stamparicevute/aj_paga",
								{
									id: idCoda
								},
								function(data) {
									if (data.result == false)
										bootbox
											.alert("<h3 class='text text-warning'>Si è verificato un errore con la stampa, accedere alla coda di stampa per verificare.</h3>");
								});
					}
				}
			})

	});
}