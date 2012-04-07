<div class="header">
	<div class="head">
		<div class="left">
			<?=anchor('', '<strong>Jia2网Logo</strong>', 'class="nav_1"') ?>
			<?=anchor('', '首页', 'class="nav_1"') ?><?=anchor('personal', '个人主页', 'clas="nav_1"') . anchor('', '搜索社团', 'class="nav_1"')?>
		</div>
		<div class="right">
			<?=form_open('') ?>
				<?=form_input(array('id' => 'textfield', 'maxlength' => 50, 'class' => 'keywords', 'name' => 'keywords')) ?>
				<?=form_close() ?>
			<? if($this->session->userdata('type') == 'register'): ?>
				<?=anchor('', '站内信', 'class="nav_1"') ?>
				<?=anchor('', '好友请求', 'class="nav_1"') ?>
				<?=anchor('', '通知', 'class="nav_1"') ?>
				<?=anchor('', '账户', 'id="account-drop-down"') ?>
				<?=anchor('personal/setting', '设置', 'class="nav_1"') ?>
				<?=anchor('index/logout', '退出') ?>
			<? else: ?>
				<?=anchor('index/login', '登录') ?>
				<?=anchor('index/regist', '注册') ?>
			<? endif ?>
			
			<input type="image" src="<?=site_url('source/img/search.gif') ?>" class="button hidden" />
		</div>				
	</div>
</div>