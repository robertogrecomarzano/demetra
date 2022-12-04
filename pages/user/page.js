$(document)
	.ready(
		function() {
			$("i.material-icons.mdc-text-field__icon.mdc-text-field__icon--trailing").click(function() {

				var input = $(this).prev("input");
				if (input.attr("type") === "password") {
					$(this).html("visibility")
					input.attr("type", "text");
				} else {
					$(this).html("visibility_off")
					input.attr("type", "password");
				}

			})
		});


function check(obj) {

	if (checkRequired({
		password_old: _e("Password attuale"),
		password: _e("Password"),
		password2: _e("Password di conferma")
	})) {

		if ($("#password").val() != $("#password2").val()) {
			bootbox.alert(_e("Le password non coincidono"));
			return false;
		}
		form_submit(obj, 'password', null);
		return true;
	}
	return false;
}