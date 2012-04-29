/**
 * @author Tiramisu
 */

/*
function scrollDoor() {
}

scrollDoor.prototype = {
	sd : function(menus, divs, openClass, closeClass) {
		var _this = this;
		if(menus.length != divs.length) {
			alert("菜单层数量和内容层数量不一样!");
			return false;
		}
		for(var i = 0; i < menus.length; i++) {
			
			
			_this.$(menus[i]).value = i;
			_this.$(menus[i]).onclick = function() {
				for(var j = 0; j < menus.length; j++) {
					_this.$(menus[j]).className = closeClass;//出现效果了的
					_this.$(divs[j]).style.display = "none";
				}
				_this.$(menus[this.value]).className = openClass;
				_this.$(divs[this.value]).style.display = "block";
			}
		}
	},
	$ : function(oid) {
		if( typeof (oid) == "string")
			return document.getElementById(oid);
		return oid;
	}
}
window.onload = function() {
	var SDmodel = new scrollDoor();
	SDmodel.sd(["t1", "t2", "t3"], ["a1", "a2", "a3"], "sd01", "sd02");//游客页面
	SDmodel.sd(["m01", "m02"], ["c01", "c02"], "sd01", "sd02");//首页页面
	SDmodel.sd(["mm01", "mm02"], ["cc01", "cc02"], "sd01", "sd02");//首页页面
	SDmodel.sd(["mmm01", "mmm02", "mmm03"], ["ccc01", "ccc02", "ccc03"], "sd01", "sd02");;//设置页面
	SDmodel.sd(["01", "02", "03", "04"], ["search_result_01", "search_result_02", "search_result_03", "search_result_04"], "sd01", "sd02");//搜索页面
	
}
*/
