<script>
	window.onload = coprotab;
</script>
		
<div>
</div>
<div id="sidebar">
	<div class="user_head_box sidebar_nav">
		<a href="<?=site_url('corporation/profile/' . $info['id'])?>" class="user_head"> <img id="" src="<?=avatar_url($info['avatar'], 'corporation', 'big') ?>" /> </a>
		<a href="" class="user_name"><?=$info['name']?></a>
	</div>
	<p>
	<? if($this->session->userdata('id')): ?>
		<? if(in_array($this->session->userdata('id'), $followers)): ?>
			<?=form_button(array('name' => 'follow', 'content' => '已关注', 'id' => $info['id'], 'disabled' => 'disabled'))?>
			<?=form_button(array('name' => 'unfollow', 'content' => '取消关注', 'id' => $info['id']))?>
		<? else:?>
			<?=form_button(array('name' => 'follow', 'content' => '关注', 'id' => $info['id']))?>
			
		<? endif?>
	<? endif ?>
	</p>
	<p>
	<? if($this->session->userdata('id')): ?>
		<? if(in_array($this->session->userdata('id'), $members)): ?>
			<?=form_button(array('name' => 'join', 'content' => '已加入', 'co_id' => $info['id'], 'disabled' => 'disabled'))?>
			<?=form_button(array('name' => 'unjoin', 'content' => '退出社团', 'co_id' => $info['id']))?>
		<? else:?>
			<?=form_button(array('name' => 'join', 'content' => '请求加入', 'co_id' => $info['id'], 'id' => 'join'))?>
			
		<? endif?>
	<? endif ?>
	</p>
	<div class="sidebar_nav">
		<h4><strong>协会信息</strong></h4>
		<ul class="asso_info">
			<li>
				社长：<?=anchor('personal/profile/' . $info['user'][0]['id'], $info['user'][0]['name']) ?>
			</li>
		</ul>
		<p class="f-aaa">
			由 <?=$info['user'][0]['name'] ?> 创建
		</p>
	</div>
	<div class="sidebar_nav">
		<h4>协会成员（<?=count($members) ?>）</h4>
		<ul class="asso_list asso_list_01">
		<? foreach($members_info as $member): ?>
			<li>
				<a class="asso_list_a_img" href="<?=site_url('personal/profile/' . $member['id']) ?>"><img src="<?=avatar_url($member['avatar'], 'personal', 'tiny') ?>" /></a>
				<a class="asso_list_a_name"><?=$member['name'] ?></a>
			</li>
		<? endforeach ?>
		</ul>
	</div>
</div>
<div id="main">
	<div class="asso_intro_box">
		<h3><?=$info['name'] ?><span> (<?=count($members) ?>个成员)</span></h3>
		<p>
			<?=$info['comment'] ?>
		</p>
		<p class="operate">
			<span><?=anchor('corporation/setting/' . $info['id'], '社团设置') ?></span>
		</p>
		<?=anchor('activity/add/' . $info['id'], '创建活动')?>
		<!--
		<a href="#?w=500" rel="popup3" class="creat_button creat_act inline">创建活动</a>
		-->
	</div>
	<div class="search_item">
		<ul>
			<li class="sd01" id="co-01">
				<a href="#">社团动态&nbsp;(<?=count($posts['activity']) ?>)</a>
			</li>
			<li class="sd02" id="co-02">
				<a href="#">社团活动&nbsp;(<?=count($activities) ?>)</a>
			</li>
			<li class="sd03" id="co-03">
				<a href="#">社团相册&nbsp;</a>
			</li>
		</ul>
	</div>
	<div id="feeds_container" class="feeds"></div>
		<div id="co_01">
			<?=$this->load->view('post/co_posts_view') ?>
		</div>
		<div id="co_02" class="hidden">
			<ul>
				<? foreach ($activities as $activity):?>
				<li class="feed_a">
				<div class="img_block">
					<?=anchor('corporation/profile/' . $info['id'], '<img src="'. avatar_url($info['avatar'], 'corporation', 'tiny') .'" >','class="head_pic"') ?>
				</div>
				<div class="feed_main">
					<div class="f_info">
						<a href="<?=site_url('corporation/profile/' . $info['id']) ?>"><?=$info['name']?></a><br>
						<span class="f_do"><?=$activity['detail']?></span>
					</div>
					<div class="f_summary">
						<p class="f_pm">
							<span><?=jdate($activity['start_time'], FALSE) ?> 至 <?=jdate($activity['deadline'], FALSE) ?></span>
						</p>
					</div>
				</li>
				<? endforeach ?>
			</ul>
		</div>
		<div id="co_03" class="hidden">该功能暂未实现
		</div>
	</div>
	
<!-- 	创建	活动 -->
<div id="popup2" class="popup_block">
<div id="add-corporation">
			<?=form_open('corporation/do_add','class="form"')?>
				<p ><label>活动名称：</label><?=form_input('name') ?></p>
				<p ><label>活动地点：</label><?=form_dropdown('school', array('1'=> '川大江安', '0' => '川大望江')) ?></p>
				<p class="hidden"><label>所在地：</label><?=form_dropdown('gender', array('0'=> '四川')) ?></p>
				<p ><label>活动时间：</label><input type="text" size="30" id="datepicker" class=""/></p>
				<p ><label>活动简介：</label><?=form_textarea(array('name' => 'comment', 'cols' => 30, 'rows' => 10)) ?></textarea></p>
				<p class="li_c"><?=form_submit('submit', '保存','class="button"') ?></p>
			<?=form_close() ?>
			<script type="text/javascript">
			$(document).ready(function(){
				$(function() {
					$("#datepicker").datepicker();
				});
			});
			</script>
	
</div>  
</div>