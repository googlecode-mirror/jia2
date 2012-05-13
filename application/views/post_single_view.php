<div class="post_main">
	<? if(!empty($posts['activity'])): ?>
		<? $this->load->view('post/co_posts_view') ?>
	<? else: ?>
		<? $this->load->view('post/user_posts_view') ?>
	<? endif ?>
</div>