$(function() {
	$("#pass input[name='submit']").click(function() {
		old_pass = $("#pass input[name='old_pass']").val();
		pass = $("#pass input[name='pass']").val();
		pass_check = $("#pass input[name='pass_check']").val();
		$.post(SITE_URL + 'personal/do_setting', {
				ajax: 1,
				setting: 'pass',
				old_pass: old_pass,
				pass: pass,
				pass_check: pass_check,
		}, function(data) {
			if(data.verify == 1) {
				window.location.href = SITE_URL + 'personal/setting';
			} else {
				$("#old_pass_prompt").text(data.old_pass);
				$("#pass_prompt").text(data.pass);
				$("#pass_check_prompt").text(data.pass_check);
				return false;
			}
		}, 'json'
		);
		return false;
	});
});