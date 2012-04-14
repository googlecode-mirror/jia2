<script>
window.onload = function(){
	var SDmodel = new scrollDoor();
	SDmodel.sd(["01", "02", "03","04"], ["search_result_01", "search_result_02", "search_result_03","search_result_04"], "sd01", "sd02");
}
</script>
<div class="container">
	<div class="content_main" id="search_page">
		<h3>&nbsp;搜索&nbsp;“张晖”<span>找到100+条结果</span></h3>
		<div id="search_box">
			<div id="search-bar">
			<?=form_input('keywords','','class="serch_input"') ?>
			<?=form_button('search', '搜索','class="serch_button"') ?>
			</div>
		</div>
		<div id="search_item">
			<div  class="tab">
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
		</div>
		<div id="search_result_01" class="search_result">
			<h4>人名 <span><?=$user_rows ?>条结果</span></h4>
			<ul id="user-result">
					<? if(isset($user_result)): ?>
					<? foreach($user_result as $row): ?>
					<li>
						<?=anchor('personal/profile/' . $row['id'], '<img src="' . avatar_url($row['avatar'], 'personal', 'big') . '">', 'class="head_pic"') ?>
						<div class="li_mbox">
							<h3><?=anchor('personal/profile/' . $row['id'], $row['name']) ?></h3>
							
						</div>
						<a href="#" class="li_r">加为好友</a>
					</li>
					<? endforeach ?>
					<? endif ?>
			</ul>
			<h4>社团 <span><?=$corporation_rows ?>条结果</span></h4>
			<ul id="corporation-result">
					<? if(isset($corporation_result)): ?>
					<? foreach($corporation_result as $row): ?>
					<li>
						<?=anchor('corporation/profile/' . $row['id'], '<img src="' . avatar_url($row['avatar'], 'corporation', 'big') . '">', 'class="head_pic"') ?>
						<div class="li_mbox">
							<h3><?=anchor('corporation/profile/' . $row['id'], $row['name']) ?></h3>
							
						</div>
						
					</li>
					<? endforeach ?>
					<? endif ?>
			</ul>
			<h4>活动 <span>0条结果</span></h4>
			<ul id="activity-result">
					<? if(isset($activity_result)): ?>
					<? foreach($activity_result as $row): ?>
					<li>
						<?=anchor('personal/profile/' . $row['id'], '<img src="' . avatar_url($row['avatar'], 'personal', 'big') . '">', 'class="head_pic"') ?>
						<div class="li_mbox">
							<h3><?=anchor('personal/profile/' . $row['id'], $row['name']) ?></h3>
							
						</div>
						<a href="#" class="li_r">加为好友</a>
					</li>
					<? endforeach ?>
					<? endif ?>
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
		

	
	</div>
</div>