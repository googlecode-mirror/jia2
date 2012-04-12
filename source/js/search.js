$(function() {
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
