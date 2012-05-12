<!-- <div>
	<?=form_open('activity/do_add/' . $corporation['id']) ?>
	<p>活动名称: <?=form_input('name') ?></p>
	<p>活动地点: <?=form_input('address') ?></p>
	<p>活动开始时间: <?=form_input('start_time') ?></p>
	<p>活动结束时间: <?=form_input('deadline') ?></p>
	<p>活动概要: <?=form_textarea('comment') ?></p>
	<p><?=form_submit('submit', '创建') ?></p>
	<?=form_close() ?>
</div> -->

<div id="add-corporation">
			<?=form_open('activity/do_add/' . $corporation['id']) ?>
				<span ><label>活动名称：</label>
					<div class="InputWrapper"><div class="InputInner">
						<?=form_input('name') ?>
					</div></div>
				</span>
				<span ><label>活动地点：</label> <div class="InputWrapper"><div class="InputInner"><?=form_input('address') ?></div></div></span>
				<span ><label>活动时间：</label>
					<div class="InputWrapper"><div class="InputInner">
						<?=form_input('start_time', '', 'id="from"') ?>
					</div></div>
					<div class="InputWrapper"><div class="InputInner">
						<?=form_input('deadline','', 'id="to"') ?>
					</div></div>
				</span>
				<span ><label>活动简介：</label>
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
									<?=form_textarea('comment') ?>
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
			<script type="text/javascript">
			$(function() {  
	        	var dates = $( "#from, #to" ).datepicker({  
	            defaultDate: "+1w",  
	            changeMonth: true,  
	            numberOfMonths: 1,  
	            onSelect: function( selectedDate ) {  
	                var option = this.id == "from" ? "minDate" : "maxDate",  
	                    instance = $( this ).data( "datepicker" ),  
	                    date = $.datepicker.parseDate(  
	                        instance.settings.dateFormat ||  
	                        $.datepicker._defaults.dateFormat,  
	                        selectedDate, instance.settings );  
	                dates.not( this ).datepicker( "option", option, date );  
	            	}  
	        	});  
	    	});  
			</script>
	
</div>  