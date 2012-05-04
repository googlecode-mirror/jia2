<div id="sidebar">
	<div class="user_head_box sidebar_nav">
		<?=anchor('personal/profile/' . $info['id'], '<img src="'. avatar_url($info['avatar'], 'personal', 'big') .'" >','class="user_head"') ?>
		<a href="" class="user_name"><?=$info['name'] ?></a>
	</div>
	<div class="sidebar_nav">
		<ul class="ul_sty_01">
			<li><a href ="post.html" target ="postiframe" class="a_sty_01 active"><i class="ico ico_newthings"></i>社团动态</a></li>
			<li><a href="post2.html" target ="postiframe"  class="a_sty_01"><i class="ico ico_active"></i>好友动态</a></li>
		</ul>
	</div>
	<div class="sidebar_nav">
		<ul class="ul_sty_02">
			<li><a href="" target ="postiframe" class="a_sty_01"><i class="ico ico_say"></i>说说</a><a href="#?w=500" rel="popup1" class="a_sty_02">发表</a></li>
		</ul>
	</div>
	
</div>
<!-- 	发表说说	 -->
<div id="popup1" class="popup_block">
<form id="inline_pub">
	<div class="inline_textarea"><textarea  cols="60" rows="2" name="mytext"></textarea></div>
	<div class="inline_button">
		<?=form_button('post', '发布') ?>
	</div>
</form>   
</div>