<div id="post_blog">
	<p><?=form_open('blog/post') ?> </p>
	<p>标题<?=form_input('title') ?></p>
	<p>标签<?=form_input('tag') ?></p>
	<p>多个标签请用空格隔开</p>
	<?=$this->load->view('blog/editor') ?>
</div>