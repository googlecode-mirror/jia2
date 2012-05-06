<?=form_open('')?>
<?=form_button('letter', '写送站内信','id="write_letter"') ?>
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
<? if(!empty($letter)): ?>
	<ul>
	<? foreach($letters as $letter): ?>
		<li class="mes_li">
			<div class="left">
				<?=anchor('personal/profile/' . $letter['user'][0]['id'], '<img src="'. avatar_url($letter['user'][0]['avatar']) .'" >','class="head_pic"') ?>
				</div>
				<div class="left">
				<?=anchor('personal/profile/' . $letter['user'][0]['id'],$letter['user'][0]['name'])?>
				<?=$letter['content'] ?>
				<?=jdate($letter['time']) ?>
				</div>
		</li>
	<? endforeach ?>
	</ul>
<? endif?>