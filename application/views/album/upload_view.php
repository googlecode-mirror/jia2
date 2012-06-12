<?=form_open_multipart('album/upload') ?>
	<p><?=form_upload() ?></p>
	<p><?=form_submit('submit', '上传') ?></p>
	<p></p>
	<p></p>
<?=form_close() ?>