<? $this->load->view('includes/slider_bar_view') ?>
<div id="main">
	<h3>&nbsp;提拉米苏&nbsp;&nbsp;<span>10+</span></h3>
	<p><span class="profile_info">位置&nbsp;<a>四川 成都</a></span>|
		<span class="profile_info">在&nbsp;<a>成都信息工程大学</a></span>|
		<span class="profile_info">是&nbsp;<a>启明拓展协会</a>&nbsp;会员</span>|
		<span class="profile_info"><a href="">更多资料</a></span></p>
		<?=form_button(array('name' => 'follow', 'content' => '关注', 'user_id' => $info[0]['id'])) ?>
	<div id="profile_pic_style">
			<ul>
				<li>
					<a href="#" id="active"><img id="" title="修改" src="images/photo_album/01.jpg" /></a>
				</li>
				<li>
					<a href="#"><img id="" title="修改" src="images/photo_album/user02.jpg" /></a>
				</li>
				<li>
					<a href="#"><img id="" title="修改" src="images/photo_album/01.jpg" /></a>
				</li>
				<li>
					<a href="#"><img id="" title="修改" src="images/photo_album/user02.jpg" /></a>
				</li>
			</ul>
	</div>
	<div class="new_things">
	<div  class="tab">
	<ul  class="navlist" >
		<li class="sd01" id="mm01">
			<a href="#"  class="tab_item">个人动态</a>
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