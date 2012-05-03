<? if(!empty($messages)): ?>
	<ul>
		<h4 class="delete-all"><a href="" class="right">全部删除</a></h4>
		<? foreach($messages as $message): ?>
			<li class="mes_li">
				<div class="left">
				<?=anchor('personal/profile/' . $message['user'][0]['id'], '<img src="'. avatar_url($message['user'][0]['avatar']) .'" >','class="head_pic"') ?>
				</div>
				<div class="left">
				<?=anchor('personal/profile/' . $message['user'][0]['id'],$message['user'][0]['name'])?>
				<?=$message['content'] ?>
				<?=jdate($message['time']) ?>
				<a href="" class="block">删除</a>
				</div>
			</li>
		<? endforeach ?>
	</ul>
<? endif ?>