/**
 * @author Tiramisu
 */

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
					_this.$(menus[j]).className = closeClass;
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
function setingtab(){
	var SDmodel = new scrollDoor();
	SDmodel.sd(["s01", "s02", "s03","s04"], ["c01", "c02", "c03","c04"], "sd01", "sd02");//设置页面
}
function searchtab(){
	var SDmodel = new scrollDoor();
	SDmodel.sd(["01", "02", "03", "04"], ["search_result_01", "search_result_02", "search_result_03", "search_result_04"], "sd01", "sd02");//搜索
}
function posttab(){
	var SDmodel = new scrollDoor();
	SDmodel.sd(["po1", "po2", "po3"], ["f_01", "f_02", "f_03"], "sd01", "sd02");//post
}
