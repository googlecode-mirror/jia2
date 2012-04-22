<!-- <div class="header">
	<div class="head">
		<div class="left">
			<?=anchor('', '<strong>Jia2网Logo</strong>', 'class="logo"') ?>
			<?=anchor('', '首页', '') ?><?=anchor('personal', '个人主页', '') . anchor('', '社团之家', ''). anchor('', '活动之家', '')?>
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
</div> -->
<script>
			$(document).ready(function(){
				$(".setting>ul").hide();
				$(".setting").hover(function(){
						$("ul",this).slideDown("fast");
					},function(){
						$("ul",this).slideUp("fast");
					});
			});
		</script>
<div id="header">
			<div id="head">
				<div class="left" id="head_nav">
					<?=anchor('', 'Jia2网Logo') ?>
					<?=anchor('', '首页', '') ?><?=anchor('personal', '个人主页', '') . anchor('', '社团之家', '')?>
				</div>
				<span class="search left">
					<?=form_open('search') ?>
					<?=form_input(array('id' => 'textfield', 'maxlength' => 50, 'class' => 'keywords', 'name' => 'keywords','value' => '社团/活动/搜人...')) ?>
					<?=form_hidden('offset', 0) ?>
					<?=form_submit('buton', '', 'class="button"') ?>
		            <?=form_close() ?>
				</span>
				<div class="right">
					
					<div class="setting">
						<a href="" class="nav_1">通知</a>
						<ul class="drop_box" >
							<li><a href="">站内信</a></li>
							<li><a href="">请求</a></li>
							<li><a href="">消息</a></li>
						</ul>
					</div>
					<div class="setting">
						<?=anchor('personal/setting', '设置', '') ?>
						<ul class="drop_box" >
							<li><a href="setting.html" >资料修改</a></li>
							<li><a href="setting.html" >头像修改</a></li>
							<li><a href="setting.html" >隐私修改</a></li>
						</ul>
					</div>
					<div class="setting">
						<?=anchor('index/logout', '退出') ?>
					</div>
					<!-- <? if($this->session->userdata('type') != 'guest'): ?>
					<?=anchor('', '通知', '') ?>
					<?=anchor('', '账户', 'id="account-drop-down"') ?>
					<?=anchor('personal/setting', '设置', '') ?>
					<?=anchor('index/logout', '退出') ?>
					<? else: ?>
						<?=anchor('index/login', '登录') ?>
						<?=anchor('index/regist', '注册') ?>
					<? endif ?> -->
				</div>			
			</div>
		</div>
		