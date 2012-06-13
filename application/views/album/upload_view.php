<h4 class="title_01 title_02"><span>上传照片</span><a>返回相册</a></h4>
<div class="main_02">
	<?=form_open_multipart('album/upload') ?>
	<p><?=form_upload() ?></p>
	<p><?=form_submit('submit', '上传') ?></p>
	<p></p>
	<p></p>
	<?=form_close() ?>
	<a href="#" >创建相册</a>
</div>