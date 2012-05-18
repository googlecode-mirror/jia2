<div id="main">
<div id="add-corporation">
	<?=form_open('corporation/do_add','class="form"')?>
		<span ><label>学号：</label>
			<div class="InputWrapper">
			<div class="InputInner">
					<?=form_input('st_card_number') ?>
			</div>
			</div>
		</span>
		<span ><label>身份证号：</label>
			<div class="InputWrapper">
			<div class="InputInner">
					<?=form_input('id_card_number') ?>
			</div>
			</div>
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
		<p class="li_d"><?=form_submit('submit', '保存','class="pub_button"') ?></p>
	<?=form_close() ?>
</div>  
</div>