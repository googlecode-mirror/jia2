<? $this->load->view('includes/slider_bar_view') ?>
<!-- <script>
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
</script> -->
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
				<div class="search_item"><ul>
					<li class="sd01" id="po1">
						<a href="" id="active">全部</a>
					</li>
					<li class="sd02" id="po2">
						<a href="">活动日志</a>
					</li>
					<li class="sd02" id="po3">
						<a href="">活动图片</a>
					</li>
					<div class="right">
					<li><a href="">刷新</a></li>
					</div>
				</ul></div>
	</div>
	<div id="feeds_container" class="feeds">
		<ul id="feed_1">
			<?=$this->load->view('post/user_posts_view') ?>
			
		</ul>
		<ul id="feed_2" class="hidden">
			<?=$this->load->view('post/co_posts_view') ?>
		</ul>
	</div>
</div>