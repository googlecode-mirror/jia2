<!--
<pre>
	<?=print_r($info) ?>
</pre>
-->
<h2><?=anchor('corporation/profile/' . $info['corporation'][0]['id'], $info['corporation'][0]['name']) . '的' . $info['user'][0]['name'] . '童鞋发起了 ' . $info['name'] ?></h2>
<h3>活动时间</h3>
<p><?=$info['start_time'] . '-' . $info['deadline'] ?></p>
<h3>活动地点</h3>
<p><?=$info['address'] ?></p>
<h3>活动详情</h3>
<p><?=$info['comment'] ?></p>
<div class="admin-options">
	<?=anchor('activity/edit/' . $info['id'], '编辑活动') ?>
</div>