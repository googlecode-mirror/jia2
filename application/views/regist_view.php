<div class="bg">
	<div class="login register">
    <div class="title">Jia2网logo_<span>注册</span></div>
    <?=form_open('index/do_regist', 'id = "reg"') ?>
    	<div class="field">
            <label >邮&nbsp; 　箱：</label>
            <input type="text" name="email" id="email" value="" maxlength="32" tabindex="1" />
            <span class="prompt" id="email_prompt">请输入正确的邮箱</span>
        </div>
        <div class="field">
            <label>姓&nbsp; 　名：</label>
            <span >
             <input type="text" name="name" id="name" maxlength="20" tabindex="2" />
            </span>
            <span class="prompt" id="name_prompt">用户名长度不超过20个字符</span>            
         </div>
         <div class="field">
            <label >密&nbsp; 　码：</label>
            <span >
             <input type="password" name="pass" id="pass" maxlength="20" tabindex="2" />
            </span>
            <span class="prompt" id="pass_prompt">密码要求什么的</span>       
         </div>
         <div class="field_below">
         	<?=anchor('', '同意以下协议并') ?>
            <?=form_submit('submit', '注册', 'class="button"') ?>
         </div>  
    	<?=form_close() ?>
	</div>
    </div>
</div>