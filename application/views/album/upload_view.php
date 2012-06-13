<h4 class="title_01 title_02"><span>上传照片</span><?=anchor('album', '返回相册') ?></h4>
<div class="main_02">
	<p class="p_1">	支持JPG、JPEG、GIF和PNG文件，最大2M。	</p>
	<?=form_open_multipart('') ?>		
	<span href="" class="btn-blue">
		浏览
		<?=form_upload('userfile') ?>
	</span>
	<p><?=form_dropdown('album', $albums_id) ?></p>
	<p><?=form_submit('submit', '上传','class="pub_button file_btn"') ?></p>
	<?=form_close() ?>
</div>