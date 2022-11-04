function form_insert(obj) {

	if (checkRequired({
		"*$('input[name^=gruppo]:checked').length > 0" : "Indicare almeno un gruppo",
		"*$('input[name^=servizio]:checked').length > 0" : "Indicare almeno un servizio",
		cognome : "Cognome",
		nome : "Nome",
		email : "Indirizzo email",
		username : "Username",
		password : "Password"
	}))
		bootbox
				.confirm({
					title : "Registrazione nuovo utente",
					message : "Registrazione di un nuovo utente del sistema. Vuoi procedere?",
					buttons : {
						confirm : {
							label : '<i class="fa fa-check"></i> Si',
							className : 'btn-success'
						},
						cancel : {
							label : '<i class="fa fa-times"></i> Annulla',
							className : 'btn-danger'
						}
					},
					callback : function(result) {
						if (result)
							form_do(obj, null, "add2");
					}
				});

}