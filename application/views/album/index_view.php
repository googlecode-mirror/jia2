<h4 class="title_01 title_02"><span>相册列表</span>
	<?=anchor(uri_string(), $info['name'] . '的相册') ?>
</h4>
<div class="main_02">
	<a class="upload_photo_btn" href="<?=site_url('album/upload') ?>">上传照片</a>
	<a class="upload_photo_btn" href="<?=site_url('album/create') ?>">创建相册</a>
	<div class="photo_album_box">
		<div id="images">
			<ul class="gallery">
				<? if(isset($albums)): ?>
				<? foreach($albums as $album): ?>
					<a href="photos.html">
					<li><img src="<?=base_url('resource/images/photo01.jpg')?>" alt="description" /><p class="album_name">相册名</p>
					</li> </a>
				<? endforeach ?>
				<? endif ?>
				<a href="photos.html">
				<li><img src="<?=base_url('resource/images/photo01.jpg')?>" alt="description" /><p class="album_name">相册名</p>
				</li> </a>
				
				<a href="photos.html">
				<li><img src="<?=base_url('resource/images/photo02.jpg')?>" alt="description" /><p class="album_name">相册名</p>
				</li> </a>
				
				<a href="photos.html">
				<li><img src="<?=base_url('resource/images/photo03.jpg')?>" alt="description" /><p class="album_name">相册名</p>
				</li> </a>
			</ul>
		</div>
	</div>
</div>