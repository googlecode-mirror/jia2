<script>
	window.onload = searchtab;
</script>
<div id="main">
	<h3>&nbsp;搜索&nbsp;<span id="searh_key">“<?=$this->input->post('keywords') ?>”</span></h3>
	<div id="search_box">
		<div id="search-bar">
			<?=form_open('search') ?>
			<?=form_hidden('offset', 0) ?>
			<?=form_input('keywords','','class="serch_input"')?>
			<?=form_submit('submit', '搜索','class="btn-blue"')?>
			<?=form_close() ?>
		</div>
	</div>
	<div class="search_item">
						<ul>
							<li class="sd01" id="01">
								<a href="#" id="active">全部结果&nbsp;100+</a>
							</li>
							<li class="sd02" id="02">
								<a href="#">人名&nbsp;100+</a>
							</li>
							<li class="sd02" id="03">
								<a href="#">社团&nbsp;0</a>
							</li>
							<li class="sd02" id="04">
								<a href="#">活动&nbsp;0</a>
							</li>
						</ul>
				</div>
	<div id="search_result_01" class="search_result">
		<h4>人名 <span><?=$user_rows?>条结果</span></h4>
		<ul id="user-result">
			<? if(isset($user_result)):?>
			<? foreach($user_result as $row):?>
			<li>
				<?=anchor('personal/profile/' . $row['id'], '<img src="' . avatar_url($row['avatar'], 'personal', 'big') . '">', 'class="head_pic"')?>
				<div class="li_mbox">
					<h3><?=anchor('personal/profile/' . $row['id'], $row['name'])?></h3>
				</div>
			</li>
			<? endforeach?>
			<? endif?>
		</ul>
		<h4>社团 <span><?=$corporation_rows?>条结果</span></h4>
		<ul id="corporation-result">
			<? if(isset($corporation_result)):?>
			<? foreach($corporation_result as $row):?>
			<li>
				<?=anchor('corporation/profile/' . $row['id'], '<img src="' . avatar_url($row['avatar'], 'corporation', 'big') . '">', 'class="head_pic"')?>
				<div class="li_mbox">
					<h3><?=anchor('corporation/profile/' . $row['id'], $row['name'])?></h3>
				</div>
			</li>
			<? endforeach?>
			<? endif?>
		</ul>
		<h4>活动 <span><?=$activity_rows?>条结果</span></h4>
		<ul id="activity-result">
			<? if(isset($activity_result)):?>
			<? foreach($activity_result as $row):?>
			<li>
				<?=anchor('activity/view/' . $row['id'], '<img src="' . avatar_url($row['corporation'][0]['avatar'], 'corporation', 'big') . '">', 'class="head_pic"')
				?>
				<div class="li_mbox">
					<h3><?=anchor('activity/view/' . $row['id'], $row['name'])
					?></h3>
				</div>
			</li>
			<? endforeach?>
			<? endif?>
		</ul>
	</div>
	<div id="search_result_02" class="hidden search_result">
		<h4>人名 <span>100+条结果</span></h4>
	</div>
	<div id="search_result_03" class="hidden search_result">
		<h4>社团 <span>100+条结果</span></h4>
	</div>
	<div id="search_result_04" class="hidden search_result">
		<h4>活动 <span>100+条结果</span></h4>
	</div>