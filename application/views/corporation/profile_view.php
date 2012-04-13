<div>
	<a href="<?=site_url('corporation/profile/' . $info[0]['id'])?>" class="head_pic"><img src="<?=avatar_url($info[0]['avatar'], 'corporation', 'big') ?>" />
		<div class="clear"></div><h4><?=$info[0]['name']?></h4>
	</a>
	<?=form_button(array('name' => 'add_friend', 'content' => '关注', 'user_id' => $info[0]['id'])) ?>
</div>