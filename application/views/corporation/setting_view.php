<!-- <h4 class="set_title">设置新头像</h4>
<p class="p_1">	支持JPG、JPEG、GIF和PNG文件，最大2M。	</p>
<?=form_open_multipart('corporation/setting/' . $info['id']) ?>

<span href="" class="btn-blue">
	浏览
	<?=form_upload('userfile') ?>
</span>
<?=form_hidden('setting', 'avatar') ?>
<?=form_submit('submit', '上传','class="pub_button file_btn"') ?>
<?=form_close() ?>

<h4 class="set_title">当前头像</h4>
<img src="<?=avatar_url($info['avatar'], 'corporation', 'big') ?>" /> -->
<script>
		window.onload = copro_m_tab;
		</script>
<div id="main">
		<div class="search_item">
		<ul>
			<li class="sd01" id="coo-01">
				<a href="#" id="active">设置协会信息&nbsp;</a>
			</li>
			<li class="sd02" id="coo-02">
				<a href="#">管理协会成员&nbsp;(6)</a>
			</li>
			<li class="sd02" id="coo-03">
				<a href="#">设置协会头像&nbsp;(6)</a>
			</li>
		</ul>
		</div>
		<div id="feeds_container" class="feeds"></div>
			<div id="coo_01">
				<form class="form">
				<span><label>协会名称：</label>
					<div class="InputWrapper"><div class="InputInner">
						<input />
					</div></div>
				</span>
				<span><label>协会类型：</label><section>1<option>1</option></section></span>
				<span><label>所在学校：</label><section>1<option>1</option></section></span>
				<span><label>协会简介：</label><textarea></textarea></span>
				<p class="li_c"><?=form_submit('submit', '保存','class="pub_button btn_11"') ?></p>
				</form>
			</div>
			<div id="coo_02" class="hidden">
				<div id="manage">
					<a class="a-img"><img /></a>
					<p id="manager_01">	
						<span>管理员:</span><br />
						<a>名字</a>
					</p>
				</div>
				<ul id="member">
					<li>
						<a class="a-img"><img /></a>
						<div class="operate">
						<p><a>名字</a></p>	
						<p>	<span>
								<a>设置为管理员</a>
								 | 
								 <a>删除</a> 
							</span></p>	
						</div>
					</li><li>
						<a class="a-img"><img /></a>
						<div class="operate">
						<p><a>名字</a></p>	
						<p>	<span>
								<a>设置为管理员</a>
								 | 
								 <a>删除</a> 
							</span></p>	
						</div>
					</li>
					<li>
						<a class="a-img"><img /></a>
						<div class="operate">
						<p><a>名字</a></p>	
						<p>	<span>
								<a>设置为管理员</a>
								 | 
								 <a>删除</a> 
							</span></p>	
						</div>
					</li><li>
						<a class="a-img"><img /></a>
						<div class="operate">
						<p><a>名字</a></p>	
						<p>	<span>
								<a>设置为管理员</a>
								 | 
								 <a>删除</a> 
							</span></p>	
						</div>
					</li>
					<li>
						<a class="a-img"><img /></a>
						<div class="operate">
						<p><a>名字</a></p>	
						<p>	<span>
								<a>设置为管理员</a>
								 | 
								 <a>删除</a> 
							</span></p>	
						</div>
					</li><li>
						<a class="a-img"><img /></a>
						<div class="operate">
						<p><a>名字</a></p>	
						<p>	<span>
								<a>设置为管理员</a>
								 | 
								 <a>删除</a> 
							</span></p>	
						</div>
					</li>
					<li>
						<a class="a-img"><img /></a>
						<div class="operate">
						<p><a>名字</a></p>	
						<p>	<span>
								<a>设置为管理员</a>
								 | 
								 <a>删除</a> 
							</span></p>	
						</div>
					</li><li>
						<a class="a-img"><img /></a>
						<div class="operate">
						<p><a>名字</a></p>	
						<p>	<span>
								<a>设置为管理员</a>
								 | 
								 <a>删除</a> 
							</span></p>	
						</div>
					</li>
				</ul>
			</div>
			<div id="coo_03" class="hidden">
				<p class="p_1">	支持JPG、JPEG、GIF和PNG文件，最大2M。	</p>
				<?=form_open_multipart('corporation/setting/' . $info['id']) ?>
				
				<span href="" class="btn-blue">
					浏览
					<?=form_upload('userfile') ?>
				</span>
				<?=form_hidden('setting', 'avatar') ?>
				<?=form_submit('submit', '上传','class="pub_button file_btn"') ?>
				<?=form_close() ?>
				
				<h4 class="set_title">当前头像</h4>
				<img src="<?=avatar_url($info['avatar'], 'corporation', 'big') ?>" />
			</div>
		</div>