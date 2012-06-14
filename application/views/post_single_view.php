<h4 class="title_01 title_02"><span>动态</span><a>返回首页</a></h4>
<div id="main">
		<div class="post_main">
		<? if(!empty($posts['activity'])): ?>
			<? $this->load->view('post/co_posts_view') ?>
		<? else: ?>
			<? $this->load->view('post/user_posts_view') ?>
		<? endif ?>
		</div>
</div>