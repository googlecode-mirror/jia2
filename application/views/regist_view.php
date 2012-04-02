<?=form_open('index/do_regist') ?>
<p>邮箱 <?=form_input('email') ?></p>
<p>姓名 <?=form_input('name') ?></p>
<p>密码 <?=form_password('pass') ?></p>
<p><?=form_submit('submit', 'regist') ?></p>
<?=form_close() ?>