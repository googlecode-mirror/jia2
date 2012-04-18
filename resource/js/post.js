/**
 * ajax 发帖以及添加评论的js
 */
$(function() {
	$("button[name='comment']").attr('disabled', 'disabled');
	$("textarea[name='comment_content']").keyup(function() {
		$button = $(this).parent().next().children('button');
		if($(this).val() != '') {
			$button.removeAttr('disabled');
		} else {
			$button.attr('disabled', 'disabled');
		}
	});
	$("button[name='comment']").click(function() {
		$comment = $(this).parent().prev().children('textarea');
		content = $comment.val();
		post_id = $comment.attr('post_id');
		owner_id = $comment.attr('owner_id');
		type_id = $comment.attr('type_id');
		$.post(
			SITE_URL + "post/comment", {
				ajax:1,
				content: content,
				post_id: post_id,
				owner_id: owner_id,
			}, function(data) {
				$comment.val('');
				$comment.parent().prev().append(data);
			}
		);
	});
});
