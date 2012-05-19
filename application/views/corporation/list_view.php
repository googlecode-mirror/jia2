<h4>所有社团</h4>
		<div  class="tab_cont_box content_1">
			<div id="a1">
				<ul id="corporation-result">
					<? if(!empty($corporations)):?>
					<? foreach($corporations as $row):?>
					<li class="box_1">
						<a><?=anchor('corporation/profile/' . $row['id'], '<img src="' . avatar_url($row['avatar'], 'corporation', 'tiny') . '">', 'class="head_pic"')?></a>
						<h3><?=anchor('corporation/profile/' . $row['id'], $row['name'])?></h3>
						<p>是简介呢还是新鲜事呢还是简介呢还是新鲜事呢还是简介呢还是新鲜事呢还是简介呢还是新鲜事呢。。</p>
						<div class="box_1_foot">
							<a class="left">+ 关注</a><a class="right">详细 >></a>
						</div>
					</li>
					<? endforeach?>
					<? endif?>
				</ul>
			</div>
		</div>