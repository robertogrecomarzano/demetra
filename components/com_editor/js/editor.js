var editor;

function alertBox(message, className) {

	$.notify({
		// options
		message : message
	}, {
		// settings
		type : className,
		delay : 5,
		offset : 5,
		spacing : 5,
		animate : {
			enter : "animated fadeInRight",
			exit : "animated fadeOutRight"
		},
		placement : {
			align : "right"
		}
	}

	);

}

function reloadFiles() {
	$.post(codebase + "/core/ajax.php?plugin=Editor&action=process", {
		action : "reload"
	}, function(data) {
		$("#files > div").jstree("destroy");
		$("#files > div").html(data);
		$("#files > div").jstree();
		$("#files > div a:first").click();
		$("#path").html("");

		window.location.hash = "/";
	});
}

$(function() {

	$("#editor")
			.summernote(
					{
						"height" : "100vh",
						"width" : "100%",
						"dialogsInBody" : true,
						"prettifyHtml" : true,
						"codemirror" : {
							"mode" : "text/x-smarty",
							"htmlMode" : false,
							"lineNumbers" : true,
							"theme" : "monokai",
							"width" : "100px",
							"textWrapping" : true
						},
						"disableDragAndDrop" : true,
						"toolbar" : [
								[ "paragraph", [ "style" ] ],
								[ "fontsize",
										[ "fontname", "fontsize", "color" ] ],
								[
										"style",
										[ "bold", "italic", "underline",
												"strikethrough", "clear" ] ],
								[ "paragraph", [ "ol", "ul", "paragraph" ] ],
								[
										"insert",
										[ "table", "link", "picture", "video",
												"hr" ] ],
								[ "misc", [ "codeview" ] ] ]
					});
	/*
	 * editor = CodeMirror.fromTextArea($("#editor")[0], { lineNumbers : true,
	 * mode : "text/x-smarty", indentUnit : 4, indentWithTabs : true,
	 * lineWrapping : true });
	 */
	$("#files > div").jstree({
		state : {
			key : "pheditor"
		},
		plugins : [ "state" ]
	});

	$("#files").on("click", "a.open-file", function(event) {
		event.preventDefault();

		var file = $(this).attr("data-file"), _this = $(this);

		window.location.hash = file;

		$.post(codebase + "/core/ajax.php?plugin=Editor&action=process", {
			action : "open",
			file : encodeURIComponent(file)
		}, function(data) {

			// editor.setValue(data);
			$(".note-editable.panel-body").html(data);
			// $("#editor").attr("data-file", file);
			$("#path").html(file);
			$(".dropdown").find(".save, .close").removeClass("disabled");

		});
	});

	$("#files").on("click", "a.open-dir", function(event) {
		event.preventDefault();

		var dir = $(this).attr("data-dir"), _this = $(this);

		window.location.hash = dir;

		editor.setValue("");
		$("#path").html(dir);
		$(".dropdown").find(".save, .reopen, .close").addClass("disabled");
		$(".dropdown").find(".delete, .rename").removeClass("disabled");
	});

	$("#files").css("height", "100vh");

	if (window.location.hash.length > 1) {
		var hash = window.location.hash.substring(1);

		setTimeout(function() {
			$(
					"#files a[data-file=\"" + hash
							+ "\"], #files a[data-dir=\"" + hash + "\"]")
					.click();
		}, 500);
	}

	$(".save").click(
			function() {
				var path = $("#path").html(), data = $(
						".note-editable.panel-body").html();

				if (path.length > 0) {
					$.post(codebase
							+ "/core/ajax.php?plugin=Editor&action=process", {
						action : "save",
						file : path,
						data : data
					}, function(data) {
						data = data.split("|");

						alertBox(data[1], data[0]);

					});
				} else {
					alertBox("Seleziona un file", "warning");
				}
			});

	/*
	 * $(window).resize( function() { if (window.innerWidth >= 720) { var height =
	 * window.innerHeight - $(".CodeMirror")[0].getBoundingClientRect().top- 20;
	 * 
	 * $("#files").css("height", "100vh"); } else { $("#files > div,
	 * .CodeMirror").css("height", ""); } });
	 * 
	 * $(window).resize();
	 */

	$(document).bind("keyup keydown", function(event) {
		if ((event.ctrlKey || event.metaKey) && event.shiftKey) {
			if (event.keyCode == 78) {
				$(".dropdown .new-file").click();
				event.preventDefault();

				return false;
			} else if (event.keyCode == 83) {
				$(".dropdown .save").click();
				event.preventDefault();

				return false;
			}
		}
	});

	$(document).bind("keyup", function(event) {
		if (event.keyCode == 27) {
			if (document.activeElement.tagName.toLowerCase() == "textarea") {
				$(".jstree-clicked").focus();
			} else {
				editor.focus();
			}
		}
	});
});