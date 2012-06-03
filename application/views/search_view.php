<script>
	window.onload=function(){
		return this.each(function(){
			if($(this).hasClass('jqTransformHidden')) {return;}

			var $input = $(this);
			var inputSelf = this;

			//set the click on the label
			var oLabel=jqTransformGetLabel($input);
			oLabel && oLabel.click(function(){aLink.trigger('click');});
			
			var aLink = $('<a href="#" class="jqTransformCheckbox"></a>');
			//wrap and add the link
			$input.addClass('jqTransformHidden').wrap('<span class="jqTransformCheckboxWrapper"></span>').parent().prepend(aLink);
			//on change, change the class of the link
			$input.change(function(){
				this.checked && aLink.addClass('jqTransformChecked') || aLink.removeClass('jqTransformChecked');
				return true;
			});
			// Click Handler, trigger the click and change event on the input
			aLink.click(function(){
				//do nothing if the original input is disabled
				if($input.attr('disabled')){return false;}
				//trigger the envents on the input object
				$input.trigger('click').trigger("change");	
				return false;
			});

			// set the default state
			this.checked && aLink.addClass('jqTransformChecked');		
		});
	}
</script>
<div id="main">
	<h3>&nbsp;搜索&nbsp;<span id="searh_key">“<?=trim($this->input->post('keywords')) ?>”</span></h3>
	<div id="search_box">
		<div id="search-bar">
			<?=form_open('search') ?>
			<?=form_hidden('offset', 0) ?>
			<?=form_input('keywords','','class="serch_input" id="in_search_content"')?>
			<?=form_submit('submit', '搜索','class="btn-blue" id="in_search"')?>
		</div>
	</div>
	<p id="chose_box">
		<div class="rowElem"><label>Checkbox: </label><input type="checkbox" name="chbox" id=""></div>
		<?=form_checkbox('user', 1, 'checked:checked') ?>用户
		<?=form_checkbox('corporation', 1) ?>社团
		<?=form_checkbox('activity', 1) ?>活动
	</p>
		<?=form_close() ?>
	<div class="search_item">
			<ul>
				<li class="sd01" id="01">
					<a href="#" id="active">搜索结果&nbsp;</a>
				</li>
			</ul>
	</div>
	<div id="search_result_01" class="search_result">
		<? if(isset($user_result)): ?>
		<h4>人名 <span><?=$user_rows?>条结果</span></h4>
		<ul id="user-result">
			<? if(isset($user_result)):?>
			<? foreach($user_result as $row):?>
			<li>
				<?=anchor_popup('personal/profile/' . $row['id'], '<img src="' . avatar_url($row['avatar'], 'personal', 'big') . '">', 'class="head_pic"')?>
				<div class="li_mbox">
					<h3><?=anchor_popup('personal/profile/' . $row['id'], $row['name'])?></h3>
					<p><?=$row['gender'] == 1 ? '男' : '女'?></p>
					<p><?=$row['province'][0]['name'] ?></p>
					<p><?=$row['school'][0]['name'] ?></p>
				</div>
			</li>
			<? endforeach?>
			<? endif?>
		</ul>
		<? endif ?>
		<? if(isset($corporation_result)): ?>
		<h4>社团 <span><?=$corporation_rows?>条结果</span></h4>
		<ul id="corporation-result">
			<? if(isset($corporation_result)):?>
			<? foreach($corporation_result as $row):?>
			<li>
				<?=anchor_popup('corporation/profile/' . $row['id'], '<img src="' . avatar_url($row['avatar'], 'corporation', 'big') . '">', 'class="head_pic"')?>
				<div class="li_mbox">
					<h3><?=anchor_popup('corporation/profile/' . $row['id'], $row['name'])?></h3>
				</div>
			</li>
			<? endforeach?>
			<? endif?>
		</ul>
		<? endif ?>
		<? if(isset($activity_result)): ?>
		<h4>活动 <span><?=$activity_rows?>条结果</span></h4>
		<ul id="activity-result">
			<? if(isset($activity_result)):?>
			<? foreach($activity_result as $row):?>
			<li>
				<?=anchor_popup('activity/view/' . $row['id'], '<img src="' . avatar_url($row['corporation'][0]['avatar'], 'corporation', 'big') . '">', 'class="head_pic"')
				?>
				<div class="li_mbox">
					<h3><?=anchor_popup('activity/view/' . $row['id'], $row['name'])
					?></h3>
				</div>
			</li>
			<? endforeach?>
			<? endif?>
		</ul>
		<? endif ?>
	</div>