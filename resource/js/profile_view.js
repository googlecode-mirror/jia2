$(function() {
	$("button[name='add_friend']").click(function() {
		user_id = $(this).attr('user_id');
		$.post(SITE_URL + 'personal/add_friend', {
			ajax: 1,
			user_id: user_id
		}, function(data) {
			if(data == 1) {
				$("button[name='add_friend']").attr('disabled', 'disabled');
				}
			}
		);
		return false;
	});
});
