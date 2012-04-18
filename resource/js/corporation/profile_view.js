$(function() {
	$("button[name='follow']").click(function() {
		$button = $(this);
		corporation_id = $(this).attr('id');
		$.post(SITE_URL + 'corporation/follow', {
			ajax: 1,
			id: corporation_id
		}, function(data) {
			if(data == 1) {
				$button.attr('disables', 'disabled');
			}
		}
		);
		return false;
	});
});