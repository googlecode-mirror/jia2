$(function() {
	$("#email").blur(function(){
		var myreg = /\w+((-w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+/;	
		if($(this).val()==''){
			$("#email_prompt").text('邮箱不能为空');
		}else if(!myreg.test($(this).val())){
			$("#email_prompt").text('邮箱格式不正确');
		}else if(myreg.test($(this).val())){
			$("#email_prompt").text('邮箱格式正确');
		}
		$.post(SITE_URL+"index/do_regist", {
			ajax:1,
			email:email,
		}, function(data) {
				if(data.verify == 1) {
					window.location.href = SITE_URL;
				} else {
					$("#email_prompt").text(data.email);
					return false;
				}
			}, 'json'
		);
	})
	$("#name").blur(function(){		
		if($(this).val()==''){
			$("#name_prompt").text('姓名不能为空');
		}else if($(this).val()!==''){
			$("#name_prompt").text('姓名正确');
		}
	})
	$("#pass").blur(function(){		
		if($(this).val()==''){
			$("#pass_prompt").text('密码不能为空');
		}else if($(this).val()!==''){
			$("#pass_prompt").text('密码正确');
		}
	})
});