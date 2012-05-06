$(function() {
	$("#write_letter").click(function() {
		$("#write_letter_area").toggle();
		if($("#write_letter_area").is(":hidden")) {
			$(this).text('写站内信');
		} else {
			$(this).text('取消');
		}
	});
	
	$("#receiver, #letter_content").keyup(function() {
		if($("#receiver").val() != '' && $("#letter_content").val() != '') {
			$("#send_letter").removeAttr('disabled');
		} else {
			$("#send_letter").attr('disabled', 'disabled');
		}
	});
	
	$("#send_letter").click(function() {
		receiver = $("#receiver").val();
		content = $("#letter_content").val();
		$.post(SITE_URL + 'notify/letter', {
			ajax: 1,
			receiver: receiver,
			content: content
		}, function(data) {
			if(data.success == 1) {
				$("#receiver").val('');
				$("#letter_content").val('');
				$('#write_letter').trigger('click');
				alert('发送成功');
			} else {
				alert(data.message);
			}
		}, 'json');
	});
	
	// 默认请求收件箱
	$.post(SITE_URL + 'notify?type=letter', {
		ajax: 1,
		box: 'in'
	}, function(data) {
		$("#letter_box").empty
	});
});