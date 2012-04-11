<div class="container">
	<div class="content_main">
		<div class="main_top">
			<a href="#" class="head_pic"><img src="<?=avatar_url($this->session->userdata('avatar'), 'big') ?>" /> 
			<div class="clear"></div><h4><?=$this->session->userdata('name')?></h4> </a>
			<div class="pub">
				<div  class="tab">
					<ul>
						<li class="sd01" id="mmm01">
							<a href="#">资料设置</a>
						</li>
						<li class="sd02" id="mmm02">
							<a href="#">头像设置</a>
						</li>
						<li class="sd02" id="mmm03">
							<a href="#">账户设置</a>
						</li>
						<li class="sd02" id="mmm04">
							<a href="#">隐私设置</a>
						</li>
					</ul>
				</div>
				<div class="clear"></div>
				<div class="tab_cont_box user_setting">
					<div id="ccc01">
						<h4 class="set_title"><span>某某</span>，你好！<a id="modify" href="#">修改</a></h4>
						<ul id="user_info">
							<li>姓名：<span>tiramisu</span></li>
							<li>性别：<span>女</span></li>
							<li>学校：<span>成都信息工程学院</span></li>
							<li>省份：<span>四川省</span></li>
						</ul>
						<ul id="user_info_form" class="hidden">
						<?=form_open('personal/do_setting')?>
						<?=form_hidden('setting', 'info') ?>
							<li>姓名：<?=form_input('name') ?></li>
							<li>性别：<?=form_dropdown('gender', array('1'=> '男淫', '0' => '女淫')) ?></li>
							<li>学校：<?=form_input('name') ?></li>
							<li>省份：<?=form_dropdown('gender', array('0'=> '四川', '1' => '重庆','2'=> '贵州', '3' => '云南')) ?>
									  <?=form_dropdown('gender', array('0'=> '四川', '1' => '重庆','2'=> '贵州', '3' => '云南')) ?></li>
							<li><?=form_submit('submit', '保存','class="button"') ?></li>
						<?=form_close() ?>
						</ul>
					</div>
					<div id="ccc02" class="hidden">
						<h4 class="set_title">设置新头像</h4>
						<p><a href="#">使用照片</a>&nbsp; |&nbsp; <a href="#">使用摄像头</a><br />
							支持JPG、JPEG、GIF、BMP和PNG文件，最大4M。
						</p>
						<a href="#" class="button" id="uploading">上传头像</a>
						<?=form_open_multipart('personal/do_setting') ?>
						<?=form_upload('userfile','class="button"') ?>
						<?=form_hidden('setting', 'avatar') ?>
						<?=form_submit('submit', '上传') ?>
						<?=form_close() ?>
						<p>使用真实姓名，上传真实头像，成为星级用户</p>
						
						<h4 class="set_title">当前头像</h4>
						<a href="#" class="head_pic"><img src="<?=avatar_url($this->session->userdata('avatar'), 'big') ?>" /> </a>
					</div>
					<div id="ccc03" class="hidden">
						<h4 class="set_title">修改密码</h4>
						<ul id="pass_setting">
						<?=form_open('personal/do_setting', 'id="pass"')?>
						<?=form_hidden('setting', 'pass') ?>
							<li>原  密  码: <?=form_password('old_pass') ?></li>
							<span class="prompt" id="old_pass_prompt"></span>
							<li>新  密  码: <?=form_password('pass') ?></li>
							<span class="prompt" id="pass_prompt"></span>
							<li>确认密码: <?=form_password('pass_check') ?></li>
							<span class="prompt" id="pass_check_prompt"></span>
							<li><?=form_submit('submit', '更新','class="button"') ?></li>
						<?=form_close() ?>
						</ul>
					</div>
					<div id="ccc04" class="hidden">
						<h4 class="set_title">隐私设置</h4>
						<ul id="pass_setting">
						<?=form_open('personal/do_setting')?>
						<?=form_hidden('setting', 'privacy') ?>
							<li>浏览权限: <?=form_dropdown('post', array('guest' => '所有人', 'register' => '注册用户', 'friend' => '仅好友', 'self' => '仅自己'), $privacy['post']) ?></li>
							<li>评论权限: <?=form_dropdown('comment', array('register' => '注册用户', 'friend' => '仅好友', 'self' => '仅自己'), $privacy['comment']) ?></li>
							<li><?=form_submit('submit', '更新','class="button"') ?></li>
						<?=form_close() ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
