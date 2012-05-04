<?=form_button('letter', '写送站内信', 'id="write_letter"') ?>
<div id="write_letter_area" style="display:none">
	<p>收信人</p>
	<p><?=form_input('receiver', '', 'id="receiver"') ?></p>
	<p>內容</p>
	<p><?=form_textarea(array('name' => 'content', 'id' => "letter_content")) ?></p>
	<p><?=form_button('submit', '发送', 'id="send_letter" disabled="disabled"') ?></p>
</div>
<? if(!empty($letter)): ?>
	<ul>
	<? foreach($letters as $letter): ?>
		<li>
			
		</li>
	<? endforeach ?>
	</ul>
<? endif?>