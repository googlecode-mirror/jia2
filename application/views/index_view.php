<? $this->load->view('includes/slider_bar_view') ?>
<div id="main">
<div class="post_top">
	<form id="pub">
		<div><textarea cols="80" rows="2" name="mytext"></textarea></div>
		<div class="input">
			<input type="button" value="发布" class="button_pub"/>
		</div>
	</form>
</div>
<div class="post_main">
	<div class="post_switch">
		<div class="left">
			<a href="" class="icon">全部</a><a href="" class="icon">活动日志</a><a href="" class="icon">活动图片</a>
		</div>
		<div class="right">
			<a href="" class="icon">刷新</a><a href="" class="icon">设置</a>
		</div>
	</div>
	<div id="feeds_container" class="feeds">
		<ul id="feed_1">
			<?=$this->load->view('post/user_posts_view') ?>
			<?=$this->load->view('post/co_posts_view') ?>