	<div class="container">
			<div class="content_main">
				<div class="main_top">
				<a href="<?=site_url('personal/profile/' . $info[0]['id'])?>" class="head_pic"><img src="<?=avatar_url($info[0]['avatar'], 'big') ?>" />
					<div class="clear"></div><h4><?=$info[0]['name']?></h4>
				</a>
				<?=form_button(array('name' => 'add_friend', 'content' => '关注', 'user_id' => $info[0]['id'])) ?>
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
							<?=form_open('post/add') ?>
							<?=form_textarea(array('name' => 'content', 'cols' => 100, 'rows' => 4)) ?>
							<p><?=form_submit('submit', '发布') ?></p>
							<?=form_close() ?>
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
							<? if($posts): ?>
							<? foreach ($posts as $post): ?>
								<div class="article_one">
									<a href="<?=site_url('personal/profile/' . $post['user'][0]['id']) ?>" class="head_pic"><img src="<?=avatar_url($post['user'][0]['avatar'], 'tiny') ?>" /></a>
									<div class="article_sub_box">
										<h4><span><?=$post['user'][0]['name'] ?></span>&nbsp;<?=$post['content'] ?></h4>
										<p>2分钟前 <a href="#">收起回复</a> | <a href="#">分享</a> </p>
										<? if($post['comment']): ?>
											<? foreach($post['comment'] as $comment): ?>
												<p><?=$comment['content'] ?></p>
											<? endforeach ?>
											<p></p>
										<? endif ?>
										<p></p>
										<p><?=form_textarea(array('name' => 'comment_content', 'post_id' => $post['id'], 'owner_id' => $post['owner_id'], 'cols' => 60, 'rows' => 2)) ?></p>
										<p><?=form_button('comment', '评论') ?></p>
									</div>
								</div>
							<? endforeach ?>
							<? endif ?>
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
						<img src="<?=site_url('source/img/user02.jpg') ?>" />
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