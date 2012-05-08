<script>
	window.onload = setingtab;
</script>
<div id="main">
	<div class="search_item">
			<ul>
				<li class="sd01" id="s01">
					<a href="#">资料设置</a>
				</li>
				<li class="sd02" id="s02">
				<a href="#">头像设置</a>
				</li>
				<li class="sd02" id="s03">
					<a href="#">账户设置</a>
				</li>
				<li class="sd02" id="s04">
					<a href="#">隐私设置</a>
				</li>
			</ul>
	</div>
	<div class="tab_cont_box user_setting">
		<div id="c01">
			<h4 class="set_title"><span>某某</span>，你好！<a id="modify" href="#">修改</a></h4>
			<ul id="user_info">
				<li class="li_1">姓名：<span>tiramisu</span></li>
				<li class="li_1">性别：<span>女</span></li>
				<li class="li_1">学校：<span>成都信息工程学院</span></li>
				<li class="li_1">省份：<span>四川省</span></li>
			</ul>
			<ul id="user_info_form" class="hidden">
			<?=form_open('personal/do_setting','class="form"')?>
			<?=form_hidden('setting', 'info') ?>
				<li ><label>姓名：</label>
					<div class="InputWrapper"><div class="InputInner">
							<?=form_input('name') ?>
					</div></div>
				</li>
				<li ><label>性别：</label>
					<?=form_dropdown('gender', array('1'=> '男淫', '0' => '女淫'),'class="SelectWrapper"') ?></li>
				<li ><label>学校：</label>
					<div class="InputWrapper"><div class="InputInner">
							<?=form_input('name') ?>
					</div></div></li>
				<li ><label>省份：</label><?=form_dropdown('gender', array('0'=> '四川', '1' => '重庆','2'=> '贵州', '3' => '云南'),'class="SelectWrapper"') ?>
						  <?=form_dropdown('gender', array('0'=> '四川', '1' => '重庆','2'=> '贵州', '3' => '云南'),'class="SelectWrapper"') ?></li>
				<li class="li_b"><?=form_submit('submit', '保存','class="pub_button"') ?></li>
			<?=form_close() ?>
			</ul>
		</div>
		<div id="c02" class="hidden">
			<h4 class="set_title">设置新头像</h4>
			<p class="p_1">	支持JPG、JPEG、GIF和PNG文件，最大2M。	</p>
			<?=form_open_multipart('personal/do_setting') ?>
			
			<span href="" class="btn-blue">
				浏览
				<?=form_upload('userfile') ?>
			</span>
			<?=form_hidden('setting', 'avatar') ?>
			<?=form_submit('submit', '上传','class="pub_button file_btn"') ?>
			<?=form_close() ?>
			
			<h4 class="set_title">当前头像</h4>
			<img src="<?=avatar_url($info['avatar'], 'personal', 'big') ?>" />
		</div>
		<div id="c03" class="hidden">
			<h4 class="set_title">修改密码</h4>
			<ul id="pass_setting">
			<?=form_open('personal/do_setting','class="form"', 'id="pass"')?>
			<?=form_hidden('setting', 'pass') ?>
				<li><label>原  密  码: </label>
					<div class="InputWrapper"><div class="InputInner">
							<?=form_password('old_pass') ?>
					</div></div>
				</li>
				<span class="prompt" id="old_pass_prompt"></span>
				<li><label>新  密  码: </label>
					<div class="InputWrapper"><div class="InputInner">
							<?=form_password('pass') ?>
					</div></div>
				</li>
				<span class="prompt" id="pass_prompt"></span>
				<li><label>确认密码: </label>
					<div class="InputWrapper"><div class="InputInner">
							<?=form_password('pass_check') ?>
					</div></div>
				</li>
				<span class="prompt" id="pass_check_prompt"></span>
				<li class="li_c"><?=form_submit('submit', '更新','class="pub_button"') ?></li>
			<?=form_close() ?>
			</ul>
		</div>
		<div id="c04" class="hidden">
			<h4 class="set_title">隐私设置</h4>
			<ul id="pass_setting">
			<?=form_open('personal/do_setting','class="form"')?>
			<?=form_hidden('setting', 'privacy') ?>
				<li ><label>浏览权限: </label><?=form_dropdown('post', array('guest' => '所有人&nbsp;', 'register' => '注册用户', 'follower' => '仅粉丝', 'self' => '仅自己'), $privacy['post'],'class="SelectWrapper"') ?></li>
				<li ><label>评论权限: </label><?=form_dropdown('comment', array('register' => '注册用户&nbsp;','follower' => '仅粉丝', 'self' => '仅自己'), $privacy['comment'],'class="SelectWrapper"') ?></li>
				<li class="hidden"><label>浏览权限: </label><?=form_dropdown('post', array('guest' => '所有人&nbsp;', 'self' => '仅自己'), $privacy['post']) ?></li>
				<li class="li_c"><?=form_submit('submit', '更新','class="pub_button"') ?></li>
			<?=form_close() ?>
			</ul>
		</div>
	</div>
</div>
<script>
$(function(){
		
		});	  
</script>			
