<script>
	/**
 * @author Tiramisu
 */
function scrollDoor(){
}
scrollDoor.prototype = {
	sd : function(menus,divs,openClass,closeClass){
		var _this = this;
		if(menus.length != divs.length)
		{
			alert("菜单层数量和内容层数量不一样!");
			return false;
		}				
		for(var i = 0 ; i < menus.length ; i++)
		{	
			_this.$(menus[i]).value = i;				
			_this.$(menus[i]).onclick = function(){					
				for(var j = 0 ; j < menus.length ; j++)
				{						
					_this.$(menus[j]).className = closeClass;
					_this.$(divs[j]).style.display = "none";
				}
				_this.$(menus[this.value]).className = openClass;	
				_this.$(divs[this.value]).style.display = "block";				
			}
		}
		},
	$ : function(oid){
		if(typeof(oid) == "string")
		return document.getElementById(oid);
		return oid;
	}
}
window.onload = function(){
	var SDmodel = new scrollDoor();
	SDmodel.sd(["01", "02", "03","04"], ["search_result_01", "search_result_02", "search_result_03","search_result_04"], "sd01", "sd02");
}
</script>
<div class="container">
	<div class="content_main" id="search_page">
		<h3>&nbsp;搜索&nbsp;“张晖”<span>找到100+条结果</span></h3>
		<div id="search_box">
			<div id="search-bar">
			<?=form_input('keywords','','class="serch_input"') ?>
			<?=form_button('search', '搜索','class="serch_button"') ?>
			<a>高级搜索</a>
			
			</div>
		</div>
		<div id="search_item">
			<div  class="tab">
				<ul>
					<li class="sd01" id="01">
						<a href="#" id="active">全部结果&nbsp;100+</a>
					</li>
					<li class="sd02" id="02">
						<a href="#">人名&nbsp;100+</a>
					</li>
					<li class="sd02" id="03">
						<a href="#">社团&nbsp;0</a>
					</li>
					<li class="sd02" id="04">
						<a href="#">活动&nbsp;0</a>
					</li>
				</ul>
			</div>
		</div>
		<div id="search_result_01" class="search_result">
			<h4>人名 <span>100+条结果</span></h4>
			<ul id="user-result">
				<li>
					<a href="#" class="head_pic"> <img /></a>
					<div class="li_mbox"><h3><a href="#">张晖</a></h3>
						成都信息工程大学<br />
						启明拓展协会<br />
					</div>
					<a href="#" class="li_r">加为好友</a>
				</li>
			</ul>
		</div>
		<div id="search_result_02" class="hidden search_result">
			<h4>人名 <span>100+条结果</span></h4>
		</div>
		<div id="search_result_03" class="hidden search_result">
			<h4>社团 <span>100+条结果</span></h4>
		</div>
		<div id="search_result_04" class="hidden search_result">
			<h4>活动 <span>100+条结果</span></h4>
		</div>
		

	
	</div>
</div>

<!--
<div id="search-bar">
	<?=form_input('keywords') ?>
	<?=form_button('search', '搜索') ?>
</div>
<div id="search-result">
	<ul id="user-result">
		<? if(isset($user_result)): ?>
		<? foreach($user_result as $row): ?>
		<li>
			<div>
				<h3><?=$row['name'] ?></h3>
				<img src="<?=$row['avatar']?>" />
			</div>
		</li>
		<? endforeach ?>
		<? endif ?>
	</ul>
</div>-->