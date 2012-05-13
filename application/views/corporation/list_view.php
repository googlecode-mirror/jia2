<h4>所有社团</h4>
<ul id="corporation-result">
	<? if(!empty($corporations)):?>
	<? foreach($corporations as $row):?>
	<li>
		<?=anchor('corporation/profile/' . $row['id'], '<img src="' . avatar_url($row['avatar'], 'corporation', 'tiny') . '">', 'class="head_pic"')?>
		<div class="li_mbox">
			<h3><?=anchor('corporation/profile/' . $row['id'], $row['name'])?></h3>
		</div>
	</li>
	<? endforeach?>
	<? endif?>
</ul>