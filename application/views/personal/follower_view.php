<div id="search_result_01" class="search_result">
<h4>我的粉丝 <span><?=$followers_num?>个</span></h4>
<ul id="user-result">
	<? if(isset($followers)):?>
	<? foreach($followers as $row):?>
	<li>
		<?=anchor('personal/profile/' . $row['id'], '<img src="' . avatar_url($row['avatar'], 'personal', 'big') . '">', 'class="head_pic"')?>
		<div class="li_mbox">
			<h3><?=anchor('personal/profile/' . $row['id'], $row['name'])?></h3>
			<p><?=$row['gender'] == 1 ? '男' : '女'?></p>
			<p><?=$row['province'][0]['name'] ?></p>
			<p><?=$row['school'][0]['name'] ?></p>
		</div>
	</li>
	<? endforeach?>
	<? endif?>
</ul>
</div>