
<pre>
<? print_r($posts) ?>
</pre>
<p><?=$this->session->userdata('type') ?></p>
<p><?=$this->session->userdata('id') ?></p>
<div id="new_post">
	<?=form_open('post/add') ?>
	<?=form_textarea('content') ?>
	<?=form_submit('submit', '发布') ?>
</div>
<div class="post"></div>
		
		<div class="header">
			<div class="head">
				<div class="left">
					<a href="index.html"><strong >Jia2网logo</strong></a>
					<a href="" class="nav_1">首页</a><a href="" class="nav_1">个人主页</a><a href="" class="nav_1">搜索社团</a>
				</div>
				<div class="right">
					<a href="" class="nav_1">站内信</a><a href="" class="nav_1">好友请求</a><a href="" class="nav_1">通知</a>
					<input type="text" class="keywords" id="textfield" maxlength="50" value="Search..." />
					<input type="image" src="images/search.gif" class="button hidden" />
					<a href="" class="nav_1">设置</a>
				</div>				
			</div>
		</div>
		<div class="container">
			
			<div class="content_main">
				<div class="main_top">
				<a href="#" class="head_pic"><img src="images/user02.jpg" />
					<div class="clear"></div><h4>用户名</h4>
				</a>
				
				<div class="pub">
					<div  class="menu_cont">
						<ul  class="navlist" >
							<li class="sd01" id="m01">
								<a href="#">状态</a>
							</li>
							<li class="sd02" id="m02">
								<a href="#">分享</a>
							</li>
						</ul>
					</div>
					<div class="clear"></div>
					<div class="">
						<div id="c01">
							<input value="你在干嘛..."/>
							<input type="button" value="发布">

						</div>
						<div id="c02" class="hidden">
							<input value="连接URL..."/>
							<input type="button" value="发布">

						</div>
					</div>
				</div>
				</div>
				<div class="line"></div>
				<div class="new_things">
					<div  class="menu_cont">
						<ul  class="navlist" >
							<li class="sd01" id="mm01">
								<a href="#">社团新鲜事</a>
							</li>
							<li class="sd02" id="mm02">
								<a href="#">好友新鲜事</a>
							</li>
						</ul>
					</div>
					<div class="clear"></div>
					<div class="article_box">
						<div id="cc01">
							<div class="article_one">
								<a href="#" class="head_pic"><img src="images/user01.jpg" /></a>
								<div class="article_sub_box">
									<h4><span>启明拓展协会：</span>高效率人生须杜绝的10件事，时间不等人，嗖的一下就过去了，改掉举棋不定、拖延症、半途而废等效率低下的习惯吧。</h4>
									<p>2分钟前 <a href="#">收起回复</a> | <a href="#">分享</a> </p>
									<p><input value="添加回复..."/></p>
								</div>
							</div>
							<div class="article_one">
								<a href="#" class="head_pic"><img src="images/user.jpg" /></a>
								<div class="article_sub_box">
									<h4><span>启明拓展协会：</span>高效率人生须杜绝的10件事，时间不等人，嗖的一下就过去了，改掉举棋不定、拖延症、半途而废等效率低下的习惯吧。</h4>
									<p>2分钟前 <a href="#">收起回复</a> | <a href="#">分享</a> </p>
									<p><input value="添加回复..."/></p>
								</div>
							</div>
						</div>
						<div id="cc02" class="hidden">
							第二层内容
						</div>
					</div>
				</div>
			</div>
			
			<div class="content_siber">
				<h3><a href="#">我的社团(2)</a></h3>
				<ul>
					<li>
						<img src="images/user02.jpg" />
						<div class="user_name">社团名</div>
					</li>
					<li>
						<img src="images/user01.jpg" />
						<div class="user_name">社团名</div>
					</li>
				</ul>
				<div class="clear"></div>
				<h3><a href="#">关注的社团(3)</a></h3>
				<ul>
					<li>
						<img src="images/user02.jpg" />
						<div class="user_name">社团名</div>
					</li>
					<li>
						<img src="images/user01.jpg" />
						<div class="user_name">社团名</div>
					</li>
					<li>
						<img src="images/user.jpg" />
						<div class="user_name">社团名</div>
					</li>
				</ul>
				<div class="clear"></div>
				<h3><a href="#">关注的活动(3)</a></h3>
				
				<div class="clear"></div>
				<h3>最近来访</h3>
				<ul>
					<li>
						<img src="images/user02.jpg" />
						<div >社团名</div>
					</li>
					<li>
						<img src="images/user01.jpg" />
						<div >社团名</div>
					</li>
				</ul>
			</div>
		</div>