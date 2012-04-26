$(function() {
	$.post(SITE_URL + 'notify/check', {
		ajax: 1
	}, function(data) {
		$("#letter_notify").append('(' + data.letter + ')');
		$("#request_notify").append('(' + data.request + ')');
		$("#message_notify").append('(' + data.message + ')');
	}, 'json'
	);
});
