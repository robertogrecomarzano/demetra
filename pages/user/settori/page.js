var url = $("#form_alias").val();
var action = $("#form_action").val();

$(document).ready(
	function() {

		$('#note').summernote({
			toolbar: [
				['style', ['bold', 'italic', 'underline', 'clear']],
				['para', ['ul', 'ol', 'paragraph']],
				['view', ['fullscreen', 'codeview', 'help']]
			],

			dialogsInBody: true,
			height: "160px",
			cleaner: {
				action: 'both', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
				//newline: '<br>', // Summernote's default is to use '<p><br></p>'
				notStyle: 'position:absolute;top:0;left:0;right:0', // Position of Notification
				icon: '<i class="note-icon">[Your Button]</i>',
				keepHtml: true, // Remove all Html formats
				keepOnlyTags: [], // If keepHtml is true, remove all tags except these
				keepClasses: false, // Remove Classes
				badTags: ['style', 'script', 'applet', 'embed', 'noframes', 'noscript', 'html'], // Remove full tags with contents
				badAttributes: ['style', 'start'], // Remove attributes from remaining tags
				limitChars: false, // 0/false|# 0/false disables option
				limitDisplay: 'both', // text|html|both
				limitStop: false // true/false
			}

		});



	});



function checkCompetence(obj) {
	if (checkRequired({
		id_settore: "Selezionare il settore",


	})) {
		var action = $("#form_action").val();
		var action_id = $("#form_id").val();

		switch (action) {
			case "add":
				return form_add2(obj);
				break;
			case "mod":
				return form_mod2(obj, action_id);
				break;
		}

	}
}