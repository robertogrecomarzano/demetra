$(document).ready(init);

function init() {
	$("#help a").click(function() {
		bootbox.alert("<?php use App\Core\Lib\Security;

Security::getAndStoreCSRFToken(); ?>");
	});
}