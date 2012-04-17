<div>
	<a href="<?=site_url('corporation/profile/' . $info['id'])?>" class="head_pic"><img src="<?=avatar_url($info['avatar'], 'corporation', 'big') ?>" />
		<div class="clear"></div><h4><?=$info['name']?></h4>
	</a>
	<?=form_button(array('name' => 'add_friend', 'content' => '关注', 'user_id' => $info['id'])) ?>
	
	<div class="admin-options">
		<p><?=anchor('activity/add/' . $info['id'], '创建活动') ?></p>
		<p><?=anchor('corporation/setting' . $info['id'], '社团设置') ?></p>
	</div>
</div>