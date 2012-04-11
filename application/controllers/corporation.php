<?php
	class Corporation extends MY_Controller {
		function __construct() {
			parent::__construct();
		}
		// 社团之家~？
		function index() {
			static_view('这里将展示社团综合信息');
		}
		
		function profile() {
			static_view('这里将展示某个社团的信息');
		}
		
		function add() {
			$this->_require_login();
			$this->_auth('add', 'corporation', $this->session->userdata('id'));
			static_view('添加社团方法，需要最高管理员权限');
		}
		
		function setting($id = '') {
			static_view('这里将是社团信息设置页面，包括社团资料设置，头像设置，权限设置');
		}
	}