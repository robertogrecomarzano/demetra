/**
 * @param obj
 * @param id
 * @param action
 */
function form_do(obj, id, action) {
	var form = $(obj).parents("form");
	if (action != "" && action != null && action != undefined)
		form.find("#form_action").val(action);

	if (id != "" && id != null && id != undefined)
		form.find("#form_id").val(id);

	if (obj.type == 'button') {
		$("#loading").show();
		form.submit();
	} else {
		if (action == "mod2" || action == "add2")
			$("form").submit(function(event) {
				event.preventDefault();
			});

		if (action == "mod2" || action == "add2")
			form.unbind('submit').submit(function(event) {
				$("#loading").show();
			});
		else {
			$("#loading").show();
			form.submit();
		}
	}

}

/**
 * 
 * @param obj
 */
function form_confirm(obj) {

	bootbox.confirm({
		title: "Attenzione",
		message: "Sei sicuro di voler proseguire?",
		buttons: {
			confirm: {
				label: '<i class="leading-icon material-icons fa fa-check"></i> Si',
				className: 'btn-success'
			},
			cancel: {
				label: '<i class="leading-icon material-icons fa fa-times"></i> Annulla',
				className: 'btn-danger'
			}
		},
		callback: function(result) {
			if (result)
				form_do(obj, null, "confirm");
		}
	});

}


/**
 * 
 * @param obj
 */
function form_submit(obj, action, action_id) {

	bootbox.confirm({
		title: "Attenzione",
		message: "Sei sicuro di voler proseguire?",
		buttons: {
			confirm: {
				label: '<i class="leading-icon material-icons fa fa-check"></i> Si',
				className: 'btn-success'
			},
			cancel: {
				label: '<i class="leading-icon material-icons fa fa-times"></i> Annulla',
				className: 'btn-danger'
			}
		},
		callback: function(result) {
			if (result)
				form_do(obj, action_id, action);
		}
	});

}

/**
 * 
 * @param obj
 */
function form_add(obj) {
	form_do(obj, null, "add");
}

/**
 * 
 * @param obj
 * @param id
 */
function form_add2(obj, id) {
	form_do(obj, null, "add2");
}

/**
 * 
 * @param obj
 * @param id
 */
function form_mod(obj, id) {
	form_do(obj, id, "mod");
}

/**
 * 
 * @param obj
 * @param id
 */
function form_mod2(obj, id) {
	form_do(obj, id, "mod2");
}

/**
 * 
 * @param obj
 * @param id
 */

function form_annulla(obj) {
	form_do(obj, null, "annulla");
}


/**
 * 
 * @param obj
 * @param id
 */
function form_del(obj, id) {

	bootbox.confirm({
		title: "Eliminazione",
		message: "Sei sicuro di voler procedere con la cancellazione?",
		buttons: {
			confirm: {
				label: '<i class="leading-icon material-icons fa fa-check"></i> Si',
				className: 'btn-success'
			},
			cancel: {
				label: '<i class="leading-icon material-icons fa fa-times"></i> Annulla',
				className: 'btn-danger'
			}
		},
		callback: function(result) {
			if (result) {
				var form = $(obj).parents("form");
				form.find("#form_method").val("DELETE");
				form_do(obj, id, "delete");
			}
		}
	});

}


/**
 * 
 * @param obj
 * @param id
 */
function form_update(obj, id) {
	bootbox.confirm({
		title: "Salvataggio",
		message: "Sei sicuro di voler procedere con la modifica dei dati?",
		buttons: {
			confirm: {
				label: '<i class="leading-icon material-icons fa fa-check"></i> Si',
				className: 'btn-success'
			},
			cancel: {
				label: '<i class="leading-icon material-icons fa fa-times"></i> Annulla',
				className: 'btn-danger'
			}
		},
		callback: function(result) {
			if (result) {
				var form = $(obj).parents("form");
				form.find("#form_method").val("PUT");
				form_do(obj, id, "update");
			}
		}
	});
}


/**
 * 
 * @param obj
 * @param id
 */
function form_update_preview(obj, id) {
	bootbox.confirm({
		title: "Salvataggio",
		message: "Sei sicuro di voler procedere con la modifica dei dati?",
		buttons: {
			confirm: {
				label: '<i class="leading-icon material-icons fa fa-check"></i> Si',
				className: 'btn-success'
			},
			cancel: {
				label: '<i class="leading-icon material-icons fa fa-times"></i> Annulla',
				className: 'btn-danger'
			}
		},
		callback: function(result) {
			if (result) {
				var form = $(obj).parents("form");
				form.find("#form_method").val("PUT");
				form_do(obj, id, "update_preview");
			}
		}
	});
}

/**
 * @param obj
 */
function form_insert(obj) {

	bootbox
		.confirm({
			title: "Registrazione",
			message: "Registrazione di un nuovo record. Vuoi procedere?",
			buttons: {
				confirm: {
					label: '<i class="fa fa-check"></i> Si',
					className: 'btn-success'
				},
				cancel: {
					label: '<i class="fa fa-times"></i> Annulla',
					className: 'btn-danger'
				}
			},
			callback: function(result) {
				if (result) {
					var form = $(obj).parents("form");
					form.find("#form_method").val("POST");
					form_do(obj, null, "store");
				}
			}
		});

}

/**
 * @param obj
 */
function form_insert_preview(obj) {

	bootbox
		.confirm({
			title: "Registrazione",
			message: "Registrazione di un nuovo record. Vuoi procedere?",
			buttons: {
				confirm: {
					label: '<i class="fa fa-check"></i> Si',
					className: 'btn-success'
				},
				cancel: {
					label: '<i class="fa fa-times"></i> Annulla',
					className: 'btn-danger'
				}
			},
			callback: function(result) {
				if (result) {
					var form = $(obj).parents("form");
					form.find("#form_method").val("POST");
					form_do(obj, null, "store_preview");
				}
			}
		});

}


/**
 * @param obj
 */
function form_insert_new(obj) {

	bootbox
		.confirm({
			title: "Registrazione",
			message: "Registrazione di un nuovo record. Vuoi procedere?",
			buttons: {
				confirm: {
					label: '<i class="fa fa-check"></i> Si',
					className: 'btn-success'
				},
				cancel: {
					label: '<i class="fa fa-times"></i> Annulla',
					className: 'btn-danger'
				}
			},
			callback: function(result) {
				if (result) {
					var form = $(obj).parents("form");
					form.find("#form_method").val("POST");
					form_do(obj, null, "store_new");
				}
			}
		});

}

/**
 * 
 * @param obj
 * @param id
 */
function form_clone(obj, id) {

	bootbox.confirm({
		title: "Duplicazione",
		message: "Sei sicuro di voler procedere con la duplicazione?",
		buttons: {
			confirm: {
				label: '<i class="leading-icon material-icons fa fa-check"></i> Si',
				className: 'btn-success'
			},
			cancel: {
				label: '<i class="leading-icon material-icons fa fa-times"></i> Annulla',
				className: 'btn-danger'
			}
		},
		callback: function(result) {
			if (result) {
				var form = $(obj).parents("form");
				form.find("#form_method").val("POST");
				form_do(obj, null, "clone");
			}
		}
	});

}