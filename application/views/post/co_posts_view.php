<? if(array_key_exists('activity', $posts)):?>
<? foreach ($posts['activity'] as $post):?>
<li class="feed_a">
	<div class="img_block">
		<?=anchor('corporation/profile/' . $post['corporation'][0]['id'], '<img src="'. avatar_url($post['corporation'][0]['avatar'], 'corporation') .'">', 'class="head_pic"') ?>
	</div>
	<div class="feed_main">
		<div class="f_info">
			<a href="<?=site_url('corporation/profile/' . $post['corporation'][0]['id']) ?>"><?=$post['corporation'][0]['name']?></a>
			<span class="f_do"><?=$post['content']?></span>
		</div>
		<div class="f_summary">
			<p class="f_pm">
				<span>22:06</span>
				<span><a>收起评论</a></span>
				<span><a>评论</a></span>
			</p>
			<div class="feeds_comment_box">
				<ul class="comment">
					<? if(array_key_exists('comment', $post)):?>
					<? foreach($post['comment'] as $comment):?>
						<li>
							<div class="img_block"><?=anchor('personal/profile/' . $comment['user'][0]['id'], '<img src="'. avatar_url($comment['user'][0]['avatar']) .'" >','class="head_pic"') ?></div>
							<div class="comment_main">
								<div class="f_info">
								<?=anchor('personal/profile/' . $comment['user'][0]['id'], $comment['user'][0]['name']) ?>：
								<span class="f_do"><?=$comment['content']?></span>
							</div>
							<p class="f_pm">
								<span>04月18日   22:06</span>
								<span><a>回复</a></span>
							</p>
							</div>
						</li>
					<? endforeach?>
					<? endif?>
			</ul>
			<div>
				<?=form_textarea('content') ?>
				<?=form_submit('submit', '评论') ?>
			</div>
		</div>
</li>				
<? endforeach ?>
<? endif ?>