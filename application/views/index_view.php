<? $this->load->view('includes/slider_bar_view') ?>
<script>
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
})
</script>
<div id="main">
<div class="post_top">
	<form id="pub">
		<div><textarea cols="80" rows="2" name="post_content" onfocus="javascript:ResizeTextarea(this,2);" onclick="javascript:ResizeTextarea(this,2);" onkeyup="javascript:ResizeTextarea(this,2);"></textarea></div>
		<div class="input">
			<?=form_button('post', '发布') ?>
		</div>
	</form>
</div>
<div class="post_main">
	<div class="post_switch">
		<div class="left">
			<a href="" class="icon" id="po1">全部</a> | <a href="" class="icon" id="po2">活动日志</a> | <a href="" class="icon" id="po3">活动图片</a>
		</div>
		<div class="right">
			<a href="" class="icon">刷新</a>
		</div>
	</div>
<script>
window.onload = function(){
	var SDmodel = new scrollDoor();
	SDmodel.sd(["po1", "po2", "po3"], ["feed_1", "feed_2", "feed_3"], "sd01", "sd02");
}
</script>
	<div id="feeds_container" class="feeds">
		<ul id="feed_1">
			<?=$this->load->view('post/user_posts_view') ?>
			
		</ul>
		<ul id="feed_2" class="hidden">
			<?=$this->load->view('post/co_posts_view') ?>
		</ul>
	</div>
</div>
</div>