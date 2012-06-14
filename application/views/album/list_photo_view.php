<h4 class="title_01 title_02"><span>图片列表</span><?=$profile_a . '->' . $back_a ?></h4>
<div class="main_02">
	<h2><?=$info['name'] ?></h2>
	<div id="page">
		<div id="images">
			<ul class="gallery">
				<? if(isset($photos) && is_array($photos)): ?>
					<? foreach($photos as $photo): ?>
						<a href="<?=base_url($photo['original'])?>" rel="lightbox[gallery]" title="图片描述。。。">
						<li><img src="<?=base_url($photo['thumb'])?>" alt="description" />
						</li> </a>
					<? endforeach ?>
				<? endif ?>
			</ul>
		</div>
	</div>
</div>