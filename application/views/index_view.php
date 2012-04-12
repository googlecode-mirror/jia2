<div class="container">
	<div class="content_main">
		<div class="main_top">
			<a href="#" class="head_pic"><img src="<?=avatar_url($this->session->userdata('avatar'), 'big') ?>" /> <div class="clear"></div><h4><?=$this->session->userdata('name')?></h4> </a>
			<div class="pub">
				<div  class="tab">
					<ul>
						<li class="sd01" id="m01">
							<a href="#">状态</a>
						</li>
						<li class="sd02" id="m02">
							<a href="#">分享</a>
						</li>
					</ul>
				</div>
				<div class="clear"></div>
				
				<div class="tab_cont_box">
					<div id="c01">
						<?=form_open('post/add')?>
						<?=form_textarea(array('name' => 'content', 'cols' => 60, 'rows' => 1,'id' => 'pub_textarea'))?>
						<p>
							<?=form_submit('submit', '发布','class="button"')?>
						</p>
						<?=form_close()?>
					</div>
					<div id="c02" class="hidden">
						<input value="连接URL..."/>
						<input type="button" value="发布">
					</div>
				</div>
			</div>
			<!--<script>
				$(function() {
					$("#pub_textarea").focus(function() {
						$("this").attr("background", "red");
					})
				});
			</script>-->
		</div>
		<div class="line"></div>
		<div class="new_things">
			<div  class="tab">
				<ul >
					<li class="sd01" id="mm01">
						<a href="#"  >社团新鲜事</a>
					</li>
					<li class="sd02" id="mm02">
						<a href="#"  >好友新鲜事</a>
					</li>
					<li id="refresh">
						<a >刷新</a>
					</li>
					
				</ul>
			</div>
			<div class="clear"></div>
			<div class="tab_cont_box">
				<? $this->load->view('posts_view') ?>
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
				<div class="user_name">
					社团名
				</div>
			</li>
			<li>
				<img src="<?=site_url('source/img/user01.jpg') ?>" />
				<div class="user_name">
					社团名
				</div>
			</li>
		</ul>
		<div class="clear"></div>
		<h3><a href="#">关注的社团(3)</a></h3>
		<ul>
			<li>
				<img src="<?=site_url('source/img/user02.jpg') ?>" />
				<div class="user_name">
					社团名
				</div>
			</li>
			<li>
				<img src="<?=site_url('source/img/user01.jpg') ?>" />
				<div class="user_name">
					社团名
				</div>
			</li>
			<li>
				<img src="<?=site_url('source/img/user.jpg') ?>" />
				<div class="user_name">
					社团名
				</div>
			</li>
		</ul>
		<div class="clear"></div>
		<h3><a href="#">关注的活动(3)</a></h3>
		<div class="clear"></div>
		<h3>最近来访</h3>
		<ul>
			<li>
				<img src="<?=site_url('source/img/user02.jpg') ?>" />
				<div >
					社团名
				</div>
			</li>
			<li>
				<img src="<?=site_url('source/img/user01.jpg') ?>" />
				<div >
					社团名
				</div>
			</li>
		</ul>
	</div>
</div>