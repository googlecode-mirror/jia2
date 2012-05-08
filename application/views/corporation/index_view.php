<script>
	window.onload = cotab;
</script>
<div id="main">
	<a href="<?=site_url('corporation/add') ?>" class="creat_button button"><i>+</i> 创建社团</a>
	<a href="#?w=500" rel="popup2"  class="creat_button button inline"><i>+</i> 创建社团</a>
	<div id="search_box">
		<div id="search-bar">
			<input type="text" name="keywords" class="serch_input" value="动漫/体育/科技/社科..."/>
			<input type="buttom" name="search" class="serch_button" value="搜索" />
		</div>
	</div>
	<div class="search_item">
		<ul>
			<li class="sd01" id="co-1">
				<a href="#" id="active">我的社团&nbsp;(2)</a>
			</li>
			<li class="sd02" id="co-2">
				<a href="#">我关注的社团&nbsp;(6)</a>
			</li>
		</ul>
	</div>
	<div id="feeds_container" class="feeds">
	<ul id="feed_1">
		<li class="feed_a">
			<div class="img_block"><img src="" /></div>
			<div class="feed_main">
				<h3 class="asso_name"><a href="<?=site_url('corporation/association-pro.html')?>">启明拓展协会</a><span>活动(6)</span><span>相册(6)</span><span>说说(20)</span></h3>
				<ul class="asso_ul">
					<li><a href="">启明拓展协会最新活动安排</a></li>
					<li><a href="">启明拓展协会的活动日志</a></li>
					<li><a href="">感谢群众还记得我</a></li>
				</ul>
			</div>
		</li>
		<li class="feed_a">
			<div class="img_block"><img src="" /></div>
			<div class="feed_main">
				<h3 class="asso_name"><a href="<?=site_url('corporation/association-pro.html')?>">启明拓展协会</a><span>活动(6)</span><span>相册(6)</span><span>说说(20)</span></h3>
				<ul class="asso_ul">
					<li><a href="">启明拓展协会最新活动安排</a></li>
					<li><a href="">启明拓展协会的活动日志</a></li>
					<li><a href="">感谢群众还记得我</a></li>
				</ul>
			</div>
		</li>
		
	</ul>
	<ul id="feed_2" class="hidden">我关注的社团
	</ul>
	</div>	
</div>

<!-- 	创建	社团 -->
<div id="popup2" class="popup_block">
<div id="add-corporation">
			<?=form_open('corporation/do_add','class="form"')?>
				<span ><label>社团名字：</label>
					<div class="InputWrapper">
					<div class="InputInner">
							<?=form_input('name') ?>
					</div>
					</div>
				</span>
				<span ><label>所属学校：</label>
					<?=form_dropdown('gender',array('1'=> '川大江安', '0' => '川大望江')) ?>
				</span>
				<span ><label>分配社长：</label>
					<div class="InputWrapper">
					<div class="InputInner">
							<?=form_input('master') ?>
					</div>
					</div>
				</span>
				<span ><label>社团简介：</label>
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
									<?=form_textarea(array('name' => 'content')) ?>
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
	
</div>  
</div>