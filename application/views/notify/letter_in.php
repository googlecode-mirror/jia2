<? if(!empty($letter)): ?>
	<ul id="letter_in_content">
	<? foreach($letters as $letter): ?>
		<li class="mes_li">
			<div class="left">
				<?=anchor('personal/profile/' . $letter['user'][0]['id'], '<img src="'. avatar_url($letter['user'][0]['avatar']) .'" >','class="head_pic"') ?>
				</div>
				<div class="left">
				<?=anchor('personal/profile/' . $letter['user'][0]['id'],$letter['user'][0]['name'])?>
				<?=$letter['content'] ?>
				<?=jdate($letter['time']) ?>
				</div>
		</li>
	<? endforeach ?>
	</ul>
<?else: ?>
<p>收件箱为空</p>
<? endif?>