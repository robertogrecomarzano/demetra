function setConfig(obj) {
	var txt = _e("Sicuro di voler proseguire?");
	var yes = _e("Sì");
	var cancel = _e("Annulla");

	bootbox.confirm({
		title: "Attenzione",
		message: txt,
		buttons: {
			confirm: {
				label: '<i class="fa fa-check"></i> ' + yes,
				className: 'btn-success'
			},
			cancel: {
				label: '<i class="fa fa-times"></i> ' + cancel,
				className: 'btn-danger'
			}
		},
		callback: function(result) {
			if (result)
				form_do(obj, null, null);
		}
	});
}





