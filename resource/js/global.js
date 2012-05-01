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