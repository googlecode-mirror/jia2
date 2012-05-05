<script>
	window.onload = posttab;
</script>
<? $this->load->view('includes/slider_bar_view') ?>
<div id="main">
<div class="post_top">
	<form id="pub">
		<div id="pub_text"><textarea cols="80" rows="3" name="post_content" class="textarea_01" onfocus="javascript:ResizeTextarea(this,3);" onclick="javascript:ResizeTextarea(this,3);" onkeyup="javascript:ResizeTextarea(this,2);"></textarea></div>
		<a class="pub_button">发布
			<?=form_button('post', '发布', 'disabled="disabled"') ?>
		</a>
	</form>
</div>
<div class="post_main">
				<div class="search_item"><ul>
					<li class="sd01" id="po1">
						<a href="" id="active">全部</a>
					</li>
					<li class="sd02" id="po2">
						<a href="">活动日志</a>
					</li>
					<li class="sd02" id="po3">
						<a href="">活动图片</a>
					</li>
					<div class="right">
					<li><a href="">刷新</a></li>
					</div>
				</ul></div>
	</div>
	<div id="feeds_container" class="feeds">
		<ul id="feed_1">
			<div id="po_1">
				<?=$this->load->view('post/user_posts_view') ?>
			</div>
			<div id="po_2" class="hidden">只显示活动日志</div>
			<div id="po_3" class="hidden">只显示图片</div>
		</ul>
		<ul id="feed_2" class="hidden">
			<?=$this->load->view('post/co_posts_view') ?>
		</ul>
	</div>
</div>