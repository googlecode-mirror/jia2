<h4 class="title_01 title_02"><span>创建相册</span><a>返回个人页面</a></h4>
<div class="main_02">
	<div id="add-album">
		<?=form_open('album/create') ?>
		<span ><label>相册名称：</label>
			<div class="InputWrapper">
				<div class="InputInner">
					<?=form_input('name')?>
				</div>
			</div> </span>
		<span ><label>权限：</label>
			<select>
				<option>所有人可见</option>
				<option>粉丝可见</option>
			</select> </span>
		<span ><label>相册描述：</label>
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
							<?=form_textarea('comment')?>
						</div></td>
						<td id="Textarea-mr"></td>
					</tr>
					<tr>
						<td id="Textarea-bl"></td>
						<td id="Textarea-bm"></td>
						<td id="Textarea-br"></td>
					</tr>
				</tbody>
			</table> </span>
		<p class="li_d">
			<?=form_submit('submit', '保存','class="pub_button"')?>
			<a href="<?=site_url('album') ?>" class="pub_button">取消</a>
		</p>
		<?=form_close()?>
	</div>
</div>