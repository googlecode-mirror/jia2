$(function() {
	$("button[name='follow']").click(function() {
		$button = $(this);
		corporation_id = $(this).attr('id');
		$.post(SITE_URL + 'corporation/follow', {
			ajax: 1,
			id: corporation_id
		}, function(data) {
			if(data == 1) {
				$button.attr('disabled', 'disabled');
				$button.text('已关注');
			} else{
				alert('由于对方的隐私设置关注失败');
			}
		}
		);
		return false;
	});
	$("button[name='unfollow']").click(function() {
		$button = $(this);
		corporation_id = $(this).attr('id');
		$.post(SITE_URL + 'corporation/unfollow', {
			ajax: 1,
			id: corporation_id
		}, function(data) {
			if(data == 1) {
				$button.remove();
				$("button[name='follow']").removeAttr('disabled');
				$("button[name='follow']").text('关注');
			} else {
				alert('取消关注失败');
			}
		}
		);
		return false;
	});
});