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
				<?=form_input(array('id' => 'textfield', 'maxlength' => 50, 'class' => 'keywords', 'name' => 'keywords')) ?>
				<?=form_hidden('offset', 0) ?>
				<?=form_submit('buton', '', 'class="button"') ?>
	            <?=form_close() ?>
			</span>
		<div class="right">
			<? if($this->session->userdata('type') != 'guest'): ?>
			<div class="setting">
				<?=anchor('', '通知', '') ?>
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
				<?=anchor('index/logout', '退出') ?>
			<? else: ?>
				<?=anchor('index/login', '登录') ?>
				<?=anchor('index/regist', '注册') ?>
			<? endif ?>
		</div>			
	</div>
</div>