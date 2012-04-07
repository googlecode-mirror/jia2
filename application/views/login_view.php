<div class="bg">
			<div class="login">
				<div class="title">
					Jia2网logo_<span>登录</span>
				</div>
				<div class="form_bg"></div>
				<?=form_open('index/do_login') ?>
					<div class="field">
						<label for="email">邮&nbsp; 　箱:</label>
						<input type="text" name="email" id="email" maxlength="32" tabindex="1" />
						<span class="prompt" id="email_prompt"></span>
					</div>
					<div class="field">
						<label>密&nbsp; 　码:</label>
						<span>
							<input type="password" name="pass" id="pass" maxlength="20" tabindex="2" />
						</span>
						<span class="prompt" id="pass_prompt"></span>
					</div>
					<div class="checkbox"></div>
					<div class="submit">
						<?=form_submit('submit', '登录', 'class="button"') ?>
						<span>|</span><span><?=anchor(site_url('index/regist'), '用户注册') ?> </span>
						<span><input type="checkbox" name="remmber" value="1"><span>记住我</span></span>
					</div>
				<?=form_close() ?>
			</div>
		</div>
		</div>