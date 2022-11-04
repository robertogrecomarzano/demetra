function setConfig(obj, id) {
	var txt = "Sicuro di voler proseguire?";
	var yes = "Sì";
	var cancel = "Annulla";

	bootbox.confirm({
		title : "Attenzione",
		message : txt,
		buttons : {
			confirm : {
				label : '<i class="fa fa-check"></i> ' + yes,
				className : 'btn-success'
			},
			cancel : {
				label : '<i class="fa fa-times"></i> ' + cancel,
				className : 'btn-danger'
			}
		},
		callback : function(result) {
			if (result)
				form_do(obj, id, "mod2");
		}
	});
}
