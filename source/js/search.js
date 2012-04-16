$(function() {
	$("#search_result_01 a[href]").attr('target', '_blank');
	$("#search_result_02 a[href]").attr('target', '_blank');
	$("#search_result_03 a[href]").attr('target', '_blank');
	$("#search_result_04 a[href]").attr('target', '_blank');
	$("button[name='search']").click(function() {
		keywords = $("#search-bar input[name='keywords']").val();
		if(keywords != '') {
			$.post(SITE_URL+'search/do_search',{
				ajax: 1,
				keywords: keywords,
				offset: 0
			}, function(data) {
				$("#user-result").empty();
				$("#user-result").append(data);
				}
			);
		}
		return false;
	});
});
