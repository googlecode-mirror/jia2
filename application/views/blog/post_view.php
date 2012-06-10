<script>
$(function(){
	$(".Checked").toggle(function(){
			$(this).removeClass("Checked").addClass("Checkbox");
			$(this).children().removeAttr('checked');
		},function(){
			$(this).removeClass("Checkbox").addClass("Checked");
			$(this).children().attr("checked", "checked");
		})
	$(".Checkbox").toggle(function(){
			$(this).removeClass("Checkbox").addClass("Checked");
			$(this).children().attr("checked", "checked");
		},function(){
			$(this).removeClass("Checked").addClass("Checkbox");
			$(this).children().removeAttr('checked');
		})
})
</script> 
<h4 class="title_01 title_02"><span>发布日志</span><a>返回日志页面</a></h4>
<div class="main_02">
	<div id="post_blog">
		<p><?=form_open('blog/post') ?> </p>
	    <div id="blog_write">
			<div><label>标&nbsp;题：</label>
					<div class="InputWrapper"><div class="InputInner">
						<?=form_input('title') ?>
					</div></div>
			</div>
			<div><label>标&nbsp;签：</label>
					<div class="InputWrapper"><div class="InputInner">
						<?=form_input('tag') ?>
					</div></div>
					<span class="info_notice">多个标签请用空格隔开</span>
			</div>
		</div>
		<?=$this->load->view('blog/editor') ?>
		<p class="li_d p_buttons">
			<?=form_submit('submit', '取消','class="pub_button left"') ?>
			<?=form_submit('submit', '直接发布','class="btn-blue btn-pub-01 right"') ?>
			<?=form_submit('submit', '保存到草稿','class="pub_button btn-pub-02"') ?>
			
		</p>
	</div>
</div>
<div class="right_handler">
	<h4 class="set_title">设置知道</h4>
	<p>
		<span class="CheckboxWrapper Checked">
			<input type="checkbox" name="user" value="1" class="chbox" checked="checked"/>
		</span>
		<span class="Checkitem">置顶</span>
	</p><p>
		<span class="CheckboxWrapper Checkbox">
			<input type="checkbox" name="corporation" value="1" class="chbox"/>
		</span>
		<span class="Checkitem">设为社团历程</span>
	</p>
	<h4 class="set_title">隐私设置</h4>
	<ul>
			<li ><label>浏览权限: </label>
				<select><option>仅自己可见</option><option>粉丝可见</option><option>注册用户可见</option><option>公开</option></select>
			</li>
			<li ><label>评论权限: </label>
				<select><option>仅自己可见</option><option>粉丝可见</option><option>注册用户可见</option><option>公开</option></select>
			</li>
	</ul>
	<p class="line"><?=form_submit('submit', '确定','class="pub_button"') ?></p>
</div>