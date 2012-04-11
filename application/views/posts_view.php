<div id="cc01">
					<? if($posts):?>
					<? foreach ($posts as $post):?>
					<div class="article_one">
						<?=anchor('personal/profile/' . $post['user'][0]['id'], '<img src="'. avatar_url($post['user'][0]['avatar']) .'">', 'class="head_pic"') ?>
						<div class="article_sub_box">
							<h4><a href="#"><?=$post['user'][0]['name']?></a>&nbsp;<?=$post['content']?></h4>
							<p>
								2分钟前 <a href="#">收起回复</a> | <a href="#">分享</a>
							</p>
							<div class="comment">
								<ul>
							<? if(array_key_exists('comment', $post)):?>
							<? foreach($post['comment'] as $comment):?>
									<li>
										<?=anchor('personal/profile/' . $comment['user'][0]['id'], '<img src="'. avatar_url($comment['user'][0]['avatar']) .'" >') ?>
										<p><?=anchor('personal/profile/' . $comment['user'][0]['id'], $comment['user'][0]['name']) ?>：<?=$comment['content']?><a href="#" class="reply"'>回复</a><br />
										<small>2012-04-09 20:43</small></p>
									</li>
								
								<? endforeach?>
								<? endif?>
								</ul>
								<p>
									<?=form_textarea(array('name' => 'comment_content', 'post_id' => $post['id'], 'type_id' =>$post['type_id'] , 'owner_id' => $post['owner_id'], 'cols' => 60, 'rows' => 2))
									?>
								</p>
								<p>
									<?=form_button('comment', '评论','class="button"')?>
								</p>
							</div>
						</div>
					</div>
					<? endforeach?>
					<? endif?>
				</div>