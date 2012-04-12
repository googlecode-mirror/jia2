<div id="search-bar">
	<?=form_input('keywords') ?>
	<?=form_button('search', '搜索') ?>
</div>
<div id="search-result">
	<ul id="user-result">
		<? if(isset($user_result)): ?>
		<? foreach($user_result as $row): ?>
		<li>
			<div>
				<h3><?=$row['name'] ?></h3>
				<img src="<?=$row['avatar']?>" />
			</div>
		</li>
		<? endforeach ?>
		<? endif ?>
	</ul>
</div>