function Check(obj) {
	if (checkRequired({
		cognome : "Cognome",
		nome : "Nome",
		email : "Indirizzo email",
		username : "Username",
		password : "Password",
		password2 : "Password di conferma",
		captcha_value : "Inserire il codice di sicurezza"
	})) {

		if ($("#password").val() != $("#password2").val()) {
			bootbox.alert("Le password non coincidono");
			return false;
		}
		form_do(obj, null, "confirm");
		return true;
	}
}