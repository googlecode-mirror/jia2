<h4 class="title_01 title_02"><span><?=anchor('blog', '日志') ?></span>
	<?=anchor('blog/' . $info['id'], $info['name'] . '的日志') ?> -> <?=anchor('blog/view/' . $blog['id'], $blog['title']) ?></h4>
<div class="main_02">
	<div class="article">
		<h2 class="hd"><?=$blog['title']?></h2>
		<div class="ht">
			<span>2011-12-04</span>
			<a href=""> 编辑</a>
			<a href=""> 删除</a>
		</div>
		<div class="bd">
			<?=$blog['content'] ?>
		</div>
	</div>
</div>