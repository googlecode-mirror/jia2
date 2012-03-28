<?php
/*
 * class: My_Controller
 * filename: MY_Controller.php
 * description :继承于CI_Controller 重写_remap() 方法，实现在url中隐藏控制器中index方法
 * author :zhanghui rabbitzhang52@gmail.com
 * create :2012年3月26日19:34:32
 */
	class MY_Controller extends CI_Controller {
		function __construct() {
			parent::__construct();
		}
		
		function _remap($method) {
			if(method_exists($this, $method)) {
				$this->$method();
			} else {
				$this->index($method);
			}
		}
	}