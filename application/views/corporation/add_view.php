<!-- <div id="add-corporation">
	<?=form_open('corporation/do_add') ?>
	<p>社团名字：<?=form_input('name') ?> </p>
	<p>所属学校：<?=form_dropdown('school', $schools) ?></p>
	<p>社团简介：<?=form_textarea('comment') ?></p>
	<p>分配社长：<?=form_input('master') ?></p>
	<p><?=form_submit('submit', '创建') ?></p>
	<?=form_close() ?>
</div> -->

<!-- 	创建	社团 -->
<div id="popup2" class="popup_block">
<div id="add-corporation">
			<?=form_open('corporation/do_add','class="form"')?>
				<span ><label>社团名字：</label>
					<div class="InputWrapper">
					<div class="InputInner">
							<?=form_input('name') ?>
					</div>
					</div>
				</span>
				<span ><label>所属学校：</label>
					<?=form_dropdown('gender',array('1'=> '川大江安', '0' => '川大望江')) ?>
				</span>
				<span ><label>分配社长：</label>
					<div class="InputWrapper">
					<div class="InputInner">
							<?=form_input('master') ?>
					</div>
					</div>
				</span>
				<span ><label>社团简介：</label>
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
									<?=form_textarea(array('name' => 'content')) ?>
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