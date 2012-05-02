// //页面最小高度
// var winHeight = 0;
// var Height = 0;
// function findDimensions()
// {
	// if(window.innerHeight)
		// winHeight = window.innerHeight;
	// else if((document.body) && (document.body.clientHeight))
		// winHeight = document.body.clientHeight;
	// if(document.documentElement && document.documentElement.clientHeight && document.documentElement.clientWidth) {
		// winHeight = document.documentElement.clientHeight;
	// }
	// alert(winHeight);
	// document.getElementById("body").style.height = winHeight+"px";
	// Height=winHeight-1000;
	// alert('content:'+Height);
	// document.getElementById("content").style.height =Height+"px";
// }
// // window.onload = findDimensions;

//发布文本框
var agt = navigator.userAgent.toLowerCase();
var is_op = (agt.indexOf("opera") != -1);
var is_ie = (agt.indexOf("msie") != -1) && document.all && !is_op;
function ResizeTextarea(a,row){
    if(!a){return}
    if(!row)
        row=5;
    var b=a.value.split("\n");
    var c=is_ie?1:0;
    c+=b.length;
    var d=a.cols;
    if(d<=20){d=40}
    for(var e=0;e<b.length;e++){
        if(b[e].length>=d){
            c+=Math.ceil(b[e].length/d)
        }
    }
    c=Math.max(c,row);
    if(c!=a.rows){
        a.rows=c;
    }
}

$(document).ready(function(){
	$("textarea").hover(function(){
		$(this).css("border-color","#676767");
	},function(){
		$(this).css("border-color","#E1E1E1");
	});
	$("body").css("min-height",document.body.clientWidth);
})

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

