/**
 * ajax 发帖以及添加评论的js
 */
$(function() {
	$("textarea[name='comment_content']").keyup(function() {
		$button = $(this).parent().next().children('button');
		if($(this).val() != '') {
			$button.removeAttr('disabled');
		} else {
			$button.attr('disabled', 'disabled');
		}
	});
	$("button[name='comment']").click(function() {
		//$comment = $(this).parent().prev().children('textarea');
		$comment = $(this).parent().prev("p").children("textarea");
		alert($comment.val());
		return false;
		content = $comment.val();
		post_id = $comment.attr('post_id');
		type = $comment.attr('type');
		$.post(
			SITE_URL + "post/comment", {
				ajax:1,
				content: content,
				post_id: post_id,
				type: type
			}, function(data) {
				if(data == "0") {
					alert('由于对方隐私设置，你不能评论~');
				} else {
					$comment.val('');
					$comment.parent().parent().prev().append(data);
				}
			}
		);
	});
	
	$("textarea[name='post_content']").keyup(function() {
		if($(this).val() != '') {
			$("button[name='post']").removeAttr('disabled');
		} else {
			$("button[name='post']").attr('disabled', 'disabled');
		}
	});
	$("button[name='post']").click(function() {
		content = $("textarea[name='post_content']").val();
		$.post(SITE_URL + "post/add", {
			ajax: 1,
			content: content
		}, function(data) {
			if(data == '0') {
				alert('发表失败');
			} else {
				$("textarea[name='post_content']").val('');
				$("#feed_1").prepend(data);
			}
		}
		);
	});
});