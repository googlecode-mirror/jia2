<script>
	window.onload = coprotab;
</script>
<div>
	<a href="<?=site_url('corporation/profile/' . $info['id'])?>" class="head_pic"><img src="<?=avatar_url($info['avatar'], 'corporation', 'big') ?>" /> <div class="clear"></div><h4><?=$info['name']
	?></h4> </a>
	<?=form_button(array('name' => 'follow', 'content' => '关注', 'id' => $info['id']))
	?>
	<div class="admin-options">
		<p>
			<?=anchor('activity/add/' . $info['id'], '创建活动')
			?>
		</p>
		<p>
			<?=anchor('corporation/setting' . $info['id'], '社团设置')
			?>
		</p>
	</div>
</div>
<div id="sidebar">
	<div class="user_head_box sidebar_nav">
		<a href="" class="user_head"> <img id="" title="修改头像" src="images/head_pic/user02.jpg" /> </a>
		<a href="" class="user_name">启明拓展</a>
	</div>
	<div class="sidebar_nav">
		<h4><strong>协会信息</strong></h4>
		<ul class="asso_info">
			<li>
				管理员：<a href="#">刘晨曦</a>
			</li>
			<li>
				分　类：<a href="#">情感</a>  <a href="">象牙塔</a>
			</li>
			<li>
				编　号：00001
			</li>
		</ul>
		<p class="f-aaa">
			2011-10-24由 刘晨曦 创建
		</p>
	</div>
	<div class="sidebar_nav">
		<h4>协会成员</h4>
		<ul class="asso_list asso_list_01">
			<li>
				<a class="asso_list_a_img"><img src="images/head_pic/user02.jpg" /></a>
				<a class="asso_list_a_name">零之动</a>
			</li>
			<li>
				<a class="asso_list_a_img"><img src="images/head_pic/user02.jpg" /></a>
				<a class="asso_list_a_name">零之动</a>
			</li>
			<li>
				<a class="asso_list_a_img"><img src="images/head_pic/user02.jpg" /></a>
				<a class="asso_list_a_name">零之动</a>
			</li>
			<li>
				<a class="asso_list_a_img"><img src="images/head_pic/user02.jpg" /></a>
				<a class="asso_list_a_name">动漫</a>
			</li>
			<li>
				<a class="asso_list_a_img"><img src="images/head_pic/user02.jpg" /></a>
				<a class="asso_list_a_name">动漫</a>
			</li>
			<li>
				<a class="asso_list_a_img"><img src="images/head_pic/user02.jpg" /></a>
				<a class="asso_list_a_name">动漫</a>
			</li>
		</ul>
	</div>
</div>
<div id="main">
	<div class="asso_intro_box">
		<h3>启明拓展协会<span> (20个成员)</span></h3>
		<p>
			在这里，你可以晒一晒你学习中的作品；
			<br />
			在这里，你可以征询问题，一起和高水平的伙伴交流切磋；
			<br />
			在这里，你可以发表你的学习心得，同时也帮助他人一起进步。
		</p>
		<p class="operate">
			<span>以加入社团</span>
			|
			<span><a href="">管理社团</a></span>
			|
			<span><a href="">退出社团</a></span>
		</p>
		<a href="" class="creat_button creat_act">创建活动</a>
	</div>
	<div class="search_item">
		<ul>
			<li class="sd01" id="co-01">
				<a href="#" id="active">活动日志&nbsp;(2)</a>
			</li>
			<li class="sd02" id="co-02">
				<a href="#">活动相册&nbsp;(6)</a>
			</li>
			<li class="sd02" id="co-03">
				<a href="#">状态&nbsp;(6)</a>
			</li>
		</ul>
	</div>
	<div id="feeds_container" class="feeds"></div>
		<div id="co_01">活动日志&nbsp
		</div>
		<div id="co_02" class="hidden">活动相册&nbsp
		</div>
		<div id="co_03" class="hidden">状态&nbsp
		</div>
	</div>