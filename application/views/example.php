<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Pusher Test</title>

	<!--
	This example view uses the Pusher Javascript SDK to subscribe
	on new events. https://github.com/pusher/pusher-js
	-->

	<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
</head>
<body>

	<script type="text/javascript">
		// Enable pusher logging - don't include this in production
		Pusher.log = function(message) {
			if (window.console && window.console.log) {
				window.console.log(message);
			}
		};

		var pusher = new Pusher('ab0ec8cbb4f1cdead28e');
		var channel = pusher.subscribe('test_channel');

		channel.bind('my_event', function(data) {
			document.getElementById('event').innerHTML = data.message;
			alert(data.message);
		});
	</script>

	<p id="event">Waiting on event...</p>
	<p>Go to <strong><a href="/example/trigger_event" target="_blank">/example/trigger_event</a></strong> in a new tab to trigger event.</p>

</body>
</html>
