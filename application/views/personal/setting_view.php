<!-- 个人资料设置视图,包含三个tab 资料设置  头像设置 隐私设置-->
<h2>资料设置</h2>
	<?=form_open('personal/do_setting')?>
	<?=form_hidden('setting', 'info') ?>
	<p>姓名: <?=form_input('name', $info[0]['name']) ?></p>
	<p>性别: <?=form_dropdown('gender', array('1'=> '男淫', '0' => '女淫'), $info[0]['gender']) ?></p>
	<p>学校，省份 等等...</p>
	<p><?=form_submit('submit', '更新') ?></p>
	<?=form_close() ?>
<h2>头像设置</h2>
<div id="avatar-setting">
	<?=form_open_multipart('personal/do_setting') ?>
	<?=form_upload('userfile') ?>
	<?=form_hidden('setting', 'avatar') ?>
	<?=form_submit('submit', '上传') ?>
	<?=form_close() ?>
</div>
<h2>账户设置</h2>
	<h3>修改密码</h3>
	<?=form_open('personal/do_setting', 'id="pass"')?>
	<?=form_hidden('setting', 'pass') ?>
	<p>原密码: <?=form_password('old_pass') ?></p>
	<span class="prompt" id="old_pass_prompt"></span>
	<p>新密码: <?=form_password('pass') ?></p>
	<span class="prompt" id="pass_prompt"></span>
	<p>确认密码: <?=form_password('pass_check') ?></p>
	<span class="prompt" id="pass_check_prompt"></span>
	<p><?=form_submit('submit', '更新') ?></p>
	<?=form_close() ?>
<h2>隐私设置</h2>
	<?=form_open('personal/do_setting')?>
	<?=form_hidden('setting', 'privacy') ?>
	<p>浏览权限: <?=form_dropdown('post', array('guest' => '所有人', 'register' => '注册用户', 'friend' => '仅好友', 'self' => '仅自己'), $privacy['post']) ?></p>
	<p>评论权限: <?=form_dropdown('comment', array('guest' => '所有人', 'register' => '注册用户', 'friend' => '仅好友', 'self' => '仅自己'), $privacy['comment']) ?></p>
	<p><?=form_submit('submit', '更新') ?></p>
	<?=form_close() ?>