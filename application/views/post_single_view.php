<div class="post_main">
	<?=if(!empty($post['activity'])): ?>
		<? $this->load->view('co_posts_view') ?>
	<? else: ?>
		<? $this->load->view('user_post_view') ?>
	<? endif ?>
</div>