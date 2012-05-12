
//下拉菜单
$(function(){
	$(".setting>ul").hide();
	$(".setting").hover(function(){
			$("ul",this).slideDown("fast");
		},function(){
			$("ul",this).slideUp("fast");
	});
	$("#nav_search_submit").attr('disabled', 'disabled');
	$("#nav_search_content").keyup(function() {
		if($(this).val != '') {
			$("#nav_search_submit").removeAttr('disabled');
		}
	});
});


//输入框
$(function(){
	$(".InputWrapper").hover(function(){
		 $(this).addClass("InputWrapper_hover");
	});
	$(".InputWrapper").focus(function(){
		 $(this).addClass("InputWrapper_focus");
	});
	$(".Textarea").hover(function(){
		 $(this).addClass("Textarea-hover");
	});
	$(".Textarea").focus(function(){
		 $(this).addClass("Textarea-focus");
	});
})