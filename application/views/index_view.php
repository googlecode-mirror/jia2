<p>here is Jia2 </p>
<pre>
<? print_r($posts) ?>
</pre>
<p><?=$this->session->userdata('type') ?></p>
<p><?=$this->session->userdata('id') ?></p>
<div id="new_post">
	<?=form_open('post/add') ?>
	<?=form_textarea('content') ?>
	<?=form_submit('submit', '发布') ?>
</div>
<div class="post">

</div>