<?php
/*
 * class: My_Controller
 * filename: MY_Controller.php
 * description :继承于CI_Controller 重写_remap() 方法，实现在url中隐藏控制器中index方法
 * author :zhanghui rabbitzhang52@gmail.com
 * create :2012年3月26日19:34:32
 */
require_once APPPATH . 'libraries/jiadb.php';
require_once APPPATH . 'libraries/auth.php';
require_once APPPATH . 'libraries/access.php';
	class MY_Controller extends CI_Controller {
		public $jiadb;
		function __construct() {
			parent::__construct();
			$this->jiadb = new Jiadb('users');
		}
		/**
		 * @param string operation
		 * @param string post comment activity corporation
		 * @param array 
		 */
		function _auth($operation, $type, $owner_id, $master = '') {
			$auth = Auth_factory::get_auth($operation, $type, $owner_id, $master);
			$auth->get_access();
			if(!$auth->access) {
				show_error('No Right Access');
			}
		}
		
		function _remap($method) {
			if(method_exists($this, $method)) {
				$this->$method();
			} else {
				$this->index($method);
			}
		}
	}