<script type="text/javascript" src="<?=base_url('resource/SWFUpload/swfupload.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('resource/SWFUpload/plugins/handlers.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('resource/SWFUpload/plugins/swfupload.queue.js') ?>"></script>
<script type="text/javascript" src="<?=base_url('resource/SWFUpload/plugins/fileprogress.js') ?>"></script>
<script>

		var swfu;
		var swfu2;

		window.onload = function() {
			swfu = new SWFUpload({
                    // Backend Settings
                    upload_url: "localhost/SwfUpload/upload.php",
                    post_params: {"PHPSESSID": "<?php echo session_id(); ?>"},

                    // File Upload Settings
                    file_size_limit : "2 MB",	// 2MB
                    file_types : "*.jpg",
                    file_types_description : "JPG Images",
                    file_upload_limit : "0",

                    // Event Handler Settings - these functions as defined in Handlers.js
                    //  The handlers are not part of SWFUpload but are part of my website and control how
                    //  my website reacts to the SWFUpload events.
                    file_queued_handler : fileQueued,
                    file_queue_error_handler : fileQueueError,
                    file_dialog_complete_handler : fileDialogComplete,
                    upload_progress_handler : uploadProgress,
                    upload_error_handler : uploadError,
                    upload_success_handler : uploadSuccess,
                    upload_complete_handler : uploadComplete,

                    // Button Settings
                    button_image_url : "images/swfupload/SmallSpyGlassWithTransperancy_17x18.png",
                    button_placeholder_id : "spanButtonPlaceholder",
                    button_width: 180,
                    button_height: 18,
                    button_text : '<span class="button">选择图片<span class="btn_startupload">(最大 2 MB)</span></span>',
                    button_text_style : '.button { font-family: Helvetica, Arial, sans-serif; font-size: 12px; }',
                    button_text_top_padding: 0,
                    button_text_left_padding: 18,
                    button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
                    button_cursor: SWFUpload.CURSOR.HAND,

                    // Flash Settings
                    flash_url : "<?=base_url('resource/SWFUpload/Flash/swfupload.swf') ?>",

                    custom_settings : {
                        progressTarget : "fsUploadProgress",
                        cancelButtonId : "btnCancel"
                    },

                    // Debug Settings
                    debug: false
                });
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
	 <div id="content">
        <h2>Swfupload PHP Ajax上传示例</h2>
        <p>图片由SWFUpload上传，然后无刷新显示缩略图</p>
        <form>
            <div class="fieldset flash" id="fsUploadProgress">
                <span class="legend">上传队列</span>
            </div>
            <div style="display: inline; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding: 2px;">
                <span id="spanButtonPlaceholder"></span>&nbsp;
                <input type="button" value="开始上传" class="btn_startupload" onclick="swfu.startUpload();"/>
                <input type="button" value="取消上传" id="btnCancel" onclick="swfu.startUpload();"/>
            </div>
        </form>
        <div id="thumbnails"></div>
    </div>
	<!--
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
			 <div class="fieldset flash" id="fsUploadProgress1">
               <span class="legend">上传队列</span>
             </div>
			<b href="#" class="btn-blue" id="spanButtonPlaceHolder" onclick="swfu.startUpload();">选择	</b>
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
			 <div class="fieldset flash" id="fsUploadProgress2">
              <span class="legend">上传队列</span>
              </div>
			<b href="#" class="btn-blue" id="spanButtonPlaceHolder2">选择</b>
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
-->
</div>  
</div>