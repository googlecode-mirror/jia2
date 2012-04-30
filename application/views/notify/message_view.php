<? if(!empty($messages)): ?>
	<ul>
		<? foreach($messages as $message): ?>
			<li>
				<?=anchor('personal/profile/' . $message['user'][0]['id'], '<img src="'. avatar_url($message['user'][0]['avatar']) .'" >' . $message['user'][0]['name'],'class="head_pic"') ?>
				<?=$message['content'] ?>
				<?=jdate($message['time']) ?>
			</li>
		<? endforeach ?>
	</ul>
<? endif ?>