var timerHeartbeat;

function startHeartbeat() {
	timerHeartbeat = setInterval(doTimerHeartbeat, 1000);
}

function stopHeartbeat() {
	clearInterval(timerHeartbeat);
}

function doTimerHeartbeat() {
	$.get(codebase + "/aj_heartbeat.php", function(data) { if (data == "-1") window.location = codebase; });
}


$(document)
	.ready(
		function() {

			startHeartbeat();
		});