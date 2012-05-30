$(function() {
	var source = $("#receiver").autocomplete("option", "source");
	$("#receiver").keyup(function() {
		key = $(this).val();
		$.post(
			SITE_URL + 'search/ajax_aucomplate', {
				ajax: 1,
				obj: 'user',
				from: 'all',
				key: key
			}, function(data) {
				$( "#receiver" ).autocomplete( "option", "source", data);
			}, 'json'
		)
	});
});