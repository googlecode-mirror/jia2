<!-- 个人资料设置视图,包含三个tab 资料设置  头像设置 隐私设置-->
<div id="avatar-setting">
	<?=form_open_multipart('personal/setting/') ?>
	<?=form_upload('avatar') ?>
	<?=form_submit('submit', '上传') ?>
	<?=form_close() ?>
</div>