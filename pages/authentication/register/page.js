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


function formRegister() {

	let pwd = $("#password").val();
	let pwd2 = $("#password2").val();

	if (pwd != pwd2) {
		bootbox.alert("Le due password non coincidono");
		return false;
	}
	return true;
}		