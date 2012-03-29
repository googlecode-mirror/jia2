<?php
/*
 * class: My_Controller
 * filename: MY_Controller.php
 * description :继承于CI_Controller 重写_remap() 方法，实现在url中隐藏控制器中index方法
 * author :zhanghui rabbitzhang52@gmail.com
 * create :2012年3月26日19:34:32
 */
require_once APPPATH . 'libraries/jiadb.php';
require_once APPPATH . 'libraries/user.php';
	class MY_Controller extends CI_Controller {
		public $jiadb;
		function __construct() {
			parent::__construct();
			$this->jiadb = new Jiadb('users');
		}
		
		function _auth($access = array(), $param = '') {
			$identity = $this->session->userdata('type');
			if($param) {
				if($param[0]['user_id'] == 3) {
					$identity = 'owner';
				} else {
					$user = $this->jiadb->fetchAll(array('id'=> 3));
					$this->jiadb->_table = 'user_type';
					$type = $this->jiadb->fetchAll(array('id'=> $user[0]['type_id']));
					$identity = $type[0]['name'];
				}
			}
			if(!in_array($identity, $access)) {
				show_error('No Right To Access');
			}
		}
	}