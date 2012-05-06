<?=form_open('')?>
<?=form_button('letter', '写站内信','id="write_letter"') ?>
<div id="write_letter_area" style="display:none">
	<p><label>收信人</label></p>
	<p><div class="InputWrapper">
			<div class="InputInner">
					<?=form_input('receiver', '', 'id="receiver"') ?>
			</div>
	</div></p>
	
	<p><label>內&nbsp;&nbsp;容</label></p>
	<p><table class="Textarea">
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
							<?=form_textarea(array('name' => 'content', 'id' => "letter_content")) ?>
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
	</p>
	<p ><?=form_button('submit', '发送', 'id="send_letter" disabled="disabled"') ?></p>
</div>
<?=form_close() ?>
<p><a id="in_box">收件箱</a>&nbsp;&nbsp;<a id="out_box">发件箱</a></p>
<div id="letter_box"></div>