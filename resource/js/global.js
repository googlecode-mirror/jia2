
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
		$(this).css("border-color","#d8ecfb");
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

//发布评论按钮
/*
$(function(){
	$("#pub").hover(function(){
		$(".pub_btn").fadeIn("slow").css("display","block");
	},function(){
		$(".pub_btn").fadeOut("slow");
	});
	$(".comment_wrap").hover(function(){
		$(".comment_button").css("display","block").fadeTo("slow", 0.66);
	},function(){
		$(".comment_button").fadeOut("slow");
	});
})

*/
//输入框,
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