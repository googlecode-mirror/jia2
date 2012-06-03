$(function() {
	$("#receiver").keyup(function() {
		key = $(this).val();
		if(key == '') {
			return;
		}
		$.post(
			SITE_URL + 'search/ajax_aucomplate', {
				ajax: 1,
				obj: 'user',
				from: 'all',
				key: key
			}, function(data) {
				$("#receiver").autocomplete({
					source: data,
					minLength: 1,
				});
			}, 'json'
		)
		
	});
});
