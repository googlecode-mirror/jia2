<script>
	window.onload = coprotab;
</script>
		
<div>	
		<div class="admin-options">
		<p>
			<?=anchor('activity/add/' . $info['id'], '创建活动')?>
		</p>
		<p>
			<?=anchor('corporation/setting/' . $info['id'], '社团设置')
			?>
		</p>
	</div>
</div>
<div id="sidebar">
	<div class="user_head_box sidebar_nav">
		<a href="<?=site_url('corporation/profile/' . $info['id'])?>" class="user_head"> <img id="" title="修改头像" src="<?=avatar_url($info['avatar'], 'corporation', 'big') ?>" /> </a>
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
			<?=form_button(array('name' => 'join', 'content' => '已加入', 'id' => $info['id'], 'disabled' => 'disabled'))?>
			<?=form_button(array('name' => 'unjoin', 'content' => '退出社团', 'id' => $info['id']))?>
		<? else:?>
			<?=form_button(array('name' => 'join', 'content' => '请求加入', 'id' => $info['id']))?>
			
		<? endif?>
	<? endif ?>
	</p>
	<div class="sidebar_nav">
		<h4><strong>协会信息</strong></h4>
		<ul class="asso_info">
			<li>
				社长：<?=anchor('personal/profile/' . $info['user'][0]['id'], $info['user'][0]['name']) ?>
			</li>
			<li>
				分　类：<a href="#">情感</a>  <a href="">象牙塔</a>
			</li>
			<li>
				编　号：00001
			</li>
		</ul>
		<p class="f-aaa">
			2011-10-24由 <?=$info['user'][0]['name'] ?> 创建
		</p>
	</div>
	<div class="sidebar_nav">
		<h4>协会成员<?=count($members) ?></h4>
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
		<h3><?=$info['name'] ?><span> (20个成员)</span></h3>
		<p>
			<?=$info['comment'] ?>
		</p>
		<p class="operate">
			<span>以加入社团</span>
			|
			<span><a href="">管理社团</a></span>
			|
			<span><a href="">退出社团</a></span>
		</p>
		<?=anchor('activity/add/' . $info['id'], '创建活动')?>
		<!--
		<a href="#?w=500" rel="popup3" class="creat_button creat_act inline">创建活动</a>
		-->
	</div>
	<div class="search_item">
		<ul>
			<li class="sd01" id="co-01">
				<a href="#" id="active">活动日志&nbsp;(2)</a>
			</li>
			<li class="sd02" id="co-02">
				<a href="#">活动相册&nbsp;(6)</a>
			</li>
			<li class="sd02" id="co-03">
				<a href="#">状态&nbsp;(6)</a>
			</li>
		</ul>
	</div>
	<div id="feeds_container" class="feeds"></div>
		<div id="co_01">活动日志&nbsp
		</div>
		<div id="co_02" class="hidden">活动相册&nbsp
		</div>
		<div id="co_03" class="hidden">状态&nbsp
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