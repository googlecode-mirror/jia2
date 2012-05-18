<div id="main">
<div id="request_comment">
	<p>申请细则：</p>
	<p>1. 申请创建社团需要通过实名认证，需要填写学生信息以及公民身份信息，你填写的身份信息最好和当前账号信息保持一致(姓名)</p>
	<p>2. 上传身份证以及学生证照，请确保字迹可辨认，以便管理员审核通过</p>
	<p>3. 申请创建的社团名将不可更改</p>
	<p>4. 如果审核通过，你会收到一条通知将指引你创建该社团</p>
	<p>5. 管理员审核之后无论通过与否你都将会收到一条通知</p>
	<p><?=form_button('roger_that', '明白', 'id="roger_that" class="pub_button"') ?></p>
</div>
<div id="add-corporation" class="hidden" >
	<?=form_open_multipart('corporation/request_add','class="form" id="request_form"')?>
		<span ><label>学号：</label>
			<div class="InputWrapper">
			<div class="InputInner">
					<?=form_input('st_card_number') ?>
			</div>
			</div>
		</span>
		<span class="btn-blue"><label>学生证照：</label>
			浏览<?=form_upload('st_card_cap') ?>
		</span>
		<span ><label>身份证号：</label>
			<div class="InputWrapper">
			<div class="InputInner">
					<?=form_input('id_card_number') ?>
			</div>
			</div>
		</span>
		<span class="btn-blue"><label>身份证照：</label>
				浏览<?=form_upload('id_card_cap') ?>
		</span>
		<span ><label>申请创建社团名：</label>
			<div class="InputWrapper">
			<div class="InputInner">
					<?=form_input('co_name') ?>
			</div>
			</div>
		</span>
		<span ><label>或许你有什么要对管理员说的，增加通过率哦亲~：</label>
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
							<?=form_textarea(array('name' => 'comment')) ?>
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
		<p class="li_d"><?=form_submit('submit', '提交申请','class="pub_button"') ?></p>
	<?=form_close() ?>
</div>  
</div>