<? $this->load->view('includes/slider_bar_view') ?>
<div id="main">
	<h3>&nbsp;<?=$info['name'] ?>&nbsp;&nbsp;</h3>
	<p><span class="profile_info">位置&nbsp;<a>四川 成都</a></span>|
		<span class="profile_info">在&nbsp;<a>成都信息工程大学</a></span>|
		<span class="profile_info"><a href="#?w=500" rel="popup4" class="inline">更多资料</a></span></p>
		<? if($this->session->userdata('id') != $info['id'] ): ?>
		<? if(in_array($this->session->userdata('id'), $followers)): ?>
		<?=form_button(array('name' => 'follow', 'content' => '已关注', 'user_id' => $info['id'], 'disabled' => 'disabled')) ?>
		<?=form_button(array('name' => 'unfollow', 'content' => '取消关注', 'user_id' => $info['id'])) ?>
		<? else: ?>
		<?=form_button(array('name' => 'follow', 'content' => '关注', 'user_id' => $info['id'])) ?>
		<? endif ?>
		<? endif ?>
		
	<div class="new_things">
	<div  class="tab">
	<ul  class="navlist" >
		<li class="sd01" id="mm01">
		</li>
	</ul>
	</div>
	<div class="clear"></div>
	<div class="article_box">
		<? $this->load->view('post/user_posts_view') ?>
		<div id="cc02" class="hidden">
			第二层内容
		</div>
	</div>
</div>
</div>

<!-- 	个人资料 -->
<div id="popup4" class="popup_block">
	<h4 class="set_title"><span>某某</span></h4>
			<ul id="user_info">
				<li class="li_1">姓名：<span>tiramisu</span></li>
				<li class="li_1">性别：<span>女</span></li>
				<li class="li_1">学校：<span>成都信息工程学院</span></li>
				<li class="li_1">省份：<span>四川省</span></li>
			</ul>
</div>  
</div>