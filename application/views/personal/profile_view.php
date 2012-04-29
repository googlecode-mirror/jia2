<? $this->load->view('includes/slider_bar_view') ?>
<div id="main">
	<h3>&nbsp;<?=$info[0]['name'] ?>&nbsp;&nbsp;</h3>
	<p><span class="profile_info">位置&nbsp;<a>四川 成都</a></span>|
		<span class="profile_info">在&nbsp;<a>成都信息工程大学</a></span>|
		<span class="profile_info"><a href="">更多资料</a></span></p>
		<? if($this->session->userdata('id') != $info[0]['id'] ): ?>
		<? if(in_array($this->session->userdata('id'), $followers)): ?>
		<?=form_button(array('name' => 'follow', 'content' => '已关注', 'user_id' => $info[0]['id'], 'disabled' => 'disabled')) ?>
		<? else: ?>
		<?=form_button(array('name' => 'follow', 'content' => '关注', 'user_id' => $info[0]['id'])) ?>
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