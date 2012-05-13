<script>
	window.onload = cotab;
</script>
<div id="main">
	<a href="<?=site_url('corporation/add') ?>" class="creat_button button"><i>+</i> 创建社团</a>
	<!-- <a href="#?w=500" rel="popup2"  class="creat_button button inline"><i>+</i> 创建社团</a> -->
	<div id="search_box">
		<div id="search-bar">
			<input type="text" name="keywords" class="serch_input"/>
			<button name="search" type="button" class="btn-blue">搜索</button>
		</div>
	</div>
	<div class="search_item">
		<ul>
			<li class="sd01" id="co-1">
				<a href="#" id="active">我的社团&nbsp;(0)</a>
			</li>
			<li class="sd02" id="co-2">
				<a href="#">我关注的社团&nbsp;(<?=$f_num ?>)</a>
			</li>
		</ul>
	</div>
	<div id="feeds_container" class="feeds">
	<ul id="feed_1">
		<li class="feed_a">
			<div class="img_block"><img src="" /></div>
			<div class="feed_main">
				<h3 class="asso_name"><a href="<?=site_url('corporation/association-pro.html')?>">启明拓展协会</a><span>活动(6)</span><span>相册(6)</span><span>说说(20)</span></h3>
				<ul class="asso_ul">
					<li><a href="">启明拓展协会最新活动安排</a></li>
					<li><a href="">启明拓展协会的活动日志</a></li>
					<li><a href="">感谢群众还记得我</a></li>
				</ul>
			</div>
		</li>
		<li class="feed_a">
			<div class="img_block"><img src="" /></div>
			<div class="feed_main">
				<h3 class="asso_name"><a href="<?=site_url('corporation/association-pro.html')?>">启明拓展协会</a><span>活动(6)</span><span>相册(6)</span><span>说说(20)</span></h3>
				<ul class="asso_ul">
					<li><a href="">启明拓展协会最新活动安排</a></li>
					<li><a href="">启明拓展协会的活动日志</a></li>
					<li><a href="">感谢群众还记得我</a></li>
				</ul>
			</div>
		</li>
		
	</ul>
	<ul id="feed_2" class="hidden">
		<? if(!empty($corporations)): ?>
			<? foreach($corporations as $corporation):?>
				<li class="feed_a">
					<div class="img_block"><img src="<?=avatar_url($corporation['avatar'], 'corporation', 'big') ?>" /></div>
						<div class="feed_main">
						<h3 class="asso_name"><a href="<?=site_url('corporation/profile/' . $corporation['id'])?>"><?=$corporation['name'] ?></a><span>活动(6)</span><span>相册(6)</span><span>说说(20)</span></h3>
						<ul class="asso_ul">
							<li><a href="">启明拓展协会最新活动安排</a></li>
							<li><a href="">启明拓展协会的活动日志</a></li>
							<li><a href="">感谢群众还记得我</a></li>
						</ul>
					</div>
				</li>
			<? endforeach?>
		<? else: ?>
			<p> 还没有关注社团？ 赶紧搜索一个或者<?=anchor('corporation/list_all', '查看全部社团') ?></p>
		<? endif ?>
	</ul>
	</div>	
</div>
