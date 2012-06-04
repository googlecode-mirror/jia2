<script type="text/javascript" src="<?=base_url('resource/SWFUpload/swfupload.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('resource/SWFUpload/plugins/handlers.js') ?>"></script>
<script>

		var swfu;
		var swfu2;

		window.onload = function() {
			var settings = {
				flash_url : "<?=base_url('resource/SWFUpload/Flash/swfupload.swf') ?>",
				upload_url : "http://www.swfupload.org/upload.php",
				post_params: {"PHPSESSID" : ""},
				file_size_limit : "100 MB",
				file_types : "*.*",
				file_types_description : "All Files",
				file_upload_limit : 100,
				file_queue_limit : 0,
				custom_settings : {
					progressTarget : "fsUploadProgress",
					cancelButtonId : "btnCancel"
				},
				debug: false,

				// Button settings
				button_placeholder_id: "spanButtonPlaceHolder",
				button_image_url: "<?=base_url('resource/img/swfload_btn1.png') ?>",
				button_width: "88",
				button_height: "30",
				// button_text: '<b class="theFont">浏览</b>',
				// button_text_style: ".theFont {color: #ffffff; font-size: 12; font-weight: bold}",
				button_text_left_padding:30,
				button_text_top_padding:5,

				// The event handler functions are defined in handlers.js
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,
				queue_complete_handler : queueComplete	// Queue plugin event
			};
			swfu = new SWFUpload(settings);
			
			var settings2 = {
				flash_url : "<?=base_url('resource/SWFUpload/Flash/swfupload.swf') ?>",
				upload_url : "http://www.swfupload.org/upload.php",
				post_params: {"PHPSESSID" : ""},
				file_size_limit : "100 MB",
				file_types : "*.*",
				file_types_description : "All Files",
				file_upload_limit : 100,
				file_queue_limit : 0,
				custom_settings : {
					progressTarget : "fsUploadProgress2",
					cancelButtonId : "btnCancel"
				},
				debug: false,

				// Button settings
				button_placeholder_id: "spanButtonPlaceHolder2",
				button_image_url: "<?=base_url('resource/img/swfload_btn1.png') ?>",
				button_width: "88",
				button_height: "30",
				// button_text: '<b class="theFont">浏览</b>',
				// button_text_style: ".theFont {color: #ffffff; font-size: 12; font-weight: bold}",
				button_text_left_padding:30,
				button_text_top_padding:5,

				// The event handler functions are defined in handlers.js
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,
				queue_complete_handler : queueComplete	// Queue plugin event
			};
			swfu2 = new SWFUpload(settings2);
	     };
</script>

<div id="main">
<div id="request_comment">
	<p>申请细则：</p>
	<p>1. 申请创建社团需要通过实名认证，需要填写学生信息以及公民身份信息，你填写的身份信息最好和当前账号信息保持一致(姓名)</p>
	<p>2. 上传身份证以及学生证照，请确保字迹可辨认，以便管理员审核通过</p>
	<p>3. 申请创建的社团名将不可更改</p>
	<p>4. 如果审核通过，你会收到一条通知将指引你创建该社团, 并且改社团的省份以及学校信息与你的一直，不可更改</p>
	<p>5. 管理员审核之后无论通过与否你都将会收到一条通知</p>
	<p><?=form_button('roger_that', '明白', 'id="roger_that" class="pub_button"') ?></p>
</div>
<div id="add-corporation" class="hidden" >
	<?=form_open_multipart('corporation/request_add','class="form" id="request_form"')?>
	<div id="fsUploadProgress"></div>
	<div id="fsUploadProgress2"></div>
		<span ><label>学号：</label>
			<div class="InputWrapper">
			<div class="InputInner">
					<?=form_input('st_card_number') ?>
			</div>
			</div>
		</span>
		<span class="swf_box"><label>学生证照：</label>
			<b href="#" class="btn-blue" id="spanButtonPlaceHolder" onclick="swfu.startUpload();">浏览	</b>
			<input id="btnCancel" type="button" value="取消上传" onclick="swfu.cancelQueue();" class="pub_button file_btn file_btn1" disabled="disabled" />
			
		</span>
		<span ><label>身份证号：</label>
			<div class="InputWrapper">
			<div class="InputInner">
					<?=form_input('id_card_number') ?>
			</div>
			</div>
		</span>
		<span class="swf_box"><label>身份证照：</label>
			<b href="#" class="btn-blue" id="spanButtonPlaceHolder2">浏览</b>
			<input id="btnCancel2" type="button" value="取消上传" onclick="swfu.cancelQueue();" class="pub_button file_btn file_btn1" disabled="disabled" />
			
		</span>
		<span ><label>创建社团名：</label>
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