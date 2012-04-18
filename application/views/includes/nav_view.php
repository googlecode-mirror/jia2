<div class="header">
	<div class="head">
		<div class="left">
			<?=anchor('', '<strong>Jia2网Logo</strong>', 'class="logo"') ?>
			<?=anchor('', '首页', '') ?><?=anchor('personal', '个人主页', '') . anchor('', '搜索社团', '')?>
			<div id="search">
				<?=form_open('search') ?>
				<?=form_input(array('id' => 'textfield', 'maxlength' => 50, 'class' => 'keywords', 'name' => 'keywords')) ?>
				<?=form_hidden('offset', 0) ?>
				<?=form_submit('submit', '', 'class="button" style="background-image:url(' . site_url('resource/img/search.gif') . ')"') ?>
	            <?=form_close() ?>
			</div>
		</div>
		<div class="right">
			<? if($this->session->userdata('type') != 'guest'): ?>
				<?=anchor('', '站内信', '') ?>
				<?=anchor('', '好友请求', '') ?>
				<?=anchor('', '通知', '') ?>
				<?=anchor('', '账户', 'id="account-drop-down"') ?>
				<?=anchor('personal/setting', '设置', '') ?>
				<?=anchor('index/logout', '退出') ?>
			<? else: ?>
				<?=anchor('index/login', '登录') ?>
				<?=anchor('index/regist', '注册') ?>
			<? endif ?>
			
			<input type="image" src="<?=site_url('resource/img/search.gif') ?>" class="button hidden" />
		</div>				
	</div>
</div>