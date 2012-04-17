<div>
	<?=form_open('activity/do_add/' . $corporation['id']) ?>
	<p>活动名称: <?=form_input('name') ?></p>
	<p>活动地点: <?=form_input('address') ?></p>
	<p>活动开始时间: <?=form_input('start_time') ?></p>
	<p>活动结束时间: <?=form_input('deadline') ?></p>
	<p>活动概要: <?=form_textarea('comment') ?></p>
	<p><?=form_submit('submit', '创建') ?></p>
	<?=form_close() ?>
</div>