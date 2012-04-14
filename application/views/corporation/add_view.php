<div id="add-corporation">
	<?=form_open('corporation/do_add') ?>
	<p>社团名字：<?=form_input('name') ?> </p>
	<p>所属学校：<?=form_dropdown('school', $schools) ?></p>
	<p>社团简介：<?=form_textarea('comment') ?></p>
	<p>分配社长：<?=form_input('master') ?></p>
	<p><?=form_submit('submit', '创建') ?></p>
	<?=form_close() ?>
</div>