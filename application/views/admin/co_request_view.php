<? if($requests): ?>
<? foreach($requests as $request): ?>
<div class="img_block">
	<?=anchor('personal/profile/' . $request['user'][0]['id'], '<img src="'. avatar_url($request['user'][0]['avatar']) .'" >','class="head_pic"') ?>
</div>
<div class="feed_main">
	<div class="f_info">
		<a href="<?=site_url('personal/profile/' . $request['user'][0]['id']) ?>"><?=$request['user'][0]['name']?>&nbsp;申请创建<?=$request['co_name'] ?>&nbsp;社团</a>
	</div>
	<div class="f_summary">
		<p class="f_pm">
			<span><?=jdate($request['time']) ?></span>
			<span><a class="col-c">查看详情</a></span>
		</p>
	</div>
	<div class="feeds_comment_box">
		<span ><label>学号：</label>
			<div class="InputWrapper">
			<div class="InputInner">
					<?=$request['st_card_number'] ?>
			</div>
			</div>
		</span>
		<span ><label>学生证：</label>
			<div class="InputWrapper">
			<div class="InputInner">
					<?=card_cap($request['st_card_cap']) ?>
			</div>
			</div>
		</span>
		<span ><label>身份证号：</label>
			<div class="InputWrapper">
			<div class="InputInner">
					<?=$request['id_card_number'] ?>
			</div>
			</div>
		</span>
		<span ><label>身份证：</label>
			<div class="InputWrapper">
			<div class="InputInner">
					<?=card_cap($request['id_card_cap']) ?>
			</div>
			</div>
		</span>
		<span ><label>申请创建社团名：</label>
			<div class="InputWrapper">
			<div class="InputInner">
					<?=$request['co_name'] ?>
			</div>
			</div>
		</span>
		<span ><label>申请备注：</label>
			<table class="Textarea">
			<tbody>
				<tr>
					<td id="Textarea-tl"></td>
					<td id="Textarea-tm"></td>
					<td id="Textarea-tr"></td>
				</tr>
				<tr>
					<td id="Textarea-ml"></td>
					<td id="Textarea-mm" class="">
						<div>
							<p><?=$request['comment'] ?></p>
						</div>
					</td>
					<td id="Textarea-mr"></td>
				</tr>
				<tr>
					<td id="Textarea-bl"></td>
					<td id="Textarea-bm"></td>
					<td id="Textarea-br"></td>
				</tr>
			</tbody>
			</table>
		</span>
	</div>
	</div>
<? endforeach ?>
<? endif ?>
<p>暂时没有未处理请求</p>